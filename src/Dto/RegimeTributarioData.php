<?php

namespace Nfse\Nfse\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class RegimeTributarioData extends Data
{
    public function __construct(
        /**
         * Opção pelo Simples Nacional.
         * 1 - Não Optante
         * 2 - Optante - Microempreendedor Individual (MEI)
         * 3 - Optante - Microempresa ou Empresa de Pequeno Porte (ME/EPP)
         */
        #[MapInputName('opSimpNac')]
        public ?int $opcaoSimplesNacional,

        /**
         * Regime de apuração dos tributos do Simples Nacional.
         * 1 - Regime de apuração pelo SN
         * 2 - Regime de apuração pelo Município
         */
        #[MapInputName('regApTribSN')]
        public ?int $regimeApuracaoTributariaSN,

        /**
         * Regime especial de tributação.
         * 0 - Nenhum
         * 1 - Microempresa Municipal
         * 2 - Estimativa
         * 3 - Sociedade de Profissionais
         * 4 - Cooperativa
         * 5 - Microempresário Individual (MEI)
         * 6 - Microempresa ou Empresa de Pequeno Porte (ME/EPP)
         */
        #[MapInputName('regEspTrib')]
        public ?int $regimeEspecialTributacao,
    ) {}
}
