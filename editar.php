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
                <li>
                    <a href="cadastros.php" style="color:#fff">
                        <strong>CADASTRAR<span class="glyphicon glyphicon-plus" style="margin-left: 10px"></strong>  
                    </a>
                </li>
                <li class="">
                    <a href="inicio.php" style="color:#fff">
                        <strong>CONSULTAR<span class="glyphicon glyphicon-search" style="margin-left: 10px"></strong>
                    </a>                   
                </li>
                <li>
                    <a href="https://www.tinus.com.br/csp/SAOJOSEDERIBAMAR/siat.csp?806sXP885I4962CM=HlAj362uIaibjgT3TR1643n6620440icYk818" target="_blank"  style="color:#fff">
                        <strong>CONSULTAR SIAT<span class="glyphicon glyphicon-search" style="margin-left: 10px"></strong>
                    </a>
                </li>
                <li>
                    <a href="https://www.receita.fazenda.gov.br/pessoajuridica/cnpj/cnpjreva/cnpjreva_solicitacao2.asp" target="_blank"  style="color:#fff">
                        <strong>EMITIR CNPJ<span class="glyphicon glyphicon-list-alt" style="margin-left: 10px"></strong>
                    </a>
                </li>
                <li>
                    <a href="inicio.php" style="color:#fff">
                        <strong>CANCELAR<span class="glyphicon glyphicon-remove" style="margin-left: 10px"></strong>
                    </a>
                </li>
                <li>
                    <a href="logout.php" style="color:#fff">
                        <strong>SAIR DO SISTEMA<span class="glyphicon glyphicon-off" style="margin-left: 10px"></strong>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="col-sm-2 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:  #c0a16b;"><h5><strong>EDITAR / REMOVER<br>RAZÃO SOCIAL / Pª FÍSICA</strong><br><br><span class="glyphicon glyphicon-pencil" style="color: #FFF"></span><span class="glyphicon glyphicon-remove" style="color: #FFF; margin-left: 10px"></span></a></h5></div>
                <div class="panel-body" style="background-color: #67b168;text-align: center"><a href="exibe_contribuintes.php"><span class="glyphicon glyphicon-home" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
        <div class="col-sm-2 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #c0a16b;"><h5><strong>EDITAR / REMOVER<br>PROCESSOS</strong><br><br><span class="glyphicon glyphicon-pencil" style="color: #FFF"></span><span class="glyphicon glyphicon-remove" style="color: #FFF; margin-left: 10px"></span></h5></div>
                <div class="panel-body" style="background-color: #67b168;text-align: center"><a href="exibe_processo.php"><span class="glyphicon glyphicon-th-list" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
        <div class="col-sm-2 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:  #c0a16b;"><h5><strong>EDITAR / REMOVER<br>LICENÇAS</strong><br><br><span class="glyphicon glyphicon-pencil" style="color: #FFF"></span><span class="glyphicon glyphicon-remove" style="color: #FFF; margin-left: 10px"></span></h5></div>
                <div class="panel-body" style="background-color: #67b168;text-align: center"><a href="exibe_licencas.php"><span class="glyphicon glyphicon-list-alt" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
        <div class="col-sm-2 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #c0a16b;"><h5><strong>EDITAR / REMOVER<br>ATIVIDADE ( PESSOAª / RAZÃO SOCIAL) </strong><br><br><span class="glyphicon glyphicon-pencil" style="color: #FFF"></span><span class="glyphicon glyphicon-remove" style="color: #FFF; margin-left: 10px"></span></h5></div>
                <div class="panel-body" style="background-color:  #67b168;text-align: center"><a href="exibe_atividade.php"><span class="glyphicon glyphicon-stats" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
        <div class="col-sm-2 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #c0a16b;"><h5><strong>EDITAR / REMOVER<br>ATIVIDADE (EMPREENDIMENTO)</strong><br><br><span class="glyphicon glyphicon-pencil" style="color: #FFF"></span><span class="glyphicon glyphicon-remove" style="color: #FFF; margin-left: 10px"></span></h5></div>
                <div class="panel-body" style="background-color:  #67b168;text-align: center"><a href="exibe_atividade_empreendimento.php"><span class="glyphicon glyphicon-briefcase" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
        <div class="col-sm-2 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #c0a16b;"><h5><strong>EDITAR / REMOVER<br>NOTIFICAÇÃO</strong><br><br><span class="glyphicon glyphicon-pencil" style="color: #FFF"></span><span class="glyphicon glyphicon-remove" style="color: #FFF; margin-left: 10px"></span></h5></div>
                <div class="panel-body" style="background-color:  #67b168;text-align: center"><a href="exibe_notificacoes.php"><span class="glyphicon glyphicon-bell" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
        <div class="col-sm-2 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #c0a16b;"><h5><strong>EDITAR / REMOVER<br>AUTO DE IINFRAÇÃO</strong><br><br><span class="glyphicon glyphicon-pencil" style="color: #FFF"></span><span class="glyphicon glyphicon-remove" style="color: #FFF; margin-left: 10px"></span></h5></div>
                <div class="panel-body" style="background-color:  #67b168;text-align: center"><a href="exibe_autos.php"><span class="glyphicon glyphicon-alert" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
    </div><hr>
</div>
<?php
require './pages/footer.php';
