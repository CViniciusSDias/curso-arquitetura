<?php

namespace Alura\Arquitetura\Academico\Aplicacao\Indicacao\IndicarAluno;

use Alura\Arquitetura\Academico\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Academico\Dominio\Aluno\RepositorioAluno;
use Alura\Arquitetura\Academico\Dominio\CPF;
use Alura\Arquitetura\Academico\Dominio\Email;
use Alura\Arquitetura\Academico\Dominio\Indicacao\EnviadorEmailIndicacao;
use Alura\Arquitetura\Academico\Dominio\Indicacao\Indicacao;
use Alura\Arquitetura\Academico\Dominio\Indicacao\RepositorioIndicacao;

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
