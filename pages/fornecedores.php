<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fornecedores</title>
    <link rel="stylesheet" href="../css/fornecedores.css">
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

    <!-- Tela de Histórico de Fornecedores -->
    <div class="main-content">
        <div class="history-supplier">
            <h1>LISTA DE FORNECEDORES</h1>

            <!-- Tabela de Fornecedores -->
            <?php
                // Conexão com o banco de dados
                require_once '../php/conexaoDB.php';

                // SQL para pegar todos os fornecedores
                $sql = "SELECT nome_fornecedor, produtos_fornecedor, telefone_fornecedor FROM fornecedor";
                $statement = $pdo->prepare($sql);
                $statement->execute();

                // Verificar se há fornecedores
                if ($statement->rowCount() > 0) {
                    echo '<table class="supplier-table">';
                    echo '<thead>';
                    echo '<tr><th>Nome</th><th>Produtos</th><th>Telefone</th></tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    
                    // Exibir os fornecedores
                    while ($fornecedor = $statement->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($fornecedor['nome_fornecedor']) . '</td>';
                        echo '<td>' . htmlspecialchars($fornecedor['produtos_fornecedor']) . '</td>';
                        echo '<td>' . htmlspecialchars($fornecedor['telefone_fornecedor']) . '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>Nenhum fornecedor encontrado.</p>';
                }
            ?>
        </div>
    </div>
</body>
</html>
