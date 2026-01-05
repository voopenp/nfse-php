# v1.1.0-beta

## 🚀 Novidades

### Suporte Completo à Distribuição de Documentos (ADN)

Agora é possível baixar documentos fiscais tanto para Contribuintes quanto para Municípios com suporte total aos parâmetros da API Nacional.

-   **Contribuinte**: Adicionado suporte para `cnpjConsulta` (para consultar notas de terceiros/filiais) e controle de `lote`.
-   **Município**: Adicionado suporte para `tipoNSU` (RECEPCAO, DISTRIBUICAO, GERAL, MEI) e controle de `lote`.

### Melhorias na API Client

-   **Correção de Endpoints**: Ajuste nos caminhos da API para respeitar o Case Sensitivity (`/DFe`, `/NFSe`, `/Eventos`).
-   **Tratamento de Erros**: Mensagens de erro da API agora são capturadas e exibidas com mais detalhes nas exceções.
-   **Mapeamento de DTOs**: Correção no mapeamento de respostas que utilizam PascalCase (ex: `TipoAmbiente`, `UltimoNSU`).

## 🛠️ Correções

-   **Fix**: Resolvido erro `TypeError` ao tentar baixar DANFSe quando a chave de acesso não estava disponível.
-   **Fix**: Correção na descompactação de arquivos XML (GZIP) que estavam sendo tratados incorretamente como ZIP.
-   **Fix**: Remoção de chamadas depreciadas `setAccessible(true)` nos testes unitários.

## 📦 Alterações Internas

-   Atualização da documentação (`README.md` e `docs/`) com novos exemplos de uso.
-   Refatoração dos testes para garantir compatibilidade com as novas assinaturas de métodos.
