<?php

namespace Alura\Arquitetura\Academico\Dominio\Indicacao;

use Alura\Arquitetura\Academico\Dominio\Aluno\Aluno;

class Indicacao
{
    private Aluno $indicado;
    private Aluno $indicante;
    private \DateTimeImmutable $dataIndicacao;

    public function __construct(Aluno $indicado, Aluno $indicante, \DateTimeImmutable $dataIndicacao)
    {
        $this->indicado = $indicado;
        $this->indicante = $indicante;
        $this->dataIndicacao = $dataIndicacao;
    }

    public function nomeIndicado(): string
    {
        return $this->indicado->nome();
    }

    public function nomeIndicante(): string
    {
        return $this->indicante->nome();
    }

    public function dataIndicacao(): \DateTimeInterface
    {
        return $this->dataIndicacao;
    }

    public function cpfIndicante(): string
    {
        return $this->indicante->numeroCpf();
    }

    public function cpfIndicado(): string
    {
        return $this->indicado->numeroCpf();
    }
}
