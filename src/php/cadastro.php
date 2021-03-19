<?php
session_start();

require('connection.php');

$username = $_POST["name"];
$password = $_POST["password"];

$query = "SELECT * FROM cornelianos WHERE nome='$username'";
$result = mysqli_query($conn, $query);
$result = mysqli_affected_rows($conn);

if($result == 1) {
  $_SESSION["usuarioJaCadastrado"] = "Outro usuario ja foi cadastrado com esse nome.";
  header("Location: ../index.php");
  exit();
}

$query = "INSERT INTO cornelianos VALUES(DEFAULT, '$username', md5('$password'))";
$result = mysqli_query($conn, $query);

header("Location: ../login.php");
exit();