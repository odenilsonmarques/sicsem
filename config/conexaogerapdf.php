<?php
header('Content-Type: text/html; charset=utf-8');

$server = "localhost";
$user = "root";
$password = "";
$database = "bd_semam";

$con = mysqli_connect($server,$user,$password)or die("Erro Ao Conectar");//Serve para abrir um conexão com o banco de dados MySQL.
mysqli_select_db($con,$database)or die(mysqli_error($con));//Serve para selecionar o banco de dados.
mysqli_set_charset($con, "utf8"); //Essa linha serve para permitir que palavras com acentos sejam aceitas  no banco


//mysqli_query("SET NAMES 'utf8'");
//mysqli_query('character_set_connection=utf8');
//mysqli_query(' character_set_client=utf8');
//mysqli_query(' character_set_results=utf8');


//echo "conectado";
