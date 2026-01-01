<?php

namespace Nfse\Tests\Unit\Service;

use Nfse\Service\MunicipioService;
use Nfse\Http\NfseContext;
use Nfse\Enums\TipoAmbiente;
use Nfse\Http\Client\AdnClient;
use Nfse\Http\Client\CncClient;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class MunicipioServiceTest extends TestCase
{
    private $context;
    private $service;
    private $adnClientMock;
    private $cncClientMock;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->context = new NfseContext(
            TipoAmbiente::Homologacao,
            '/tmp/cert.pfx',
            'password'
        );

        $this->adnClientMock = $this->createMock(AdnClient::class);
        $this->cncClientMock = $this->createMock(CncClient::class);
        
        $this->service = new MunicipioService($this->context);

        $reflection = new ReflectionClass($this->service);
        
        $adnProperty = $reflection->getProperty('adnClient');
        $adnProperty->setAccessible(true);
        $adnProperty->setValue($this->service, $this->adnClientMock);

        $cncProperty = $reflection->getProperty('cncClient');
        $cncProperty->setAccessible(true);
        $cncProperty->setValue($this->service, $this->cncClientMock);
    }

    public function testBaixarDfeMunicipio()
    {
        $this->adnClientMock->expects($this->once())
            ->method('baixarDfeMunicipio')
            ->with(100)
            ->willReturn(['dfe' => 'data']);

        $result = $this->service->baixarDfe(100);

        $this->assertEquals(['dfe' => 'data'], $result);
    }

    public function testEnviarLote()
    {
        $xmlZipB64 = 'base64data';
        $this->adnClientMock->expects($this->once())
            ->method('enviarLote')
            ->with($xmlZipB64)
            ->willReturn(['protocolo' => '123']);

        $result = $this->service->enviarLote($xmlZipB64);

        $this->assertEquals(['protocolo' => '123'], $result);
    }

    public function testConsultarContribuinte()
    {
        $this->cncClientMock->expects($this->once())
            ->method('consultarContribuinte')
            ->with('12345678000199')
            ->willReturn(['nome' => 'Empresa Teste']);

        $result = $this->service->consultarContribuinte('12345678000199');

        $this->assertEquals(['nome' => 'Empresa Teste'], $result);
    }
}
