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
<link rel="stylesheet" href="css/estilo_paginainicial.css">
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
                <li class="">
                    <a href="inicio.php" style="color:#fff">
                        <strong>CONSULTAR<span class="glyphicon glyphicon-search" style="margin-left: 10px"></strong>
                    </a>                   
                </li>
                <li>
                    <?php if($_SESSION['nivel_acesso'] == "2"){
                    ?>  
                    <a href="editar.php" style="color:#fff">
                        <strong>EDITAR<span class="glyphicon glyphicon-pencil" style="margin-left: 10px"></strong></a>
                    <?php
                    }else {
                    ?>                        
                     <a href="#myModal" data-toggle="modal" style="color:#fff">
                        <strong>EDITAR<span class="glyphicon glyphicon-pencil" style="margin-left: 10px"></strong></a><?php
                    }?>                  
                </li>
                <li>
                    <a href="inicio.php" style="color:#fff">
                        <strong>CANCELAR<span class="glyphicon glyphicon-remove" style="margin-left: 10px"></strong>
                    </a>
                </li>
                <li>
                    <a href="logout.php" style="color:#fff">
                        <strong>SAIR DO SISTEM<span class="glyphicon glyphicon-off" style="margin-left: 10px"></strong>
                    </a>
                </li>
            </ul>
        </div>
        <!-- MODAL PARA O CAMPO EDITAR CASOS USUARIO NÃO AUTORIZADOS TENTEM ACESSAR ESTE CAMPO-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">VOCÊ NÃO TEM PERMISSÃO PARA ACESSAR ESSA ÁREA</h4>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: center">
                            <strong>CONSULTE O USUÁRIO NÍVEL 2 PARA REALIZAR A AÇÃO</strong>
                            <a href="#" data-toggle="popover" title="Nelson Weber" style="text-decoration: none"><br>IDENTIFICAR USUÁRIO</span></a>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Retornar</button>
                    </div>
                </div>

            </div>
        </div>
        <!--Este script chama o popover para indentificar quem é o usuario nivel 2-->
        <script>
            $(document).ready(function () {
                $('[data-toggle="popover"]').popover();
            });
        </script>
        
        <div class="col-sm-5 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #737373;"><h5><strong>CADASTRO<br>EMPREENDIMENTO</strong><br><br></h5></div>
                <div class="panel-body" style="background-color:  #67b168;text-align: center"><a href="cad_empresa.php"><span class="glyphicon glyphicon-stats" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
        
        
        
        <div class="col-sm-5 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #737373;"><h5><strong>CADASTRO<br>ATIVIDADE</strong><br><br></h5></div>
                <div class="panel-body" style="background-color:  #67b168;text-align: center"><a href="#"><span class="glyphicon glyphicon-briefcase" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
    </div><hr>
</div>
<?php
require './pages/footer.php';
