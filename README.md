# Clean Architecture in PHP

Este projeto é uma implementação de uma arquitetura limpa em PHP. A clean architecture é um padrão de desenvolvimento que visa separar as regras de negócio da implementação técnica, facilitando a manutenção, testabilidade, escalabilidade do código e desacoplando as tecnologias externas ao nosso domínio.

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

## Usando Banco de Dados (docker-compose)

A versão com banco de dados está relacionada ao arquivo 'docker-compose.yml' onde utilizamos o docker para subir um container mysql para persistir os dados do nosso sistema. Com o docker não precisamos nos preocupar em baixar, instalar e configurar nosso banco, apenas utilizamos alguns comandos via prompt de comando para estar tudo ok.

Todas as configurações do container do banco estão disponiveis no arquivo 'docker-compose.yml' e a modelagem dentro do arquivo .sql em 'docker/dump.sql'. Com o docker instalado, iremos realizar um comando para inicializar o nosso container mysql. 

```
docker-compose up -d
```

Espere alguns segundos para até o banco ser configurado automaticamente, podemos acompanhar executando o comando 'docker-compose logs', e pronto, agora é só executar o arquivo matricula-aluno.php sem repetir os campos definidos como chave primária. Esses campos são protegidos contra repetição, são elas:

- CPF do Aluno;
- DDD + Numero(chave composta); 