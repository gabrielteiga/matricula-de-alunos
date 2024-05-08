<?php
    namespace Gabriel\php\App\Indicacao;

use Gabriel\php\Domain\Aluno\Aluno;

    interface IEnviaEmailIndicacao
    {
        // mail, phpMailer, swiftMailer, ... (bibliotecas que enviam emails)
        public function sendTo(Aluno $indicado): void;
    }