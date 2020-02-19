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
/*controle de sessão*/
if(!isset($_SESSION['controle_de_abas'])){
    $_SESSION['controle_de_abas'] = 0;
}
?>
<!--TODOS OS SCRIPTS ABAIX0 SERVEM PARA VALIDAÇÃO DAS PÁGINAS DE PROCESSO E LICENCAS.CRIAR UM REPOSITÓRIO SOMENTE PARA ESSES SCRIPT, QUE POR ENQUANTO IRÃO PERMANENCER POR AQUI -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<link rel="stylesheet" href="css/estilo_cadProcessoLicenca.css">


<!--OS DADOS ABAIXO SÃO REFERENTES AO CADASTRO DE PROCESSO-->
<script type="text/javascript">
    function comparaDataAnoProcesso() {
        var ano = document.getElementById("ano").value;
        var data_processo = document.getElementById("data_processo").value;
        var data = data_processo.substr(0, 4); // pega só o ano
        if (ano !== data) {
            alert("ERRO! O ANO DA DATA INFORMADA, ESTÁ DIFERENTE DO ANO INFORMADO");
            ano = document.getElementById("ano").value = '';
            data_processo = document.getElementById("data_processo").value = '';
        } 
    }
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
        $('#frmprocesso').validate({
            //na linha abaixo sao criada as regras de validacao
            rules: {
                numero_processo: {
                    required: true,
                    maxlength: 3
                },
                ano: {
                    required: true
                },
                data_processo: {
                    required: true
                },
                empresa: {
                    required: true
                },
                empreendimento: {
                    required: true
                },                              
                assunto: {
                    required: true
                }
            },
            //na  linha abaixo sao criada as mensagem que serao vista pelo usuarios
            messages: {
                numero_processo: {
                    required: "Campo Obrigatório*",
                    maxlength: "Erro! Informe no Máximo 3 Digitos!"
                },
                ano: {
                    required: "Campo Obrigatório*"
                },
                data_processo: {
                    required: "Campo Obrigatório*"
                },
                empresa: {
                    required: "Campo Obrigatório*",
                    minlength: "Nome Inválido!"
                },
                empreendimento: {
                    required: "Campo Obrigatório, Caso Não Apareça, Selecione a Empresa Novamente *"                   
                },              
                assunto: {
                    required: "Campo Obrigatório*"
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
<!--OS DADOS ACIMA SÃO REFERENTES AO CADASTRO DE PROCESSO-->

<div class="row">   
    <div class="col-sm-6">
        <h3><strong>CADASTRO DE NOTIFICAÇÕES</strong></h3>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3">
        <div class="nav">          
            <ul class="nav navbar-nav navbar-right" style="font-size: 14px;border-radius:5px;margin-right: 3px" >
                <li class="dropdown">
                    <a href=""  data-toggle="dropdown" class="btn btn-default">Ir Para <span class="caret"></span></a>
                    <ul class="dropdown-menu ">
                        <li><a href="cad_empresa.php"><strong><img src="img/man-with-company.png"> CADASTRO RAZÃO SOCIAL E / OU Pª FÍSICA</strong></a></li>
                        <li><a href="#"><strong><img src="img/user_2.png"> CADASTRO REPRESENTANTE</strong></a></li>
                        <li><a href="#"><strong><img src="img/contract.png"> CADASTRO PROCESSO</strong></a></li>
                        <li><a href="#"><strong><img src="img/construction-worker_1.png"> CADASTRO EMPREENDIMENTO</strong></a></li>
                        <li><a href="#"><strong><img src="img/notifications-button_1.png">CADASTRO NOTIFICAÇÃO</strong></a></li>
                        <li><a href="#"><strong><img src="img/police-shield-with-a-star-symbol (2).png"> CADASTRO AUTORIZAÇÃO</strong></a></li>
                        <li><a href="#"style="color: #2e6da4"><strong><img src="img/office-block.png"> CONSULTAR RAZÃO SOCIAL E / OU Pª FÍSICA</strong></a></li>
                        <li><a href="#" style="color: #2e6da4"><strong><img src="img/icon.png"> CONSULTAR REPRESENTANTES</strong></a></li>
                        <li><a href="#" style="color: #2e6da4"><strong><img src="img/notebook_1.png"> CONSULTAR PROCESSOS</strong></a></li>
                        <li><a href="#" style="color: #2e6da4"><strong><img src="img/miner.png"> CONSULTAR EMPREENDIMENTOS</strong></a></li>
                        <li><a href="#" style="color: #2e6da4"><strong><img src="img/document_3.png"> CONSULTAR LICENÇAS</strong></a></li>
                        <li><a href="#" style="color: #2e6da4"><strong><img src="img/notification_1.png"> CONSULTAR NOTIFICAÇÕES</strong></a></li>
                        <li><a href="#" style="color: #2e6da4"><strong><img src="img/police-shield-with-a-star-symbol (1).png"> CONSULTAR AUTORIZAÇÃO</strong></a></li>
                        <li><a href="cadastros.php" style="color: #ce8483"><strong><img src="img/error.png"> CANCELAR</strong></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="panel-group">
    <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li <?php if($_SESSION['controle_de_abas'] == 0){echo "class='active'";} ?>>
                    <a href="#form_processo" data-toggle="tab">PROCESSO</a>
                </li>  
                
                <li <?php if($_SESSION['controle_de_abas'] == 1){echo "class='active'";} ?>>
                    <?php if(isset($_SESSION['ultimo_processo'])){
                    ?><a href="#form_notificacao" data-toggle="tab">NOTIFICAÇÃO</a><?php
                    }else{
                        ?><a href="#" data-toggle="tab">NOTIFICAÇÃO</a><?php
                    }?>
                </li>    
                
                    <?php if($_SESSION['controle_de_abas']== 2){?>
                <li class="active">
                        <a href="#sucesso" data-toggle="tab">CADASTRO FINALIZADO</a>
                </li>        
                    <?php }?>                    
            </ul><br>
        
            <div class="tab-content">               
                <div  id="form_processo" 
                    <?php if($_SESSION['controle_de_abas'] == 0){echo "class='tab-pane active in fade'";} 
                    else {
                       echo "class='tab-pane in fade'";
                    } ?>>
                    <form  action="recebe_cad_processo.php"  method="POST" name="frmprocesso" id="frmprocesso">
                        <div class="panel panel-success">
                            <div class="panel-heading">                                
                                <div class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DO PROCESSO --- <span style="color: #d58512">Atenção Todos os Campos Com Asteriscos(*) São Obrigatórios</span></strong></a>
                                </div>
                            </div>
                            <div  class="panel-collapse ">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">                                                
                                                <label for="empresa"><strong>RAZÃO SOCIAL / Pª FÍSICA *</strong></label><a href="cad_empresa.php">Caso não encontre, clique aqui para realizar o cadastro</a><br/>
                                                <select name="empresa" id="empresa" class="form-control" autofocus="">                                                                                            
                                                    <option value="">SELECIONE</option>                                                       
                                                        <?php                                          
                                                        $empresa = "SELECT codigo_empresa, razaosocial_pessoafisica FROM tb_empresa ORDER BY codigo_empresa DESC";
                                                        $recebe_empresas = mysqli_query($con, $empresa);
                                                        while ($linha = mysqli_fetch_array($recebe_empresas)) {
                                                        echo '<option value="' . $linha['codigo_empresa'] . '">' . $linha['razaosocial_pessoafisica'] . '</option>';
                                                        }
                                                        ?>                                                                                                                    
                                                </select>
                                            </div>
                                            <div class="form-group">                   
                                                <label for="empreendimento"><strong>EMPREENDIMENTO*</strong></label><button type="button" data-toggle="modal" data-target="#myModalcad" class="btn btn-link">Caso não encontre, clique aqui para realizar o cadastro</button>                                    
                                                    <select name="empreendimento" id="empreendimento" class="form-control" autofocus="" >                                                                                                      
                                                        <option value="" selected="selected">SELECIONE</option>                                       
                                                    </select>
                                            </div>                                                              
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">                                      
                                            <div class="form-group">
                                                <label for="assunto"><strong>ASSUNTO *</strong></label><br/>
                                                <select name="assunto" id="assunto" class="form-control">
                                                    <option value="">SELECIONE</option>                                            
                                    
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
                                        </div>
                                    </div> 
                                    <div class="row">                          
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="numero_processo"><strong>NÚMERO DO PROCESSO *</strong></label><br/>
                                                <input type="text" name="numero_processo" id="numero_processo" onkeyup="somenteNumeros(this);" maxlength="3" class="form-control" placeholder="Campo Obrigatório"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="ano"><strong>ANO *</strong></label><br/>
                                                <select name="ano" id="ano" class="form-control">
                                                    <option value="">SELECIONE</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                </select>                              
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="data_processo">DATA *</label>
                                                <input type="date" name="data_processo" id="data_processo" class="form-control" onblur="comparaDataAnoProcesso()"  />
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="situacao_processo">SITUAÇÃO</label>
                                                <input type="text" name="situacao_processo" id="situacao_processo" value="ABERTO" readonly="" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="motivo_situacao">MOTIVO DA SITUAÇÃO</label>
                                                <input type="text" name="motivo_situacao" id="motivo_situacao" value="A DEFINIR" readonly="" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-title" style="text-align: center;"><br/>
                                <button type="submit" class="btn btn-success" style="font-size: 17px; font-weight: bold;">REALIZAR CADASTRO <span class="glyphicon glyphicon-saved" style="margin-left: 10px;"></span></button>
                                <button  class="btn btn-danger"><a href="cadastros.php"style="text-decoration: none;color:#FFF">CANCELAR CADASTRO<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a></button><br/><br/>
                            </div>   
                        </div>
                    </form>
                </div>
                <div id="form_notificacao" 
                     <?php if($_SESSION['controle_de_abas'] == 2){echo "class='tab-pane active in fade'";} 
                    else {
                       echo "class='tab-pane in fade'";
                    } ?>>
               
                    <form  action="recebe_cad_notificacao.php"  method="POST" name="frmnotificacao" id="frmnotificacao">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DA NOTIFICAÇÃO</strong></a>
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">                
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="empresa"><strong>RAZÃO SOCIAL / PESSOA FÍSICA kkkkkk *</strong></label>
                                        <a href="cad_empresa.php" style="float: right;font-size: 16px" target="_blanck"><strong>caso não encontre,faça o cadastro - aqui</strong></a><br/>
                                        <select name="empresa" id="empresa" class="form-control">
                                            <option value="">SELEIONE</option>
                                            <?php
                                            $parametro_empresa = filter_input(INPUT_GET, "parametro_empresa");
                                            $empresa = "SELECT *FROM tb_empresa WHERE razaosocial_pessoafisica LIKE '%$parametro_empresa%' ORDER BY razaosocial_pessoafisica";
                                            $recebe_empresas = mysqli_query($con, $empresa);
                                            while ($linha = mysqli_fetch_array($recebe_empresas)) {
                                                echo '<option value="' . $linha['codigo_empresa'] . '">' . $linha['razaosocial_pessoafisica'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group"  >
                                        <label for="processo"><strong>PROCESSO *</strong></label><br/>
                                        <select  name="processo" id="processo" class="form-control">
                                            <option>SELECIONE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="numero_notificacao"><strong>Nº NOTIFICAÇÃO *</strong></label><br/>
                                        <input type=number name="numero_notificacao" id="numero_notificacao"  class="form-control" autofocus  />
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="ano"><strong>ANO *</strong></label><br/>
                                        <select name="ano" id="ano" class="form-control">
                                            <option value="">SELECIONE</option>                                          
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                        </select>  
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="data_hora_notificacao"><strong>DATA E HORA DA NOTIFICAÇÃO *</strong></label><br/>
                                        <input type="datetime-local" name="data_hora_notificacao" id="data_hora_notificacao" class="form-control" onblur="comparaAnoData()"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="data_hora_comparecimento"><strong>DATA E HORA PARA COMPARECIMENTO *</strong></label><br/>
                                        <input type="datetime-local" name="data_hora_comparecimento" id="data_hora_comparecimento" class="form-control" onblur="comparadatas()"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="profissao_atividade"><strong>PROFISSÃO E / OU  ATIVIDADE REALIZADA *</strong></label><br/>
                                        <input type="text" name="profissao_atividade" id="profissao_atividade" class="form-control" autofocus  />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="descricao_prazo"><strong>DESCRICÃO E PRAZO *</strong></label><br/>
                                        <input type="text" name="descricao_prazo" id="descricao_prazo" class="form-control" autofocus/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="status">SITUAÇÃO</label>
                                        <input type="text" name="status" id="status" value="NOTIFICADO" readonly="" class="form-control" autofocus=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" ><strong>INFORMAÇÕES ADICIONAIS (NOTIFICAÇÃO / PROCESSO / LICENÇA)</strong></a>
                        </div>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="status_informacoes_adicionais"><strong>A INFORMAÇÕES ADICIONAIS ? *</strong></label><br/>
                                        <select name="status_informacoes_adicionais" id="status_informacoes_adicionais" class="form-control" onchange="mostrardivinformacoes(this.value)">
                                            <option value="">SELECIONE</option>
                                            <option value="SIM">SIM</option>
                                            <option value="NAO">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>                        
                            <div class="row">
                                <div class="col-sm-3" id="NUMNOTANTERIOR">
                                    <div class="form-group">
                                        <label for="numero_notificacao_anterior"><strong>NÚMERO DA NOTICAÇÃO ANTERIOR</strong></label><br/>
                                        <input type="number" name="numero_notificacao_anterior" id="numero_notificacao_anterior" maxlength="3" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="NUMANOANTERIOR">
                                    <div class="form-group">
                                        <label for="numero_notificacao_ano_anterior"><strong>ANO DA NOTIFICAÇÃO ANTERIOR</strong></label><br/>
                                        <input type="number" name="numero_notificacao_ano_anterior" id="numero_notificacao_ano_anterior" maxlength="4" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="NUMPROANTERIOR">
                                    <div class="form-group">
                                        <label for="numero_processo_notificacao_anterior"><strong>NÚMERO DO PROCESSO ANTERIOR</strong></label><br/>
                                        <input type="number" name="numero_processo_notificacao_anterior" id="numero_processo_notificacao_anterior" maxlength="3" class="form-control" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="NUMANOPROANTERIOR">
                                    <div class="form-group">
                                        <label for="ano_processo_notificacao_anterior"><strong>ANO DO PROCESSO ANTERIOR</strong></label><br/>
                                        <input type="number" name="ano_processo_notificacao_anterior" id="ano_processo_notificacao_anterior"  maxlength="4"  class="form-control" placeholder=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" id="LICENCAANTERIOR">
                                    <div class="form-group">
                                        <label for="status_licenca"><strong>A LICENCA AMBIENTAL</strong></label><br/>
                                        <select name="status_licenca" id="status_licenca" class="form-control" onchange="mostrardivlicencas(this.value)">
                                            <option value="">SELECIONE</option>
                                            <option value="SIM">SIM</option>
                                            <option value="NAO">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3" id="NUMLICENCA">
                                    <div class="form-group" >
                                        <label for="numero_licenca_notificacao_anterior"><strong>NÚMERO DA LICENÇA</strong></label><br/>
                                        <input type="number" name="numero_licenca_notificacao_anterior" id="numero_licenca_notificacao_anterior" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-3" id="NUMANOLICENCA">
                                    <div class="form-group" >
                                        <label for="ano_licenca_notificacao_anterior"><strong>ANO DA LICENÇA</strong></label><br/>
                                        <input type="number" name="ano_licenca_notificacao_anterior" id="ano_licenca_notificacao_anterior" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-3" id="ORGAOEMISSOR">
                                    <div class="form-group" >
                                        <label for="orgao_emissor_licenca"><strong>ORGÃO EMITENTE DA LICENÇA</strong></label><br/>
                                        <input type="text" name="orgao_emissor_licenca" id="orgao_emissor_licenca" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-3" id="DATAVALIDADE">
                                    <div class="form-group" >
                                        <label for="data_validade"><strong>DATA VALIDADE</strong></label><br/>
                                        <input type="date" name="data_validade" id="data_validade" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><strong>DADOS DO RESPONSÁVEL E / OU NOTIFICADO</strong></a>
                        </div>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="status_notificado"><strong>O NOTIFICADO INFORMOU SEU DADOS ? *</strong></label><br/>
                                        <select name="status_notificado" id="status_notificado" class="form-control" onchange="mostrardivnotificados(this.value)">
                                            <option value="">SELECIONE</option>
                                            <option value="SIM">SIM</option>
                                            <option value="NAO">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8" id="NOMENOTIFICADO">
                                    <div class="form-group">
                                        <label for="nome_notificado"><strong>NOME DO NOTIFICADO E / OU REPONSÁVEL</strong></label><br/>
                                        <input type="text" name="nome_notificado" id="nome_notificado" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-4" id="CPFNOTIFICADO">
                                    <div class="form-group">
                                        <label for="cpf"><strong>CPF</strong></label><br/>
                                        <input type="text" name="cpf" id="cpf" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6" id="LOGRADOURONOTIFICADO">
                                    <div class="form-group">
                                        <label for="logradouro"><strong>RUA</strong></label><br/>
                                        <input type="text" name="logradouro" id="logradouro" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-2" id="NUMERONOTIFICADO">
                                    <div class="form-group">
                                        <label for="numero"><strong>NÚMERO</strong></label><br/>
                                        <input type="text" name="numero" id="numero" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-4" id=BAIRRONOTIFICADO>
                                    <div class="form-group">
                                        <label for="bairro"><strong>BAIRRO</strong></label><br/>
                                        <input type="text" name="bairro" id="bairro" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" id="TESTEMUNHANOTIFICADO">
                                    <div class="form-group">
                                        <label for="testemunha"><strong>NOME DA TESTEMUNHA</strong></label><br/>
                                        <input type="text" name="testemunha" id="testemunha" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><strong>DADOS DO FISCAL E CHEFE DE FISCALIZAÇÃO</strong></a>
                        </div>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="fiscal"><strong>FISCAL *</strong></label><br/>
                                        <select name="fiscal" id="fiscal" class="form-control">
                                            <option value="">SELECIONE O FISCAL</option>
                                            <?php
                                            $fiscal = "SELECT *FROM tb_fiscal";
                                            $recebe_fiscal = mysqli_query($con, $fiscal);
                                            while ($linha = mysqli_fetch_array($recebe_fiscal)) {
                                                echo '<option value="' . $linha['codigo_fiscal'] . '">' . $linha['nome_matricula_fiscal'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="chefe"><strong>CHEFE DE FISCALIZAÇÃO *</strong></label><br/>
                                        <select name="chefe" id="chefe" class="form-control">
                                            <option value="">SELECIONE O CHEFE DE FISCALIZAÇÃO</option>
                                            <?php
                                            $chefe_fiscalizacao = "SELECT *FROM tb_chefe_fiscalizacao";
                                            $recebe_chefe_fiscalizacao = mysqli_query($con, $chefe_fiscalizacao);
                                            while ($linha = mysqli_fetch_array($recebe_chefe_fiscalizacao)) {
                                                echo '<option value="' . $linha['codigo_chefe_fiscalizacao'] . '">' . $linha['nome_matricula_chefe'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-title" style="text-align: center;"><br/>
                        <input type="submit" value="REALIZAR CADASTRO" class="btn btn-success" style="font-size: 17px; font-weight: bold">
                        <button  class="btn btn-danger"><a href="home.php"  style="font-size: 17px; font-weight: bold; color: #fff;text-decoration: none;">CANCELAR CADASTRO</a></button><br/><br/>
                    </div>   
                </div>
            </dIv>
        </div>
    </form>
                
            </div>
        </div>
    </div>
</div>
               
           
