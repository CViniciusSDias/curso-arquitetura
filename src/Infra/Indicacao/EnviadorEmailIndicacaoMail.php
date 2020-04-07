<?php

namespace Alura\Arquitetura\Infra\Indicacao;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Indicacao\EnviadorEmailIndicacao;

class EnviadorEmailIndicacaoMail implements EnviadorEmailIndicacao
{
    public function enviarEmailPara(Aluno $alunoIndicado): void
    {
        mail($alunoIndicado->email(), 'Você foi indicado para se cadastrar', 'Olá. Você acaba de ser indicado para se cadastrar em nossa plataforma.');
    }
}
