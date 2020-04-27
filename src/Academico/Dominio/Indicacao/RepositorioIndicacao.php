<?php

namespace Alura\Arquitetura\Academico\Dominio\Indicacao;

interface RepositorioIndicacao
{
    public function adicionar(Indicacao $indicacao): void;
}
