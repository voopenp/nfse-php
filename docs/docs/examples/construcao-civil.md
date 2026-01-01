# Construção Civil (Obra)

Para serviços de construção civil, é obrigatório informar os dados da obra.

## Regras de Negócio

-   **Obrigatoriedade**: O grupo `obra` é obrigatório para códigos de tributação como `07.02.01`, `07.02.02`, `07.04.01`, `07.05.01`, etc.
-   **Identificação da Obra**: Deve ser informada através de **pelo menos um** dos seguintes campos (Choice):
    -   `cObra`: Código da Obra (CIB - Cadastro Imobiliário Brasileiro / antigo CNO).
    -   `inscImobFisc`: Inscrição Imobiliária Fiscal.
    -   `end`: Endereço da Obra (se não houver CIB ou Inscrição).
-   **CIB (Cadastro Imobiliário Brasileiro)**: O CIB será de preenchimento obrigatório a partir de **2027**. Até lá, caso a obra não possua CIB, deve-se utilizar a Inscrição Imobiliária ou o Endereço da Obra.
-   **Endereço da Obra**: O CEP da obra deve pertencer ao município informado em `localPrestacao`.

## Exemplo de Código

```php
use Nfse\Dto\Nfse\ServicoData;
use Nfse\Dto\Nfse\ObraData;
use Nfse\Dto\Nfse\EnderecoData;
use Nfse\Dto\Nfse\LocalPrestacaoData;
use Nfse\Dto\Nfse\CodigoServicoData;

$servico = new ServicoData(
    localPrestacao: new LocalPrestacaoData(
        codigoLocalPrestacao: '3550308', // Município da obra (São Paulo)
        codigoPaisPrestacao: null
    ),
    codigoServico: new CodigoServicoData(
        codigoTributacaoNacional: '07.02.01', // Execução de obras...
        codigoTributacaoMunicipal: '702',
        descricaoServico: 'Construção Civil',
        codigoNbs: '123456789',
        codigoInternoContribuinte: null
    ),
    obra: new ObraData(
        inscricaoImobiliariaFiscal: '123.456.789-0', // Inscrição na prefeitura
        codigoObra: 'ART-2023/001',                  // Código ART ou Alvará
        endereco: new EnderecoData(
            codigoMunicipio: '3550308',
            cep: '01001000',
            logradouro: 'Rua da Obra',
            numero: 'SN',
            bairro: 'Centro',
            complemento: 'Lote 1',
            enderecoExterior: null
        )
    ),
    // ... outros campos
    comercioExterior: null,
    atividadeEvento: null
);
```

## Validações Comuns

-   **Erro E0370**: Grupo obra não informado para serviço de construção.
-   **Erro E0380**: CEP da obra não corresponde ao município da prestação.
