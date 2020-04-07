<?php

namespace Alura\Arquitetura\Dominio\Indicacao;

interface RepositorioIndicacoesExternas
{
    /** @return Indicacao[] */
    public function todas(): array;
}
