<?php

namespace Alura\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno;

use Alura\Arquitetura\Academico\Dominio\Aluno\AlunoMatriculado;
use Alura\Arquitetura\Academico\Dominio\Aluno\CriptografadorDeSenha;
use Alura\Arquitetura\Academico\Dominio\Aluno\FabricaAluno;
use Alura\Arquitetura\Academico\Dominio\Aluno\RepositorioAluno;
use Alura\Arquitetura\Shared\Dominio\Evento\EmitidorEvento;

class MatriculaAluno
{
    private RepositorioAluno $repositorioAluno;
    private CriptografadorDeSenha $criptografadorDeSenha;
    private EmitidorEvento $emitidorEvento;

    public function __construct(
        RepositorioAluno $repositorioAluno,
        CriptografadorDeSenha $criptografadorDeSenha,
        EmitidorEvento $emitidorEvento
    ) {
        $this->repositorioAluno = $repositorioAluno;
        $this->criptografadorDeSenha = $criptografadorDeSenha;
        $this->emitidorEvento = $emitidorEvento;
    }

    public function cadastra(MatriculaAlunoDto $dados): void
    {
        $aluno = (new FabricaAluno())
            ->comCpfNomeEmail($dados->numeroCpfAluno, $dados->nomeAluno, $dados->enderecoEmailAluno)
            ->comSenha($this->criptografadorDeSenha->criptografarSenha($dados->senhaEmTextoAluno))
            ->constroi();

        $this->repositorioAluno->adiciona($aluno);

        $this->emitidorEvento->dipatch(new AlunoMatriculado($aluno->cpf()));
    }
}
