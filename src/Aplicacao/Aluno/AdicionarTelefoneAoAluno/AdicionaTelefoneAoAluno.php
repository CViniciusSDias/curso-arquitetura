<?php

namespace Alura\Arquitetura\Aplicacao\Aluno\AdicionarTelefoneAoAluno;

use Alura\Arquitetura\Dominio\Aluno\RepositorioAluno;
use Alura\Arquitetura\Dominio\Aluno\Telefone;
use Alura\Arquitetura\Dominio\CPF;

class AdicionaTelefoneAoAluno
{
    private RepositorioAluno $repositorioAluno;

    public function __construct(RepositorioAluno $repositorioAluno)
    {
        $this->repositorioAluno = $repositorioAluno;
    }

    public function adicionaTelefoneAoAluno(AdicionaTelefoneAoAlunoDto $dados)
    {
        $cpf = new CPF($dados->cpfAluno);
        $aluno = $this->repositorioAluno->buscaPorCpf($cpf);

        $this->repositorioAluno
            ->adicionaTelefoneAoAluno($aluno, new Telefone($dados->dddTelefone, $dados->numeroTelefone));
    }
}
