<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "bd_semam";
/*or die, serve para nos avisar qual o problema*/
$con = mysqli_connect($server,$user,$password,$database) or die("Erro Ao Conectar");//Serve para abrir um conexão com o banco de dados MySQL.
mysqli_select_db($con,$database) or die(mysqli_error($con));//Serve para selecionar o banco de dados.
mysqli_set_charset($con, "utf8"); //Essa linha serve para permitir que palavras com acentos sejam aceitas  no banco


//echo "conectado";