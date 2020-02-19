<?php
require './config/conexao.php';
session_start();

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
    exit();
}

if (isset($_GET['codigo_processo']) && empty($_GET['codigo_processo']) == FALSE) {
    $codigo_processo = $_GET['codigo_processo'];
    
    print_r($codigo_processo);
   
    $sql = "DELETE FROM tb_processo WHERE codigo_processo = $codigo_processo";
    $exeSql = mysqli_query($con, $sql);
    
//    header("Location:exibe_processo.php");
} else {
    header("Location:editar.php");
}


