<?php

namespace Alura\Arquitetura\Academico\Aplicacao\Aluno\MatricularAluno;

use Alura\Arquitetura\Academico\Dominio\Aluno\AlunoMatriculado;
use Alura\Arquitetura\Academico\Dominio\Aluno\CriptografadorDeSenha;
use Alura\Arquitetura\Academico\Dominio\Aluno\FabricaAluno;
use Alura\Arquitetura\Academico\Dominio\Aluno\RepositorioAluno;
use Alura\Arquitetura\Shared\Dominio\Evento\EmitidorEvento;
use Alura\Arquitetura\Shared\Dominio\Evento\PublicadorDeEvento;

class MatriculaAluno
{
    private RepositorioAluno $repositorioAluno;
    private CriptografadorDeSenha $criptografadorDeSenha;
    private PublicadorDeEvento $publicadorDeEvento;

    public function __construct(
        RepositorioAluno $repositorioAluno,
        CriptografadorDeSenha $criptografadorDeSenha,
        PublicadorDeEvento $publicadorDeEvento
    ) {
        $this->repositorioAluno = $repositorioAluno;
        $this->criptografadorDeSenha = $criptografadorDeSenha;
        $this->publicadorDeEvento = $publicadorDeEvento;
    }

    public function cadastra(MatriculaAlunoDto $dados): void
    {
        $aluno = (new FabricaAluno())
            ->comCpfNomeEmail($dados->numeroCpfAluno, $dados->nomeAluno, $dados->enderecoEmailAluno)
            ->comSenha($this->criptografadorDeSenha->criptografarSenha($dados->senhaEmTextoAluno))
            ->constroi();

        $this->repositorioAluno->adiciona($aluno);

        $this->publicadorDeEvento->publica(new AlunoMatriculado($aluno->cpf()));
    }
}
