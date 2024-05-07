<?php
    namespace Gabriel\php\Repository\Indicacao;
    use Gabriel\php\App\Indicacao\EnviaEmailIndicacao;
    use Gabriel\php\Domain\Aluno\Aluno;

    class EnviaEmailIndicacaoMail implements EnviaEmailIndicacao
    {
        public function sendTo(Aluno $indicado): void
        {
            $titulo = 'Indicacao';
            $emailAluno = $indicado->getEmail();
            $mensagem = 'Você foi indicado para o treinamento de Arquitetura Limpa utilizando PHP.<br><br>Acesse agora: <strong>link<strong>.';
            mail($emailAluno, $titulo, $mensagem);
        }
    }