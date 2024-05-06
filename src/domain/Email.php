<?php
    namespace Gabriel\php\Domain;

    class Email{
        private string $endereco;

        public function __construct(string $endereco)
        {
            if (filter_var($endereco, FILTER_VALIDATE_EMAIL) === false) {
                throw new \InvalidArgumentException("Email invalido");
            }
            $this->endereco = $endereco;
        }

        public function __toString(): string
        {
            return $this->endereco; 
        }
    }