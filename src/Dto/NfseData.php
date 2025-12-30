<?php

namespace Nfse\Nfse\Dto;

use Nfse\Nfse\Enums\DfeType;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class NfseData extends DfeData
{
    public function getType(): DfeType
    {
        return DfeType::NFSe;
    }

    public function __construct(
        /**
         * Versão do leiaute.
         */
        #[MapInputName('versao')]
        public ?string $versao,

        /**
         * Informações da NFS-e.
         */
        #[MapInputName('infNFSe')]
        public ?InfNfseData $infNfse,
    ) {}
}
