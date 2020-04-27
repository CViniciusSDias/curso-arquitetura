<?php

namespace Alura\Arquitetura\Shared\Infra\Evento\LeagueEvent;

use Alura\Arquitetura\Shared\Dominio\Evento\EventoDominio;
use League\Event\AbstractEvent;

class Evento extends AbstractEvent
{
    private EventoDominio $eventoDominio;

    public function __construct(EventoDominio $eventoDominio)
    {
        $this->eventoDominio = $eventoDominio;
    }

    public function getName()
    {
        return get_class($this->eventoDominio);
    }

    public function eventoDominio(): EventoDominio
    {
        return $this->eventoDominio;
    }
}
