<?php
require_once 'conexaoDB.php';

if (!empty($_POST)) {
    try {
        $imagem = !empty($_POST['imagem']) ? $_POST['imagem'] : 'NULL';

        $sql = "INSERT INTO produto (nome_produto, qtd_produto, preco_produto, img_produto)
                VALUES (:nome_produto, :qtd_produto, :preco_produto, :img_produto)";

        $statement = $pdo->prepare($sql);

        $dados = array(
            ':nome_produto' => $_POST['nome'],
            ':qtd_produto' => $_POST['quantidade'],
            ':preco_produto' => $_POST['preco'],
            ':img_produto' => $imagem
        );
        echo $sql;

        if ($statement->execute($dados)) {
            header("Location: ../pages/cadastrar_produto.php?msgSucesso=Cadastro do produto realizado com sucesso!");
            exit;
        }
    } catch (PDOException $e) {
        header("Location: ../pages/cadastrar_produto.php?msgErro=Falha ao cadastrar produto!");
        exit;
    }
} else {
    header("Location: ../pages/login.php");
    exit;
}
?>
