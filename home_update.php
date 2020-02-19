<?php
session_start();
require './config/conexao.php';
require './pages/headerhome.php';

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
    exit();
}
?>

<style>
    /* Make the image fully responsive */
    .carousel-inner img {
        width: 100%;
        height: 70%;
    }
</style>

<div class="row">
    <div class="container-fluid">
        <div class="col-sm-2 sidenav"><br>
            <img src="img/user (4)_1.png" style="height: 120px;"  class="img-responsive  center-block "><br>           
            <?php
            echo'<div class="row">';
            echo'<div class="col-sm-12">';
            echo '<p style="text-align:center;color:#170B3B;font-size:16px;background-color:#EFEFFB;border-radius:7px"><strong>Olá ' . $_SESSION['nome'] . '</strong></p>';
            echo'</div>';
            echo'</div>';
            ?>            
            <ul class="nav nav-pills nav-stacked">
                <li>
                    <a href="home.php">
                        <strong>CADASTRAR</strong>
                    </a>
                </li>
                <li class="">
                    <a href="listar_cadastros.php">
                        <strong>CONSULTAR</strong>
                    </a>                   
                </li>
                <li>
                    <a href="listar_cadastros.php">
                        <strong>CANCELAR</strong>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <strong>SAIR DO SISTEMA</strong>
                    </a>
                </li>
            </ul>
        </div>
        <style>
            .circulo {
                height: 120px;
                width: 120px;
                border-radius: 50%;
                display: inline-block;
            }
        </style>
        <div class="col-sm-1" style="background-color: #d43f3a ;width: 120px;height: 120px;"><br>
            <img src="img/empresa_pessoafisica (2).png" width="90px"><br><br>           
        </div>
        <div class="col-sm-1" style="background-color: #d58512;width: 120px;height: 120px;"><br>
            <img src="img/businessmen.png" width="90px"><br><br>
        </div>
        <div class="col-sm-1" style="background-color: #1b6d85;width: 120px;height: 120px;"><br>
            <img src="img/documentation.png" width="90px"><br><br>
        </div>
        <div class="col-sm-1" style="background-color: #006600;width: 120px;height: 120px;"><br>
            <img src="img/construction-worker.png" width="90px">
        </div>
        <div class="col-sm-1" style="background-color: #985f0d;width: 120px;height: 120px;"><br>           
            <img src="img/document.png" width="90px">
        </div>
        <div class="col-sm-1" style="background-color: #d43f3a ;width: 120px;height: 120px;"><br>            
            <img src="img/notifications-button.png" width="90px">
        </div>
        <div class="col-sm-1"  style="background-color: #d58512;width: 120px;height: 120px;"><br>           
            <img src="img/police-identity-card.png" width="90px">
        </div>
        <div class="col-sm-1" style="background-color: #1b6d85;width: 120px;height: 120px;"><br>         
            <img src="img/job-search.png" width="90px">
        </div>
        <div class="col-sm-1" style="background-color: #006600;width: 120px;height: 120px;"><br>           
            <img src="img/bill.png" width="90px">
        </div>
    

    
        
            <div class="circulo text-center" style="background-color: #d43f3a; color:#FFF;font-weight: bolder"><br>
                Empresas / Pª Física
            </div>
            <div class="circulo text-center" style="background-color:#d58512;color: #FFF;font-weight: bolder"><br>
                Representante
            </div>
            <div class="circulo text-center" style="background-color: #1b6d85; color: #FFF; font-weight: bolder"><br>
                Processo
            </div>
            <div class="circulo text-center" style="background-color:#006600; color: #FFF;font-weight: bolder"><br>
                Empreendimento
            </div>
            <div class="circulo text-center" style="background-color:#985f0d; color: #FFF;font-weight: bolder"><br>
                Licença
            </div>
            <div class="circulo text-center" style="background-color:#d43f3a; color: #FFF;font-weight: bolder"><br>
                Notificação
            </div>
        


    </div>
