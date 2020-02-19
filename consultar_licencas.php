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
            $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_processo.codigo_processo,tb_processo.assunto FROM tb_licenca, tb_processo WHERE tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND assunto = 'AUTORIZACAO PARA CORTE DE ARVORE'";
            $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="AUTORIZAÇÃO PARA CORTE ÁRVORE"><strong>ACA<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_processo.codigo_processo,tb_processo.assunto FROM tb_licenca, tb_processo WHERE tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND assunto = 'AUTORIZACAO PARA PODA DE ARVORE'";
            $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="AUTORIZAÇÃO PARA PODA DE ÁRVORE"><strong>APA<br></strong><span class="badge">' . $sql_total . '</span></a>';

            $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_processo.codigo_processo,tb_processo.assunto FROM tb_licenca, tb_processo WHERE tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND assunto = 'AUTORIZACAO DE LIMPEZA DE AREA'";
            $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="AUTORIZAÇÃO DE LIMPEZA DE ÁREA"><strong>ALA<br></strong> <span class="badge">' . $sql_total . '</span></a>';


            $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_processo.codigo_processo,tb_processo.assunto FROM tb_licenca, tb_processo WHERE tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND assunto = 'AUTORIZACAO PARA SUPRESSAO DE VEGETACAO E LIMPEZA DE AREA'";
            $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="AUTORIZAÇÃO PARA SUPRESSÃO DE VEGETAÇÃO E LIMPEZA DE ÁREA"><strong>ASVLA<br></strong> <span class="badge">' . $sql_total . '</span></a>';


            $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_processo.codigo_processo,tb_processo.assunto FROM tb_licenca, tb_processo WHERE tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND assunto = 'LICENCA AMBIENTAL SIMPLIFICADA'";
            $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="LICENÇA AMBIENTAL SIMPLIFICADA"><strong>LAS<br></strong> <span class="badge">' . $sql_total . '</span></a>';


            $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_processo.codigo_processo,tb_processo.assunto FROM tb_licenca, tb_processo WHERE tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND assunto = 'LICENCA DE INSTALACAO'";
            $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="LICENÇA DE INSTALAÇÃO"><strong>LI<br></strong> <span class="badge">' . $sql_total . '</span></a>';


            $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_processo.codigo_processo,tb_processo.assunto FROM tb_licenca, tb_processo WHERE tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND assunto = 'LICENCA DE OPERACAO'";
            $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="LICENÇA DE OPERAÇÃO"><strong>LO<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_processo.codigo_processo,tb_processo.assunto FROM tb_licenca, tb_processo WHERE tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND assunto = 'LICENCA DE OPERACAO CORRETIVA'";
            $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="LICENÇA DE OPERAÇÃO CORRETIVA"><strong>LOC<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_processo.codigo_processo,tb_processo.assunto FROM tb_licenca, tb_processo WHERE tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND assunto = 'LICENCA DE PRÉVIA'";
            $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="LICENÇA DE PRÉVIA"><strong>LP<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_processo.codigo_processo,tb_processo.assunto FROM tb_licenca, tb_processo WHERE tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND assunto = 'RENOVACAO DE ALVARA VERDE'";
            $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="RENOVAÇÃO DE ALVARÁ VERDE"><strong>RAV<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_processo.codigo_processo,tb_processo.assunto FROM tb_licenca, tb_processo WHERE tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND assunto = 'RENOVACAO DE LICENCA DE INSTALACAO'";
            $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="RENOVAÇÃO DE LICEÇA DE INSTALAÇÃO"><strong>RLI<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_processo.codigo_processo,tb_processo.assunto FROM tb_licenca, tb_processo WHERE tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND assunto = 'RENOVACAO DE LICENCA DE OPERACAO'";
            $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="RENOVAÇÃO DE LICEÇA DE OPERAÇÃO"><strong>RLO<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_processo.codigo_processo,tb_processo.assunto FROM tb_licenca, tb_processo WHERE tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND assunto = 'RENOVACAO DE LICENCA PREVIA'";
            $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="RENOVAÇÃO DE LICEÇA PRÉVIA"><strong>RLP<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_invalidas = "SELECT *FROM  tb_licenca where data_validade < current_date()";
            $linhas_invalidas = mysqli_query($con, $sql_invalidas);
            $total_invalidas = mysqli_num_rows($linhas_invalidas);
            echo'<a href="consultar_licencas_invalidas.php" class="btn btn-warning" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"TITLE="LICENÇAS DE VENCIDAS"><strong>L VENCIDAS<br></strong> <span class="badge">' . $total_invalidas . '</span></a>';

            //ESSA PARTE DO CÓDIGO TEM  COMO PROPÓSITO CAPTURAR A QTD DEGAL DE EMPRESAS CADASTRADAS
            $sql_qtd_emp = "SELECT *FROM tb_licenca";
            $sql_qtd = mysqli_query($con, $sql_qtd_emp);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-success" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="TOTAL DE LICENCAS"><strong>T LICENÇAS<br></strong><span class="badge">' . $sql_total . '</span></a>';

            echo'<a href="inicio.php" class="btn btn-danger" style="font-size:14px; font-weight:bold;color:white;"title="CANCELAR"><strong>CANCELAR<br></strong><span class="glyphicon glyphicon-remove"></span></a><br><br>';
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
                <li><a href="consultar_processos.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR PROCESSO<span class="glyphicon glyphicon-list-alt" style="margin-left: 5px"></a></li>                
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
                <li><a href="consultar_nivelPoluidor.php" style="font-weight:bold; color:#2e6da4">NIVEL DE POLUIÇÃO DAS ATIVIDADES<span class="glyphicon glyphicon-fire" style="margin-left: 5px"></a></li>
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
            <input type="text" name="parametro_empresa" onKeypress="return letras(event)" class="form-control" placeholder="Razão Social / Pª Fisica" title="Digite Apenas Letras">
        </div>
        <div class="col-sm-2" style="">
            <input type="text" name="parametro_cnpj_cpf" onkeyup="somenteNumeros(this);" maxlength="18" class="form-control" placeholder="Cnpj / Cpf" title="Digite Apenas Números">
        </div>
        <div class="col-sm-2">
            <select name="parametro_assunto"  class="form-control" >
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
        <div class="col-sm-2">
            <select name="parametro_ano_licenca"  class="form-control" >
                <option value="">ANO DA LICENÇA</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>                                          
            </select>
        </div>
       
        <div class="col-sm-1" style="">
            <input type="text" name="parametro_numero" onkeyup="somenteNumeros(this);" maxlength="3" class="form-control"  placeholder="Nº LIC" title="Digite Apenas Números">
        </div>

        <div class="col-sm-1" style="">
            <input type="text" name="parametro_processo" onkeyup="somenteNumeros(this);" class="form-control" placeholder="Nº PROC" title="Digite Apenas Letras">
        </div>

        <div class="col-sm-1" style="">
            <input type="submit" value="BUSCAR" class="btn btn-primary" style="font-size: 15px; font-weight: bold;color: #fff;text-align: center">
        </div>
    </div><br>
</form>

<?php
$parametro_empresa = filter_input(INPUT_GET, "parametro_empresa");
$parametro_cnpj_cpf = filter_input(INPUT_GET, "parametro_cnpj_cpf");
$parametro_numero = filter_input(INPUT_GET, "parametro_numero");
$parametro_processo = filter_input(INPUT_GET, "parametro_processo");
$parametro_ano_licenca = filter_input(INPUT_GET, "parametro_ano_licenca");
$parametro_assunto = filter_input(INPUT_GET, "parametro_assunto");

$sql = "SELECT tb_licenca.codigo_licenca,tb_licenca.numero_licenca,tb_licenca.data_emissao,tb_licenca.data_validade,tb_licenca.taxa,tb_licenca.descricao_atividade,tb_licenca.ano_licenca,
            tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_empresa.cnpj_cpf,tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_empreendimento.nome_bairro,tb_empreendimento.nome_atividade,tb_processo.numero_processo,tb_processo.assunto,curdate(),datediff(data_validade,curdate()) quantidade_de_dias, (if(current_date()<= data_validade,'<strong>VALIDA</strong>','<strong style=color:#8B0000>INVALIDA<strong>')) AS situacao
            FROM 
            tb_licenca,tb_empresa,tb_empreendimento,tb_processo
            WHERE(razaosocial_pessoafisica LIKE '$parametro_empresa%'  AND cnpj_cpf LIKE '$parametro_cnpj_cpf%' AND numero_licenca LIKE '$parametro_numero%' AND numero_processo LIKE '$parametro_processo%'  AND ano_licenca LIKE '$parametro_ano_licenca%' AND assunto LIKE '$parametro_assunto%')AND 
            tb_licenca.fk4_codigo_empresa = tb_empresa.codigo_empresa AND tb_licenca.fk1_codigo_empreendimento = tb_empreendimento.codigo_empreendimento  AND tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo ORDER BY razaosocial_pessoafisica";
$recebe = mysqli_query($con, $sql);

if (mysqli_num_rows($recebe) > 0 AND $parametro_empresa OR $parametro_cnpj_cpf OR $parametro_numero OR $parametro_processo OR $parametro_ano_licenca OR $parametro_assunto) {
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
            echo'<strong>TOTAL DE LICENÇAS FILTRADAS </strong><span class="badge">' . $total . '</span></a><br>';
            ?>
            <div class = "table-overflow"><br>
                <table class="table table-striped table-hover table-bordered">
                    <header>
                        <tr  style="text-align: center;background-color:#dff0d8;color: #000000" >
                            <!--<th style="text-align: center;font-size: 12px"><strong>COD</strong></th>-->
                            <th style="text-align: center;font-size: 12px">RAZÃO SOCIAL / Pª FÍSICA</th> 

                            <th style="text-align: center;font-size: 12px">CNPJ / CPF</th> 
                            <th style="text-align: center;font-size: 12px">LICENÇA</th> 
                            <th style="text-align: center;font-size: 12px">Nº LIC</th> 
                            <th style="text-align: center;font-size: 12px">Nº PROC</th> 
                            <th style="text-align: center;font-size: 12px">ANO LICENÇA</th>
                            <th style="text-align: center;font-size: 12px">EMISSÃO</th> 
                            <th style="text-align: center;font-size: 12px">VALIDADE</th>  
                            <th style="text-align: center;font-size: 12px">TAXA</th>  
                            <th style="text-align: center;font-size: 12px;" >VENCE EM</th>            
                            <th style="text-align: center;font-size: 12px;" >SITUAÇÃO</th>            
                            <th style="width: 1%"><img  src="img/olho_1.png" title="Ver Mais Detalhes" style="margin-left:25px"></th> 
                        </tr>
                    </header>

                    <?php
                    while ($linhas = mysqli_fetch_array($recebe)) {
                        $codigo_licenca = $linhas['codigo_licenca']; //variavel pararecupar o id do empreendimento
                        echo'<tr style="font-size:13px">';
                        echo'<td style="font-size:12px">' . $linhas['razaosocial_pessoafisica'] . '</td>';
                        echo'<td style="font-size:12px;">' . $linhas['cnpj_cpf'] . '</td>';
                        echo'<td style="font-size:12px;">' . $linhas['assunto'] . '</td>';
                        echo'<td style="font-size:12px">' . $linhas['numero_licenca'] . '</td>';
                        echo'<td style="font-size:12px;">' . $linhas['numero_processo'] . '</td>';
                        echo'<td style="font-size:12px;">' . $linhas['ano_licenca'] . '</td>';
                        echo'<td style="font-size:12px;">' . date('d/m/Y', strtotime($linhas['data_emissao'])) . '</td>';
                        echo'<td style="font-size:12px">' . date('d/m/Y', strtotime($linhas['data_validade'])) . '</td>';
                        echo'<td style="font-size:12px;text-align:center;background-color:#A9A9A9;color:#FFF">' . $linhas['taxa'] . '</td>';
                        echo'<td style="font-size:12px;text-align:center;color:#FFF;background-color:#FF8C00">' . $linhas['quantidade_de_dias'] . ' DIAS </td>';
                        echo'<td style="font-size:12px;text-align:center;color:#FFF;background-color:#008000">' . $linhas['situacao'] . '</td>';
                        echo'<td style="height:30px;text-align:center;background-color:	#4682B4;color:#FFF" title="Detalhes"><a href=detalhes_licenca.php?codigo_licenca=' . $codigo_licenca . '><strong style="color:#FFF">VISUALIZAR</strong></a></td>';
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
