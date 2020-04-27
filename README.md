# Projeto para curso sobre DDD

## Descrição do curso

O curso tratará de detalhes de design e arquitetura, se baseando em conceitos de DDD e Clean Architecture.

## Descrição do projeto

A pasta raiz contém os Bounded Contexts (Acadêmico e Gamificação) e o Shared Kernel. Dentro de cada uma destas pastas
temos estruturas bem semelhantes.

A pasta `Apresentacao` irá conter o ponto de entrada no sistema, que falará com os casos de uso contidos na pasta
`Aplicacao`, que orquestram chamadas ao `Dominio`, que fornece todas as interfaces que podem ou não precisar de
`Infra`.

PS.: O conteúdo da pasta `Apresentacao` deve ser ignorado por enquanto, visto que possui apenas alguns arquivos de
rascunho