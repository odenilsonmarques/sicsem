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

if (isset($_GET['codigo_empresa']) && empty($_GET['codigo_empresa']) == FALSE) {
    $codigo = $_GET['codigo_empresa'];/*link dinamico utilizando o get*/

    $sqlContribuinte = "SELECT *FROM tb_empresa WHERE codigo_empresa = $codigo";
    $sqlexe = mysqli_query($con, $sqlContribuinte);
    $info = mysqli_fetch_array($sqlexe);
    $nomeContribuinte = $info['razaosocial_pessoafisica'];
    
    $sql = "DELETE FROM tb_empresa WHERE codigo_empresa = $codigo";
    $exe_sql = mysqli_query($con, $sql);

    //O CÓDIGO ABAIXO REGISTRA O USUARIO QUE REALIZOU O CADASTRO DE CERTO EMPRESA / PESSOA FISICA
    $emailUser = $_SESSION['email'];
    $user = $_SESSION['nome'];
    $ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
    $ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
    $data = Date("Y-m-d H:i:s");
    $acaoUsuario = "Excluiu o contribuinte->$nomeContribuinte";
    $sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
    mysqli_query($con, $sqlLog);

    if (mysqli_affected_rows($con) > 0) {
        $_SESSION['msg'] = "<div class='alert alert-success text-center' role='alert'><strong>CONTRIBUINTE EXCLUÍDO COM SUCESSO!</strong></div>";
        header("Location: exibe_contribuintes.php");
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'><strong>ERRO O CONTRIBUINTE NÃO PODE SER APAGADO, CONSULTE O ADMINISTRADOR DA BASE DE DADOS!</strong></div>";
        header("Location: exibe_contribuintes.php");
    }
}





    