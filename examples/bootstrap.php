<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Nfse\Http\NfseContext;
use Nfse\Nfse;

// Configurações básicas para os exemplos
$certificatePath = __DIR__ . '/cert.pfx';
$certificatePassword = 'password';

// Se o arquivo de certificado não existir, vamos avisar (apenas para o exemplo)
if (!file_exists($certificatePath)) {
    echo "AVISO: Arquivo de certificado não encontrado em: $certificatePath\n";
    echo "Para rodar estes exemplos, coloque seu certificado .pfx na pasta examples/ e ajuste a senha no arquivo bootstrap.php\n\n";
}

$context = new NfseContext(
    certificatePath: $certificatePath,
    certificatePassword: $certificatePassword,
    isProduction: false // Use false para ambiente de homologação
);

$nfse = new Nfse($context);

return $nfse;
