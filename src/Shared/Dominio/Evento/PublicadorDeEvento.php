<?php

namespace Alura\Arquitetura\Shared\Dominio\Evento;

class PublicadorDeEvento
{
    /** @var OuvinteEvento[]  */
    private array $processadoresEvento = [];

    public function adicionaOuvinte(OuvinteEvento $processadorEvento)
    {
        $this->processadoresEvento[] = $processadorEvento;
    }

    public function publica(Evento $evento)
    {
        foreach ($this->processadoresEvento as $processadorEvento) {
            $processadorEvento->processa($evento);
        }
    }
}
