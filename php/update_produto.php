<?php

    require_once 'conexaoDB.php';

    if (isset($_POST['id_produto']) && isset($_POST['produto_ativado'])) {
        $id_produto = $_POST['id_produto'];
        $produto_ativado = $_POST['produto_ativado'];

        $sql = "UPDATE produto SET produto_ativado = :produto_ativado WHERE id_produto = :id_produto";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':produto_ativado', $produto_ativado, PDO::PARAM_INT);
        $statement->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
        
        if ($statement->execute()) {
            echo 'Produto atualizado com sucesso.';
        } else {
            echo 'Erro ao atualizar produto.';
        }
    } else {
        echo 'Dados inválidos.';
    }
?>
