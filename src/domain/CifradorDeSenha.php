<?php
    namespace Gabriel\php\Domain;

    interface CifradorDeSenha
    {
        public function cifrar(string $senha): string;
        public function verificar(string $senhaTexto, string $senhaCifrada): bool;
    }