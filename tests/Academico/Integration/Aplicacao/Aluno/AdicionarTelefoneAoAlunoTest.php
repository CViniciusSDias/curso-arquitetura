<?php

namespace Alura\Arquitetura\Tests\Academico;

use Alura\Arquitetura\Academico\Aplicacao\Aluno\AdicionarTelefoneAoAluno\AdicionaTelefoneAoAluno;
use Alura\Arquitetura\Academico\Aplicacao\Aluno\AdicionarTelefoneAoAluno\AdicionaTelefoneAoAlunoDto;
use Alura\Arquitetura\Academico\Dominio\Aluno\AlunoNaoEncontrado;
use Alura\Arquitetura\Academico\Dominio\Aluno\FabricaAluno;
use Alura\Arquitetura\Academico\Dominio\Aluno\RepositorioAluno;
use Alura\Arquitetura\Academico\Dominio\CPF;
use Alura\Arquitetura\Academico\Infra\Aluno\RepositorioAlunoPdo;
use PHPUnit\Framework\TestCase;

class AdicionarTelefoneAoAlunoTest extends TestCase
{
    public function testAdicionarTelefoneAUmAlunoInexistenteDeveLancarExcecao()
    {
        $this->expectException(AlunoNaoEncontrado::class);

        $repositorioAluno = $this->repositorioVazio();
        $adicionaTelefoneAoAluno = new AdicionaTelefoneAoAluno($repositorioAluno);
        $dados = new AdicionaTelefoneAoAlunoDto('123.456.789-10', '22', '22222222');
        $adicionaTelefoneAoAluno->adicionaTelefoneAoAluno($dados);
    }

    private function repositorioVazio(): RepositorioAluno
    {
        $connection = $this->conexao();

        return new RepositorioAlunoPdo($connection);
    }

    public function testAdicionarTelefoneAUmAlunoDeveFuncionar()
    {
        $cpfAluno = '123.456.789-10';
        $repositorioAluno = $this->repositorioComUmAluno($cpfAluno);

        $adicionaTelefoneAoAluno = new AdicionaTelefoneAoAluno($repositorioAluno);
        $dados = new AdicionaTelefoneAoAlunoDto($cpfAluno, '22', '22222222');
        $adicionaTelefoneAoAluno->adicionaTelefoneAoAluno($dados);

        $aluno = $repositorioAluno->buscaPorCpf(new CPF($cpfAluno));
        $this->assertCount(1, $aluno->telefones());
        $this->assertEquals('(22) 22222222', $aluno->numerosTelefone()[0]);
    }

    private function repositorioComUmAluno(string $cpfAluno): RepositorioAluno
    {
        $conexao = $this->conexao();
        $repositorio = new RepositorioAlunoPdo($conexao);
        $aluno = (new FabricaAluno())
            ->comCpfNomeEmail($cpfAluno, '', 'email@example.com')
            ->constroi();

        $repositorio->adiciona($aluno);

        return $repositorio;
    }

    private function conexao(): \PDO
    {
        $connection = new \PDO('sqlite::memory:');
        $connection->exec('
            CREATE TABLE alunos (cpf TEXT PRIMARY KEY, nome TEXT, email TEXT);
            CREATE TABLE telefones (ddd TEXT, numero TEXT, cpf_aluno TEXT, PRIMARY KEY (ddd, numero));
        ');
        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $connection;
    }


}
