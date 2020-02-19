<?php

require './config/conexao.php';
session_start();

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
}

$codigo_empreendimentos = $_GET['empreendimento'];
$sql = ("SELECT *FROM tb_empreendimento WHERE codigo_empreendimento = $codigo_empreendimentos" . " ORDER BY codigo_empreendimento DESC");
$recebesql = (mysqli_query($con, $sql));
while ($linha = mysqli_fetch_array($recebesql)) {

    echo"<option value='" . $linha['codigo_empreendimento'] . "'>" . $linha['nome_empreendimento'] . $linha['descricao_atividade'] . "</option>";
}
   