<?php

namespace Alura\Arquitetura\Infra\Aluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\AlunoNaoEncontrado;
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
        $sql = 'SELECT cpf, nome, email, ddd, numero as numero_telefone FROM alunos LEFT JOIN telefones ON telefones.cpf_aluno = alunos.cpf WHERE alunos.cpf = ?;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, (string) $cpf);
        $stmt->execute();

        $dadosAluno = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($dadosAluno) === 0) {
            throw new AlunoNaoEncontrado($cpf);
        }

        return $this->mapeiaAluno($dadosAluno);
    }

    private function mapeiaAluno(array $dadosAluno): Aluno
    {
        if (empty($dadosAluno)) {
            throw new \InvalidArgumentException('Aluno não existe');
        }

        $primeiraLinha = $dadosAluno[0];
        $aluno = new Aluno(new CPF($primeiraLinha['cpf']), $primeiraLinha['nome'], new Email($primeiraLinha['email']));
        $telefones = array_filter($dadosAluno, fn ($linha) => $linha['ddd'] !== null && $linha['numero_telefone'] !== null);
        foreach ($telefones as $linha) {
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

    public function adicionaTelefoneAoAluno(Aluno $aluno, Telefone $telefone)
    {
        $stmt = $this->pdo->prepare('INSERT INTO telefones (ddd, numero, cpf_aluno) VALUES (:ddd, :numero, :cpf_aluno);');
        $stmt->bindValue('ddd', $telefone->ddd());
        $stmt->bindValue('numero', $telefone->numero());
        $stmt->bindValue('cpf_aluno', (string) $aluno->cpf());

        $stmt->execute();
    }
}
