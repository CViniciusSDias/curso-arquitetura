<?php

namespace Alura\Arquitetura\Academico\Aplicacao\Aluno\AdicionarTelefoneAoAluno;

class AdicionaTelefoneAoAlunoDto
{
    public string $cpfAluno;
    public string $dddTelefone;
    public string $numeroTelefone;

    public function __construct(string $cpfAluno, string $dddTelefone, string $numeroTelefone)
    {
        $this->cpfAluno = $cpfAluno;
        $this->dddTelefone = $dddTelefone;
        $this->numeroTelefone = $numeroTelefone;
    }
}
