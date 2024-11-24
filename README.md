
# Sistema de Gerenciamento de Estoque

Este é um sistema de gerenciamento de estoque desenvolvido como parte do trabalho da disciplina **Engenharia de Software Aplicada** na Unisagrado. O sistema utiliza PHP, PostgreSQL, HTML e CSS e é executado localmente com o XAMPP para emular o servidor.

## Funcionalidades
- Cadastro de produtos
- Atualização de estoque
- Consulta de produtos
- Edição de itens do estoque
- Remoção de itens do estoque
- Gerenciamento de usuários

## Tecnologias Utilizadas
- **HTML**: para a criação das páginas web.
- **CSS**: para personalização das páginas.
- **JavaScript**: para manipulação das páginas.
- **PHP**: para a lógica de back-end.
- **PostgreSQL**: para o banco de dados.
- **XAMPP**: para emular um servidor local.

## Pré-requisitos
Certifique-se de ter os seguintes softwares instalados no seu sistema:
1. [XAMPP](https://www.apachefriends.org/index.html) (PHP e Apache)
2. [PostgreSQL](https://www.postgresql.org/)
3. Navegador web para acessar a interface do sistema
4. Editor de texto para alterações no código (opcional, ex: VSCode)

## Configuração do Ambiente
### 1. Clonar o repositório
Clone este repositório em sua máquina local:
```bash
git clone https://github.com/joaoboconcelo/estoque-unisagrado
```

### 2. Configurar o XAMPP
1. Instale e configure o XAMPP.
2. Inicie o servidor Apache e o módulo PHP.

### 3. Configurar o Banco de Dados
1. Instale o PostgreSQL.
2. Crie um banco de dados para o sistema:
   ```sql
   CREATE DATABASE estoque;
   ```
3. Importe o esquema do banco de dados localizado em `database/schema.sql`:


### 4. Configurar Conexão com o Banco
No arquivo `php/conexaoDB.php`, configure as credenciais do banco de dados:
```php
    $endereco = 'localhost';
    $banco = 'estoque';
    $usuario = 'usuario';
    $senha = 'senha';
```

### 5. Rodar o Sistema
1. Mova o projeto para a pasta do servidor local (ex.: `htdocs`).
2. Acesse o sistema no navegador:
   ```
   http://localhost/estoque-unisagrado
   ```

## Estrutura do Projeto
- `/pages`: Arquivos acessíveis ao navegador.
- `/pages`: Arquivos de estilização.
- `/php`: Lógica do sistema.
- `/database`: Scripts do banco de dados.
- `/img`: Imagens do projeto.
