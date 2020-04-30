<?php

namespace Alura\Arquitetura\Shared\Dominio\Evento;

abstract class OuvinteEvento
{
    public function processa(EventoDominio $evento)
    {
        if ($this->sabeProcessar($evento)) {
            $this->reageAo($evento);
        }
    }

    abstract public function sabeProcessar(EventoDominio $evento): bool;
    abstract public function reageAo(EventoDominio $evento): void;
}
