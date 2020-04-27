<?php

namespace Alura\Arquitetura\Shared\Dominio\Evento;

interface EventoDominio
{
    public function momento(): \DateTimeInterface;
}
