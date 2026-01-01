# Validações de DTOs

A biblioteca utiliza o pacote `spatie/laravel-data` para gerenciar DTOs e suas validações. As validações são aplicadas diretamente nas propriedades do construtor dos DTOs usando atributos PHP.

## Como funciona

Cada DTO define suas regras de validação através de atributos como `#[Required]`, `#[Max]`, `#[Size]`, etc.

Exemplo no `InfDpsData`:

```php
public function __construct(
    #[Required, Size(1, 46)]
    public ?string $id,

    #[Required, Max(1)]
    public ?int $tipoAmbiente,
    // ...
)
```

## Validando Dados

Para validar dados manualmente, você pode usar o método `validate`:

```php
use Nfse\Dto\Nfse\InfDpsData;

try {
    InfDpsData::validate($dados);
} catch (\Illuminate\Validation\ValidationException $e) {
    // Tratar erros de validação
    $errors = $e->errors();
}
```

Ou validar e criar a instância ao mesmo tempo:

```php
$infDps = InfDpsData::validateAndCreate($dados);
```

## Ambiente de Testes

Para garantir que as validações funcionem corretamente em um ambiente standalone (fora do Laravel), a biblioteca configura um mock do container do Laravel no arquivo `tests/Pest.php`.

Isso permite que as regras de validação do Laravel sejam resolvidas e aplicadas corretamente durante os testes unitários.
