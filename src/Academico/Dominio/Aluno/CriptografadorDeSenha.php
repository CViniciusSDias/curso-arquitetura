<?php

namespace Alura\Arquitetura\Academico\Dominio\Aluno;

interface CriptografadorDeSenha
{
    public function criptografarSenha(string $senhaEmTexto): string;
    public function senhaEhValida(string $senhaEmTexto, Aluno $aluno): bool;
}
