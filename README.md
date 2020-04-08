# Projeto para curso sobre arquitetura

## Descrição do curso

O curso tratará de detalhes de design e arquitetura, se baseando em conceitos de DDD e Clean Architecture.

## Descrição do projeto

A pasta `Apresentacao` irá conter o ponto de entrada no sistema, que falará com os casos de uso contidos na pasta
`Aplicacao`, que orquestram chamadas ao `Dominio`, que fornece todas as interfaces que podem ou não precisar de `Infraestrutura`.

PS.: O conteúdo da pasta `Apresentacao` deve ser ignorado por enquanto, visto que possui apenas alguns arquivos de rascunho