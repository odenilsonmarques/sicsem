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

<form name="fmrpesquisa">
    <div class="row">
        <div class="col-sm-10">
            <?php
            //ESSA PARTE DO CÓDIGO TEM  COMO PROPÓSITO CAPTURAR A QTD DE NOTIFICAÇÕES CADASTRADO
            $sql_qtd_proc = "SELECT *FROM tb_notificacao";
            $sql_qtd = mysqli_query($con, $sql_qtd_proc);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="float:left;font-size: 15px; font-weight: bold;color:white;"title="TOTAL DE NOTIFICAÇÕES"><strong>TOTAL DE NOTIFICAÇÕES </strong><span class="badge">' . $sql_total . '</span></a>';
            echo'<a href="inicio.php" class="btn btn-danger" style="margin-left:5px;font-size: 15px; font-weight: bold;color:white;"title="CANCELAR"><strong>PAGINA INICIAL </strong><span class="glyphicon glyphicon-remove" style="margin-left:5px"></span></a>';
            ?>
        </div> 
        <div class="col-sm-2" style="text-align:right;">                           
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">-------  IR PARA -------
                <span class="caret"></span></button>
            <ul class="dropdown-menu"> 
                <?php if ($_SESSION['nivel_acesso'] == "4" || $_SESSION['nivel_acesso'] == "6")  {
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
                <li><a href="consultar_processos.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR PROCESSO<span class="glyphicon glyphicon-list-alt" style="margin-left: 5px"></a></li> 
                <li><a href="#" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR AUTO DE INFRAÇÕES<span class="glyphicon glyphicon-alert" style="margin-left: 5px"></a></li>

                <li>
                    <?php if ($_SESSION['nivel_acesso'] == "4" || $_SESSION['nivel_acesso'] == "5" || $_SESSION['nivel_acesso'] == "6") {
                        ?>  
                        <a href="editar.php" style="color:#985f0d">
                            <strong>REALIZAR EDICÃO<span class="glyphicon glyphicon-pencil" style="margin-left: 10px"></strong></a>
                        <?php
                    } else {
                        ?>                        
                        <a href="#myModal" data-toggle="modal" style="color:#985f0d">
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
        <div class="col-sm-2" style="">
            <input type="text" name="parametro_empresa" onKeypress="return letras(event)" maxlength="3" class="form-control"  placeholder="Pª Física / Razão Social" title="Digite Apenas Números">
        </div>
        <div class="col-sm-2" style="">
            <input type="text" name="parametro_num_notificacao" onkeyup="somenteNumeros(this);" maxlength="3" class="form-control"  placeholder="Nº da Notificação" title="Digite Apenas Números">
        </div>
        <div class="col-sm-2" style="">
            <input type="text" name="parametro_num_processo" onkeyup="somenteNumeros(this);" maxlength="4" class="form-control"  placeholder="Nº Processo" title="Digite Apenas Números">
        </div>
       <div class="col-sm-2" style="">
            <select name="parametro_ano" id="ano" class="form-control" >
                <option value="">ANO</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
            </select>
        </div> 
        <div class="col-sm-1" style="">
            <input type="submit" value="BUSCAR" class="btn btn-primary" style="font-size: 15px; font-weight: bold;color: #fff;text-align: center">
        </div>
    </div><br>
</form>
<?php
$parametro_empresa = filter_input(INPUT_GET, "parametro_empresa");
$parametro_num_notificacao = filter_input(INPUT_GET, "parametro_num_notificacao");
$parametro_num_processo = filter_input(INPUT_GET, "parametro_num_processo");
$parametro_ano = filter_input(INPUT_GET, "parametro_ano");

$sql = "SELECT tb_notificacao.codigo_notificacao,tb_notificacao.numero_notificacao,tb_notificacao.ano_notificacao,tb_notificacao.data_notificacao,tb_notificacao.data_comparecimento,tb_notificacao.profissao_atividade,tb_notificacao.descricao_prazo,tb_notificacao.status,tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_processo.numero_processo,tb_fiscal.nome_matricula_fiscal,
            (if(current_date()<= data_comparecimento,'<strong>DENTRO DO PRAZO</strong>','<strong style=color:#F4C430>PRAZO VENCIDO<strong>')) AS situacao    
            FROM 
            tb_notificacao,tb_empresa,tb_processo,tb_fiscal
            WHERE(razaosocial_pessoafisica LIKE '$parametro_empresa%' AND numero_notificacao LIKE '$parametro_num_notificacao%' AND numero_processo LIKE '$parametro_num_processo%' AND ano_notificacao LIKE '$parametro_ano%')AND 
            tb_notificacao.fk5_codigo_empresa = tb_empresa.codigo_empresa AND tb_notificacao.fk2_codigo_processo = tb_processo.codigo_processo AND tb_notificacao.fk1_codigo_fiscal = tb_fiscal.codigo_fiscal ORDER BY codigo_notificacao";
$recebe = mysqli_query($con, $sql);
if (mysqli_num_rows($recebe) > 0 AND $parametro_empresa OR $parametro_num_notificacao OR $parametro_num_processo OR $parametro_ano) {
    ?>
    <div class="row">
        <div class = "col-sm-12">
            <!--ESTE CSS RESPONSVEL POR AJUDAR NA INSERÇÃO DA BARRA DE ROLAGEM DA TABELA-->
            <style type = "text/css">
                .table-overflow {
                    max-height:400px;
                    overflow-x:auto;
                }
            </style>
            <div class = "table-overflow"><br>
                <table class="table table-striped table-hover table-bordered">
                    <header>
                        <tr style="text-align: center;background-color:#dff0d8;color: #000000" >
                            <th style="text-align: center;font-size: 12px">PROFISSÃO / ATIVIDADE</th> 
                            <th style="text-align: center;font-size: 12px"><strong>Nº NOTIFICACÃO</strong></th>
                            <th style="text-align: center;font-size: 12px">DATA  NOTIFICAÇÃO</th>
                            <th style="text-align: center;font-size: 12px">DATA COMPARECIMENTO</th>
                            <th style="text-align: center;font-size: 12px">NÚMERO PROCESSO</th> 
                            <th style="text-align: center;font-size: 12px">STATUS</th>  
                            <th style="text-align: center;font-size: 12px">SITUAÇÃO</th>             
                            <th style="width: 1%"><img  src="img/olho_1.png" title="Ver Mais Detalhes" style="margin-left: 25px"></th>             
                        </tr>
                    </header>
                    <?php
                    while ($linhas = mysqli_fetch_array($recebe)) {
                        $notificacoes = $linhas['codigo_notificacao']; //variavel para recupar o id da notificação
                        echo'<tr style="font-size:13px">';
                        echo'<td style="font-size:12px">' . $linhas['nome_fantasia'] . '</td>';
                        echo'<td style="font-size:12px">' . $linhas['numero_notificacao'] . '</td>';
                        echo'<td style="font-size:12px">' . date('d/m/Y', strtotime($linhas['data_notificacao'])) . '</td>';
                        echo'<td style="font-size:12px">' . date('d/m/Y', strtotime($linhas['data_comparecimento'])) . '</td>';
                        echo'<td style="font-size:12px">' . $linhas['numero_processo'] . '</td>';
                        echo'<td style="font-size:12px">' . $linhas['status'] . '</td>';
                        echo'<td style="font-size:12px">' . $linhas['situacao'] . '</td>';
                        echo'<td style="height:30px;text-align:center" title="Detalhes"><a href=detalhes_notificacao.php?codigo_notificacao=' . $notificacoes . '><button type="button" class="btn btn-xs btn-primary">VISUALIZAR</button></strong></a></td>';
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



