<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\CriptografadorDeSenha;

class CriptografadorDeSenhaMd5 implements CriptografadorDeSenha
{
    public function criptografarSenha(string $senhaEmTexto): string
    {
        return md5($senhaEmTexto);
    }

    public function senhaEhValida(string $senhaEmTexto, Aluno $aluno): bool
    {
        return md5($senhaEmTexto) === $aluno->senha();
    }
}
