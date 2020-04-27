<?php

namespace Alura\Arquitetura\Academico\Dominio\Indicacao;

interface RepositorioIndicacoesExternas
{
    /** @return Indicacao[] */
    public function todas(): array;
}
