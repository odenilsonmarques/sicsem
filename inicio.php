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
                     <?php if ($_SESSION['nivel_acesso'] == "4" || $_SESSION['nivel_acesso'] == "5" || $_SESSION['nivel_acesso'] == "6") {
                        ?>  
                        <a href="cadastros.php" style="color:#fff">
                            <strong>CADASTRAR<span class="glyphicon glyphicon-plus" style="margin-left: 10px"></strong></a>
                        <?php
                    } else {
                        ?>                        
                        <a href="#myModalCadastro" data-toggle="modal" style="color:#fff" >
                            <strong>CADASTRAR<span class="glyphicon glyphicon-plus" style="margin-left: 10px"></strong></a><?php }
                    ?> 
                </li>
                
                <li>
                    <a href="https://www.tinus.com.br/csp/SAOJOSEDERIBAMAR/siat.csp?806sXP885I4962CM=HlAj362uIaibjgT3TR1643n6620440icYk818" target="_blank"  style="color:#fff">
                        <strong>CONSULTAR SIAT<span class="glyphicon glyphicon-search" style="margin-left: 10px"></strong>
                    </a>
                </li>
                 <li>
                    <a href="#myModalDenuncia" data-toggle="modal" style="color:#fff">
                        <strong>DENUNCIAS<span class="glyphicon glyphicon-bullhorn" style="margin-left: 10px"></strong>
                    </a>
                </li>
                <li>
                    <?php if ($_SESSION['nivel_acesso'] == "4" || $_SESSION['nivel_acesso'] == "5" || $_SESSION['nivel_acesso'] == "6")  {
                        ?>  
                        <a href="editar.php" style="color:#fff">
                            <strong>AÇÕES<span class="glyphicon glyphicon-pencil" style="margin-left: 10px"></strong></a>
                        <?php
                    } else {
                        ?>                        
                        <a href="#myModal" data-toggle="modal" style="color:#fff" >
                            <strong>AÇÕES<span class="glyphicon glyphicon-pencil" style="margin-left: 10px"></strong></a><?php }
                    ?>                  
                </li>        
                <li>
                    <a href="https://www.receita.fazenda.gov.br/pessoajuridica/cnpj/cnpjreva/cnpjreva_solicitacao2.asp" target="_blank"  style="color:#fff">
                        <strong>EMITIR CNPJ<span class="glyphicon glyphicon-list-alt" style="margin-left: 10px"></strong>
                    </a>
                </li>
                <li>
                    <a href="logout.php" style="color:#fff">
                        <strong>SAIR DO SISTEMA<span class="glyphicon glyphicon-off" style="margin-left: 10px"></strong>
                    </a>
                </li>
            </ul>
        </div
         <!--MODAL PARA O CAMPO CADASTRO - BLOQEANDO USUARIO CASO ELE NÃO SEJA TENHA PERMISSÃO-->
        <div class="modal fade" id="myModalCadastro" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">VOCÊ NÃO TEM PERMISSÃO PARA ACESSAR ESSA ÁREA</h4>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: center">
                            <strong>CONSULTE O USUÁRIO QUE TENHA ESSA PERMISSÃO</strong>
                            <a href="#" data-toggle="popover" title="PROTOCOLO / GABINETE" style="text-decoration: none"><br>IDENTIFICAR USUÁRIO</span></a>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Retornar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!--MODAL PARA O CAMPO  DENUNCIA - INFORMAND AO USUARIO QUE ESTA PÁGINA ESTÁ EM DESENVOLEVIMENTO-->
        <div class="modal fade" id="myModalDenuncia" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="text-align: center">PÁGINA EM DENSENVOLVIMENTO</h4>
                    </div>
                    <div class="modal-body text-center">
                        <img src="img/desenvolvimento32.jpg" width="350" height="250" >
                    </div>
                </div>
            </div>
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
                            <a href="#" data-toggle="popover" title="Protocolo /  Gabinete" style="text-decoration: none"><br>IDENTIFICAR USUÁRIO</span></a>
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
        <div class="col-sm-2 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #31708f;"><h5><strong>CONSULTAR<br>EMPRESA / Pª FÍSICA</strong><br><br></span></h5></div>
                <div class="panel-body" style="background-color: #67b168;text-align: center"><a href="consultar_empresas.php"><span class="glyphicon glyphicon-home" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
        <div class="col-sm-2 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#31708f;"><h5><strong>CONSULTAR<br>PROCESSO</strong><br><br></span></h5></div>
                <div class="panel-body" style="background-color: #67b168;text-align: center"><a href="consultar_processos.php"><span class="glyphicon glyphicon-th-list" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
        <div class="col-sm-2 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #31708f;"><h5><strong>CONSULTAR<br>LICENÇAS</strong><br><br></span></h5></div>
                <div class="panel-body" style="background-color: #67b168;text-align: center"><a href="consultar_licencas.php"><span class="glyphicon glyphicon-list-alt" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
         
        <div class="col-sm-2 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #31708f;"><h5><strong>CONSULTAR<br>ATIVIDADES</strong><br><br></span></h5></div>
                <div class="panel-body" style="background-color: #67b168;text-align: center"><a href="consultar_atividades.php"><span class="glyphicon glyphicon-briefcase" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>       
        <div class="col-sm-2 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #31708f;"><h5><strong>CONSULTAR<br>NOTIFICAÇÕES</strong><br><br></span></h5></div>
                <div class="panel-body" style="background-color: #67b168;text-align: center"><a href="consultar_notificacoes.php"><span class="glyphicon glyphicon-bell" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
        <div class="col-sm-2 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #31708f;"><h5><strong>CONSULTAR<br> AUTO DE INFRACÃO</strong><br><br></span></h5></div>
                <div class="panel-body" style="background-color: #67b168;text-align: center"><a href="consultar_infracao.php"><span class="glyphicon glyphicon-alert" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
        <div class="col-sm-2 grow">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #31708f;"><h5><strong>CONSULTAR<br>VISTORIA</strong><br><br></span></h5></div>
                <div class="panel-body" style="background-color: #67b168;text-align: center"><a href="#"><span class="glyphicon glyphicon-eye-open" style="color:#fff;font-size: 60px"></span></a></div>
            </div>
        </div>
        
    </div><hr>
    <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127545.95114662919!2d-44.10975811893266!3d-2.568182620455705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7f6bd1b638097d1%3A0xf7a20fe4d4222001!2sParque+Da+Cidade!5e0!3m2!1spt-BR!2sbr!4v1553870603639!5m2!1spt-BR!2sbr" width="1000" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->

    <div class="row">
        <h2 style="color: #31708f">NOSSOS CONTRIBUINTES</h2><br>
        <!--ESTE CSS RESPONSVEL POR AJUDAR NA INSERÇÃO DA BARRA DE ROLAGEM DA TABELA-->
        <style type="text/css">
            .table-overflow {
                max-height:400px;
                overflow-x:auto;
            }
        </style>
        <div class="table-overflow">
            <table class="table table-striped table-hover table-bordered" >
                <header>
                    <tr style="text-align: center;background-color:#67b168;color: #000000" >               
                        <th style="text-align: center;font-size: 12px">RAZÃO SOCIAL / PESSOA FÍSICA</th>   
                        <th style="text-align: center;font-size: 12px">NOME FANTASIA</th>                     
                        <th style="text-align: center;font-size: 12px">CNPJ / CPF</th>
                        <th style="text-align: center;font-size: 12px">TELEFONE</th>
                        <th style="width: 1%;text-align: center"><span class="glyphicon  glyphicon-eye-open" style="margin-left: 5px;color: #fff"></span></th>  
                    </tr>
                </header>

                <?php
                //seleciona todos os itens da tabela 
                $empresas = "select * from tb_empresa";
                $linha = mysqli_query($con, $empresas);

                //conta o total de itens 
                $total = mysqli_num_rows($linha);

                $sql = "SELECT codigo_empresa,razaosocial_pessoafisica,nome_fantasia,cnpj_cpf,bairro,telefone
                        FROM tb_empresa ORDER BY razaosocial_pessoafisica";
                
                $recebe = mysqli_query($con, $sql);
                if (mysqli_num_rows($recebe) > 0) {
                    while ($linhas = mysqli_fetch_array($recebe)) {
                        $empresa = $linhas['codigo_empresa']; //variavel pararecupar o id do empreendimento         
                        echo'<td style="font-size:12px">' . $linhas['razaosocial_pessoafisica'] . '</td>';
                        echo'<td style="font-size:12px">' . $linhas['nome_fantasia'] . '</td>';           
                        echo'<td style="font-size:12px">' . $linhas['cnpj_cpf'] . '</td>';         
                        echo'<td style="font-size:12px">' . $linhas['telefone'] . '</td>';
                        echo'<td style="height:30px;text-align:center" title="Detalhes"><a href=detalhes_empresa.php?codigo_empresa=' . $empresa . '><button type="button" class="btn btn-xs btn-primary">VISUALIZAR</button></strong></a></td>';
                        echo'</tr >';
                    }
                }
                ?>
            </table>
        </div>  
        <br><br><br>
    </div>
</div>
<?php
require './pages/footer.php';
