<?php

require_once 'vendor/autoload.php';

use Alura\Arquitetura\Academico\Dominio\Aluno\AlunoMatriculado;
use Alura\Arquitetura\Shared\Infra\Evento\LeagueEvent\EmitidorEvento as LeagueEventEmitidorEvento;
use Alura\Arquitetura\Shared\Infra\Evento\LeagueEvent\Evento as LeagueEventEvento;
use League\Event\Emitter;
use Alura\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\{MatriculaAluno, MatriculaAlunoDto};
use Alura\Arquitetura\Academico\Infra\Aluno\{CriptografadorDeSenhaMd5, CriptografadorDeSenhaPadrao, CriptografadorDeSenhaArgon2};
use Alura\Arquitetura\Academico\Infra\Aluno\RepositorioAlunoPdo;

$conexao = new PDO('sqlite::memory:');
$conexao->exec('CREATE TABLE alunos (cpf TEXT PRIMARY KEY, nome TEXT, email TEXT);');

$parametros = $argv;
array_shift($parametros);

$emitter = new Emitter();
$emitter->addListener(AlunoMatriculado::class, function (LeagueEventEvento $leagueEventEvento) {
    /** @var AlunoMatriculado $eventoDominio */
    $eventoDominio = $leagueEventEvento->eventoDominio();
    fputs(STDERR, $eventoDominio->cpfAluno() . ' matriculado em ' . $eventoDominio->momento()->format('d/m/Y'));
});

$dados = new MatriculaAlunoDto(...$parametros);
$service = new MatriculaAluno(new RepositorioAlunoPdo($conexao), new CriptografadorDeSenhaArgon2(), new LeagueEventEmitidorEvento($emitter));
$service->cadastra($dados);

$conexao->query('SELECT * FROM alunos')->fetchAll();
