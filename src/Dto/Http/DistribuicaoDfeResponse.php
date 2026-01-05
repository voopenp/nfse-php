<?php

namespace Nfse\Dto\Http;

use Spatie\LaravelData\Data;

class DistribuicaoDfeResponse extends Data
{
    /**
     * @param  MensagemProcessamentoDto[]  $alertas
     * @param  MensagemProcessamentoDto[]  $erros
     * @param  DistribuicaoNsuDto[]  $listaNsu
     */
    public function __construct(
        public ?string $tipoAmbiente = null,
        public ?string $versaoAplicativo = null,
        public ?string $dataHoraProcessamento = null,
        public ?int $ultimoNsu = null,
        public ?int $maiorNsu = null,
        public array $alertas = [],
        public array $erros = [],
        public array $listaNsu = [],
    ) {}
}
