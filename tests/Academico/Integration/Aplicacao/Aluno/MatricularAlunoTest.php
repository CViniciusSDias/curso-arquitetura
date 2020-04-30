<?php

namespace Alura\Arquitetura\Tests\Academico\Integration\Aplicacao\Aluno;

use Alura\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatriculaAluno;
use Alura\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\MatriculaAlunoDto;
use Alura\Arquitetura\Academico\Dominio\Aluno\CriptografadorDeSenha;
use Alura\Arquitetura\Academico\Dominio\CPF;
use Alura\Arquitetura\Academico\Infra\Aluno\CriptografadorDeSenhaArgon2;
use Alura\Arquitetura\Academico\Infra\Aluno\CriptografadorDeSenhaMd5;
use Alura\Arquitetura\Academico\Infra\Aluno\CriptografadorDeSenhaPadrao;
use Alura\Arquitetura\Academico\Infra\Aluno\RepositorioAlunoEmMemoria;
use Alura\Arquitetura\Shared\Dominio\Evento\PublicadorDeEvento;
use PHPUnit\Framework\TestCase;

class MatricularAlunoTest extends TestCase
{
    /**
     * @dataProvider criptografadores
     */
    public function testAoCadastrarAlunoSenhaDeveSerCifrada(CriptografadorDeSenha $criptografadorSenha)
    {
        $numeroCpfAluno = '123.456.789-10';
        $dados = new MatriculaAlunoDto(
            $numeroCpfAluno,
            'Vinicius Dias',
            'email@example.com',
            '123456'
        );

        $repositorioAluno = new RepositorioAlunoEmMemoria();
        $cadastrarAluno = new MatriculaAluno($repositorioAluno, $criptografadorSenha, new PublicadorDeEvento());
        $cadastrarAluno->cadastra($dados);

        $aluno = $repositorioAluno->buscaPorCpf(new CPF($numeroCpfAluno));

        $this->assertTrue($criptografadorSenha->senhaEhValida('123456', $aluno));
    }

    public function criptografadores()
    {
        return [
            [new CriptografadorDeSenhaArgon2()],
            [new CriptografadorDeSenhaPadrao()],
            [new CriptografadorDeSenhaMd5()],
        ];
    }
}
