<?php

namespace Nfse\Service;

use Nfse\Http\Client\AdnClient;
use Nfse\Http\Client\CncClient;
use Nfse\Http\NfseContext;
use Nfse\Http\Exceptions\NfseApiException;

class MunicipioService
{
    private AdnClient $adnClient;
    private CncClient $cncClient;

    public function __construct(private NfseContext $context)
    {
        $this->adnClient = new AdnClient($context);
        $this->cncClient = new CncClient($context);
    }

    /**
     * ADN Município - Baixa arrecadação e notas do município via NSU
     */
    public function baixarDfe(int $nsu): array
    {
        return $this->adnClient->baixarDfeMunicipio($nsu);
    }

    /**
     * ADN Recepção - Envio de lote de documentos XML (DPS, Eventos)
     */
    public function enviarLote(string $xmlZipB64): array
    {
        return $this->adnClient->enviarLote($xmlZipB64);
    }

    /**
     * CNC Consulta - Consulta dados atuais de um contribuinte
     */
    public function consultarContribuinte(string $cpfCnpj): array
    {
        return $this->cncClient->consultarContribuinte($cpfCnpj);
    }

    /**
     * CNC Município - Baixa alterações no cadastro nacional via NSU
     */
    public function baixarAlteracoesCadastro(int $nsu): array
    {
        return $this->cncClient->baixarAlteracoesCadastro($nsu);
    }

    /**
     * CNC Recepção - Cadastra ou atualiza um contribuinte no CNC
     */
    public function atualizarContribuinte(array $dados): array
    {
        return $this->cncClient->atualizarContribuinte($dados);
    }
}
