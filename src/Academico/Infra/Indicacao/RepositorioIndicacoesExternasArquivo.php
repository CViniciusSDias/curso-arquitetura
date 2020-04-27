<?php

namespace Alura\Arquitetura\Academico\Infra\Indicacao;

use Alura\Arquitetura\Academico\Dominio\Aluno\FabricaAluno;
use Alura\Arquitetura\Academico\Dominio\Indicacao\Indicacao;
use Alura\Arquitetura\Academico\Dominio\Indicacao\RepositorioIndicacoesExternas;

class RepositorioIndicacoesExternasArquivo implements RepositorioIndicacoesExternas
{
    private string $caminhoArquivo;

    public function __construct(string $caminhoArquivo)
    {
        $this->caminhoArquivo = $caminhoArquivo;
    }

    /** @return Indicacao[] */
    public function todas(): array
    {
        $listaIndicacoes = [];
        $dadosArquivo = json_decode(file_get_contents($this->caminhoArquivo));
        foreach ($dadosArquivo as $dadosIndicacao) {
            $fabricaAluno = new FabricaAluno();
            $indicado = $fabricaAluno
                ->comCpfNomeEmail(
                    $dadosIndicacao['cpf_indicado'],
                    $dadosIndicacao['nome_indicado'],
                    $dadosIndicacao['email_indicado']
                )
                ->constroi();
            $indicante = $fabricaAluno
                ->comCpfNomeEmail(
                    $dadosIndicacao['cpf_indicante'],
                    $dadosIndicacao['nome_indicante'],
                    $dadosIndicacao['email_indicante']
                )
                ->constroi();

            $listaIndicacoes[] = new Indicacao(
                $indicado,
                $indicante,
                \DateTimeImmutable::createFromFormat('!d/m/Y', $dadosIndicacao['data_indicacao'])
            );
        }

        return $listaIndicacoes;
    }
}
