<?php
session_start();
require './config/conexao.php';
if (isset($_POST['email']) && empty($_POST['email']) == FALSE) {
    if (isset($_POST['senha']) && empty($_POST['senha']) == FALSE) {

        $email = mysqli_real_escape_string($con, $_POST['email']);
        $senha = mysqli_real_escape_string($con, $_POST['senha']);
        $senha = md5($senha);

        $usuario = "SELECT *FROM tb_usuario WHERE email = '$email' AND senha = '$senha'";
        $recebe_usuario = mysqli_query($con, $usuario);
        $resultado = mysqli_fetch_assoc($recebe_usuario);
        if (mysqli_num_rows($recebe_usuario) > 0) {
            //salvando o email e a senha na sessao
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['nome'] = $resultado['nome'];
            $_SESSION['nivel_acesso'] = $resultado['nivel_acesso'];
            
            /* salvando os dados do usuario q logou no sistema */
                $data_acesso = Date("Y-m-d H:i:s");
                $sql = "INSERT INTO tb_controle_usuario(email,data_acesso)values('$email','$data_acesso')";
                mysqli_query($con, $sql);
//                print_r($sql);
                            
            if ($_SESSION['nivel_acesso'] == "0") {
                header("Location:inicioadm.php");
            } else if ($_SESSION['nivel_acesso'] == "1" || $_SESSION['nivel_acesso'] == "2" || $_SESSION['nivel_acesso'] == "3" || $_SESSION['nivel_acesso'] == "4" || $_SESSION['nivel_acesso'] == "5" || $_SESSION['nivel_acesso'] == "6" || $_SESSION['nivel_acesso'] == "7") {
                header("Location:inicio.php");
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>E-mail e / ou Senha Incorretos!</div>";
                header("Location:login.php");
                exit();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>E-mail e / ou Senha Incorretos!</div>";
            header("Location:login.php");
            exit();
        }
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>E-mail e / ou Senha Incorretos!</div>";
        header("Location:login.php");
        exit();
    }
}


    