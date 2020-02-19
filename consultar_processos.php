
<?php
session_start();
require './config/conexao.php';
require './pages/header.php';

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
}
?>
<script type="text/javascript">
    function somenteNumeros(num) {
        var er = /[^0-9.]/;
        er.lastIndex = 0;
        var campo = num;
        if (er.test(campo.value)) {
            campo.value = "";
        }
    }
</script>
<script type="text/javascript">
    function letras(e) {
        var expressao;
        expressao = /[0-9]/;
        if (expressao.test(String.fromCharCode(e.keyCode))) {
            return false;
        } else {
            return true;
        }
    }
</script>
<link rel="stylesheet" href="css/estilo_empreedempres.css">
<form name="fmrpesquisa" id="frmpesquisa">
    <div class="row">
        <div class="col-sm-10">
            <?php
            //ESSA PARTE DO CÓDIGO TEM  COMO PROPÓSITO CAPTURAR A QTD DE PROCESSOS CADASTRADO
            $sql_qtd_proc = "SELECT *FROM tb_processo";
            $sql_qtd = mysqli_query($con, $sql_qtd_proc);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="float:left;font-size: 15px; font-weight: bold;color:white;"title="TOTAL DE PROCESSOS"><strong>TOTAL DE PROCESSOS </strong><span class="badge">' . $sql_total . '</span></a>';
            echo'<a href="inicio.php" class="btn btn-danger" style="margin-left:5px;font-size: 15px; font-weight: bold;color:white;"title="CANCELAR"><strong>PAGINA INICIAL </strong><span class="glyphicon glyphicon-remove" style="margin-left:5px"></span></a>';
            ?>
        </div>       
        <div class="col-sm-2" style="text-align:right;">                           
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">-------  IR PARA -------
                <span class="caret"></span></button>
            <ul class="dropdown-menu">  
                <?php if ($_SESSION['nivel_acesso'] == "4" || $_SESSION['nivel_acesso'] == "6") {
                    ?>  
                    <li><a href="cadastros.php" style="font-weight:bold; color:#006600; text-decoration:none;margin-right: 20px">CADASTRO<span class="glyphicon glyphicon-plus" style="margin-left: 5px"></a></li>          
                    <li><a href="cad_empresa.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR RAZÃO SOCIAL / PESSOA FÍSICA<span class="glyphicon glyphicon-home" style="margin-left: 5px"></a></li>          
                    <li><a href="cad_empreendimento.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR EMPREENDIMENTO / ATIVIDADE<span class="glyphicon glyphicon-stats" style="margin-left: 5px"></a></li>
                    <li><a href="cad_atividade.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR ATIVIDADE PARA UM EMPREENDIMENTO<span class="glyphicon glyphicon-briefcase" style="margin-left: 5px"></a></li>
                    <li><a href="cad_processo.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR PROCESSO<span class="glyphicon glyphicon-list-alt" style="margin-left: 5px"></a></li>
                    <li><a href="cad_licenca.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR LICENÇA<span class="glyphicon glyphicon-duplicate" style="margin-left: 5px"></a></li>
                    <li><a href="cad_notificacao.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR NOTIFICAÇÃO<span class="glyphicon  glyphicon-bell" style="margin-left: 5px"></a></li>
                    <li><a href="cad_infracao.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR AUTO DE INFRAÇÃO<span class="glyphicon  glyphicon-alert" style="margin-left: 5px"></a></li>
                    <?php
                } else {
                    ?>  
                    <li><a href="#myModalCadastro" data-toggle="modal" style="font-weight:bold; color:#006600; text-decoration:none;margin-right: 20px">CADASTRO<span class="glyphicon glyphicon-plus" style="margin-left: 5px"></a></li>          
                    <li><a href="#myModalCadastro" data-toggle="modal"  style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR RAZÃO SOCIAL / PESSOA FÍSICA<span class="glyphicon glyphicon-home" style="margin-left: 5px"></a></li>          
                    <li><a href="#myModalCadastro" data-toggle="modal"  style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR EMPREENDIMENTO / ATIVIDADE<span class="glyphicon glyphicon-stats" style="margin-left: 5px"></a></li>
                    <li><a href="#myModalCadastro" data-toggle="modal"  style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR ATIVIDADE PARA UM EMPREENDIMENTO<span class="glyphicon glyphicon-briefcase" style="margin-left: 5px"></a></li>
                    <li><a href="#myModalCadastro" data-toggle="modal"  style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR PROCESSO<span class="glyphicon glyphicon-list-alt" style="margin-left: 5px"></a></li>
                    <li><a href="#myModalCadastro" data-toggle="modal"  style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR LICENÇA<span class="glyphicon glyphicon-duplicate" style="margin-left: 5px"></a></li>
                    <li><a href="#myModalCadastro" data-toggle="modal"  style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR NOTIFICAÇÃO<span class="glyphicon  glyphicon-bell" style="margin-left: 5px"></a></li>
                    <li><a href="#myModalCadastro" data-toggle="modal"  style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR AUTO DE INFRAÇÃO<span class="glyphicon  glyphicon-alert" style="margin-left: 5px"></a></li>
                <?php }
                ?>
                <li><a href="inicio.php" style="font-weight:bold; color:#0A246A; text-decoration:none;margin-right: 15px">CONSULTA<span class="glyphicon glyphicon-search" style="margin-left: 5px"></a></li>          
                <li><a href="#" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR EMPREENDIMENTO / ATIVIDADE<span class="glyphicon glyphicon-stats" style="margin-left: 5px"></a></li>
                <li><a href="consultar_atividades.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR ATIVIDADE PARA UM EMPREENDIMENTO<span class="glyphicon glyphicon-briefcase" style="margin-left: 5px"></a></li>
                <li><a href="consultar_licencas.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR LICENÇA<span class="glyphicon glyphicon-duplicate" style="margin-left: 5px"></a></li>               
                <li><a href="consultar_notificacoes.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR NOTIFICAÇÃO<span class="glyphicon glyphicon-bell" style="margin-left: 5px"></a></li>
                <li><a href="#" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR AUTO DE INFRAÇÕES<span class="glyphicon glyphicon-alert" style="margin-left: 5px"></a></li>

                <li>
                    <?php if ($_SESSION['nivel_acesso'] == "4" || $_SESSION['nivel_acesso'] == "5" || $_SESSION['nivel_acesso'] == "6") {
                        ?>  
                        <a href="editar.php" style="color:#985f0d">
                            <strong>REALIZAR EDICÃO<span class="glyphicon glyphicon-pencil" style="margin-left: 10px"></strong></a>
                        <?php
                    } else {
                        ?>                        
                        <a href="#myModal" data-toggle="modal" style="color:#985f0d" >
                            <strong>REALIZAR EDICÃO<span class="glyphicon glyphicon-pencil" style="margin-left: 10px"></strong></a><?php }
                    ?>                  
                </li>
                <li><a href="inicio.php" style="font-weight:bold; color: #ce8483">PAGINA INICIAL <span class="glyphicon glyphicon-remove" style="margin-left: 5px"></a></li>
                <li><a href="logout.php" style="font-weight:bold; color: #ce8483">SAIR DO SISTEMA<span class="glyphicon glyphicon-off" style="margin-left: 5px"></a></li>
            </ul>
        </div>
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
        <!--Este script chama o popover para indentificar quem é o usuario nivel 2-->
        <script>
            $(document).ready(function () {
                $('[data-toggle="popover"]').popover();
            });
        </script>        
    </div><hr>

    <div class="row">
<<<<<<< HEAD
        <!--        <div class="col-sm-3" style="">
                    <input type="text" name="parametro_num_processo" onkeyup="somenteNumeros(this);" maxlength="3" class="form-control"  placeholder="Nº PROCESSO / PROTOCOLO" title="Digite Apenas Números">
                </div>-->
        <div class="col-sm-2" style="">
            <select name="parametro_mes" id="parametro_mes" class="form-control" >
                <option value="">MES</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </div> 
=======
        <div class="col-sm-3" style="">
            <input type="text" name="parametro_num_processo" onkeyup="somenteNumeros(this);" maxlength="3" class="form-control"  placeholder="Nº PROCESSO / PROTOCOLO" title="Digite Apenas Números">
        </div>
<!--        <div class="col-sm-2" style="">
            <input type="date" name="parametro_data_inicio" class="form-control">
        </div>
        <div class="col-sm-2" style="">
            <input type="date" name="parametro_data_fim" class="form-control">
        </div>-->
>>>>>>> fa7ccae93c79c911f982823ea269f9961a78a791
        <div class="col-sm-2" style="">
            <select name="parametro_ano" id="parametro_ano" class="form-control" >
                <option value="">ANO</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
            </select>
        </div> 
        <!--        <div class="col-sm-2" style="">
                    <select name="parametro_mes" id="parametro_mes" class="form-control" >
                        <option value="">MES</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                    </select>
                </div> -->

                <div class="col-sm-2">
                    <select name="parametro_assunto" id="atividade_empreendimento" class="form-control" >
                        <option value="">LICENÇA</option>
                        <option value="AUTO DE INFRAÇÃO">AUTO DE INFRAÇÃO</option>
                        <option value="AUTO DE NOTIFICAÇÃO E INTIMAÇÃO">AUTO DE NOTIFICAÇÃO E INTIMAÇÃO</option>                                           
                        <option value="AUTORIZAÇÃO PARA CORTE DE ARVORE">AUTORIZAÇÃO PARA CORTE DE ARVORE</option> 
                        <option value="AUTORIZAÇÃO PARA PODA DE ÁRVORE">AUTORIZAÇÃO PARA PODA DE ÁRVORE</option> 
                        <option value="AUTORIZAÇÃO DE LIMPEZA DE ÁREA">AUTORIZAÇÃO DE LIMPEZA DE ÁREA</option>                                                   
                        <option value="AUTORIZAÇÃO PARA SUPRESSÃO DE VEGETAÇÃO E LIMPEZA DE ÁREA">AUTORIZAÇÃO PARA SUPRESSÃO DE VEGETAÇÃO E LIMPEZA DE ÁREA</option>                                                  
                        <option value="LICENCA AMBIENTAL SIMPLIFICADA">L.A.S</option>
                        <option value="LICENÇA DE INSTALAÇÃO">L.I</option>
                        <option value="LICENÇA DE OPERAÇÃO">L.O</option>
                        <option value="LICENÇA DE OPERAÇÃO CORRETIVA">L.O.C</option>
                        <option value="LICENÇA DE PRÉVIA">L.P</option>                                                                                                                   
                        <option value="RENOVAÇÃO DE LICENCA PRÉVIA">R.L.P</option>
                        <option value="RENOVAÇÃO DE LICENÇA DE INSTALAÇÃO">R.L.I</option>
                        <option value="RENOVAÇÃO DE LICENÇA DE OPERAÇÃO">R.L.O</option>
                    </select>
                </div>
        <div class="col-sm-1" style="">
            <input type="submit" value="BUSCAR" class="btn btn-primary" style="font-size: 15px; font-weight: bold;color: #fff;text-align: center">
        </div>
    </div><br>
</form>

<?php
<<<<<<< HEAD
//$parametro_num_processo = filter_input(INPUT_GET, "parametro_num_processo");
$parametro_mes = filter_input(INPUT_GET, "parametro_mes");
=======
>>>>>>> fa7ccae93c79c911f982823ea269f9961a78a791
$parametro_ano = filter_input(INPUT_GET, "parametro_ano");
$parametro_num_processo = filter_input(INPUT_GET, "parametro_num_processo");
$parametro_assunto = filter_input(INPUT_GET, "parametro_assunto");

<<<<<<< HEAD

$sql = "SELECT tb_processo.codigo_processo,tb_processo.numero_processo,tb_processo.ano,tb_processo.data_processo,tb_processo.assunto,tb_processo.situacao_processo
            FROM 
            tb_processo
            WHERE(month(data_processo) = '$parametro_mes' and year(data_processo) = '$parametro_ano')
            
            ";

if(!empty($_REQUEST['parametro_mes'])){
    $sql .="AND MONTH(data_processo)=".$_REQUEST['parametro_mes']; 
}
if(!empty($_REQUEST['parametro_ano'])){
    $sql .="AND YEAR(data_processo)=".$_REQUEST['parametro_ano']; 
}



echo $sql;

=======
$sql = "SELECT tb_processo.codigo_processo,tb_processo.numero_processo,tb_processo.ano,tb_processo.data_processo,tb_processo.assunto,tb_processo.situacao_processo,tb_empresa.razaosocial_pessoafisica,tb_empreendimento.nome_empreendimento,tb_empreendimento.nome_atividade 
        FROM 
            tb_processo, tb_empresa, tb_empreendimento
        WHERE(numero_processo LIKE '$parametro_num_processo%' AND ano LIKE '$parametro_ano%' AND assunto LIKE '$parametro_assunto%') AND
            tb_processo.fk3_codigo_empresa = tb_empresa.codigo_empresa AND tb_processo.fk4_codigo_empreendimento = tb_empreendimento.codigo_empreendimento";
>>>>>>> fa7ccae93c79c911f982823ea269f9961a78a791

$recebe = mysqli_query($con, $sql);


if (mysqli_num_rows($recebe) > 0) {
    ?>
    <div class = "row">
        <div class = "col-sm-12">
            <!--ESTE CSS RESPONSVEL POR AJUDAR NA INSERÇÃO DA BARRA DE ROLAGEM DA TABELA-->
            <style type = "text/css">
                .table-overflow {
                    max-height:400px;
                    overflow-x:auto;
                }
            </style>
            <?php
            //retorna a qtd de linha apos a filtragem
            $total = mysqli_num_rows($recebe);
            echo'<strong>TOTAL DE PROCESSOS FILTRADOS </strong><span class="badge">' . $total . '</span></a><br>';
            ?>

            <div class = "table-overflow"><br>
                <table class="table table-striped table-hover table-bordered">
                    <header>
                        <tr  style="text-align: center;background-color:#dff0d8;color: #000000" >
                            <!--<th style="text-align: center;font-size: 12px"><strong>COD</strong></th>-->
                            <th style="text-align: center;font-size: 12px">Nº PROCESSO / PROTOCOLO</th>                                                                   
                            <th style="text-align: center;font-size: 12px">ANO</th> 
                            <th style="text-align: center;font-size: 12px">EMPRESA / PESSSOA FÍSICA</th>                                                                              
                            <th style="text-align: center;font-size: 12px">ASSUNTO</th>
                            <th style="text-align: center;font-size: 12px">DATA</th>   
                            <th style="text-align: center;font-size: 12px">SITUAÇÃO</th>        
                            <th style="width: 1%"><img  src="img/olho_1.png" title="Ver Mais Detalhes" style="margin-left: 25px"></th> 
                        </tr>
                    </header>

                    <?php
                    while ($linhas = mysqli_fetch_array($recebe)) {
                        $codigo_processo = $linhas['codigo_processo']; //variavel para recupar o id do processo
                        echo'<tr style="font-size:13px">';
                        echo'<td style="font-size:12px;">' . $linhas['numero_processo'] . '</td>';
                        echo'<td style="font-size:12px;">' . $linhas['ano'] . '</td>';
//                        echo'<td style="font-size:12px">' . $linhas['razaosocial_pessoafisica'] . '</td>';
                        echo'<td style="font-size:12px;">' . $linhas['assunto'] . '</td>';
                        echo'<td style="font-size:12px;">' . date('d/m/Y', strtotime($linhas['data_processo'])) . '</td>';
                        echo'<td style="font-size:12px">' . $linhas['situacao_processo'] . '</td>';
                        echo'<td style="height:30px;text-align:center" title="Detalhes"><a href=detalhes_processo.php?codigo_processo=' . $codigo_processo . '><button type="button" class="btn btn-xs btn-primary">VISUALIZAR</button></strong></a></td>';
                        echo'</tr>';
                    }
                }
                ?>     
            </table><br>

        </div>
    </div>
</div>

<?php
require './pages/footer.php';









