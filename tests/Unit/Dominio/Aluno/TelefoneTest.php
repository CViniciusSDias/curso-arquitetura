<?php

namespace Alura\Arquitetura\Tests\Unit\Dominio\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Telefone;
use PHPUnit\Framework\TestCase;

class TelefoneTest extends TestCase
{
    public function testTelefoneDeveSerRepresentadoComoString()
    {
        $telefone = new Telefone('24', '22222222');

        $this->assertEquals('(24) 22222222', $telefone);
    }

    public function testTelefoneComDddNoFormatoInvalidoNaoPodeExistir()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('DDD inválido');

        new Telefone('', '22222222');
    }

    public function testTelefoneComNumeroNoFormatoInvalidoNaoPodeExistir()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Número de telefone inválido');

        new Telefone('21', '2222222');
    }
}
