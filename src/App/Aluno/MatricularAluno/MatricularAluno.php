<?php
    
    namespace Gabriel\php\App\Aluno\MatricularAluno;

use Gabriel\php\Domain\Aluno\Aluno;
use Gabriel\php\Domain\Aluno\AlunoRepository;

    class MatricularAluno
    {
        private AlunoRepository $alunoRepository;
        
        public function __construct(AlunoRepository $alunoRepository)
        {
            $this->alunoRepository = $alunoRepository;
        }
        
        public function run(MatricularAlunoDto $data): void
        {
            $aluno = Aluno::comCpfNomeEEmail($data->cpfAluno, $data->nomeAluno, $data->emailAluno);
            $this->alunoRepository->addAluno($aluno);
        }
    }