<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\RepositorioAluno;
use Alura\Arquitetura\Dominio\Aluno\Telefone;
use Alura\Arquitetura\Dominio\CPF;
use Alura\Arquitetura\Dominio\Email;
use PDO;

class RepositorioAlunoPdo implements RepositorioAluno
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function adiciona(Aluno $aluno): void
    {
        $sql = 'INSERT INTO alunos (cpf, nome, email) VALUES (:cpf, :nome, :email);';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('cpf', $aluno->cpf());
        $stmt->bindValue('nome', $aluno->nome());
        $stmt->bindValue('email', $aluno->email());
        $stmt->execute();

        $sql = 'INSERT INTO telefones (ddd, numero) VALUES (:ddd, :numero);';
        $stmt = $this->pdo->prepare($sql);

        /** @var Telefone $telefone */
        foreach ($aluno->telefones() as $telefone) {
            $stmt->bindValue('ddd', $telefone->ddd());
            $stmt->bindValue('numero', $telefone->numero());
            $stmt->execute();
        }
    }

    public function buscaPorCpf(CPF $cpf): Aluno
    {
        $sql = 'SELECT cpf, nome, email, ddd, numero as numero_telefone FROM alunos JOIN telefones ON telefones.cpf_aluno = aluno.cpf WHERE cpf = ?;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, (string) $cpf);

        $dadosAluno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->mapeiaAluno($dadosAluno);
    }

    private function mapeiaAluno(array $dadosAluno): Aluno
    {
        if (empty($dadosAluno)) {
            throw new \InvalidArgumentException('Aluno não existe');
        }

        $primeiraLinha = $dadosAluno[0];
        $aluno = new Aluno(new CPF($primeiraLinha['cpf']), $primeiraLinha['nome'], new Email($primeiraLinha['email']));
        foreach ($dadosAluno as $linha) {
            $aluno->addTelefone($linha['ddd'], $linha['numero_telefone']);
        }

        return $aluno;
    }

    public function maiorIndicante(): Aluno
    {
        $sql = 'SELECT COUNT(indicacoes.id) AS numero_indicacoes,
                       cpf
                  FROM indicacoes
                  JOIN alunos ON alunos.cpf = indicacoes.cpf_indicante
              GROUP BY cpf
              ORDER BY numero_indicacoes DESC
                 LIMIT 1;';
        $stmt = $this->pdo->query($sql);

        $dadosAluno = $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->buscaPorCpf($dadosAluno['cpf']);
    }
}
