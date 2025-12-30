<?php

namespace Nfse\Nfse\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class TomadorData extends Data
{
    public function __construct(
        /**
         * CPF do tomador.
         * Obrigatório se pessoa física.
         */
        #[MapInputName('CPF')]
        public ?string $cpf,

        /**
         * CNPJ do tomador.
         * Obrigatório se pessoa jurídica.
         */
        #[MapInputName('CNPJ')]
        public ?string $cnpj,

        /**
         * Número de Identificação Fiscal (NIF) do tomador.
         * Não permitido se tpEmit=2.
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
         * Inscrição Municipal do tomador.
         */
        #[MapInputName('IM')]
        public ?string $inscricaoMunicipal,

        /**
         * Razão Social ou Nome do tomador.
         */
        #[MapInputName('xNome')]
        public ?string $nome,

        /**
         * Endereço do tomador.
         */
        #[MapInputName('end')]
        public ?EnderecoData $endereco,

        /**
         * Telefone do tomador.
         */
        #[MapInputName('fone')]
        public ?string $telefone,

        /**
         * Email do tomador.
         */
        #[MapInputName('email')]
        public ?string $email,
    ) {}
}
