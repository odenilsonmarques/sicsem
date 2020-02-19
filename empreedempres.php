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
?>

<link rel="stylesheet" href="css/estilo_empreedempres.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 sidenav"><br>
            <img src="img/user (1)_1.png"  class="img-responsive  center-block" style="height: 102px"><br>    
            <?php
            echo'<div class="row">';
            echo'<div class="col-sm-12">';
            echo '<p style="text-align:center;color:#fff;font-size:16px;border-radius:7px"><strong>Olá ' . $_SESSION['nome'] . '</strong></p>';
            echo'</div>';
            echo'</div>';
            ?>            
            <ul class="nav nav-pills">
                <li>
                    <a href="cadastros.php" style="color:#fff">
                        <strong>CADASTRAR</strong>  
                    </a>
                </li>
                <li class="">
                    <a href="editar.php" style="color:#fff">
                        <strong>EDITAR</strong>
                    </a>                   
                </li>
                <li>
                    <a href="pagina_inicial.php" style="color:#fff">
                        <strong>CANCELAR</strong>
                    </a>
                </li>
                <li>
                    <a href="logout.php" style="color:#fff">
                        <strong>SAIR DO SISTEMA</strong>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="col-sm-3 grow">
            <div class="panel panel-default">
                <div class="panel-heading text-center" style="background-color: #67b168;"><h4><strong>CONSULTE<br>EMPRESA-EMPREENDIMENTO</strong></h4></div>
                <div class="panel-body text-center" style="background-color: #67b168;"><a href="consultar_licencas.php"><br><br><br><img src="img/construction-worker.png"><br><br><br></a></div>
            </div>
        </div>
        <div class="col-sm-3 grow">
            <div class="panel panel-default">
                <div class="panel-heading text-center"style="background-color: #67b168;" ><h4><strong>CONSULTE<br>EM CONSTRUÇÃO</strong></h4></div>
                <div class="panel-body  text-center" style="background-color: #67b168;"><a href="#"><br><br><br><img src="img/power-button (1).png"><br><br><br></a></div>
            </div>
        </div>
        <div class="col-sm-3 grow">
            <div class="panel panel-default">
                <div class="panel-heading text-center" style="background-color: #67b168;"><h4><strong>CONSULTE<br>EM CONSTRUÇÃO</strong></h4></div>
                <div class="panel-body  text-center" style="background-color: #67b168;"><a href="#"><br><br><br><img src="img/power-button (1).png"><br><br><br></a></div>
            </div>
        </div>
    </div><hr>
</div>
<?php
require './pages/footer.php';


        