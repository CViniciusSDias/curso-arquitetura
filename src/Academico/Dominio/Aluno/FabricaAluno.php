<?php

namespace Alura\Arquitetura\Academico\Dominio\Aluno;

use Alura\Arquitetura\Academico\Dominio\CPF;
use Alura\Arquitetura\Academico\Dominio\Email;

class FabricaAluno
{
    private Aluno $aluno;

    public function comCpfNomeEmail(string $numeroCpf, string $nome, string $enderecoEmail): self
    {
        $cpf = new CPF($numeroCpf);
        $email = new Email($enderecoEmail);

        $this->aluno = new Aluno($cpf, $nome, $email);

        return $this;
    }

    public function comSenha(string $senhaCifrada): self
    {
        $this->aluno->defineSenha($senhaCifrada);

        return $this;
    }

    public function comTelefone(string $ddd, string $numero): self
    {
        $this->aluno->addTelefone($ddd, $numero);

        return $this;
    }

    public function constroi(): Aluno
    {
        return $this->aluno;
    }
}
