<?php

namespace Alura\Arquitetura\Academico\Dominio\Aluno;

use Alura\Arquitetura\Shared\Dominio\Evento\Evento;
use Alura\Arquitetura\Shared\Dominio\Evento\OuvinteEvento;

class LogaEventoAlunoMatriculado extends OuvinteEvento
{
    public function sabeProcessar(Evento $evento): bool
    {
        return $evento->nome() === AlunoMatriculado::class;
    }

    public function reageAo(Evento $evento): void
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
