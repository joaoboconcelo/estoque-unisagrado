<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Compra</title>
    <link rel="stylesheet" href="../css/nova_compra.css">   
</head>
<?php
    require_once '../php/conexaoDB.php';
    $id_produto_selecionado = '';
    $id_fornecedor_selecionado = '';
    if (isset($_GET['id_produto'])) {
        $id_produto_selecionado = $_GET['id_produto'];
    }
    $sql = "SELECT id_produto, nome_produto FROM produto";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $produtos = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET['id_fornecedor'])) {
        $id_fornecedor_selecionado = $_GET['id_fornecedor'];
    }
    $sql = "SELECT id_fornecedor, nome_fornecedor FROM fornecedor";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $fornecedores = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
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

    <!-- Tela de Nova Compra -->
    <div class="main-content">
        <div class="new-purchase">
            <h1>NOVA COMPRA</h1>
            <form action="../php/nova_compra.php" method="post">
                <div class="form-group">
                    <label for="selecionar-produto">PRODUTO</label>
                    <select id="selecionar-produto" name="id_produto" required="">
                        <option value="" disabled="" selected="">Selecione o produto...</option>
                        <?php foreach ($produtos as $produto): ?>
                            <option value="<?= $produto['id_produto'] ?>" 
                                    <?= ($produto['id_produto'] == $id_produto_selecionado) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($produto['nome_produto']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">

                    <label for="selecionar-fornecedor">FORNECEDOR</label>
                    <select id="selecionar-fornecedor" name="id_fornecedor" required="">
                        <option value="" disabled="" selected="">Selecione o fornecedor...</option>
                        <?php foreach ($fornecedores as $fornecedor): ?>
                            <option value="<?= $fornecedor['id_fornecedor'] ?>" 
                                    <?= ($fornecedor['id_fornecedor'] == $id_fornecedor_selecionado) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($fornecedor['nome_fornecedor']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <div class="icon-container">
                        <img src="https://img.icons8.com/material-outlined/24/000000/stack.png" alt="Ícone Quantidade" width="20">
                    </div>
                    <label for="quantidade">Quantidade</label>
                    <input type="number" id="quantidade" name="quantidade">
                </div>
                
                <div class="form-group">
                    <div class="icon-container">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/cheap-2.png" alt="Ícone Preço" width="20">
                    </div>
                    <label for="preco">Preço</label>
                    <input type="text" id="preco" oninput="validarPreco(this)" name="preco">
                </div>
                <button type="submit" class="button-submit">Cadastrar compra</button>
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
<script>
function validarPreco(input) {
    input.value = input.value.replace(/[^0-9.,]/g, '');
    input.value = input.value.replace(',', '.');
    const partes = input.value.split('.');
    if (partes.length > 2) {
        input.value = partes[0] + '.' + partes[1];
    }
}
</script>
</html>
