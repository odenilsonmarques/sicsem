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

<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui.min.css">
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<link rel="stylesheet" href="css/estilo_alteraAtividade.css"/>
<script type='text/javascript' >
    $(function () {
        $("#descricao_atividade").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "auto_complete_ativ.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $('#descricao_atividade').val(ui.item.label); // display the selected text
                $('#selectuser_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        jQuery.validator.addMethod("isString", function (value, element) {
            var regExp = /[0-9]/;
            if (regExp.test(value))
                return false;

            return true;
        },
                "Por Favor! Insira Somente Letras");

        //Na linha abaixo, quando o form for submetido ele faz o validate 
        $('#frmatividade').validate({
            //na linha abaixo sao criada as regras de validacao
            rules: {
                potencial_poluidor: {
                    required: true
                },
                empresa: {
                    required: true
                },
                descricao_atividade: {
                    required: true,
                    minlength: 15

                }
            },
            //na  linha abaixo sao criada as mensagem que serao vista pelo usuarios
            messages: {
                potencial_poluidor: {
                    required: "Campo Obrigatório*"
                },
                empresa: {
                    required: "Campo Obrigatório*"
                },
                descricao_atividade: {
                    required: "Campo Obrigatório*",
                    minlength: "Atividade Inválida!"
                }
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#empresa').change(function () {
            $('#empreendimento').load('exibe_empreendimentos.php?empresa=' + $('#empresa').val());
        });
    });
</script>

<script type='text/javascript' >
    $(function () {
        $("#nome_atividade").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "auto_complete_licenca.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $('#nome_atividade').val(ui.item.label); // display the selected text
                $('#selectuser_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });
</script>

<div class="row">  
    <div class="col-sm-6">
        <h3><strong>CADASTRO DE ATIVIDADE PARA EMPRENDIMENTO</strong></h3>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3" style="text-align:right;">  
        <button class="btn btn-danger"><a href="cadastros.php" style="text-decoration: none;font-size: 14px;color:#fff"><strong>CANCELAR</strong><span class="glyphicon glyphicon-remove" style="margin-left: 5px;"></span></a></button>
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">-------  <strong>IR PARA</strong> -------
            <span class="caret"></span></button>
        <ul class="dropdown-menu">     
            <li><a href="cadastros.php" style="font-weight:bold; color:#006600; text-decoration:none;margin-right: 20px">CADASTRO<span class="glyphicon glyphicon-plus" style="margin-left: 5px"></a></li>
            <li><a href="cad_empresa.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR RAZÃO SOCIAL / PESSOA FÍSICA<span class="glyphicon glyphicon-home" style="margin-left: 5px"></a></li>
            <li><a href="cad_empreendimento.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR EMPREENDIMENTO / ATIVIDADE<span class="glyphicon glyphicon-stats" style="margin-left: 5px"></a></li>         
            <li><a href="cad_processo.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR PROCESSO<span class="glyphicon glyphicon-list-alt" style="margin-left: 5px"></a></li>
            <li><a href="cad_licenca.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR LICENÇA<span class="glyphicon glyphicon-duplicate" style="margin-left: 5px"></a></li>
           <li><a href="cad_notificacao.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR NOTIFICAÇÃO<span class="glyphicon  glyphicon-bell" style="margin-left: 5px"></a></li>
            <li><a href="cad_infracao.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR AUTO DE INFRAÇÃO<span class="glyphicon  glyphicon-alert" style="margin-left: 5px"></a></li>
            <li><a href="inicio.php" style="font-weight:bold; color:#0A246A; text-decoration:none;margin-right: 15px">CONSULTA<span class="glyphicon glyphicon-search" style="margin-left: 5px"></a></li>
            <li><a href="consultar_empresas.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR RAZÃO SOCIAL / PESSOA FÍSICA<span class="glyphicon glyphicon-home" style="margin-left: 5px"></a></li>
            <li><a href="#" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR EMPREENDIMENTO / ATIVIDADE<span class="glyphicon glyphicon-stats" style="margin-left: 5px"></a></li>
            <li><a href="consultar_atividades.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR ATIVIDADE PARA UM EMPREENDIMENTO<span class="glyphicon glyphicon-briefcase" style="margin-left: 5px"></a></li>
            <li><a href="consultar_processos.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR PROCESSO<span class="glyphicon glyphicon-list-alt" style="margin-left: 5px"></a></li>
            <li><a href="consultar_licencas.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR LICENÇA<span class="glyphicon glyphicon-duplicate" style="margin-left: 5px"></a></li>
            <li><a href="consultar_notificacoes.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR NOTIFICAÇÃO<span class="glyphicon glyphicon-bell" style="margin-left: 5px"></a></li>
            <li><a href="#" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR AUTO DE INFRAÇÕES<span class="glyphicon glyphicon-alert" style="margin-left: 5px"></a></li>
            <li>
                <?php if ($_SESSION['nivel_acesso'] == "4" || $_SESSION['nivel_acesso'] == "5" || $_SESSION['nivel_acesso'] == "6")  {
                    ?>  
                    <a href="editar.php" style="color:#2e6da4">
                        <strong>REALIZAR EDICÃO<span class="glyphicon glyphicon-pencil" style="margin-left: 10px"></strong></a>
                    <?php
                } else {
                    ?>                        
                    <a href="#myModal" data-toggle="modal" style="color:#2e6da4" >
                        <strong>REALIZAR EDICÃO<span class="glyphicon glyphicon-pencil" style="margin-left: 10px"></strong></a><?php }
                ?>                  
            </li>
            <li><a href="cadastros.php" style="font-weight:bold; color: #ce8483">CANCELAR<span class="glyphicon glyphicon-remove" style="margin-left: 5px"></a></li>
            <li><a href="logout.php" style="font-weight:bold; color: #ce8483">SAIR DO SISTEMA<span class="glyphicon glyphicon-off" style="margin-left: 5px"></a></li>
        </ul>
    </div>
</div>
<div class="panel-group">
    <form  action="recebe_cad_atividade1.php"  method="POST" name="frmatividade" id="frmatividade">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DA ATIVIDADE - <span style="color: #d58512">Atenção Todos os Campos Com Asteriscos(*) São Obrigatórios</span></strong></a>
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="empresa"><strong>RAZÃO SOCIAL / PESSOA FÍSICA *</strong></label><br/>
                                        <select  name="empresa" id="empresa" class="form-control">
                                            <option value="">SELECIONE</option><br>
                                            <?php
                                            $empresa = "SELECT codigo_empresa, razaosocial_pessoafisica FROM tb_empresa ORDER BY codigo_empresa DESC";
                                            $recebe_empresas = mysqli_query($con, $empresa);
                                            while ($linha = mysqli_fetch_array($recebe_empresas)) {
                                                echo '<option value="' . $linha['codigo_empresa'] . '">' . $linha['razaosocial_pessoafisica'] . '</option>';
                                                echo '<option></option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!----------------------------------------------------------------------------------------------------------------------->                            
                            <div class="row">
                                <div class="col-sm-12" id="EMPREATIV">
                                    <div class="form-group">
                                        <label for="empreendimento"><strong>EMPREENDIMENTO *</strong></label><br/>
                                        <select name="empreendimento" id="empreendimento" class="form-control">                            
                                            <option value="" selected="">SELECIONE</option> 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12" id="ATIV">
                                    <div class="form-group">
                                       <label for="nome_atividade"><strong>ATIVIDADE A SER LICENCIADA *</strong></label><br>
                                        <input type="text" name="nome_atividade" id="nome_atividade" class="form-control" autocomplete="of"/>
                                    </div>
                                </div>
                            </div>                        
                            <!------------------------------------------------------------------------------------------------------------------------>
                            <div class="row">
                                <div class="col-sm-12">                                    
                                    <div class="form-group">
                                        <label for="potencial_poluidor"><strong>POTENCIAL POLUIDOR DA ATIVIDADE *</strong></label><br/>
                                        <select name="potencial_poluidor" id="potencial_poluidor" class="form-control" />                                                                            l">
                                        <option value="">SELECIONE</option>
                                        <option value="INSIGNIFICANTE">INSIGNIFICANTE</option>
                                        <option value="BAIXO">BAIXO</option>
                                        <option value="MEDIO">MÉDIO</option>
                                        <option value="ALTO">ALTO</option>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-title" style="text-align: center;"><br/>
                        <button type="submit" class="btn btn-success" style="font-size: 17px; font-weight: bold;"><span>REALIZAR CADASTRO<span class = "glyphicon glyphicon-saved" style = "margin-left: 10px;" > </span></button>
                        <button  class="btn btn-danger"><strong><a href = "cadastros.php"style = "text-decoration: none;color:#FFF"> CANCELAR CADASTRO <span class = "glyphicon glyphicon-remove" style = "margin-left: 10px;" ></span></a></strong></button><br/><br/>
                    </div>   
                </div>
            </dIv>
        </div>
    </form>
</div>
</body>
</html>

