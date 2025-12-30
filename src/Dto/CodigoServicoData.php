<?php

namespace Nfse\Nfse\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CodigoServicoData extends Data
{
    public function __construct(
        /**
         * Código de tributação nacional (LC 116/03).
         */
        #[MapInputName('cTribNac')]
        public ?string $codigoTributacaoNacional,

        /**
         * Código de tributação municipal.
         */
        #[MapInputName('cTribMun')]
        public ?string $codigoTributacaoMunicipal,

        /**
         * Descrição do serviço.
         */
        #[MapInputName('xDescServ')]
        public ?string $descricaoServico,

        /**
         * Código NBS (Nomenclatura Brasileira de Serviços).
         */
        #[MapInputName('cNBS')]
        public ?string $codigoNbs,

        /**
         * Código interno do serviço no sistema do contribuinte.
         */
        #[MapInputName('cIntContrib')]
        public ?string $codigoInternoContribuinte,
    ) {}
}
