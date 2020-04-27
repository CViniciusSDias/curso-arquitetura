<?php

namespace Alura\Arquitetura\Academico\Dominio\Aluno;

use Alura\Arquitetura\Academico\Dominio\CPF;
use Alura\Arquitetura\Shared\Dominio\Evento\EventoDominio;

class AlunoMatriculado implements EventoDominio
{
    private CPF $cpfAluno;
    private \DateTimeInterface $momento;

    public function __construct(CPF $cpfAluno)
    {
        $this->cpfAluno = $cpfAluno;
        $this->momento = new \DateTimeImmutable();
    }

    public function cpfAluno(): CPF
    {
        return $this->cpfAluno;
    }

    public function momento(): \DateTimeInterface
    {
        return $this->momento;
    }
}
