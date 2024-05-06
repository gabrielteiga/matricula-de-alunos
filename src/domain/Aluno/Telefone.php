<?php
    namespace Gabriel\php\Domain\Aluno;

    class Telefone 
    {
        private string $ddd;
        private string $numero;

        public function __construct(string $ddd, string $numero)
        {
            $this->setDdd($ddd);
            $this->setNumero($numero);
        }

        public function getDdd(): string
        {
            return $this->ddd;
        }
        
        private function setDdd(string $ddd): void
        {
            if (preg_match('/\d{2}/', $ddd) === false){
                throw new \InvalidArgumentException("DDD deve possuir apenas 2 números.");
            }
            
            $this->ddd = $ddd;
        }

        public function getNumero(): string
        {
            return $this->numero;
        }

        private function setNumero(string $numero)
        {
            if (preg_match('/\d{8,9}/', $numero) === false)
            {
                throw new \InvalidArgumentException("O número de telefone deve possuir 8 ou 9 números.");
            }

            $this->numero = $numero;
        }

        public function __toString()
        {
            return "({$this->ddd}) {$this->numero}";
        }
    }