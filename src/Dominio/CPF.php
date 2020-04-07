<?php

namespace Alura\Arquitetura\Dominio;

class CPF
{
    private string $numero;

    public function __construct(string $numero)
    {
        $opcoes = [
            'options' => [
                'regexp' => '/\d{3}\.\d{3}\.\d{3}\-\d{2}/',
            ],
        ];
        if (filter_var($numero, FILTER_VALIDATE_REGEXP, $opcoes) === false) {
            throw new \InvalidArgumentException('Número do CPF fornecido em formato inválido');
        }

        $this->numero = $numero;
    }

    public function __toString(): string
    {
        return $this->numero;
    }
}
