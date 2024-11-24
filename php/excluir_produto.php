<?php
require_once 'conexaoDB.php';

if (!empty($_POST)) {
    try {        

        $sql = "DELETE FROM produto
                WHERE id_produto = :id_produto";

        $statement = $pdo->prepare($sql);

        $dados = array(
            ':id_produto' => $_POST['id_produto']
        );
        echo $_POST['id_produto'];

        if ($statement->execute($dados)) {
            header("Location: ../pages/excluir_produto.php?msgSucesso=Produto excluído com sucesso!");
            exit;
        }
    } catch (PDOException $e) {
        header("Location: ../pages/excluir_produto.php?msgErro=Falha ao excluir produto!");
        exit;
    }
} else {
    header("Location: ../pages/login.php");
    exit;
}
?>
