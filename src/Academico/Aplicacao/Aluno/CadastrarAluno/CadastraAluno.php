<?php

namespace Alura\Arquitetura\Academico\Aplicacao\Aluno\CadastrarAluno;

use Alura\Arquitetura\Academico\Dominio\Aluno\CriptografadorDeSenha;
use Alura\Arquitetura\Academico\Dominio\Aluno\FabricaAluno;
use Alura\Arquitetura\Academico\Dominio\Aluno\RepositorioAluno;

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
        $aluno = (new FabricaAluno())
            ->comCpfNomeEmail($dados->numeroCpfAluno, $dados->nomeAluno, $dados->enderecoEmailAluno)
            ->comSenha($this->criptografadorDeSenha->criptografarSenha($dados->senhaEmTextoAluno))
            ->constroi();

        $this->repositorioAluno->adiciona($aluno);
    }
}
