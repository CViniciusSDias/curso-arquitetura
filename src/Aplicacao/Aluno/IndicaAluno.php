<?php

namespace Alura\Arquitetura\Aplicacao\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Indicacao\EnviadorEmailIndicacao;
use Alura\Arquitetura\Dominio\Indicacao\Indicacao;
use Alura\Arquitetura\Dominio\Indicacao\RepositorioIndicacao;

class IndicaAluno
{
    private RepositorioIndicacao $repositorioIndicacao;
    private EnviadorEmailIndicacao $enviadorEmailIndicacao;

    public function __construct(RepositorioIndicacao $repositorioIndicacao, EnviadorEmailIndicacao $enviadorEmailIndicacao)
    {
        $this->repositorioIndicacao = $repositorioIndicacao;
        $this->enviadorEmailIndicacao = $enviadorEmailIndicacao;
    }

    public function indica(Aluno $indicante, Aluno $indicado): void
    {
        $indicacao = new Indicacao($indicado, $indicante, new \DateTimeImmutable());
        $this->repositorioIndicacao->adicionar($indicacao);
        $this->enviadorEmailIndicacao->enviarEmailPara($indicado);
    }
}
