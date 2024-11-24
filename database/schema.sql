CREATE TABLE funcionario (
    id_funcionario SERIAL PRIMARY KEY,
    usuario_funcionario VARCHAR UNIQUE NOT NULL,
    senha_funcionario VARCHAR NOT NULL,
    nivel_acesso VARCHAR NOT NULL,
    funcionario_excluido BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE produto (
    id_produto SERIAL PRIMARY KEY,
    nome_produto VARCHAR NOT NULL,
    qtd_produto INTEGER NOT NULL DEFAULT 0,
    preco_produto DECIMAL(10, 2) NOT NULL,
    img_produto VARCHAR,
    produto_ativado BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE fornecedor (
    id_fornecedor SERIAL PRIMARY KEY,
    nome_fornecedor VARCHAR NOT NULL,
    produtos_fornecedor VARCHAR NOT NULL,
    telefone_fornecedor VARCHAR NOT NULL
);

CREATE TABLE compra (
    id_compra SERIAL PRIMARY KEY,
    id_produto INTEGER NOT NULL,
    id_fornecedor INTEGER NOT NULL,
    qtd_compra INTEGER NOT NULL,
    preco_compra DECIMAL(10, 2) NOT NULL,
    data_compra TIMESTAMP NOT NULL DEFAULT NOW(),
    FOREIGN KEY (id_produto) REFERENCES produto(id_produto),
    FOREIGN KEY (id_fornecedor) REFERENCES fornecedor(id_fornecedor)
);
