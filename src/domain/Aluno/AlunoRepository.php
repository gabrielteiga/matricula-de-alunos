<?php
    namespace Gabriel\php\Domain\Aluno;

use Gabriel\php\Domain\Cpf;

    interface AlunoRepository 
    {
        public function addAluno(Aluno $aluno): void;
        public function buscarPorCpf(Cpf $cpf): Aluno;
        /** @return Aluno[] */
        public function getAllAlunos(): array;
    }