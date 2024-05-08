<?php
    namespace Gabriel\php\Domain;

    interface ICifradorDeSenha
    {
        public function cifrar(string $senha): string;
        public function verificar(string $senhaTexto, string $senhaCifrada): bool;
    }