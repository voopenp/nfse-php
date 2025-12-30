<?php

namespace Nfse\Nfse\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class EmitenteData extends Data
{
    public function __construct(
        /**
         * CNPJ do emitente.
         */
        #[MapInputName('CNPJ')]
        public ?string $cnpj,

        /**
         * CPF do emitente.
         */
        #[MapInputName('CPF')]
        public ?string $cpf,

        /**
         * Inscrição Municipal do emitente.
         */
        #[MapInputName('IM')]
        public ?string $inscricaoMunicipal,

        /**
         * Razão Social ou Nome do emitente.
         */
        #[MapInputName('xNome')]
        public ?string $nome,

        /**
         * Nome Fantasia do emitente.
         */
        #[MapInputName('xFant')]
        public ?string $nomeFantasia,

        /**
         * Endereço do emitente.
         */
        #[MapInputName('enderNac')]
        public ?EnderecoEmitenteData $endereco,

        /**
         * Telefone do emitente.
         */
        #[MapInputName('fone')]
        public ?string $telefone,

        /**
         * Email do emitente.
         */
        #[MapInputName('email')]
        public ?string $email,
    ) {}
}
