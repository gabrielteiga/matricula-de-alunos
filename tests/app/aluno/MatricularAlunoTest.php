<?php

namespace Gabriel\php\Testes\App\Aluno;

use Gabriel\php\App\Aluno\MatricularAluno\MatricularAluno;
use Gabriel\php\App\Aluno\MatricularAluno\MatricularAlunoDto;
use Gabriel\php\Domain\Cpf;
use Gabriel\php\Repository\Aluno\AlunoRepositoryMem;
use PHPUnit\Framework\TestCase;

class MatricularAlunoTest extends TestCase
{
    public function testAlunoAdicionadoAoRepositorio()
    {
        $dadosAluno = new MatricularAlunoDto(
            '123.123.123-12',
            'Gabriel Teste',
            'gabriel@teste.com'
        );
        
        $repository = new AlunoRepositoryMem();
        $usecase = new MatricularAluno($repository);

        $usecase->run($dadosAluno);

        $aluno = $repository->buscarPorCpf(new Cpf("123.123.123-12"));
        $this->assertSame('Gabriel Teste', $aluno->getNome());
        $this->assertSame('gabriel@teste.com', $aluno->getEmail());
        $this->assertEmpty($aluno->getTelefones());
    }
}