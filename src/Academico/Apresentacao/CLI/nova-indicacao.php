<?php

use Alura\Arquitetura\Academico\Aplicacao\Indicacao\IndicarAluno\{IndicaAluno, IndicaAlunoDto};
use Alura\Arquitetura\Academico\Infra\Aluno\RepositorioAlunoPdo;
use Alura\Arquitetura\Academico\Infra\Indicacao\EnviadorEmailIndicacaoMail;
use Alura\Arquitetura\Academico\Infra\Indicacao\RepositorioIndicacaoPdo;

require_once 'vendor/autoload.php';

$pdo = new PDO('sqlite::memory:');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('
    CREATE TABLE indicacoes (cpf_indicante TEXT, cpf_indicado TEXT, data_indicacao TEXT, PRIMARY KEY (cpf_indicante, cpf_indicado));
    CREATE TABLE alunos (cpf TEXT PRIMARY KEY, nome TEXT, email TEXT);
    CREATE TABLE telefones (ddd TEXT, numero TEXT, cpf_aluno TEXT, PRIMARY KEY (ddd, numero));
');

$parametros = $argv;
array_shift($parametros);

$dados = new IndicaAlunoDto(...$parametros);
$indicaAluno = new IndicaAluno(new RepositorioIndicacaoPdo($pdo), new EnviadorEmailIndicacaoMail(), new RepositorioAlunoPdo($pdo));
$indicaAluno->indica($dados);

var_dump($pdo->query('SELECT * FROM indicacoes;')->fetchAll(\PDO::FETCH_ASSOC));
