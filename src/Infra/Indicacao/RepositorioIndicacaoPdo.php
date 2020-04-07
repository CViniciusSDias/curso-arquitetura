<?php

namespace Alura\Arquitetura\Infra\Indicacao;

use Alura\Arquitetura\Dominio\Indicacao\Indicacao;
use Alura\Arquitetura\Dominio\Indicacao\RepositorioIndicacao;
use PDO;

class RepositorioIndicacaoPdo implements RepositorioIndicacao
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function adicionar(Indicacao $indicacao): void
    {
        $sql = 'INSERT INTO indicacoes (cpf_indicante, cpf_indicado, data_indicacao) VALUES (:indicante, :indicado, :data);';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('indicante', $indicacao->cpfIndicante());
        $stmt->bindValue('indicado', $indicacao->cpfIndicado());
        $stmt->bindValue('data', $indicacao->dataIndicacao()->format('Y-m-d'));
        $stmt->execute();
    }
}
