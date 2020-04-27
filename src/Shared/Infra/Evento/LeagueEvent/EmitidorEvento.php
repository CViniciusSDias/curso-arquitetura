<?php

namespace Alura\Arquitetura\Shared\Infra\Evento\LeagueEvent;

use Alura\Arquitetura\Shared\Dominio\Evento\{EventoDominio, EmitidorEvento as EmitidorEventoDominio};
use League\Event\Emitter;

class EmitidorEvento implements EmitidorEventoDominio
{
    private Emitter $emitidor;

    public function __construct(Emitter $emitidor)
    {
        $this->emitidor = $emitidor;
    }

    public function dipatch(EventoDominio $eventoDominio): void
    {
        $this->emitidor->emit(new Evento($eventoDominio));
    }
}
