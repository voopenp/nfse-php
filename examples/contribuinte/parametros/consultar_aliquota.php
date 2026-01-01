<?php

/** @var \Nfse\Nfse $nfse */
$nfse = require_once __DIR__ . '/../../bootstrap.php';

try {
    $codigoMunicipio = '3550308';
    $codigoServico = '01.01';
    $competencia = '2023-10-01';
    
    echo "Consultando alíquota para o serviço $codigoServico no município $codigoMunicipio...\n";
    
    $aliquota = $nfse->contribuinte()->consultarAliquota($codigoMunicipio, $codigoServico, $competencia);
    
    print_r($aliquota);
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
