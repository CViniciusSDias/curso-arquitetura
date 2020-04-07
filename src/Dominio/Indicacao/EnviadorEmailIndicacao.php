<?php

namespace Alura\Arquitetura\Dominio\Indicacao;

use Alura\Arquitetura\Dominio\Aluno\Aluno;

interface EnviadorEmailIndicacao
{
    public function enviarEmailPara(Aluno $alunoIndicado): void;
}
