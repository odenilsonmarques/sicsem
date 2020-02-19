<?php
session_start();
require './config/conexao.php';
require './pages/header_home.php';


if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE ) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE ) {
        
    }
} else {
    header("Location:login.php");
    exit();
}
?>

<div class="row">
    <div class="container-fluid">
        <div class="col-sm-2 sidenav"><br>

            <img src="img/user (2).png" style="height: 120px;"  class="img-responsive  center-block"><hr style="border-color: #fff">

            <?php
            
                echo'<div class="row">';
                    echo'<div class="col-sm-12">';
                        echo '<p style="text-align:center;color:#fff;font-size:16px;background-color:#122b40"><strong>Olá ' . $_SESSION['nome'] . '</strong></p>';       
                    echo'</div>';
                echo'</div>';
            
            ?>
      
            <ul class="nav nav-pills nav-stacked">
                <li class="">
                    <a href="home.php" style="color: #122b40;font-size: 17px">
                        <strong>CADASTRAR</strong>
                    </a>
                </li>
                <li>
                    <a href="listar_cadastros.php" style="color: #122b40;font-size: 17px">
                        <strong>CONSULTAR</strong>
                    </a>
                </li>
                <li>
                    <a href="listar_cadastros.php" style="color: #122b40;font-size: 17px">
                        <strong>CANCELAR</strong>
                    </a>
                </li>
                <li>
                    <a href="logout.php" style="color: #122b40;font-size: 17px">
                        <strong>SAIR DO SISTEMA</strong>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-sm-3 grow">
            <div class="panel  panel-default">
                <div class="panel-heading"><h5><strong>CONSULTAR EMPREENDIMENTO</strong></h5></div>
                <div class="panel-body"><a href="listar_empreendimento.php"><img src="img/construction-worker.png"></a></div>
            </div>
        </div>
        <div class="col-sm-3 grow">
            <div class="panel  panel-default">
                <div class="panel-heading"><h5><strong>CONSULTAR LICENÇAS</strong></h5></div>
                <div class="panel-body"><a href="listar_licencas.php"><img src="img/document.png"></a></div>
            </div>
        </div>
        <div class="col-sm-3 grow">
            <div class="panel  panel-default">
                <div class="panel-heading"><h5><strong>CONSULTAR NOTIFICAÇÃO</strong></h5></div>
                <div class="panel-body"><a href="listar_notificacoes.php"><img src="img/document.png"></a></div>
            </div>
        </div>
    </div>
</div>
