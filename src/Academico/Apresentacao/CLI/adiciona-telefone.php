<?php

use Alura\Arquitetura\Academico\Aplicacao\Aluno\AdicionarTelefoneAoAluno\AdicionaTelefoneAoAluno;
use Alura\Arquitetura\Academico\Aplicacao\Aluno\AdicionarTelefoneAoAluno\AdicionaTelefoneAoAlunoDto;
use Alura\Arquitetura\Shared\Infra\DI\ContainerCreator;

require_once 'vendor/autoload.php';

$parametros = $argv;
array_shift($parametros);

$dados = new AdicionaTelefoneAoAlunoDto(...$parametros);

$adicionaTelefone = ContainerCreator::criarContainer()->get(AdicionaTelefoneAoAluno::class);
$adicionaTelefone->adicionaTelefoneAoAluno($dados);
