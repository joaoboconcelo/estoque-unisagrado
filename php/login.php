<?php
    require_once 'conexaoDB.php';

    if(!empty($_POST)){

        session_start();

        try{
            $sql = "SELECT usuario_funcionario, nivel_acesso FROM funcionario
            WHERE usuario_funcionario = :usuario AND senha_funcionario = :senha";

            $statement = $pdo->prepare($sql);

            $dados = array(
                ':usuario' => $_POST['usuario'],
                ':senha' => md5($_POST['senha'])
            );

            $statement->execute($dados);
            $result = $statement->fetchAll();

            if($statement->rowCount() == 1){
                $result = $result[0];
                $_SESSION['usuario'] = $result['usuario_funcionario'];
                $_SESSION['nivelAcesso'] = $result['nivel_acesso'];
                
                header("Location: ../pages/dashboard.php");
            }
            else{
                session_destroy();
                header("Location: ../pages/login.php?msgErro=E-mail e/ou senha incorretos");

            }

        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    else{
        header("Location: ../pages/login.php");
    }
    die();

?>