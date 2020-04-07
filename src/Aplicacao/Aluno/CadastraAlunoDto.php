<?php

namespace Alura\Arquitetura\Aplicacao\Aluno;

class CadastraAlunoDto
{
    public string $numeroCpfAluno;
    public string $nomeAluno;
    public string $enderecoEmailAluno;
    public string $senhaEmTextoAluno;

    public function __construct(string $numeroCpfAluno, string $nomeAluno, string $enderecoEmailAluno, string $senhaEmTextoAluno)
    {
        $this->numeroCpfAluno = $numeroCpfAluno;
        $this->nomeAluno = $nomeAluno;
        $this->enderecoEmailAluno = $enderecoEmailAluno;
        $this->senhaEmTextoAluno = $senhaEmTextoAluno;
    }
}
