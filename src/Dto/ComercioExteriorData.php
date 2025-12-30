<?php

namespace Nfse\Nfse\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ComercioExteriorData extends Data
{
    public function __construct(
        /**
         * Modo de prestação do serviço.
         * 1 - Transfronteiriço
         * 2 - Consumo no Brasil
         * 3 - Presença Comercial no Exterior
         * 4 - Movimento Temporário de Pessoas Físicas
         */
        #[MapInputName('mdPrestacao')]
        public ?int $modoPrestacao,

        /**
         * Vínculo entre as partes no negócio.
         * 1 - Sem vínculo
         * 2 - Com vínculo
         */
        #[MapInputName('vincPrest')]
        public ?int $vinculoPrestacao,

        /**
         * Código da moeda da transação (ISO 4217).
         */
        #[MapInputName('tpMoeda')]
        public ?string $tipoMoeda,

        /**
         * Valor do serviço na moeda estrangeira.
         */
        #[MapInputName('vServMoeda')]
        public ?float $valorServicoMoeda,

        /**
         * Mecanismo de apoio/fomento ao Comércio Exterior utilizado pelo prestador.
         */
        #[MapInputName('mecAFComexP')]
        public ?string $mecanismoApoioComexPrestador,

        /**
         * Mecanismo de apoio/fomento ao Comércio Exterior utilizado pelo tomador.
         */
        #[MapInputName('mecAFComexT')]
        public ?string $mecanismoApoioComexTomador,

        /**
         * Movimentação temporária de bens.
         */
        #[MapInputName('movTempBens')]
        public ?string $movimentacaoTemporariaBens,

        /**
         * Número da Declaração de Importação (DI/DSI/DA/DRI-E) averbada.
         */
        #[MapInputName('nDI')]
        public ?string $numeroDeclaracaoImportacao,

        /**
         * Número do Registro de Exportação (RE) averbado.
         */
        #[MapInputName('nRE')]
        public ?string $numeroRegistroExportacao,

        /**
         * Compartilhamento de dados com o MDIC.
         * 1 - Sim
         * 2 - Não
         */
        #[MapInputName('mdic')]
        public ?string $mdic,
    ) {}
}
