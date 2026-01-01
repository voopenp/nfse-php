---
title: Visão Geral dos Serviços
sidebar_position: 1
---

# Serviços e Configuração 🛠️

O `nfse-php` oferece uma camada de serviços de alto nível que abstrai a complexidade da comunicação com o Sistema Nacional NFS-e. Em vez de lidar diretamente com clientes HTTP e assinaturas XML, você utiliza os serviços `ContribuinteService` e `MunicipioService`.

## NfseContext

Antes de utilizar qualquer serviço, você deve configurar o `NfseContext`. Ele armazena as credenciais e o ambiente de execução.

```php
use Nfse\Http\NfseContext;
use Nfse\Enums\TipoAmbiente;

$context = new NfseContext(
    ambiente: TipoAmbiente::Homologacao, // ou TipoAmbiente::Producao
    certificatePath: '/caminho/para/certificado.p12',
    certificatePassword: 'senha_do_certificado'
);
```

## Ponto de Entrada Principal

A classe `Nfse\Nfse` atua como uma fábrica para os serviços disponíveis.

```php
use Nfse\Nfse;

$nfse = new Nfse($context);

// Para operações de Prestador/Tomador
$contribuinte = $nfse->contribuinte();

// Para operações de Prefeitura (Município)
$municipio = $nfse->municipio();
```

## Estrutura de Serviços

A biblioteca separa as funcionalidades de acordo com o público-alvo e permissões:

### 👤 Contribuinte Service

Destinado a empresas e profissionais autônomos.

-   **Emissão**: Envio de DPS para geração de NFS-e.
-   **Consulta**: Recuperação de notas emitidas e eventos.
-   **Distribuição**: Download de documentos onde o contribuinte é parte.
-   **Parâmetros**: Consulta de alíquotas e regras municipais.

### 🏛️ Município Service

Destinado a prefeituras e órgãos de controle.

-   **Sincronização**: Download em lote de todos os documentos do município.
-   **Recepção**: Envio de lotes de documentos para o Ambiente Nacional.
-   **Cadastro (CNC)**: Gestão e consulta de contribuintes no Cadastro Nacional.

## Tratamento de Erros

A biblioteca utiliza `NfseApiException` para erros de comunicação e respostas da API.

```php
use Nfse\Http\Exceptions\NfseApiException;

try {
    $contribuinte->emitir($dps);
} catch (NfseApiException $e) {
    echo "Erro na API: " . $e->getMessage();
    // Detalhes adicionais podem estar disponíveis no código de erro
}
```
