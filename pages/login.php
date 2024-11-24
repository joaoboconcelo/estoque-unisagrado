<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="../css/login.css">
  </head>

  <body>
    <div class="login-container">
      <div class="login-box">
        <h2>LOGIN</h2>
        <form action="../php/login.php" method="post">
          <div class="input-group">
            <label for="usuario"><i class="fas fa-user"></i> USUÁRIO</label>
            <input type="text" id="usuario" name="usuario" required="">
          </div>
          <div class="input-group">
            <label for="senha"><i class="fas fa-lock"></i> SENHA</label>
            <input type="password" id="senha" name="senha" required="">
            <i class="fas fa-eye toggle-password"></i>
          </div>
          <button type="submit" class="login-button">ENTRAR</button>
        </form>
        <br>
        <h3 style="color: red; font-size: 14px;">
          <?php if (!empty($_GET['msgErro'])) { ?>
          <?php echo $_GET['msgErro']; ?>
          <?php } ?>
          <br><br>
        </h3>
      </div>
    </div>


  </body>

</html>