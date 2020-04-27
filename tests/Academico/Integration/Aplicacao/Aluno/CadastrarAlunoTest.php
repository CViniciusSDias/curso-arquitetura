<?php

namespace Alura\Arquitetura\Tests\Academico\Integration\Aplicacao\Aluno;

use Alura\Arquitetura\Academico\Aplicacao\Aluno\CadastrarAluno\CadastraAluno;
use Alura\Arquitetura\Academico\Aplicacao\Aluno\CadastrarAluno\CadastraAlunoDto;
use Alura\Arquitetura\Academico\Dominio\Aluno\CriptografadorDeSenha;
use Alura\Arquitetura\Academico\Dominio\CPF;
use Alura\Arquitetura\Academico\Infra\Aluno\CriptografadorDeSenhaArgon2;
use Alura\Arquitetura\Academico\Infra\Aluno\CriptografadorDeSenhaMd5;
use Alura\Arquitetura\Academico\Infra\Aluno\CriptografadorDeSenhaPadrao;
use Alura\Arquitetura\Academico\Infra\Aluno\RepositorioAlunoEmMemoria;
use PHPUnit\Framework\TestCase;

class CadastrarAlunoTest extends TestCase
{
    /**
     * @dataProvider criptografadores
     */
    public function testAoCadastrarAlunoSenhaDeveSerCifrada(CriptografadorDeSenha $criptografadorSenha)
    {
        $numeroCpfAluno = '123.456.789-10';
        $dados = new CadastraAlunoDto(
            $numeroCpfAluno,
            'Vinicius Dias',
            'email@example.com',
            '123456'
        );

        $repositorioAluno = new RepositorioAlunoEmMemoria();
        $cadastrarAluno = new CadastraAluno($repositorioAluno, $criptografadorSenha);
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
