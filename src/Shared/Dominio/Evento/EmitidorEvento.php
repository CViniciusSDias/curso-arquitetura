<?php


namespace Alura\Arquitetura\Shared\Dominio\Evento;

use Alura\Arquitetura\Shared\Dominio\Evento\EventoDominio;

interface EmitidorEvento
{
    public function dipatch(EventoDominio $eventoDominio): void;
}
