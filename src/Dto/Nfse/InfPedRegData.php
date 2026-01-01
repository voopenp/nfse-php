<?php

namespace Nfse\Dto\Nfse;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
/**
 * @typescript
 */
class InfPedRegData extends Data
{
    public function __construct(
        #[MapInputName('tpAmb')]
        public int $tipoAmbiente,

        #[MapInputName('verAplic')]
        public string $versaoAplicativo,

        #[MapInputName('dhEvento')]
        public string $dataHoraEvento,

        #[MapInputName('chNFSe')]
        public string $chaveNfse,

        // Autor: escolha CNPJ ou CPF (opcionais)
        #[MapInputName('CNPJAutor')]
        public ?string $cnpjAutor = null,

        #[MapInputName('CPFAutor')]
        public ?string $cpfAutor = null,

        #[MapInputName('nPedRegEvento')]
        public int $nPedRegEvento = 1,

        // Tipo de evento (ex: '101101' para cancelamento)
        public string $tipoEvento = '101101',

        #[MapInputName('e101101')]
        public ?CancelamentoData $e101101 = null,
    ) {}
}
