<?php

namespace Gabriel\php\Testes\App\Aluno;

use Gabriel\php\App\Aluno\MatricularAluno\MatricularAluno;
use Gabriel\php\App\Aluno\MatricularAluno\MatricularAlunoDto;
use Gabriel\php\Domain\Cpf;
use Gabriel\php\Repository\Aluno\AlunoRepositoryMem;
use PHPUnit\Framework\TestCase;

class MatricularAlunoTest extends TestCase
{
    public function testAlunoSemTelefoneAdicionadoAoRepositorio()
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

    public function testAlunoComTelefoneAdicionadoAoRepositorio()
    {
        $dadosAluno = new MatricularAlunoDto(
            '123.123.123-12',
            'Gabriel Teste',
            'gabriel@teste.com',
            '51',
            '991919191'
        );
        
        $repository = new AlunoRepositoryMem();
        $usecase = new MatricularAluno($repository);

        $usecase->run($dadosAluno);

        $aluno = $repository->buscarPorCpf(new Cpf("123.123.123-12"));
        $this->assertSame('Gabriel Teste', $aluno->getNome());
        $this->assertSame('gabriel@teste.com', $aluno->getEmail());
        $this->assertSame(count($aluno->getTelefones()), 1);
        $this->assertSame('51', $aluno->getTelefones()[0]->getDdd());
        $this->assertSame('991919191', $aluno->getTelefones()[0]->getNumero());
    }
}