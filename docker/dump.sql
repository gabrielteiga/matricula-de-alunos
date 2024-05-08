CREATE TABLE alunos (
    cpf VARCHAR(14) PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100)
);

CREATE TABLE telefones (
    ddd VARCHAR(2),
    numero VARCHAR(9),
    cpf_aluno VARCHAR(14),
    PRIMARY KEY (ddd, numero),
    FOREIGN KEY (cpf_aluno) REFERENCES alunos(cpf)
);

CREATE TABLE indicacoes (
    cpf_indicante VARCHAR(14),
    cpf_indicado VARCHAR(14),
    data_indicacao VARCHAR(10),
    PRIMARY KEY (cpf_indicante, cpf_indicado),
    FOREIGN KEY (cpf_indicante) REFERENCES alunos(cpf),
    FOREIGN KEY (cpf_indicado) REFERENCES alunos(cpf)
);