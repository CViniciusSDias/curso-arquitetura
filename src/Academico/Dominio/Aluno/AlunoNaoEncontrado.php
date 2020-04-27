<?php

namespace Alura\Arquitetura\Academico\Dominio\Aluno;

use Alura\Arquitetura\Academico\Dominio\CPF;
use Throwable;

class AlunoNaoEncontrado extends \DomainException
{
    public function __construct(CPF $cpf)
    {
        parent::__construct("Aluno com CPF $cpf não encontrado");
    }
}
