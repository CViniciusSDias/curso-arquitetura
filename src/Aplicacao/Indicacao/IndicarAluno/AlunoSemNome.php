<?php

namespace Alura\Arquitetura\Aplicacao\Indicacao\IndicarAluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\CPF;
use Alura\Arquitetura\Dominio\Email;

class AlunoSemNome extends Aluno
{
    public function __construct(CPF $cpf, Email $email)
    {
        parent::__construct($cpf, '', $email);
    }
}
