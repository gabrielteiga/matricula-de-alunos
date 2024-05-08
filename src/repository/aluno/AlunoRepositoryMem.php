<?php
    namespace Gabriel\php\Repository\Aluno;

    use Gabriel\php\Domain\Aluno\Aluno;
    use Gabriel\php\Domain\Aluno\AlunoNaoEncontrado;
    use Gabriel\php\Domain\Aluno\IAlunoRepository;
    use Gabriel\php\Domain\Cpf;

    class AlunoRepositoryMem implements IAlunoRepository
    {
        private array $alunos = [];

        public function addAluno(Aluno $aluno): void
        {
            $this->alunos[] = $aluno;
        }

        public function buscarPorCpf(Cpf $cpf): Aluno
        {
            $alunosFiltrados = array_filter($this->alunos, 
                fn(Aluno $aluno) => $aluno->getCpf() == $cpf);

            if (count($alunosFiltrados) === 0) 
            {
                throw new AlunoNaoEncontrado($cpf);
            }

            if (count($alunosFiltrados) > 1)
            {
                throw new \Exception("Mais de um aluno com cpf! FATAL!");
            }

            return $alunosFiltrados[0];
        }

        /** @return Aluno[] */
        public function getAllAlunos(): array
        {
            return $this->alunos;
        }
    }
