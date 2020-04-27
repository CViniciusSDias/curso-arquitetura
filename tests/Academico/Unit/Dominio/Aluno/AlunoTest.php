<?php

namespace Alura\Arquitetura\Tests\Academico\Unit\Dominio\Aluno;

use Alura\Arquitetura\Academico\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Academico\Dominio\CPF;
use Alura\Arquitetura\Academico\Dominio\Email;
use PHPUnit\Framework\TestCase;

class AlunoTest extends TestCase
{
    public function testAlunoDeveSaberSeusNumerosDeTelefone()
    {
        $aluno = new Aluno(
            new CPF('123.456.789-10'), 'Vinicius Dias', new Email('email@example.com')
        );
        $aluno->addTelefone('24', '999999999');
        $aluno->addTelefone('21', '22222222');

        $numerosTelefone = [
            '(24) 999999999',
            '(21) 22222222',
        ];
        $this->assertEquals($numerosTelefone, $aluno->numerosTelefone());
    }
}
