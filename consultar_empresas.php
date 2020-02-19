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
            $_SESSION['nome'];
            //ESSA PARTE DO CÓDIGO TEM  COMO PROPÓSITO CAPTURAR A QTD DEGAL DE EMPRESAS CADASTRADAS
            $sql_qtd_emp = "SELECT *FROM tb_empresa";
            $sql_qtd = mysqli_query($con, $sql_qtd_emp);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-success" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="TOTAL DE EMPRESA CADASTRADAS"><strong>TOTAL DE EMPRESA CADASTRADAS </strong><span class="badge">' . $sql_total . '</span></a>';
            echo'<a href="inicio.php" class="btn btn-danger" style="font-size:16px; font-weight:bold;color:white;"title="CANCELAR"><strong>PAGINA INICIAL </strong><span class="glyphicon glyphicon-remove"></span></a><br>';
            ?>
        </div>       
        <div class="col-sm-2" style="text-align:right;">                           
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">-------  IR PARA -------
                <span class="caret"></span></button>
            <ul class="dropdown-menu"> 
                <?php if ($_SESSION['nivel_acesso'] == "4" ||  $_SESSION['nivel_acesso'] == "6")  {
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
                <li><a href="consultar_processos.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR PROCESSO<span class="glyphicon glyphicon-list-alt" style="margin-left: 5px"></a></li>                
                <li><a href="consultar_notificacoes.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR NOTIFICAÇÃO<span class="glyphicon glyphicon-bell" style="margin-left: 5px"></a></li>
                <li><a href="#" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR AUTO DE INFRAÇÕES<span class="glyphicon glyphicon-alert" style="margin-left: 5px"></a></li>

                <li>
                    <?php if ($_SESSION['nivel_acesso'] == "4" || $_SESSION['nivel_acesso'] == "5" || $_SESSION['nivel_acesso'] == "6")  {
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
                <li><a href="consultar_nivelPoluidor.php" style="font-weight:bold; color:#2e6da4">NIVEL DE POLUIÇÃO DAS ATIVIDADES<span class="glyphicon glyphicon-fire" style="margin-left: 5px"></a></li>
                <li><a href="inicio.php" style="font-weight:bold; color: #ce8483">PAGINA INICIAL<span class="glyphicon glyphicon-remove" style="margin-left: 5px"></a></li>
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
        <div class="col-sm-3" style="">
            <input type="text" name="parametro_empresa" onKeypress="return letras(event)" class="form-control" placeholder="Razão Social / Pessoa Fisica" title="Digite Apenas Letras">
        </div> 
        <div class="col-sm-3" style="">
            <input type="text" name="parametro_nome_fantasia" onKeypress="return letras(event)" class="form-control" placeholder="Nome Fantasia" title="Digite Apenas Letras">
        </div> 
        <div class="col-sm-2" style="">
            <input type="text" name="parametro_cnpj_cpf" onkeyup="somenteNumeros(this);" maxlength="18" class="form-control" placeholder="Cnpj / Cpf" title="Digite Apenas Números">
        </div>
        <div class="col-sm-2" style="">
            <input type="text" name="parametro_bairro" onKeypress="return letras(event)" class="form-control" placeholder="Bairro" title="Digite Apenas Letras">
        </div> 

        <div class="col-sm-1" style="">
            <input type="submit" value="BUSCAR" class="btn btn-primary" style="font-size: 15px; font-weight: bold;color: #fff;text-align: center">
        </div>
    </div><br>
</form>

<?php
$parametro_empresa = filter_input(INPUT_GET, "parametro_empresa");
$parametro_nome_fantasia = filter_input(INPUT_GET, "parametro_nome_fantasia");
$parametro_cnpj_cpf = filter_input(INPUT_GET, "parametro_cnpj_cpf");
$parametro_bairro = filter_input(INPUT_GET, "parametro_bairro");

$sql = "SELECT 
            codigo_empresa,razaosocial_pessoafisica,nome_fantasia,cnpj_cpf,bairro
        FROM 
            tb_empresa
        WHERE
            (razaosocial_pessoafisica LIKE '$parametro_empresa%' AND nome_fantasia LIKE '$parametro_nome_fantasia%' AND cnpj_cpf LIKE '$parametro_cnpj_cpf%' AND bairro LIKE '$parametro_bairro%')";
$recebe = mysqli_query($con, $sql);

if (mysqli_num_rows($recebe) > 0 AND $parametro_empresa OR $parametro_cnpj_cpf OR $parametro_nome_fantasia OR $parametro_bairro) {
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
            echo'<strong>TOTAL DE RAZÃO SOCIAL / Pª FÍSICA FILTRADAS </strong><span class="badge">' . $total . '</span></a><br>';
            ?>
            <div class = "table-overflow"><br>
                <table class="table table-striped table-hover table-bordered">
                    <header>
                        <tr style="text-align: center;background-color:#dff0d8;color: #000000" >
                            <th style="text-align: center;font-size: 12px">EMPRESA / PESSSOA FÍSICA</th> 
                            <th style="text-align: center;font-size: 12px">NOME FANTASIA</th> 
                            <th style="text-align: center;font-size: 12px">CNPJ / CPF</th> 
                            <th style="text-align: center;font-size: 12px">BAIRRO</th>
                            <th style="width: 1%;text-align: center"><span class="glyphicon  glyphicon-eye-open" style="margin-left: 5px;color: #337ab7"></span></th>  
                        </tr>
                    </header>
                    <?php
                    while ($linhas = mysqli_fetch_array($recebe)) {
                        $codigo_empresa = $linhas['codigo_empresa']; //variavel pararecupar o id do empreendimento
                        echo'<tr style="font-size:13px">';
                        echo'<td style="font-size:12px">' . $linhas['razaosocial_pessoafisica'] . '</td>';
                        echo'<td style="font-size:12px">' . $linhas['nome_fantasia'] . '</td>';
                        echo'<td style="font-size:12px;width:10%">' . $linhas['cnpj_cpf'] . '</td>';
                        echo'<td style="font-size:12px;width:10%">' . $linhas['bairro'] . '</td>';
                        echo'<td style="height:30px;text-align:center" title="Detalhes"><a href=detalhes_empresa.php?codigo_empresa=' . $codigo_empresa . '><button type="button" class="btn btn-xs btn-primary">VISUALIZAR</button></strong></a></td>';
                        echo'</tr>';
                    }                
                }else {?>
                    <div class='alert alert-warning text-center' role='alert'>Caso não encontre a <span style="color: #CC0000">Razão Social / Pessoa Física</span> clique no link ao lado para cadastrar! <a href="cad_empresa.php" target="_blank">Razão Social / Pessoa Física</a></div>
               <?php }
                ?>
            </table><br>
        </div>
    </div>
</div>
<?php
require './pages/footer.php';

