<?php

namespace Alura\Arquitetura\Tests\Unit\Dominio\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\CPF;
use Alura\Arquitetura\Dominio\Email;
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
