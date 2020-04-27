<?php

namespace Alura\Arquitetura\Academico\Infra\Aluno;

use Alura\Arquitetura\Academico\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Academico\Dominio\Aluno\CriptografadorDeSenha;

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
