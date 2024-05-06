<?php
    namespace Gabriel\php\Domain\Aluno;

    use Gabriel\php\Domain\Cpf;
    use Gabriel\php\Domain\Email;

    class Aluno {
        private Cpf $cpf;
        private string $nome;
        private Email $email;
        private array $telefones;

        public static function comCpfNomeEEmail(string $cpf, string $nome, string $email): self
        {
            return new Aluno(new Cpf($cpf), $nome, new Email($email));
        }

        public function __construct(Cpf $cpf, string $nome, Email $email)
        {
            $this->cpf = $cpf;
            $this->nome = $nome;
            $this->email = $email;
        }

        public function addTelefone(string $ddd, string $numero): self
        {
            $this->telefones[] = new Telefone($ddd, $numero);
            return $this;
        }
        
        public function getCpf(): string
        {
            return $this->cpf;
        }

        public function getNome(): string
        {
            return $this->nome;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        /** @return Telefone[] */
        public function getTelefones(): array
        {
            return $this->telefones;
        }
    }
