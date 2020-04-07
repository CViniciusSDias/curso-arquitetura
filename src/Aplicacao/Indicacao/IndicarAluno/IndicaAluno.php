<?php

namespace Alura\Arquitetura\Aplicacao\Indicacao\IndicarAluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\RepositorioAluno;
use Alura\Arquitetura\Dominio\CPF;
use Alura\Arquitetura\Dominio\Email;
use Alura\Arquitetura\Dominio\Indicacao\EnviadorEmailIndicacao;
use Alura\Arquitetura\Dominio\Indicacao\Indicacao;
use Alura\Arquitetura\Dominio\Indicacao\RepositorioIndicacao;

class IndicaAluno
{
    private RepositorioIndicacao $repositorioIndicacao;
    private EnviadorEmailIndicacao $enviadorEmailIndicacao;
    private RepositorioAluno $repositorioAluno;

    public function __construct(
        RepositorioIndicacao $repositorioIndicacao,
        EnviadorEmailIndicacao $enviadorEmailIndicacao,
        RepositorioAluno $repositorioAluno
    ) {
        $this->repositorioIndicacao = $repositorioIndicacao;
        $this->enviadorEmailIndicacao = $enviadorEmailIndicacao;
        $this->repositorioAluno = $repositorioAluno;
    }

    public function indica(IndicaAlunoDto $dados): void
    {
        $indicado = $this->repositorioAluno->buscaPorCpf(new CPF($dados->cpfIndicado));
        $indicante = $this->repositorioAluno->buscaPorCpf(new CPF($dados->cpfIndicante));
        $indicacao = new Indicacao($indicado, $indicante, new \DateTimeImmutable());

        $this->repositorioIndicacao->adicionar($indicacao);
        $this->enviadorEmailIndicacao->enviarEmailPara($indicado);
    }
}
