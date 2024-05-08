<?php
    namespace Gabriel\php\Repository\Aluno;
    use Gabriel\php\Domain\ICifradorDeSenha;

    class CifradorDeSenhaMd5 implements ICifradorDeSenha
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