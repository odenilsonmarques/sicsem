<?php

session_start();
require './config/conexao.php';
require './pages/header.php';

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
    exit();
}

if (isset($_GET['codigo_processo']) && empty($_GET['codigo_processo']) == FALSE) {
    $codigo = $_GET['codigo_processo']; /* link dinamico utilizando o get */

    $sqlProcesso = "SELECT *FROM tb_processo WHERE codigo_processo = $codigo";
    $sqlexe = mysqli_query($con, $sqlProcesso);
    $info = mysqli_fetch_array($sqlexe);
    $numeroProcesso = $info['numero_processo'];
    
    $sql = "DELETE FROM tb_processo WHERE codigo_processo = $codigo";
    $exe_sql = mysqli_query($con, $sql);

    //O CÓDIGO ABAIXO REGISTRA O USUARIO QUE REALIZOU O CADASTRO DE CERTO EMPRESA / PESSOA FISICA
    $emailUser = $_SESSION['email'];
    $user = $_SESSION['nome'];
    $ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
    $ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
    $data = Date("Y-m-d H:i:s");
    $acaoUsuario = "Excluiu o processo->$numeroProcesso";
    $sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
    mysqli_query($con, $sqlLog);

    if (mysqli_affected_rows($con) > 0) {
        $_SESSION['msg'] = "<div class='alert alert-success text-center' role='alert'><strong>PROCESSO EXCLUÍDO COM SUCESSO!</strong></div>";
        header("Location: exibe_processo.php");
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'><strong>ERRO O PROCESSO NÃO PODE SER APAGADO, CONSULTE O ADMINISTRADOR DA BASE DE DADOS!</strong></div>";
        header("Location: exibe_processo.php");
    }
}





    