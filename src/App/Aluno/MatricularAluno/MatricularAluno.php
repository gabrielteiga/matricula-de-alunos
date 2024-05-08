<?php
    
    namespace Gabriel\php\App\Aluno\MatricularAluno;

use Gabriel\php\Domain\Aluno\Aluno;
use Gabriel\php\Domain\Aluno\IAlunoRepository;

    class MatricularAluno
    {
        private IAlunoRepository $alunoRepository;
        
        public function __construct(IAlunoRepository $alunoRepository)
        {
            $this->alunoRepository = $alunoRepository;
        }
        
        public function run(MatricularAlunoDto $data): void
        {
            $aluno = Aluno::comCpfNomeEEmail($data->cpfAluno, $data->nomeAluno, $data->emailAluno)
                ->addTelefone($data->ddd, $data->numero);
            $this->alunoRepository->addAluno($aluno);
        }
    }