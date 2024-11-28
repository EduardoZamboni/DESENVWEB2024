
CREATE TABLE administradores (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE perguntas (
    id SERIAL PRIMARY KEY,
    texto_pergunta TEXT NOT NULL,
    status VARCHAR(10) NOT NULL
);

CREATE TABLE avaliacoes (
    id SERIAL PRIMARY KEY,
    pergunta_id INTEGER NOT NULL,
    resposta INTEGER NOT NULL CHECK (resposta >= 0 AND resposta <= 10),
    feedback TEXT,
    data_hora TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT "TBAVALIACOES -> TBPERGUNTAS" FOREIGN KEY (pergunta_id)
        REFERENCES perguntas (id)


