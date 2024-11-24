<?php
require_once 'conexaoDB.php';

if (!empty($_POST)) {
    try {
        // Inicia a transação
        $pdo->beginTransaction();

        // Inserir a compra na tabela 'compra'
        $sql = "INSERT INTO compra (id_produto, id_fornecedor, qtd_compra, preco_compra)
                VALUES (:idProduto, :idFornecedor, :quantidade, :preco)";
        
        $statement = $pdo->prepare($sql);

        $dados = array(
            ':idProduto' => $_POST['id_produto'],
            ':idFornecedor' => $_POST['id_fornecedor'],
            ':quantidade' => $_POST['quantidade'],
            ':preco' => $_POST['preco']
        );

        if ($statement->execute($dados)) {
            // Atualizar a quantidade na tabela 'produto'
            $sqlUpdate = "UPDATE produto 
                          SET qtd_produto = qtd_produto + :quantidade
                          WHERE id_produto = :idProduto";

            $statementUpdate = $pdo->prepare($sqlUpdate);
            $dadosUpdate = array(
                ':quantidade' => $_POST['quantidade'],
                ':idProduto' => $_POST['id_produto']
            );

            if ($statementUpdate->execute($dadosUpdate)) {
                // Confirma a transação
                $pdo->commit();
                header("Location: ../pages/nova_compra.php?msgSucesso=Compra cadastrada e estoque atualizado com sucesso!");
                exit;
            } else {
                // Reverte a transação em caso de falha
                $pdo->rollBack();
                throw new Exception("Falha ao atualizar a quantidade no estoque.");
            }
        } else {
            $pdo->rollBack();
            throw new Exception("Falha ao cadastrar a compra.");
        }
    } catch (Exception $e) {
        // Exibe erro caso haja falha na execução
        echo $e->getMessage();
    }
} else {
    header("Location: ../pages/login.php");
    exit;
}
?>
