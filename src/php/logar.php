<?php
session_start();
require("connection.php");

$username = $_POST["name"];
$password = $_POST["password"];

$query = "SELECT * FROM cornelianos WHERE nome='$username' AND senha=md5('$password')";
$result = mysqli_query($conn, $query);
$result = mysqli_affected_rows($conn);

if($result == 1) {
  $_SESSION["logado"] = $username;
  header("Location: ../panel.php");
  exit();
} else {
  $_SESSION["usuarioInexistente"] = "Usuario ou Senha invalidos";
  header("Location: ../login.php");
  exit();
}
