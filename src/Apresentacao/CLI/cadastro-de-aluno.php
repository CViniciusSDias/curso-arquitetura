<?php

require_once 'vendor/autoload.php';

use Alura\Arquitetura\Aplicacao\Aluno\CadastraAluno;
use Alura\Arquitetura\Aplicacao\Aluno\CadastraAlunoDto;
use Alura\Arquitetura\Infra\Aluno\{CriptografadorDeSenhaMd5, CriptografadorDeSenhaPadrao, CriptografadorDeSenhaArgon2};
use Alura\Arquitetura\Infra\Aluno\RepositorioAlunoPdo;

$conexao = new PDO('sqlite::memory:');
$conexao->exec('CREATE TABLE alunos (cpf TEXT PRIMARY KEY, nome TEXT, email TEXT);');

$parametros = $argv;
array_shift($parametros);
$dados = new CadastraAlunoDto(...$parametros);
$service = new CadastraAluno(new RepositorioAlunoPdo($conexao), new CriptografadorDeSenhaArgon2());
$service->cadastra($dados);

$conexao->query('SELECT * FROM alunos')->fetchAll();
