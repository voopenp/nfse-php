<?php

namespace Nfse\Nfse\Dto;

use Nfse\Nfse\Enums\DfeType;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class DpsData extends DfeData
{
    public function getType(): DfeType
    {
        return DfeType::DPS;
    }

    public function __construct(
        #[MapInputName('@versao')]
        public ?string $versao,

        #[MapInputName('infDPS')]
        public ?InfDpsData $infDps,
    ) {}
}
