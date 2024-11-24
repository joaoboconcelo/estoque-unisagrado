<?php
require_once 'conexaoDB.php';

if (!empty($_POST)) {
    try {
        $sql = "INSERT INTO funcionario (usuario_funcionario, senha_funcionario, nivel_acesso)
                VALUES (:usuario, :senha, :nivelAcesso)";

        $statement = $pdo->prepare($sql);

        $dados = array(
            ':usuario' => $_POST['usuario'],
            ':senha' => md5($_POST['senha']),
            ':nivelAcesso' => $_POST['nivel-acesso']
        );

        if ($statement->execute($dados)) {
            header("Location: ../pages/cadastro.php?msgSucesso=Cadastro realizado com sucesso");
            exit;
        }
    } catch (PDOException $e) {
        header("Location: ../pages/cadastro.php?msgErro=Falha ao realizar o cadastro");
        exit;
    }
} else {
    header("Location: ../pages/cadastro.php");
    exit;
}
?>
