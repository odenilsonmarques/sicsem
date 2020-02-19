<?php

require './config/conexao.php';
session_start();

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
}

$codigo_li = $_GET['empresa'];

$sql = "SELECT nome_atividade from tb_empreendimento WHERE fk1_codigo_empresa= ".$codigo_li;

//$sql = "SELECT *FROM tb_atividade WHERE fk8_codigo_empresa= ".$codigo_li;

$recebesql = (mysqli_query($con, $sql));
while ($linha = mysqli_fetch_array($recebesql)) {
        echo"<option value='" .$linha['']."'> ".$linha['']." ".$linha ['']."</option>";
        echo"<option value='" .$linha['codigo_empreendimento']."'> ".$linha['nome_atividade']."</option>";
//        echo"<option value='" .$linha['codigo_atividade']."'> ".$linha['nome_atividade']."</option>";
//    echo"<option value='" .$linha['codigo_processo']."'> ".$linha['numero_processo']." ".$linha ['assunto']."</option>";
}



