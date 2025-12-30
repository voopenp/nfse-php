<?php

namespace Nfse\Nfse\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ValoresNfseData extends Data
{
    public function __construct(
        /**
         * Valor da Base de Cálculo.
         */
        #[MapInputName('vBC')]
        public ?float $baseCalculo,

        /**
         * Alíquota Aplicada.
         */
        #[MapInputName('pAliqAplic')]
        public ?float $aliquotaAplicada,

        /**
         * Valor do ISSQN.
         */
        #[MapInputName('vISSQN')]
        public ?float $valorIssqn,

        /**
         * Valor Líquido da NFS-e.
         */
        #[MapInputName('vLiq')]
        public ?float $valorLiquido,
    ) {}
}
