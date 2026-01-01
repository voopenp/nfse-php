# Regras do Schema DPS

A biblioteca implementa diversas regras de negócio e validações baseadas no documento `schema-dps.txt`. Abaixo estão algumas das regras mais importantes que foram mapeadas para os DTOs.

## Estrutura da DPS

### Identificador (ID)

O campo `ID` da DPS deve seguir um formato específico:

-   **Prefixo**: "DPS"
-   **Composição**: "DPS" + Cód.Mun.Emi. + Tipo Inscrição + Inscrição + Série + Número.
-   **Tamanho**: Deve ter entre 1 e 46 caracteres. (Regra E0002)

## Regras de Emissão

### Motivo da Emissão (cMotivoEmisTI)

-   Se o emitente for o prestador de serviço (`tpEmit = 1`), este campo **não deve** ser preenchido. (Regra E0029)

### Chave de NFS-e Rejeitada (chNFSeRej)

-   Somente permitido se o emitente for o Tomador ou Intermediário (`tpEmit = 2` ou `3`) e o motivo da emissão for a rejeição de NFS-e emitida pelo Prestador (`cMotivoEmisTI = 4`). (Regra E0034)

### Município Emissor (cLocEmi)

-   O código do município deve existir e estar ativo no cadastro de convênio municipal do sistema nacional. (Regra E0037/E0038)

## Regras de Substituição

### Chave Substituída (chSubstda)

-   Deve ser uma chave de NFS-e válida, existente e não cancelada. (Regras E0042, E0044, E0046)

### Prazos e Restrições

-   Não é permitida a substituição fora do prazo estabelecido pelo município emissor. (Regra E0050)
-   NFS-e sem identificação do tomador pode ter restrições para substituição dependendo da parametrização municipal. (Regra E0056)

## Regras de Identificação

### Tomador (toma)

-   **Email**: Deve ser informado conforme estrutura padrão (conter @, ponto, etc.). (Regra E0247)
-   **Endereço**: Se o tomador for identificado, o endereço nacional ou exterior torna-se obrigatório dependendo da residência.

### Intermediário (interm)

-   **CNPJ**: Deve ser um CNPJ válido (verificação de DV). (Regra E0248)
-   **Existência**: O CNPJ deve existir no cadastro nacional na data de competência informada. (Regra E0250)

## Regras de Valores e Deduções

### Dedução/Redução (vDedRed)

-   **Permissão por Serviço**: O código de serviço deve permitir dedução/redução conforme parametrização municipal. (Regra E0446)
-   **Alíquota Mínima**: O valor de dedução não pode resultar em uma alíquota efetiva menor que 2%, exceto para serviços específicos (7.02, 7.05, 16.01). (Regra E0447)
-   **Documentos**: Se houver dedução por documentos, estes devem ser informados e validados (Chave NFS-e, NF-e, etc.). (Regra E0449)

## Regras de Assinatura Digital

### Assinatura no DPS vs NFSe

-   **DPS**: A assinatura é **opcional** no schema XSD (`minOccurs="0"`). No entanto, para a maioria das integrações via API, a assinatura da tag `infDPS` é necessária para garantir a integridade.
-   **NFSe**: A assinatura é **obrigatória** no retorno da SEFIN.

### Padrão XML-DSig

A biblioteca segue o padrão oficial XML-DSig, garantindo que os elementos `SignedInfo`, `SignatureValue` e `KeyInfo` estejam presentes e corretos.

## Identificadores (IDs)

### ID do DPS (45 posições)

Regra de formação: `DPS` + `Cód.Mun (7)` + `Tipo Inscrição (1)` + `Inscrição (14)` + `Série (5)` + `Número (15)`.

-   O CPF deve ser completado com zeros à esquerda (14 posições).
-   A série NÃO pode ser composta apenas de zeros.

### ID da NFSe (53 posições)

Regra de formação: `NFS` + `Cód.Mun.(7)` + `Amb.Ger.(1)` + `Tipo Inscrição(1)` + `Inscrição(14)` + `No.NFS-e(13)` + `AnoMes Emis.(4)` + `Cód.Num.(9)` + `DV(1)`.

## Mapeamento de Campos

Os DTOs utilizam o atributo `#[MapInputName]` e `#[MapName]` para garantir que os campos do XML/JSON sejam corretamente mapeados para as propriedades PHP, respeitando as nomenclaturas do schema nacional.
