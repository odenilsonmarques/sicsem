<?php

require './config/conexao.php';
session_start();

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
}

$codigo_empreendimentos = $_GET['empresa'];

$sql = ("SELECT *FROM tb_processo WHERE fk3_codigo_empresa= $codigo_empreendimentos"." ORDER BY numero_processo DESC");
$recebesql = (mysqli_query($con, $sql));
while ($linha = mysqli_fetch_array($recebesql)) {
    echo"<option value='" .$linha['codigo_processo']."'> ".$linha['numero_processo']." ".$linha ['assunto']."</option>";
}

