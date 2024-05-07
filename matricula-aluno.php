<?php

use Gabriel\php\Domain\Aluno\Aluno;
use Gabriel\php\Repository\Aluno\AlunoRepositoryMem;

require 'vendor/autoload.php';

$cpf = $argv[1];
$nome = $argv[2];
$email = $argv[3];
$ddd = $argv[4];
$numero = $argv[5];

$repositorio = new AlunoRepositoryMem();
$aluno = Aluno::comCpfNomeEEmail($cpf, $nome, $email)->addTelefone($ddd, $numero);
$repositorio->addAluno($aluno);

$aluno = Aluno::comCpfNomeEEmail($cpf, $nome, $email)->addTelefone($ddd, $numero);
$repositorio->addAluno($aluno);

$aluno = Aluno::comCpfNomeEEmail($cpf, $nome, $email)->addTelefone($ddd, $numero);
$repositorio->addAluno($aluno);

$alunos = $repositorio->getAllAlunos();
foreach ($alunos as $aluno) {
    echo $aluno->getNome();
}