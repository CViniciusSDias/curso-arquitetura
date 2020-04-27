<?php

namespace Alura\Arquitetura\Shared\Infra\DI;

use Alura\Arquitetura\Academico\Dominio\Aluno\AlunoMatriculado;
use Alura\Arquitetura\Academico\Dominio\Aluno\CriptografadorDeSenha;
use Alura\Arquitetura\Academico\Dominio\Aluno\RepositorioAluno;
use Alura\Arquitetura\Academico\Dominio\Indicacao\EnviadorEmailIndicacao;
use Alura\Arquitetura\Academico\Infra\Aluno\CriptografadorDeSenhaArgon2;
use Alura\Arquitetura\Academico\Infra\Aluno\RepositorioAlunoPdo;
use Alura\Arquitetura\Academico\Infra\Indicacao\EnviadorEmailIndicacaoMail;
use Alura\Arquitetura\Shared\Dominio\Evento\EmitidorEvento;
use Alura\Arquitetura\Shared\Infra\Evento\LeagueEvent\EmitidorEvento as LeagueEventEmitidorEvento;
use Alura\Arquitetura\Shared\Infra\Evento\LeagueEvent\Evento as LeagueEventEvento;
use DI\ContainerBuilder;
use League\Event\Emitter;
use PDO;
use Psr\Container\ContainerInterface;
use function DI\autowire;
use function DI\factory;

final class ContainerCreator
{
    public static function criarContainer(): ContainerInterface
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(self::definitions());

        return $builder->build();
    }

    private static function definitions()
    {
        return [
            RepositorioAluno::class => autowire(RepositorioAlunoPdo::class),
            EmitidorEvento::class => autowire(LeagueEventEmitidorEvento::class),
            CriptografadorDeSenha::class => autowire(CriptografadorDeSenhaArgon2::class),
            EnviadorEmailIndicacao::class => autowire(EnviadorEmailIndicacaoMail::class),
            PDO::class => factory(function () {
                $pdo = new PDO('sqlite::memory:');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->exec('
                    CREATE TABLE indicacoes (cpf_indicante TEXT, cpf_indicado TEXT, data_indicacao TEXT, PRIMARY KEY (cpf_indicante, cpf_indicado));
                    CREATE TABLE alunos (cpf TEXT PRIMARY KEY, nome TEXT, email TEXT);
                    CREATE TABLE telefones (ddd TEXT, numero TEXT, cpf_aluno TEXT, PRIMARY KEY (ddd, numero));
                ');

                return $pdo;
            }),
            Emitter::class => factory(fn () => self::mapeamentoEventos())
        ];
    }

    private static function mapeamentoEventos(): Emitter
    {
        $emitter = new Emitter();

        $emitter->addListener(AlunoMatriculado::class, function (LeagueEventEvento $leagueEventEvento) {
            /** @var AlunoMatriculado $eventoDominio */
            $eventoDominio = $leagueEventEvento->eventoDominio();

            fprintf(
                STDERR,
                "Aluno com CPF %s foi matriculado em %s\n",
                $eventoDominio->cpfAluno(),
                $eventoDominio->momento()->format('d/m/Y')
            );
        });

        return $emitter;
    }
}
