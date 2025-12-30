<?php

namespace Nfse\Nfse\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class IntermediarioData extends Data
{
    public function __construct(
        /**
         * CNPJ do intermediário.
         * Obrigatório se pessoa jurídica.
         */
        #[MapInputName('CNPJ')]
        public ?string $cnpj,

        /**
         * CPF do intermediário.
         * Obrigatório se pessoa física.
         */
        #[MapInputName('CPF')]
        public ?string $cpf,

        /**
         * Número de Identificação Fiscal (NIF) do intermediário.
         * Não permitido se tpEmit=3.
         */
        #[MapInputName('NIF')]
        public ?string $nif,

        /**
         * Código do motivo de não informar o NIF.
         */
        #[MapInputName('cNaoNIF')]
        public ?string $codigoNaoNif,

        /**
         * Cadastro de Atividade Econômica da Pessoa Física.
         */
        #[MapInputName('CAEPF')]
        public ?string $caepf,

        /**
         * Inscrição Municipal do intermediário.
         */
        #[MapInputName('IM')]
        public ?string $inscricaoMunicipal,

        /**
         * Razão Social ou Nome do intermediário.
         */
        #[MapInputName('xNome')]
        public ?string $nome,

        /**
         * Endereço do intermediário.
         */
        #[MapInputName('end')]
        public ?EnderecoData $endereco,

        /**
         * Telefone do intermediário.
         */
        #[MapInputName('fone')]
        public ?string $telefone,

        /**
         * Email do intermediário.
         */
        #[MapInputName('email')]
        public ?string $email,
    ) {}
}
