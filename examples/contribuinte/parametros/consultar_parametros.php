<?php

/** @var \Nfse\Nfse $nfse */
$nfse = require_once __DIR__ . '/../../bootstrap.php';

try {
    $codigoMunicipio = '3550308'; // São Paulo
    
    echo "Consultando parâmetros do convênio para o município: $codigoMunicipio...\n";
    
    $parametros = $nfse->contribuinte()->consultarParametrosConvenio($codigoMunicipio);
    
    print_r($parametros);
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
