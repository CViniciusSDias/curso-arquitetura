<?php

namespace Alura\Arquitetura\Dominio\Indicacao;

interface RepositorioExternoIndicacao
{
    /** @return Indicacao[] */
    public function todas(): array;
}
