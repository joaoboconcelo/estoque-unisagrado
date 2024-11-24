<?php
require_once 'conexaoDB.php';

if (isset($_GET['id'])) {
    $usuarioId = $_GET['id'];

    $sql = "UPDATE funcionario SET funcionario_excluido = TRUE WHERE id_funcionario = :id_funcionario";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':id_funcionario', $usuarioId, PDO::PARAM_INT);

    if ($statement->execute()) {
        header('Location: ../pages/usuarios.php');
        exit();
    } else {
        echo "Erro ao excluir o usuário.";
    }
} else {
    echo "ID do usuário não especificado.";
}
?>
