<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produtos</title>
    <link rel="stylesheet" href="../css/editar_produto.css">

    <script>
        function redirecionar() {
            var select = document.getElementById('selecionar-produto');
            var idProduto = select.value;

            if (idProduto) {
                window.location.href = "../php/processa_dados_edicao.php?id_produto=" + idProduto;
            }
        }
    </script>
</head>
<?php
    require_once '../php/conexaoDB.php';
    $id_produto_selecionado = '';
    if (isset($_GET['id_produto'])) {
        $id_produto_selecionado = $_GET['id_produto'];
    }
    $nome = isset($_GET['nome']) ? $_GET['nome'] : '';
    $quantidade = isset($_GET['quantidade']) ? $_GET['quantidade'] : '';
    $preco = isset($_GET['preco']) ? $_GET['preco'] : '';
    $imagem = isset($_GET['imagem']) ? $_GET['imagem'] : '';
    $sql = "SELECT id_produto, nome_produto FROM produto";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $produtos = $statement->fetchAll(PDO::FETCH_ASSOC);

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

    <!-- Tela de Editar Produtos -->
    <div class="main-content">
        <div class="edit-products">
            <h1>EDITAR PRODUTOS</h1>
            <form action="../php/editar_produto.php" method="post">
                <div class="input-group">
                    <label for="selecionar-produto">Selecionar produto</label>
                    <select id="selecionar-produto" name="selecionar-produto" required="" onchange="redirecionar()">
                        <option value="" disabled="" selected="">Selecione o produto...</option>
                        <?php foreach ($produtos as $produto): ?>
                            <option value="<?= $produto['id_produto'] ?>" 
                                    <?= ($produto['id_produto'] == $id_produto_selecionado) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($produto['nome_produto']) ?>
                            </option>
                        <?php endforeach; ?>
                </select>
                </div>
                <input type="hidden" name="id_produto" id="id_produto" value="<?= $id_produto_selecionado ?>">
                <div class="form-group">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/edit--v1.png" alt="Ícone Nome" width="20">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($nome) ?>">
                </div>
                <div class="form-group">
                    <img src="https://img.icons8.com/material-outlined/24/000000/stack.png" alt="Ícone Quantidade" width="20">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" id="quantidade" name="quantidade" value="<?= htmlspecialchars($quantidade) ?>">
                </div>
                <div class="form-group">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/cheap-2.png" alt="Ícone Preço" width="20">
                    <label for="preco">Preço</label>
                    <input type="text" id="preco" oninput="validarPreco(this)" name="preco" value="<?= htmlspecialchars($preco) ?>">
                </div>
                <div class="form-group">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/image.png" alt="Ícone Imagem" width="20">
                    <label for="imagem">Imagem</label>
                    <input type="text" id="imagem" name="imagem" value="<?= htmlspecialchars($imagem) ?>">
                </div>
                <button type="submit" class="button-submit">Editar</button>
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
