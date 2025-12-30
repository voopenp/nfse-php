# Atores (Participantes)

Estes DTOs identificam as partes envolvidas na prestação do serviço e na emissão do documento fiscal.

## PrestadorData

Identifica o estabelecimento ou pessoa física que presta o serviço.

### Propriedades

| Propriedade          | Tipo                   | Mapeamento XML | Descrição                          |
| :------------------- | :--------------------- | :------------- | :--------------------------------- |
| `cnpj`               | `string`               | `CNPJ`         | CNPJ do prestador (14 dígitos).    |
| `cpf`                | `string`               | `CPF`          | CPF do prestador (11 dígitos).     |
| `inscricaoMunicipal` | `string`               | `IM`           | Inscrição Municipal do prestador.  |
| `nome`               | `string`               | `xNome`        | Razão Social ou Nome do prestador. |
| `endereco`           | `EnderecoData`         | `end`          | Endereço completo do prestador.    |
| `regimeTributario`   | `RegimeTributarioData` | `regTrib`      | Detalhes do regime de tributação.  |

---

## TomadorData

Identifica o contratante do serviço.

### Propriedades

| Propriedade | Tipo           | Mapeamento XML | Descrição                                   |
| :---------- | :------------- | :------------- | :------------------------------------------ |
| `cnpj`      | `string`       | `CNPJ`         | CNPJ do tomador.                            |
| `cpf`       | `string`       | `CPF`          | CPF do tomador.                             |
| `nome`      | `string`       | `xNome`        | Razão Social ou Nome do tomador.            |
| `endereco`  | `EnderecoData` | `end`          | Endereço do tomador (Nacional ou Exterior). |

---

## IntermediarioData

Identifica o intermediário do serviço, se houver.

### Propriedades

| Propriedade | Tipo     | Mapeamento XML | Descrição              |
| :---------- | :------- | :------------- | :--------------------- |
| `cnpj`      | `string` | `CNPJ`         | CNPJ do intermediário. |
| `cpf`       | `string` | `CPF`          | CPF do intermediário.  |
| `nome`      | `string` | `xNome`        | Nome do intermediário. |

---

## EmitenteData

Utilizado na NFS-e para identificar a entidade que emitiu o documento (geralmente o município ou o sistema nacional).

### Propriedades

| Propriedade    | Tipo                   | Mapeamento XML | Descrição                      |
| :------------- | :--------------------- | :------------- | :----------------------------- |
| `cnpj`         | `string`               | `CNPJ`         | CNPJ da entidade emissora.     |
| `nome`         | `string`               | `xNome`        | Nome da entidade emissora.     |
| `nomeFantasia` | `string`               | `xFant`        | Nome fantasia da entidade.     |
| `endereco`     | `EnderecoEmitenteData` | `enderNac`     | Endereço nacional da entidade. |
