<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Fornecedores</title>
    <link rel="stylesheet" href="../css/cadastro_fornecedor.css">
</head>
<body>
    <?php
        session_start();
    ?>
    <!-- Barra lateral -->
    <div class="sidebar">
        <a href="../pages/dashboard.php">Dashboard</a>
        <a href="../pages/cadastrar_produto.php">Cadastro de produtos</a>
        <a href="../pages/cadastrar_fornecedor.php">Cadastro de fornecedor</a>
        <a href="../pages/editar_produto.php">Edição de produtos</a>
        <a href="../pages/excluir_produto.php">Exclusão de produtos</a>

        <?php if (isset($_SESSION['nivelAcesso']) && $_SESSION['nivelAcesso'] === 'admin') : ?>
            <a href="../pages/nova_compra.php">Nova compra</a>
            <a href="../pages/cadastro.php">Novo funcionário</a>
            <a href="../pages/fornecedores.php">Fornecedores</a>
            <a href="../pages/usuarios.php">Usuários</a>
        <?php endif; ?>
        <a href="../php/logout.php">Sair</a>
    </div>

    <div class="main-content">
        <div class="insert-supplier">
            <h1>CADASTRAR FORNECEDOR</h1>
            <form action="../php/cadastrar_fornecedor.php" method="post">

                <div class="form-group">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/edit--v1.png" alt="Ícone Nome" width="20">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-group">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/edit--v1.png" alt="Ícone Pro" width="20">
                    <label for="descricao">Produtos</label>
                    <input type="text" id="descricao" name="descricao" required>
                </div>
                <div class="form-group">
                    <img src="https://img.icons8.com/?size=100&id=85164&format=png&color=000000" alt="Ícone Preço" width="20">
                    <label for="preco">Telefone</label>
                    <input type="text" id="telefone" name="telefone" required>
                </div>
                <button type="submit" class="button-submit">Cadastrar</button>
            </form>
            <br>
            <h3 style="color: red; font-size: 14px;">
          <?php if (!empty($_GET['msgErro'])) { ?>
          <?php echo $_GET['msgErro']; ?>
          <?php } ?>
        </h3>
        <h3 style="color: green; font-size: 14px;">
          <?php if (!empty($_GET['msgSucesso'])) { ?>
              <?php echo $_GET['msgSucesso']; ?>
              <br><br>
          <?php } ?>
</h3>
        </div>
    </div>
</body>
</html>
