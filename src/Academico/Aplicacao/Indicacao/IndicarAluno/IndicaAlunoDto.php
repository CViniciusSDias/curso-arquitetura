<?php

namespace Alura\Arquitetura\Academico\Aplicacao\Indicacao\IndicarAluno;

class IndicaAlunoDto
{
    public string $cpfIndicado;
    public string $cpfIndicante;

    public function __construct(string $cpfIndicado, string $cpfIndicante)
    {
        $this->cpfIndicado = $cpfIndicado;
        $this->cpfIndicante = $cpfIndicante;
    }
}
