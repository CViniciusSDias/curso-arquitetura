<?php

use Alura\Arquitetura\Shared\Infra\DI\ContainerCreator;
use Alura\Arquitetura\Academico\Aplicacao\Indicacao\IndicarAluno\{IndicaAluno, IndicaAlunoDto};

require_once 'vendor/autoload.php';

$parametros = $argv;
array_shift($parametros);

$dados = new IndicaAlunoDto(...$parametros);
$indicaAluno = ContainerCreator::criarContainer()->get(IndicaAluno::class);
$indicaAluno->indica($dados);
