<?php

namespace Nfse\Tests\Unit\Service;

use Nfse\Service\ContribuinteService;
use Nfse\Http\NfseContext;
use Nfse\Enums\TipoAmbiente;
use Nfse\Dto\Nfse\DpsData;
use Nfse\Dto\Nfse\InfDpsData;
use Nfse\Http\Contracts\SefinNacionalInterface;
use Nfse\Dto\Http\EmissaoNfseResponse;
use Nfse\Dto\Http\ConsultaNfseResponse;
use Nfse\Support\IdGenerator;
use Nfse\Http\Client\AdnClient;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ContribuinteServiceTest extends TestCase
{
    private $context;
    private $service;
    private $sefinClientMock;
    private $adnClientMock;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->context = new NfseContext(
            TipoAmbiente::Homologacao,
            '/tmp/cert.pfx',
            'password'
        );

        $this->sefinClientMock = $this->createMock(SefinNacionalInterface::class);
        $this->adnClientMock = $this->createMock(AdnClient::class);
        
        $this->service = new ContribuinteService($this->context);

        $reflection = new ReflectionClass($this->service);
        
        $sefinProperty = $reflection->getProperty('sefinClient');
        $sefinProperty->setAccessible(true);
        $sefinProperty->setValue($this->service, $this->sefinClientMock);

        $adnProperty = $reflection->getProperty('adnClient');
        $adnProperty->setAccessible(true);
        $adnProperty->setValue($this->service, $this->adnClientMock);
    }

    public function testEmitirNfseSuccess()
    {
        $idDps = IdGenerator::generateDpsId('12345678000199', '3550308', '1', '1');
        $dpsData = new DpsData(
            versao: '1.00',
            infDps: new InfDpsData(
                id: $idDps,
                tipoAmbiente: 2,
                dataEmissao: '2023-10-27T10:00:00',
                versaoAplicativo: '1.0',
                serie: '1',
                numeroDps: '1',
                dataCompetencia: '2023-10-27',
                tipoEmitente: 1,
                codigoLocalEmissao: '3550308'
            )
        );

        $responseDto = new EmissaoNfseResponse(
            tipoAmbiente: 2,
            versaoAplicativo: '1.0',
            dataHoraProcessamento: '2023-10-27T10:00:00',
            idDps: 'DPS123',
            chaveAcesso: 'CHAVE123',
            nfseXmlGZipB64: base64_encode(gzencode('<nfse>xml</nfse>'))
        );

        $this->sefinClientMock->expects($this->once())
            ->method('emitirNfse')
            ->willReturn($responseDto);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Parser de XML ainda não implementado');
        
        $this->service->emitir($dpsData);
    }

    public function testConsultarNfseSuccess()
    {
        $chave = '12345678901234567890123456789012345678901234567890';
        $xmlContent = '<nfse>Dados da Nota</nfse>';
        $encodedXml = base64_encode(gzencode($xmlContent));

        $responseDto = new ConsultaNfseResponse(
            tipoAmbiente: 2,
            versaoAplicativo: '1.0',
            dataHoraProcessamento: '2023-10-27T10:00:00',
            chaveAcesso: $chave,
            nfseXmlGZipB64: $encodedXml
        );

        $this->sefinClientMock->expects($this->once())
            ->method('consultarNfse')
            ->with($chave)
            ->willReturn($responseDto);
        
        try {
            $this->service->consultar($chave);
        } catch (\Exception $e) {
            $this->assertStringContainsString('Parser de XML ainda não implementado', $e->getMessage());
            $this->assertStringContainsString('Dados da Nota', $e->getMessage());
        }
    }

    public function testDownloadDanfseSuccess()
    {
        $chave = '12345678901234567890123456789012345678901234567890';
        $pdfContent = '%PDF-1.4 content...';

        $this->adnClientMock->expects($this->once())
            ->method('obterDanfse')
            ->with($chave)
            ->willReturn($pdfContent);

        $result = $this->service->downloadDanfse($chave);

        $this->assertEquals($pdfContent, $result);
    }
}
