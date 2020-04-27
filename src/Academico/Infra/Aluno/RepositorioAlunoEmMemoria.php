<?php

namespace Alura\Arquitetura\Academico\Infra\Aluno;

use Alura\Arquitetura\Academico\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Academico\Dominio\Aluno\AlunoNaoEncontrado;
use Alura\Arquitetura\Academico\Dominio\Aluno\RepositorioAluno;
use Alura\Arquitetura\Academico\Dominio\Aluno\Telefone;
use Alura\Arquitetura\Academico\Dominio\CPF;

class RepositorioAlunoEmMemoria implements RepositorioAluno
{
    private array $alunos = [];

    public function adiciona(Aluno $aluno): void
    {
        $this->alunos[] = $aluno;
    }

    /**
     * @inheritDoc
     */
    public function buscaPorCpf(CPF $cpf): Aluno
    {
        $aluno = array_values(array_filter($this->alunos, fn (Aluno $aluno) => $aluno->numeroCpf() == $cpf));
        if (count($aluno) === 0) {
            throw new AlunoNaoEncontrado($cpf);
        }

        return $aluno[0];
    }

    public function maiorIndicante(): Aluno
    {
        return null;
    }

    public function adicionaTelefoneAoAluno(Aluno $aluno, Telefone $telefone)
    {
        $aluno->addTelefone($telefone->ddd(), $telefone->numero());
    }
}
