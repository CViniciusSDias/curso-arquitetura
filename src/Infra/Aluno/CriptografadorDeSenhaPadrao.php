<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\CriptografadorDeSenha;

class CriptografadorDeSenhaPadrao implements CriptografadorDeSenha
{
    public function criptografarSenha(string $senhaEmTexto): string
    {
        return password_hash($senhaEmTexto, PASSWORD_DEFAULT);
    }

    public function senhaEhValida(string $senhaEmTexto, Aluno $aluno): bool
    {
        return password_verify($senhaEmTexto, $aluno->senha());
    }
}
