<?php

namespace Alura\Arquitetura\Infra\Indicacao;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\CPF;
use Alura\Arquitetura\Dominio\Email;
use Alura\Arquitetura\Dominio\Indicacao\Indicacao;
use Alura\Arquitetura\Dominio\Indicacao\RepositorioIndicacoesExternas;

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
            $indicado = new Aluno(
                new CPF($dadosIndicacao['cpf_indicado']),
                $dadosIndicacao['nome_indicado'],
                new Email($dadosIndicacao['email_indicado'])
            );
            $indicante = new Aluno(
                new CPF($dadosIndicacao['cpf_indicante']),
                $dadosIndicacao['nome_indicante'],
                new Email($dadosIndicacao['email_indicante'])
            );

            $listaIndicacoes[] = new Indicacao(
                $indicado,
                $indicante,
                \DateTimeImmutable::createFromFormat('!d/m/Y', $dadosIndicacao['data_indicacao'])
            );
        }

        return $listaIndicacoes;
    }
}
