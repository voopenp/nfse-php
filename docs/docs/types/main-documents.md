# Documentos Principais

Estes são os objetos raiz que representam os documentos fiscais no sistema.

## DpsData

Representa a **Declaração de Prestação de Serviço (DPS)**. É o documento enviado pelo contribuinte para solicitar a geração de uma NFS-e.

### Propriedades

| Propriedade | Tipo         | Mapeamento XML | Descrição                               |
| :---------- | :----------- | :------------- | :-------------------------------------- |
| `versao`    | `string`     | `@versao`      | Versão do layout da DPS.                |
| `infDps`    | `InfDpsData` | `infDPS`       | Grupo de informações detalhadas da DPS. |

---

## NfseData

Representa a **Nota Fiscal de Serviço Eletrônica (NFS-e)**. É o documento gerado pelo sistema nacional após o processamento de uma DPS.

### Propriedades

| Propriedade | Tipo          | Mapeamento XML | Descrição                                 |
| :---------- | :------------ | :------------- | :---------------------------------------- |
| `versao`    | `string`      | `versao`       | Versão do layout da NFS-e.                |
| `infNfse`   | `InfNfseData` | `infNFSe`      | Grupo de informações detalhadas da NFS-e. |
