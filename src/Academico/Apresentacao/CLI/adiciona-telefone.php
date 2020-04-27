<?php

use Alura\Arquitetura\Academico\Aplicacao\Aluno\AdicionarTelefoneAoAluno\AdicionaTelefoneAoAluno;
use Alura\Arquitetura\Academico\Aplicacao\Aluno\AdicionarTelefoneAoAluno\AdicionaTelefoneAoAlunoDto;
use Alura\Arquitetura\Academico\Infra\Aluno\RepositorioAlunoPdo;

require_once 'vendor/autoload.php';

$parametros = $argv;
array_shift($parametros);

$pdo = new PDO('sqlite::memory:');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('
    CREATE TABLE indicacoes (cpf_indicante TEXT, cpf_indicado TEXT, data_indicacao TEXT, PRIMARY KEY (cpf_indicante, cpf_indicado));
    CREATE TABLE alunos (cpf TEXT PRIMARY KEY, nome TEXT, email TEXT);
    CREATE TABLE telefones (ddd TEXT, numero TEXT, cpf_aluno TEXT, PRIMARY KEY (ddd, numero));
');

$dados = new AdicionaTelefoneAoAlunoDto(...$parametros);
$adicionaTelefone = new AdicionaTelefoneAoAluno(new RepositorioAlunoPdo($pdo));
$adicionaTelefone->adicionaTelefoneAoAluno($dados);
