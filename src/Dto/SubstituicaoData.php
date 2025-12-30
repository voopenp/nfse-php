<?php

namespace Nfse\Nfse\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class SubstituicaoData extends Data
{
    public function __construct(
        /**
         * Chave de acesso da NFS-e a ser substituída.
         */
        #[MapInputName('chSubstda')]
        public ?string $chaveSubstituida,

        /**
         * Código do motivo da substituição.
         * 01 - Desenquadramento de NFS-e do Simples Nacional
         * 02 - Enquadramento de NFS-e no Simples Nacional
         * 99 - Outros
         */
        #[MapInputName('cMotivo')]
        public ?string $codigoMotivo,

        /**
         * Descrição do motivo da substituição.
         * Obrigatório se cMotivo = 99.
         */
        #[MapInputName('xMotivo')]
        public ?string $descricaoMotivo,
    ) {}
}
