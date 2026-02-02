<?php

namespace Nfse\Service;

use Nfse\Dto\Nfse\DpsData;
use Nfse\Dto\Nfse\NfseData;
use Nfse\Http\Client\AdnClient;
use Nfse\Http\Client\SefinClient;
use Nfse\Http\Contracts\SefinNacionalInterface;
use Nfse\Http\Exceptions\NfseApiException;
use Nfse\Http\NfseContext;
use Nfse\Signer\Certificate;
use Nfse\Signer\SignerInterface;
use Nfse\Signer\XmlSigner;
use Nfse\Xml\DpsXmlBuilder;
use Nfse\Xml\NfseXmlParser;
use Nfse\Dto\Nfse\InfEventoData;
use Nfse\Dto\Nfse\PedRegEventoData;
use Nfse\Dto\Nfse\InfPedRegData;
use Nfse\Dto\Nfse\CancelamentoData;
use Nfse\Xml\EventosXmlBuilder;

class ContribuinteService
{
    private SefinNacionalInterface $sefinClient;

    private AdnClient $adnClient;

    public function __construct(private NfseContext $context)
    {
        $this->sefinClient = new SefinClient($context);
        $this->adnClient = new AdnClient($context);
    }

    public function cancelarNfse(string $chaveAcesso, string $justificativa, int $numSeqEvento = 1): \Nfse\Dto\Http\RegistroEventoResponse
    {
        // 1) Monta o DTO do pedido de registro de evento (pedRegEvento)
        $evt = new InfEventoData;
        $evt->pedRegEvento = new PedRegEventoData;
        $evt->pedRegEvento->infPedReg = new InfPedRegData;
    
        // chave + sequência
        $evt->pedRegEvento->infPedReg->chaveAcesso = $chaveAcesso;
        $evt->pedRegEvento->infPedReg->numSeqEvento = $numSeqEvento;
    
        // tipo do evento (cancelamento)
        $evt->pedRegEvento->infPedReg->tipoEvento = '101101';
    
        // dados específicos do cancelamento (e101101)
        $cancel = new CancelamentoData;
        $cancel->xJust = $justificativa; // (nome do campo pode ser xJust mesmo; confirme no CancelamentoData)
        $evt->pedRegEvento->infPedReg->e101101 = $cancel;
    
        // 2) Build do XML
        $builder = new EventosXmlBuilder;
        $xml = $builder->build($evt);
    
        // 3) Assina a tag correta: "infPedReg" (está no schema e nos DTOs que você achou)
        $cert = new Certificate($this->context->certificatePath, $this->context->certificatePassword);
        $signer = $this->createSigner($cert);
        $signedXml = $signer->sign($xml, 'infPedReg');
    
        // 4) Envelope (GZIP + Base64)
        $eventoXmlGZipB64 = base64_encode(gzencode($signedXml));
    
        // 5) Envia o evento
        return $this->sefinClient->registrarEvento($chaveAcesso, $eventoXmlGZipB64);
    }
    
    public function downloadXmlNfse(string $chave): ?string
    {
        try {
            $response = $this->sefinClient->consultarNfse($chave);
        } catch (NfseApiException $e) {
            return null;
        }
    
        if (empty($response->nfseXmlGZipB64)) {
            return null;
        }
    
        $xml = gzdecode(base64_decode($response->nfseXmlGZipB64));
    
        if ($xml === false || trim($xml) === '') {
            return null;
        }
    
        return $xml;
    }


    /**
     * Emite uma NFS-e a partir de um DPS.
     */
    public function emitir(DpsData $dps): NfseData
    {
        $builder = new DpsXmlBuilder;
        $xml = $builder->build($dps);

        $cert = new Certificate($this->context->certificatePath, $this->context->certificatePassword);
        $signer = $this->createSigner($cert);

        // Assina a tag 'infDPS'
        $signedXml = $signer->sign($xml, 'infDPS');

        // Envelope (GZIP + Base64)
        $payload = base64_encode(gzencode($signedXml));

        // Transport
        $response = $this->sefinClient->emitirNfse($payload);

        if (! empty($response->erros)) {
            $msg = 'Erro na emissão: '.json_encode($response->erros);
            throw NfseApiException::responseError($msg);
        }

        if (! $response->nfseXmlGZipB64) {
            throw NfseApiException::responseError('Resposta sem XML da NFS-e.');
        }

        $nfseXml = gzdecode(base64_decode($response->nfseXmlGZipB64));

        $parser = new NfseXmlParser;

        return $parser->parse($nfseXml);
    }

    public function consultar(string $chave): ?NfseData
    {
        try {
            $response = $this->sefinClient->consultarNfse($chave);
        } catch (NfseApiException $e) {
            return null;
        }

        if (! $response->nfseXmlGZipB64) {
            return null;
        }

        $nfseXml = gzdecode(base64_decode($response->nfseXmlGZipB64));

        $parser = new NfseXmlParser;

        return $parser->parse($nfseXml);
    }

    public function consultarDps(string $idDps): \Nfse\Dto\Http\ConsultaDpsResponse
    {
        return $this->sefinClient->consultarDps($idDps);
    }

    public function downloadDanfse(string $chaveAcesso): string
    {
        return $this->adnClient->obterDanfse($chaveAcesso);
    }

    public function verificarDps(string $idDps): bool
    {
        return $this->sefinClient->verificarDps($idDps);
    }

    public function registrarEvento(string $chaveAcesso, string $eventoXmlGZipB64): \Nfse\Dto\Http\RegistroEventoResponse
    {
        return $this->sefinClient->registrarEvento($chaveAcesso, $eventoXmlGZipB64);
    }

    public function consultarEvento(string $chaveAcesso, int $tipoEvento, int $numSeqEvento): \Nfse\Dto\Http\RegistroEventoResponse
    {
        return $this->sefinClient->consultarEvento($chaveAcesso, $tipoEvento, $numSeqEvento);
    }

    public function listarEventos(string $chaveAcesso, ?int $tipoEvento = null): array
    {
        if ($tipoEvento) {
            return $this->sefinClient->listarEventosPorTipo($chaveAcesso, $tipoEvento);
        }

        return $this->sefinClient->listarEventos($chaveAcesso);
    }

    /**
     * ADN Contribuinte - Baixa documentos via NSU
     */
    public function baixarDfe(int $nsu, ?string $cnpjConsulta = null, bool $lote = true): \Nfse\Dto\Http\DistribuicaoDfeResponse
    {
        return $this->adnClient->baixarDfeContribuinte($nsu, $cnpjConsulta, $lote);
    }

    /**
     * ADN Contribuinte - Consulta eventos de uma nota
     */
    public function consultarEventos(string $chaveAcesso): array
    {
        return $this->adnClient->consultarEventosContribuinte($chaveAcesso);
    }

    public function consultarParametrosConvenio(string $codigoMunicipio): \Nfse\Dto\Http\ResultadoConsultaConfiguracoesConvenioResponse
    {
        return $this->adnClient->consultarParametrosConvenio($codigoMunicipio);
    }

    public function consultarAliquota(string $codigoMunicipio, string $codigoServico, string $competencia): \Nfse\Dto\Http\ResultadoConsultaAliquotasResponse
    {
        return $this->adnClient->consultarAliquota($codigoMunicipio, $codigoServico, $competencia);
    }

    public function consultarHistoricoAliquotas(string $codigoMunicipio, string $codigoServico): \Nfse\Dto\Http\ResultadoConsultaAliquotasResponse
    {
        return $this->adnClient->consultarHistoricoAliquotas($codigoMunicipio, $codigoServico);
    }

    public function consultarBeneficio(string $codigoMunicipio, string $numeroBeneficio, string $competencia): array
    {
        return $this->adnClient->consultarBeneficio($codigoMunicipio, $numeroBeneficio, $competencia);
    }

    public function consultarRegimesEspeciais(string $codigoMunicipio, string $codigoServico, string $competencia): array
    {
        return $this->adnClient->consultarRegimesEspeciais($codigoMunicipio, $codigoServico, $competencia);
    }

    public function consultarRetencoes(string $codigoMunicipio, string $competencia): array
    {
        return $this->adnClient->consultarRetencoes($codigoMunicipio, $competencia);
    }

    protected function createSigner(Certificate $certificate): SignerInterface
    {
        return new XmlSigner($certificate);
    }
}
