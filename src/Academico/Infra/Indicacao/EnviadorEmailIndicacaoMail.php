<?php

namespace Alura\Arquitetura\Academico\Infra\Indicacao;

use Alura\Arquitetura\Academico\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Academico\Dominio\Indicacao\EnviadorEmailIndicacao;

class EnviadorEmailIndicacaoMail implements EnviadorEmailIndicacao
{
    public function enviarEmailPara(Aluno $alunoIndicado): void
    {
        /*mail(
            $alunoIndicado->email(),
            'Você foi indicado para se cadastrar',
            'Olá. Você acaba de ser indicado para se cadastrar em nossa plataforma.'
        );*/
    }
}
