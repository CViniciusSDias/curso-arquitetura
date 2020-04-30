<?php

namespace Alura\Arquitetura\Shared\Dominio\Evento;

abstract class Evento
{
    private \DateTimeImmutable $momento;

    public function __construct()
    {
        $this->momento = new \DateTimeImmutable();
    }

    public function momento(): \DateTimeImmutable
    {
        return $this->momento;
    }

    public function nome(): string
    {
        return get_class($this);
    }
}
