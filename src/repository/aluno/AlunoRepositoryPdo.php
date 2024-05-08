<?php
    namespace Gabriel\php\Repository\Aluno;

    use Gabriel\php\Domain\Aluno\Aluno;
    use Gabriel\php\Domain\Aluno\AlunoNaoEncontrado;
    use Gabriel\php\Domain\Aluno\IAlunoRepository;
    use Gabriel\php\Domain\Aluno\Telefone;
    use Gabriel\php\Domain\Cpf;

    class AlunoRepositoryPdo implements IAlunoRepository
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

            $sql = 'INSERT INTO telefones(ddd, numero, cpf_aluno) VALUES (:ddd, :numero, :cpf_aluno);';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue('cpf_aluno', $aluno->getCpf());

            /** @var Telefone $telefone */
            foreach ($aluno->getTelefones() as $telefone) {
                $stmt->bindValue('ddd', $telefone->getDdd());
                $stmt->bindValue('numero', $telefone->getNumero());
                $stmt->execute();
            }
        }

        public function buscarPorCpf(Cpf $cpf): Aluno
        {
            $sql = 'SELECT cpf, nome, email, ddd, numero 
                FROM alunos 
                JOIN telefones ON alunos.cpf = telefones.cpf_aluno 
                WHERE alunos.cpf = :cpf;';
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue('cpf', (string) $cpf);
            $stmt->execute();

            $dadosAluno = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if (count($dadosAluno) === 0) {
                throw new AlunoNaoEncontrado($cpf);
            }

            return $this->mapearAluno($dadosAluno);
        }

        private function mapearAluno(array $dadosAluno): Aluno
        {
            $primeiraLinha = $dadosAluno[0];

            $aluno = Aluno::comCpfNomeEEmail($primeiraLinha['cpf'], $primeiraLinha['nome'], $primeiraLinha['email']);
            $telefones = array_filter($dadosAluno, fn($linha) => $linha['ddd'] !== null && $linha['numero'] !== null);
            foreach ($telefones as $linha) {
                $aluno->addTelefone($linha['ddd'], $linha['numero']);
            }

            return $aluno;
        }

        /** @return Aluno[] */
        public function getAllAlunos(): array
        {
            $sql = 'SELECT cpf, nome, email, ddd, numero
                FROM alunos
                LEFT JOIN telefones on alunos.cpf = telefones.cpf_aluno;';
            
            $stmt = $this->conexao->query( $sql );
            
            $listaDadosAlunos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $alunos = [];

            foreach ($listaDadosAlunos as $dadosAluno) {
                if (!array_key_exists($dadosAluno['cpf'], $alunos)){
                    $alunos[$dadosAluno['cpf']] = Aluno::comCpfNomeEEmail(
                        $dadosAluno['cpf'],
                        $dadosAluno['nome'],
                        $dadosAluno['email'],
                    );
                }

                if ($dadosAluno['ddd'] !== null && $dadosAluno['numero'] !== null){
                    $alunos[$dadosAluno['cpf']]->addTelefone($dadosAluno['ddd'], $dadosAluno['numero']);
                }
            }

            return array_values($alunos);
        }
    }