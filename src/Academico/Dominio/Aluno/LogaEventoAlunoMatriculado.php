<?php

namespace Alura\Arquitetura\Academico\Dominio\Aluno;

use Alura\Arquitetura\Shared\Dominio\Evento\EventoDominio;
use Alura\Arquitetura\Shared\Dominio\Evento\OuvinteEvento;

class LogaEventoAlunoMatriculado extends OuvinteEvento
{
    public function sabeProcessar(EventoDominio $evento): bool
    {
        return $evento instanceof AlunoMatriculado;
    }

    public function reageAo(EventoDominio $evento): void
    {
        /** @var AlunoMatriculado $eventoAlunoMatriculado */
        $eventoAlunoMatriculado = $evento;

        fprintf(
            STDERR,
            "Aluno com CPF %s foi matriculado em %s\n",
            $eventoAlunoMatriculado->cpfAluno(),
            $eventoAlunoMatriculado->momento()->format('d/m/Y')
        );
    }
}
