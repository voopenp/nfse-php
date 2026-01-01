---
title: Eventos (Cancelamento)
sidebar_position: 3
---

Exemplo de criação e envio de evento (cancelamento) usando DTOs e o builder de XML.

```php
use Nfse\Dto\Nfse\PedRegEventoData;
use Nfse\Dto\Nfse\InfPedRegData;
use Nfse\Dto\Nfse\CancelamentoData;
use Nfse\Xml\EventosXmlBuilder;
use Nfse\Signer\Certificate;
use Nfse\Signer\XmlSigner;

// 1) Monte os dados do pedido
$inf = new InfPedRegData(
    tipoAmbiente: 2,
    versaoAplicativo: '1.0',
    dataHoraEvento: (new \DateTime())->format(DATE_ATOM),
    cnpjAutor: '12345678000199',
    chaveNfse: '12345678901234567890123456789012345678901234567890',
    nPedRegEvento: 1,
    tipoEvento: '101101', // cancelamento
    e101101: new CancelamentoData(
        descricao: 'Cancelamento de NFS-e',
        codigoMotivo: '1',
        motivo: 'Erro na emissão'
    )
);

$pedido = new PedRegEventoData(infPedReg: $inf);

// 2) Gerar o XML
$builder = new EventosXmlBuilder();
$pedidoXml = $builder->buildPedRegEvento($pedido);

// 3) Assinar o bloco (assina o elemento `infPedReg` que contém o atributo Id)
$cert = new Certificate('/path/to/cert.pfx', 'password');
$signer = new XmlSigner($cert);
$signedXml = $signer->sign($pedidoXml, 'infPedReg', 'Id', OPENSSL_ALGO_SHA1, [], 'pedRegEvento');

// 4) Compactar (gzip) e codificar em base64
$payload = base64_encode(gzencode($signedXml));

// 5) Registrar evento na NFS-e
$resultado = $service->registrarEvento($inf->chaveNfse, $payload);
if ($resultado->sucesso) {
    echo "Evento registrado com sucesso!";
}
```
