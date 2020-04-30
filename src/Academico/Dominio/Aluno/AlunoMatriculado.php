<?php

namespace Alura\Arquitetura\Academico\Dominio\Aluno;

use Alura\Arquitetura\Academico\Dominio\CPF;
use Alura\Arquitetura\Shared\Dominio\Evento\Evento;

class AlunoMatriculado extends Evento
{
    private CPF $cpfAluno;

    public function __construct(CPF $cpfAluno)
    {
        parent::__construct();
        $this->cpfAluno = $cpfAluno;
    }

    public function cpfAluno(): CPF
    {
        return $this->cpfAluno;
    }
}
