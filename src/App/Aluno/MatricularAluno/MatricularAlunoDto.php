<?php
    namespace Gabriel\php\App\Aluno\MatricularAluno;

    class MatricularAlunoDto
    {
        public string $cpfAluno;
        public string $nomeAluno;
        public string $emailAluno;
        public string|null $ddd;
        public string|null $numero;

        public function __construct(string $cpfAluno, string $nomeAluno, string $emailAluno, string $ddd = null, string $numero = null)
        {
            $this->cpfAluno = $cpfAluno;
            $this->nomeAluno = $nomeAluno;
            $this->emailAluno = $emailAluno;
            $this->ddd = $ddd;
            $this->numero = $numero;
        }
    }