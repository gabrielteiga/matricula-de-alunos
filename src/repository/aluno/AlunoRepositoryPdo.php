<?php
    namespace Gabriel\php\Repository\Aluno;

    use Gabriel\php\Domain\Aluno\Aluno;
    use Gabriel\php\Domain\Aluno\AlunoRepository;
    use Gabriel\php\Domain\Cpf;

    class AlunoRepositoryPdo implements AlunoRepository
    {
        private \PDO $conexao;

        public function __construct(\PDO $conexao)
        {
            $this->conexao = $conexao;
        }

        public function addAluno(Aluno $aluno): void
        {
            $sql = 'INSERT INTO alunos(cpf, nome, email) VALUES(:cpf, :nome, :email);';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue('cpf', $aluno->getCpf());
            $stmt->bindValue('nome', $aluno->getNome());
            $stmt->bindValue('email', $aluno->getEmail());
            $stmt->execute();

            /** @var Telefone $telefone */
            foreach ($aluno->getTelefones() as $telefone) {
                $sql = 'INSERT INTO telefones(ddd, numero, cpf_aluno) VALUES (:ddd, :numero, :cpf_aluno);';
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue('ddd', $telefone->getDdd());
                $stmt->bindValue('numero', $telefone->getNumero());
                $stmt->bindValue('cpf_aluno', $aluno->getCpf());
                $stmt->execute();
            }
        }

        public function buscarPorCpf(Cpf $cpf): Aluno
        {
            // To-Do
        }

        /** @return Aluno[] */
        public function getAllAlunos(): array
        {
            // To-Do
        }
    }