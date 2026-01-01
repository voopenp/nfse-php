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
class PedRegEventoData extends Data
{
    public function __construct(
        #[MapInputName('infPedReg')]
        public InfPedRegData $infPedReg,

        #[MapInputName('versao')]
        public string $versao = '1.01'
    ) {}
}
