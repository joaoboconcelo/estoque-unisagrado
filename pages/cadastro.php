<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Cadastro</title>
    <link rel="stylesheet" href="../css/cadastro.css">
    <script>
        // Função para validar as senhas
        function validarSenhas(event) {
            // Obtendo os valores dos campos
            var senha = document.getElementById('senha').value;
            var confirmarSenha = document.getElementById('confirmar-senha').value;

            // Se as senhas não forem iguais, impede o envio do formulário e exibe uma mensagem de erro
            if (senha !== confirmarSenha) {
                event.preventDefault();  // Impede o envio do formulário
                alert("As senhas não são iguais. Por favor, verifique.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    
    <div class="register-container">
        <div class="register-box">

            <h2>CADASTRO</h2>
            <!-- Adicionando o onsubmit para validar antes de enviar -->
            <form action="../php/cadastro.php" method="post" onsubmit="return validarSenhas(event)">
                <div class="input-group">
                    <label for="usuario"><i class="fas fa-user"></i> USUÁRIO</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                <div class="input-group">
                    <label for="senha"><i class="fas fa-lock"></i> SENHA</label>
                    <input type="password" id="senha" name="senha" required>
                    <i class="fas fa-eye toggle-password"></i>
                </div>
                <div class="input-group">
                    <label for="confirmar-senha"><i class="fas fa-lock"></i> CONFIRME A SENHA</label>
                    <input type="password" id="confirmar-senha" name="confirmar-senha" required>
                    <i class="fas fa-eye toggle-password"></i>
                </div>
                <div class="input-group">
                    <label for="nivel-acesso">SELECIONAR NÍVEL DE ACESSO</label>
                    <select id="nivel-acesso" name="nivel-acesso" required>
                        <option value="" disabled="" selected="">Selecione...</option>
                        <option value="admin">Administrador</option>
                        <option value="user">Usuário</option>
                    </select>
                </div>
                <button type="submit" name="enviarDados" class="register-button">CADASTRAR</button>
            </form>
            <br>
            <h3 style="color: red; font-size: 14px;">
                <?php if (!empty($_GET['msgErro'])) { ?>
                <?php echo $_GET['msgErro']; ?>
                <?php } ?>
            </h3>
            <h3 style="color: green; font-size: 14px;">
                <?php if (!empty($_GET['msgSucesso'])) { ?>
                    <?php echo $_GET['msgSucesso']; ?>
                    <br><br>
                    <a href="../pages/login.php" style="color: blue; text-decoration: none;">Clique aqui para acessar a página de login</a>
                <?php } ?>
            </h3>

        </div>
    </div>
</body>
</html>
