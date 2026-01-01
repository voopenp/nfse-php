<?php

namespace Nfse\Tests\Unit\Xml;

use Nfse\Dto\Nfse\CancelamentoData;
use Nfse\Dto\Nfse\InfPedRegData;
use Nfse\Dto\Nfse\PedRegEventoData;
use Nfse\Signer\Certificate;
use Nfse\Signer\XmlSigner;
use Nfse\Xml\EventosXmlBuilder;

it('builds, signs and encodes an evento payload', function () {
    $ch = '12345678901234567890123456789012345678901234567890';

    $inf = new InfPedRegData(
        tipoAmbiente: 2,
        versaoAplicativo: '1.0',
        dataHoraEvento: '2025-01-01T12:00:00-03:00',
        chaveNfse: $ch,
        nPedRegEvento: 3
    );

    $cancel = new CancelamentoData(descricao: 'Cancelamento', codigoMotivo: '1', motivo: 'Teste');
    // attach cancellation to infPedReg
    $inf = new InfPedRegData(
        tipoAmbiente: 2,
        versaoAplicativo: '1.0',
        dataHoraEvento: '2025-01-01T12:00:00-03:00',
        chaveNfse: $ch,
        nPedRegEvento: 3,
        e101101: $cancel
    );

    $pedido = new PedRegEventoData(infPedReg: $inf);

    $xml = (new EventosXmlBuilder)->buildPedRegEvento($pedido);
    expect($xml)->toContain('<pedRegEvento');

    $pfxPath = __DIR__.'/../../fixtures/certs/test.pfx';
    $password = '1234';

    $certificate = new Certificate($pfxPath, $password);
    $signer = new XmlSigner($certificate);

    // Sign the inner element that contains the Id attribute
    $signed = $signer->sign($xml, 'infPedReg');

    // The signed XML should contain a Signature and a Reference to the root Id
    $id = 'PRE'.$ch.'101101'.'003';
    expect($signed)->toContain('Signature xmlns')
        ->and($signed)->toContain('Reference URI="#'.$id.'"');

    $payload = base64_encode(gzencode($signed));
    expect($payload)->toBeString();

    // Roundtrip: decode and gunzip should return the original signed content
    $decoded = gzdecode(base64_decode($payload));
    expect($decoded)->toBe($signed);
});
