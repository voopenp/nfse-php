# Valores e Tributação

Estes DTOs gerenciam os aspectos financeiros da prestação, incluindo valores brutos, retenções e regimes especiais.

## ValoresData

Consolida todos os valores financeiros da operação.

### Propriedades

| Propriedade            | Tipo                       | Mapeamento XML    | Descrição                                    |
| :--------------------- | :------------------------- | :---------------- | :------------------------------------------- |
| `valorServicoPrestado` | `ValorServicoPrestadoData` | `vServPrest`      | Valor bruto do serviço.                      |
| `desconto`             | `DescontoData`             | `vDescCondIncond` | Descontos aplicados.                         |
| `deducaoReducao`       | `DeducaoReducaoData`       | `vDedRed`         | Deduções da base de cálculo.                 |
| `tributacao`           | `TributacaoData`           | `trib`            | Detalhes da tributação (ISSQN, PIS, COFINS). |

---

## TributacaoData

Define como o serviço será tributado.

### Propriedades de ISSQN

| Propriedade         | Tipo  | Mapeamento XML            | Descrição                                                  |
| :------------------ | :---- | :------------------------ | :--------------------------------------------------------- |
| `tributacaoIssqn`   | `int` | `tribMun.tribISSQN`       | 1-Tributável, 2-Imunidade, 3-Exportação, 4-Não Incidência. |
| `tipoRetencaoIssqn` | `int` | `tribMun.tpRetISSQN`      | 1-Não Retido, 2-Retido Tomador, 3-Retido Intermediário.    |
| `tipoSuspensao`     | `int` | `tribMun.exigSusp.tpSusp` | 1-Judicial, 2-Administrativa.                              |

---

## RegimeTributarioData

Identifica o enquadramento fiscal do prestador.

### Propriedades

| Propriedade                | Tipo  | Mapeamento XML | Descrição                                       |
| :------------------------- | :---- | :------------- | :---------------------------------------------- |
| `opcaoSimplesNacional`     | `int` | `opSimpNac`    | 1-Não, 2-MEI, 3-ME/EPP.                         |
| `regimeEspecialTributacao` | `int` | `regEspTrib`   | 1-Estimativa, 3-Soc. Profissionais, 5-MEI, etc. |

---

## ValorServicoPrestadoData

Detalha o valor bruto recebido.

### Propriedades

| Propriedade     | Tipo    | Mapeamento XML | Descrição                                        |
| :-------------- | :------ | :------------- | :----------------------------------------------- |
| `valorServico`  | `float` | `vServ`        | Valor total do serviço.                          |
| `valorRecebido` | `float` | `vReceb`       | Valor recebido (obrigatório para intermediário). |
