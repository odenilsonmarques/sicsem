<?php
require './config/conexao.php';
session_start();

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
}

$codigo_municipios = $_GET['municipio'];

$sql = ("SELECT *FROM tb_bairro WHERE fk1_codigo_municipio=".$codigo_municipios);
$recebesql = (mysqli_query($con, $sql));
while($linha = mysqli_fetch_array($recebesql)){
    echo"<option value='" . $linha['codigo_bairro']."'>" . $linha['nome_bairro']. "</option>";
}
