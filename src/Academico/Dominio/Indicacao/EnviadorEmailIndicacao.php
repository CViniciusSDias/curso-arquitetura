<?php

namespace Alura\Arquitetura\Academico\Dominio\Indicacao;

use Alura\Arquitetura\Academico\Dominio\Aluno\Aluno;

interface EnviadorEmailIndicacao
{
    public function enviarEmailPara(Aluno $alunoIndicado): void;
}
