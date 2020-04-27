<?php

require_once 'vendor/autoload.php';

use Alura\Arquitetura\Shared\Infra\DI\ContainerCreator;
use Alura\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno\{MatriculaAluno, MatriculaAlunoDto};

$parametros = $argv;
array_shift($parametros);

$dados = new MatriculaAlunoDto(...$parametros);
$service = ContainerCreator::criarContainer()->get(MatriculaAluno::class);

$service->cadastra($dados);
