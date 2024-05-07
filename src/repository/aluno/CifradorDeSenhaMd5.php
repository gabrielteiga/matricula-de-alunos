<?php
    namespace Gabriel\php\Repository\Aluno;
    use Gabriel\php\Domain\CifradorDeSenha;

    class CifradorDeSenhaMd5 implements CifradorDeSenha
    {
        public function cifrar(string $senha): string
        {
            return md5($senha);
        }

        public function verificar(string $senhaTexto, string $senhaCifrada): bool
        {
            return md5($senhaTexto) == $senhaCifrada;
        }
    }