<?php
    namespace Gabriel\php\Domain\Aluno;

use Gabriel\php\Domain\Cpf;

    class AlunoNaoEncontrado extends \DomainException
    {
        public function __construct(Cpf $cpf)
        {
            parent::__construct("Aluno com CPF $cpf não encontrado");
        }
    }