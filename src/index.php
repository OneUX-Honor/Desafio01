<?php
session_start();
if(isset($_SESSION["logado"])) {
  header("Location: panel.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Cadastro</title>

  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="erros">
    <?php 
    if(isset($_SESSION["usuarioJaCadastrado"])): ?>
    
      <div class="erro">
        <h1>
          <?php echo($_SESSION["usuarioJaCadastrado"]) ?>
        </h1>
      </div>
    
    <?php 
    endif;
    ?>
  </div>
  <form action="php/cadastro.php" method="POST">
    <h1>Cadastre o Corneliano</h1>
    <input type="text" name="name" placeholder="Nome do corneliano" autocomplete="off" required/>
    <input type="password" name="password" placeholder="Senha do corneliano" autocomplete="off" required/>
    <input type="submit" value="Cadastrar"/>
    <a class="account" href="login.php">Ja tem uma conta?!</a>
  </form>
</body>
</html>