# Applying Clean Architecture in PHP

## Camadas
    - App --> Regras de aplicação, especificidades da implementação
    - Domain --> Regras de Negócio, necessidades do time de negócios
    - Repository(Infra) --> Repositories, frameworks, ui, externas à aplicação...

## Utilização

    O arquivo matricula-aluno.php está simulando a utilização da nossa aplicação via CLI e para o bom funcionamento temos que respeitar algumas regras.

    - CPF: Só será aceito no formato "xxx.xxx.xxx-xx" onde x é substituído por números.
    - Email: O email deve respeitar o seguinte formato "example@example.com", colocando um domínio válido com '@' e '.{extensão}'

    Abaixo temos um exemplo:
```
    php matricula-aluno.php "123.123.123-20" "Gabriel Teiga" "example@example.com" "51" "999999999"
```