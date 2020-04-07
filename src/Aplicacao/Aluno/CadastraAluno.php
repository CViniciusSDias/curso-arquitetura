<?php

namespace Alura\Arquitetura\Aplicacao\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\CriptografadorDeSenha;
use Alura\Arquitetura\Dominio\Aluno\RepositorioAluno;
use Alura\Arquitetura\Dominio\CPF;
use Alura\Arquitetura\Dominio\Email;

class CadastraAluno
{
    private RepositorioAluno $repositorioAluno;
    private CriptografadorDeSenha $criptografadorDeSenha;

    public function __construct(RepositorioAluno $repositorioAluno, CriptografadorDeSenha $criptografadorDeSenha)
    {
        $this->repositorioAluno = $repositorioAluno;
        $this->criptografadorDeSenha = $criptografadorDeSenha;
    }

    public function cadastra(CadastraAlunoDto $dados): void
    {
        $aluno = new Aluno(
            new CPF($dados->numeroCpfAluno),
            $dados->nomeAluno,
            new Email($dados->enderecoEmailAluno),
        );
        $aluno->defineSenha($this->criptografadorDeSenha->criptografarSenha($dados->senhaEmTextoAluno));
        var_dump($aluno->senha());

        $this->repositorioAluno->adiciona($aluno);
    }
}
