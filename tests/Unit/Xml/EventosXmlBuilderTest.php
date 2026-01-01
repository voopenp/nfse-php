<?php

use Nfse\Dto\Nfse\InfPedRegData;
use Nfse\Dto\Nfse\PedRegEventoData;
use Nfse\Dto\Nfse\CancelamentoData;
use Nfse\Xml\EventosXmlBuilder;

it('builds a pedRegEvento xml for cancelamento', function () {
    $inf = new InfPedRegData(
        tipoAmbiente: 2,
        versaoAplicativo: '1.0',
        dataHoraEvento: '2025-01-01T12:00:00-03:00',
        cnpjAutor: '12345678000199',
        chaveNfse: '12345678901234567890123456789012345678901234567890',
        nPedRegEvento: 1,
        tipoEvento: '101101',
        e101101: new CancelamentoData(descricao: 'Cancelamento de NFS-e', codigoMotivo: '1', motivo: 'Teste')
    );

    $pedido = new PedRegEventoData(infPedReg: $inf);

    $xml = (new EventosXmlBuilder())->buildPedRegEvento($pedido);

    expect($xml)->toContain('<pedRegEvento');
    expect($xml)->toContain('<infPedReg Id="PRE12345678901234567890123456789012345678901234567890101101');
    expect($xml)->toContain('<e101101>');
    expect($xml)->toContain('<xMotivo>Teste</xMotivo>');
});
