<?php

use Gabriel\php\App\Aluno\MatricularAluno\MatricularAluno;
use Gabriel\php\App\Aluno\MatricularAluno\MatricularAlunoDto;
use Gabriel\php\Repository\Aluno\AlunoRepositoryMem;
use Gabriel\php\Repository\Aluno\AlunoRepositoryPdo;

require 'vendor/autoload.php';

// Recebendo dados pelo prompt
$cpf = $argv[1];
$nome = $argv[2];
$email = $argv[3];
$ddd = $argv[4];
$numero = $argv[5];

// Criando o repositório
$repositorio;
try
{
    $repositorio = new AlunoRepositoryPdo(
        new \PDO("mysql:host=localhost:3307;dbname=db_php", "root", "root")
    );
    echo "conectado ao banco com PDO\n";
}
catch(\Exception $e)
{
    $repositorio = new AlunoRepositoryMem();
    echo "iniciado banco em Memoria\n";
}

// Usando o usecase MatricularAluno
$usecase = new MatricularAluno($repositorio);
$dadosAluno = new MatricularAlunoDto(
    $cpf,
    $nome,
    $email,
);
$usecase->run($dadosAluno);
$usecase->run($dadosAluno);
$usecase->run($dadosAluno);

// Imprimindo cada aluno matriculado
foreach ($repositorio->getAllAlunos() as $aluno)
{
    echo "\n".$aluno->getNome()."\n";
}