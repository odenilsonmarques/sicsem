<?php

require './config/conexao.php';
session_start();

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
}

$codigo_empresas = $_GET['empresa'];

$sql = ("SELECT  *FROM tb_empresa WHERE codigo_empresa=" . $codigo_empresas . "");
$recebesql = (mysqli_query($con, $sql));

while ($linha = mysqli_fetch_array($recebesql)) {
//    echo"<option value='" . $linha[''] . "'>" . $linha[''] . "</option>";
     echo"<option value='" . $linha['nome_fantasia'] . "'>" . $linha['nome_fantasia']."</option>";
//    echo"<option value='" . $linha['codigo_empreendimento'] . "'>" . $linha['nome_empreendimento'] . "</option>";
}


 