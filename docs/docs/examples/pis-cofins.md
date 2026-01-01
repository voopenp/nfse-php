# PIS/COFINS

Exemplo de preenchimento de campos relativos a PIS e COFINS, incluindo base de cálculo, alíquotas e valores retidos.

## Regras de Negócio

-   **CST**: Código da Situação Tributária do PIS/COFINS é obrigatório se houver informações de PIS/COFINS.
-   **Valores**: Se o CST indicar tributação, os valores de base de cálculo e alíquotas devem ser informados.

## Exemplo: PIS Zerado e COFINS sobre Faturamento

Neste exemplo, temos um cenário onde o PIS é zerado (alíquota 0.00%) e o COFINS incide sobre o faturamento (alíquota 7.60%), com retenção (tpRetPisCofins = 2).

```php
use Nfse\Dto\Nfse\ValoresData;
use Nfse\Dto\Nfse\TributacaoData;
use Nfse\Dto\Nfse\ValorServicoPrestadoData;

$valores = new ValoresData(
    valorServicoPrestado: new ValorServicoPrestadoData(
        valorRecebido: null,
        valorServico: 10000.00
    ),
    desconto: null,
    deducaoReducao: null,
    tributacao: new TributacaoData(
        tributacaoIssqn: 1,
        tipoImunidade: null,
        tipoRetencaoIssqn: 1,
        tipoSuspensao: null,
        numeroProcessoSuspensao: null,
        beneficioMunicipal: null,

        // Campos de PIS/COFINS
        cstPisCofins: '01', // 01 - Operação Tributável com Alíquota Básica
        baseCalculoPisCofins: 10000.00,
        aliquotaPis: 0.00,
        aliquotaCofins: 7.60,
        valorPis: 0.00,
        valorCofins: 760.00,
        tipoRetencaoPisCofins: 2, // 2 - Retido

        percentualTotalTributosSN: null,
        indicadorTotalTributos: null
    )
);
```

## Campos Adicionados

Os seguintes campos foram adicionados ao DTO `TributacaoData` para suportar este cenário:

-   `baseCalculoPisCofins`: Base de cálculo do PIS/COFINS.
-   `aliquotaPis`: Alíquota do PIS (em %).
-   `aliquotaCofins`: Alíquota do COFINS (em %).
-   `valorPis`: Valor monetário do PIS.
-   `valorCofins`: Valor monetário do COFINS.
-   `tipoRetencaoPisCofins`: Indicador de retenção (1 - Não Retido, 2 - Retido).
