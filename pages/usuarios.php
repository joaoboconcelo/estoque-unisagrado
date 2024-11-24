<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" href="../css/usuarios.css">
    <script>
        function confirmarExclusao(usuarioId) {
            if (confirm('Tem certeza de que deseja excluir este usuário?')) {
                window.location.href = '../php/excluir_usuario.php?id=' + usuarioId;
            }
        }
    </script>
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
            <h1>LISTA DE USUÁRIOS</h1>

            <?php
            require_once '../php/conexaoDB.php';

            $sql = "SELECT id_funcionario, usuario_funcionario, nivel_acesso, funcionario_excluido FROM funcionario";
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $usuarios = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <table class="user-table">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Nível de Acesso</th>
                        <th>Excluído</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($usuarios) > 0): ?>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['usuario_funcionario']) ?></td>
                                <td><?= htmlspecialchars($usuario['nivel_acesso']) ?></td>
                                <td>
                                    <?php if ($usuario['funcionario_excluido'] == 1): ?>
                                        <input type="checkbox" checked disabled>
                                    <?php else: ?>
                                        <input type="checkbox" disabled>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button onclick="confirmarExclusao(<?= $usuario['id_funcionario'] ?>)">Excluir</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Nenhum usuário encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
