# Serviço e Localização

Estes DTOs detalham o que foi prestado, onde ocorreu a prestação e como o serviço é classificado.

## ServicoData

Agrupa todas as informações relativas ao serviço prestado.

### Propriedades

| Propriedade                 | Tipo                  | Mapeamento XML | Descrição                             |
| :-------------------------- | :-------------------- | :------------- | :------------------------------------ |
| `localPrestacao`            | `LocalPrestacaoData`  | `locPrest`     | Onde o serviço foi prestado.          |
| `codigoServico`             | `CodigoServicoData`   | `cServ`        | Classificação e descrição do serviço. |
| `informacoesComplementares` | `string`              | `infoComplem`  | Observações gerais sobre o serviço.   |
| `obra`                      | `ObraData`            | `obra`         | Dados da obra (se aplicável).         |
| `atividadeEvento`           | `AtividadeEventoData` | `atvEvento`    | Dados do evento (se aplicável).       |

---

## LocalPrestacaoData

Identifica a localidade geográfica da prestação.

### Propriedades

| Propriedade            | Tipo     | Mapeamento XML   | Descrição                                       |
| :--------------------- | :------- | :--------------- | :---------------------------------------------- |
| `codigoLocalPrestacao` | `string` | `cLocPrestacao`  | Código IBGE do município (ou 0000000 para mar). |
| `codigoPaisPrestacao`  | `string` | `cPaisPrestacao` | Código ISO2 do país (se exterior).              |

---

## CodigoServicoData

Define a classificação fiscal do serviço.

### Propriedades

| Propriedade                 | Tipo     | Mapeamento XML | Descrição                            |
| :-------------------------- | :------- | :------------- | :----------------------------------- |
| `codigoTributacaoNacional`  | `string` | `cTribNac`     | Código da LC 116/03 (ex: 01.01).     |
| `codigoTributacaoMunicipal` | `string` | `cTribMun`     | Código do serviço no município.      |
| `descricaoServico`          | `string` | `xDescServ`    | Descrição detalhada do serviço.      |
| `codigoNbs`                 | `string` | `cNBS`         | Nomenclatura Brasileira de Serviços. |

---

## EnderecoData

Estrutura universal para endereços na biblioteca.

### Propriedades

| Propriedade        | Tipo                   | Mapeamento XML | Descrição                               |
| :----------------- | :--------------------- | :------------- | :-------------------------------------- |
| `logradouro`       | `string`               | `xLgr`         | Nome da rua, avenida, etc.              |
| `numero`           | `string`               | `nro`          | Número do endereço.                     |
| `bairro`           | `string`               | `xBairro`      | Bairro.                                 |
| `codigoMunicipio`  | `string`               | `endNac.cMun`  | Código IBGE do município.               |
| `cep`              | `string`               | `endNac.CEP`   | CEP (8 dígitos).                        |
| `enderecoExterior` | `EnderecoExteriorData` | `endExt`       | Dados se o endereço for fora do Brasil. |
