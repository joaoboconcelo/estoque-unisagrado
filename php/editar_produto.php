<?php
require_once 'conexaoDB.php';

if (!empty($_POST)) {
    try {
        $imagem = !empty($_POST['imagem']) ? $_POST['imagem'] : 'NULL';
        

        $sql = "UPDATE produto
                SET nome_produto = :nome_produto, qtd_produto = :qtd_produto, preco_produto = :preco_produto, img_produto = :img_produto
                WHERE id_produto = :id_produto";

        $statement = $pdo->prepare($sql);

        $dados = array(
            ':nome_produto' => $_POST['nome'],
            ':qtd_produto' => $_POST['quantidade'],
            ':preco_produto' => $_POST['preco'],
            ':img_produto' => $imagem,
            ':id_produto' => $_POST['id_produto']
        );
        echo $_POST['id_produto'];

        if ($statement->execute($dados)) {
            header("Location: ../pages/editar_produto.php?msgSucesso=Produto editado com sucesso!");
            exit;
        }
    } catch (PDOException $e) {
        header("Location: ../pages/editar_produto.php?msgErro=Falha ao editar produto!");
        exit;
    }
} else {
    header("Location: ../pages/login.php");
    exit;
}
?>
