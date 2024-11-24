<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Inclusão do jQuery -->
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
        <div class="history-users">
            <h1>Dashboard</h1>

            <?php
            require_once '../php/conexaoDB.php';

            $sql = "SELECT id_produto, nome_produto, qtd_produto, preco_produto, img_produto, produto_ativado 
                    FROM produto ORDER BY qtd_produto DESC";
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $produtos = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <table>
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome do Produto</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Ativar/Desativar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($produtos) > 0): ?>
                        <?php foreach ($produtos as $produto): ?>
                            <tr id="produto-<?= $produto['id_produto'] ?>">
                                <td class="product-img">
                                    <?php 
                                        $imgPath = $produto['img_produto'];
                                        if ($imgPath == null || $imgPath == '' || $imgPath == "NULL") {
                                            $imgPath = "../img/default.png";
                                        }
                                    ?>
                                    <img src="<?= htmlspecialchars($imgPath) ?>" alt="Imagem do Produto">
                                </td>
                                <td class="product-name"><?= htmlspecialchars($produto['nome_produto']) ?></td>

                                <?php
                                if ($produto['qtd_produto'] == 0) {
                                    $quantidadeClass = 'no-stock';
                                } elseif ($produto['qtd_produto'] <= 20) {
                                    $quantidadeClass = 'low-stock';
                                } else {
                                    $quantidadeClass = '';
                                }
                                ?>
                                <td class="product-quantity <?= $quantidadeClass ?>">
                                    <?= htmlspecialchars($produto['qtd_produto']) ?>
                                </td>

                                <td class="product-price">R$ <?= number_format($produto['preco_produto'], 2, ',', '.') ?></td>

                                <td class="product-status">
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-activation" data-id="<?= $produto['id_produto'] ?>" <?= $produto['produto_ativado'] ? 'checked' : '' ?>>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Nenhum produto encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Quando o estado do toggle mudar
            $(".toggle-activation").change(function() {
                var produtoId = $(this).data("id");
                var ativado = $(this).prop("checked") ? 1 : 0;

                $.ajax({
                    url: '../php/update_produto.php',
                    type: 'POST',
                    data: {
                        id_produto: produtoId,
                        produto_ativado: ativado
                    },
                    success: function(response) {
                        if (ativado == 1) {
                            $('#produto-' + produtoId).find('.slider').css('background-color', '#4CAF50');
                        } else {
                            $('#produto-' + produtoId).find('.slider').css('background-color', '#ccc');
                        }
                    },
                    error: function() {
                        alert('Erro ao atualizar status.');
                    }
                });
            });
        });
    </script>
</body>
</html>
