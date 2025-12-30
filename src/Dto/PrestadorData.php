<?php

namespace Nfse\Nfse\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class PrestadorData extends Data
{
    public function __construct(
        /**
         * CNPJ do prestador.
         * Obrigatório se não for pessoa física.
         */
        #[MapInputName('CNPJ')]
        public ?string $cnpj,

        /**
         * CPF do prestador.
         * Obrigatório se pessoa física.
         */
        #[MapInputName('CPF')]
        public ?string $cpf,

        /**
         * Número de Identificação Fiscal (NIF) do prestador.
         * Não permitido se tpEmit=1.
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
         * Inscrição Municipal do prestador.
         */
        #[MapInputName('IM')]
        public ?string $inscricaoMunicipal,

        /**
         * Razão Social ou Nome do prestador.
         */
        #[MapInputName('xNome')]
        public ?string $nome,

        /**
         * Endereço do prestador.
         */
        #[MapInputName('end')]
        public ?EnderecoData $endereco,

        /**
         * Telefone do prestador.
         */
        #[MapInputName('fone')]
        public ?string $telefone,

        /**
         * Email do prestador.
         */
        #[MapInputName('email')]
        public ?string $email,

        /**
         * Regime tributário do prestador.
         */
        #[MapInputName('regTrib')]
        public ?RegimeTributarioData $regimeTributario,
    ) {}
}
