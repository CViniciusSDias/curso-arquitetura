<?php


namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Dominio\CPF;

interface RepositorioAluno
{
    public function adiciona(Aluno $aluno): void;
    public function buscaPorCpf(CPF $cpf): Aluno;
    public function maiorIndicante(): Aluno;
    public function adicionaTelefoneAoAluno(Aluno $aluno, Telefone $telefone);
}
