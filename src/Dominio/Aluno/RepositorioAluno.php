<?php


namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Dominio\CPF;

interface RepositorioAluno
{
    public function adiciona(Aluno $aluno): void;
    /** @throws \DomainException Caso aluno com CPF informado não exista */
    public function buscaPorCpf(CPF $cpf): Aluno;
    public function maiorIndicante(): Aluno;
    public function adicionaTelefoneAoAluno(Aluno $aluno, Telefone $telefone);
}
