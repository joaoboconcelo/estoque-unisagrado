<?php
    require_once '../php/conexaoDB.php';

    if (isset($_GET['id_produto'])) {
        $id_produto = $_GET['id_produto'];

        try {
            $sql = "SELECT nome_produto, qtd_produto, preco_produto, img_produto FROM produto WHERE id_produto = :id_produto";
            $statement = $pdo->prepare($sql); 
            $statement->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
            $statement->execute();
            $produto = $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro ao buscar dados do produto: " . $e->getMessage());
        }

        if ($produto) {
            $nome = $produto['nome_produto'];
            $quantidade = $produto['qtd_produto'];
            $preco = $produto['preco_produto'];
            $imagem = $produto['img_produto'];
            if($imagem == "NULL"){
                $imagem = "";
            }
            header("Location: ../pages/editar_produto.php?nome=$nome&quantidade=$quantidade&preco=$preco&imagem=$imagem&id_produto=$id_produto");
            exit;
        }
    }
?>
