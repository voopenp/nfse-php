<?php

namespace Nfse\Nfse\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class TributacaoData extends Data
{
    public function __construct(
        /**
         * Tributação do ISSQN.
         * 1 - Operação tributável
         * 2 - Imunidade
         * 3 - Exportação de serviço
         * 4 - Não Incidência
         */
        #[MapInputName('tribMun.tribISSQN')]
        public ?int $tributacaoIssqn,

        /**
         * Tipo de retencao do ISSQN.
         * 1 - Não Retido
         * 2 - Retido pelo Tomador
         * 3 - Retido pelo Intermediario
         */
        #[MapInputName('tribMun.tpRetISSQN')]
        public ?int $tipoRetencaoIssqn,

        /**
         * Código da Situação Tributária do PIS/COFINS.
         */
        #[MapInputName('tribFed.piscofins.CST')]
        public ?string $cstPisCofins,

        /**
         * Valor percentual total aproximado dos tributos federais, estaduais e municipais.
         */
        #[MapInputName('totTrib.pTotTribSN')]
        public ?float $percentualTotalTributosSN,
    ) {}
}
