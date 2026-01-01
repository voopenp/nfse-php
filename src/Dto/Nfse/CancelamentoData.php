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
class CancelamentoData extends Data
{
    public function __construct(
        #[MapInputName('xDesc')]
        public ?string $descricao,

        #[MapInputName('cMotivo')]
        public ?string $codigoMotivo,

        #[MapInputName('xMotivo')]
        public ?string $motivo
    ) {}
}
