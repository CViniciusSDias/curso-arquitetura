<?php

namespace Alura\Arquitetura\Academico\Infra\Aluno;

use Alura\Arquitetura\Academico\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Academico\Dominio\Aluno\CriptografadorDeSenha;

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
