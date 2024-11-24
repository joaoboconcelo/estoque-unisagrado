<?php
require_once 'conexaoDB.php';
if (!empty($_POST)) {
    try {

        $sql = "INSERT INTO fornecedor (nome_fornecedor, produtos_fornecedor, telefone_fornecedor)
                VALUES (:nome_fornecedor, :produtos_fornecedor, :telefone_fornecedor)";

        $statement = $pdo->prepare($sql);

        $dados = array(
            ':nome_fornecedor' => $_POST['nome'],
            ':produtos_fornecedor' => $_POST['descricao'],
            ':telefone_fornecedor' => $_POST['telefone']
        );
        echo $sql;

        if ($statement->execute($dados)) {
            header("Location: ../pages/cadastrar_fornecedor.php?msgSucesso=Cadastro de fornecedor realizado com sucesso!");
            exit;
        }
    } catch (PDOException $e) {
        header("Location: ../pages/cadastrar_fornecedor.php?msgErro=Falha ao cadastrar fornecedor!");
        exit;
    }
} else {
    header("Location: ../pages/login.php");
    exit;
}
?>
