<?php

namespace Alura\Arquitetura\Dominio\Indicacao;

interface RepositorioIndicacao
{
    public function adicionar(Indicacao $indicacao): void;
}
