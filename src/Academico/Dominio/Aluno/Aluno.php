<?php

namespace Alura\Arquitetura\Academico\Dominio\Aluno;

use Alura\Arquitetura\Academico\Dominio\{CPF, Email};

class Aluno
{
    private CPF $cpf;
    private string $nome;
    private Email $email;
    /** @var Telefone[] */
    private array $telefones;
    private string $senha;

    public function __construct(CPF $cpf, string $nome, Email $email)
    {
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->email = $email;
        $this->telefones = [];
    }

    public function numeroCpf(): string
    {
        return $this->cpf;
    }

    public function cpf(): CPF
    {
        return $this->cpf;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function addTelefone(string $ddd, string $numero)
    {
        $this->telefones[] = new Telefone($ddd, $numero);
    }

    /** @return string[] */
    public function numerosTelefone(): array
    {
        return array_map(fn ($telefone) => (string) $telefone, $this->telefones);
    }

    /** @return Telefone[] */
    public function telefones(): array
    {
        return $this->telefones;
    }

    public function defineSenha(string $senha)
    {
        $this->senha = $senha;
    }

    public function senha(): string
    {
        return $this->senha;
    }
}
