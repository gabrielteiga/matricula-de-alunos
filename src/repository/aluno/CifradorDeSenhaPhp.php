<?php
    namespace Gabriel\php\Repository\Aluno;
    use Gabriel\php\Domain\CifradorDeSenha;

    class CifradorDeSenhaPhp implements CifradorDeSenha
    {
        public function cifrar(string $senha): string
        {
            return password_hash($senha, PASSWORD_ARGON2ID);
        }

        public function verificar(string $senhaTexto, string $senhaCifrada): bool
        {
            return password_verify($senhaTexto, $senhaCifrada);
        }
    }