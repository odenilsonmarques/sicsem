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

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>

<script type="text/javascript">
    function comparaDataAno() {
        var ano_licenca = document.getElementById("ano_licenca").value;
        var data_emissao = document.getElementById("data_emissao").value;
        var data = data_emissao.substr(0, 4); // pega só o ano
        if (ano_licenca !== data) {
            ano_licenca = document.getElementById("ano_licenca").value = '';
            data_emissao = document.getElementById("data_emissao").value = '';
            alert("ERRO! O ANO DA LICENÇA INFORMADO, NÃO ESTÁ COM O MESMO ANO DA DATA DE EMISSÃO");
        }
    }
</script>

<script type="text/javascript">
    function comparaDatas()
    {
        var data_emissao = document.getElementById("data_emissao");
        var data_validade = document.getElementById("data_validade");

        if (data_emissao.value >= data_validade.value) {
            alert("ERRO! A DATA DE EMISSÃO NÃO PODE SER MAIOR OU IGUAL A DATA DE VALIDADE");
            data_emissao = document.getElementById('data_emissao').value = '';
            data_validade = document.getElementById('data_validade').value = '';
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#empresa').change(function () {
            $('#processo').load('exibe_processos.php?empresa=' + $('#empresa').val());
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
        $('#frmlicenca').validate({
            //na linha abaixo sao criada as regras de validacao
            rules: {
                numero_licenca: {
                    required: true,
                    maxlength: 3
                },
                ano_licenca: {
                    required: true
                },
                data_emissao: {
                    required: true
                },
                data_validade: {
                    required: true
                },
                licenca: {
                    required: true
                },
                atividade_realizada: {
                    required: true,
                    minlength: 10,
                    isString: true
                },
                empresa: {
                    required: true
                },
                empreendimento: {
                    required: true
                },
                processo: {
                    required: true
                }
            },
            //na  linha abaixo sao criada as mensagem que serao vista pelo usuarios
            messages: {
                numero_licenca: {
                    required: "Campo Obrigatório*",
                    maxlength: "Erro! Informe no Máximo 3 Digitos!"
                },
                ano_licenca: {
                    required: "Campo Obrigatório*"
                },
                data_emissao: {
                    required: "Campo Obrigatório*"

                },
                data_validade: {
                    required: "Campo Obrigatório*"
                },
                licenca: {
                    required: "Campo Obrigatório*"
                },
                atividade_realizada: {
                    required: "Campo Obrigatório*",
                    minlength: "Atividade Inválida, Informe Mais Detalhes Para Que o Cadastro Possa Ser Realizado!"
                },
                empresa: {
                    required: "Campo Obrigatório*"
                },
                empreendimento: {
                    required: "Campo Obrigatório*"
                },
                processo: {
                    required: "Campo Obrigatório*"
                }
            }
        });
    });
</script>

<div class="row">   
    <div class="col-sm-12 text-center">
        <div class="alert alert-warning"><!---Alert-->
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><strong>&times;</strong></a>
            <p class="text-center"><strong>ATENÇÃO: TODOS OS CAMPOS COM ASTERISCOS (*) SÃO OBRIGATÓRIOS</strong></p>
        </div>
    </div>
    <div class="col-sm-6">
        <h3><strong>CADASTRO LICENÇA</strong></h3>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3">     
        <div class="nav">
            <ul class="nav navbar-nav navbar-right" style="font-size: 14px;border-radius:5px;margin-right: 3px" >
                <li class="dropdown">
                    <a href=""  data-toggle="dropdown" class="btn btn-default">Ir Para <span class="caret"></span></a>
                    <ul class="dropdown-menu ">
                        <li><a href="cad_empresa.php"><strong><img src="img/man-with-company.png"> CADASTRO RAZÃO SOCIAL E / OU Pª FÍSICA</strong></a></li>
                        <li><a href="cad_representante.php"><strong><img src="img/user_2.png"> CADASTRO REPRESENTANTE</strong></a></li>
                        <li><a href="cad_processo.php"><strong><img src="img/contract.png"> CADASTRO PROCESSO</strong></a></li>
                        <li><a href="cad_empreendimento.php"><strong><img src="img/construction-worker_1.png"> CADASTRO EMPREENDIMENTO</strong></a></li>
                        <li><a href="cad_notificacao.php"><strong><img src="img/notifications-button_1.png">CADASTRO NOTIFICAÇÃO</strong></a></li>
                        <li><a href="cad_autorizacao.php"><strong><img src="img/police-shield-with-a-star-symbol (2).png"> CADASTRO AUTORIZAÇÃO</strong></a></li>
                        <li><a href="consultar_empresas.php"style="color: #2e6da4"><strong><img src="img/office-block.png"> CONSULTAR RAZÃO SOCIAL E / OU Pª FÍSICA</strong></a></li>
                        <li><a href="consultar_representante.php" style="color: #2e6da4"><strong><img src="img/icon.png"> CONSULTAR REPRESENTANTES</strong></a></li>
                        <li><a href="consultar_processo.php" style="color: #2e6da4"><strong><img src="img/notebook_1.png"> CONSULTAR PROCESSOS</strong></a></li>
                        <li><a href="consultar_empreendimento.php" style="color: #2e6da4"><strong><img src="img/miner.png"> CONSULTAR EMPREENDIMENTOS</strong></a></li>
                        <li><a href="consultar_licencas.php" style="color: #2e6da4"><strong><img src="img/document_3.png"> CONSULTAR LICENÇAS</strong></a></li>
                        <li><a href="consultar_notificacoes.php" style="color: #2e6da4"><strong><img src="img/notification_1.png"> CONSULTAR NOTIFICAÇÕES</strong></a></li>
                        <li><a href="consultar_autorizacoes.php" style="color: #2e6da4"><strong><img src="img/police-shield-with-a-star-symbol (1).png"> CONSULTAR AUTORIZAÇÃO</strong></a></li>
                        <li><a href="home.php" style="color: #ce8483"><strong><img src="img/error.png"> CANCELAR</strong></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="panel-group">
    <form  action="recebe_cad_licenca.php"  method="POST" name="frmlicenca" id="frmlicenca">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DA LICENÇA</strong></a>
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <!--<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Exibir / Ocultar</button>-->
                                    <div class="alert alert-warning"><!---Alert-->
                                        <!--<a href="#" class="close" data-dismiss="alert" aria-label="close"><strong>&times;</strong></a>-->
                                        <p><a href="consultar_licencas.php"><strong>ANTES DE REALIZAR O CADASTRO, VERIFIQUE SE A LICENÇA JÁ ESTÁ CADASTRADA - CLICANDO AQUI</strong></a></hP>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="numero_licenca"><strong>NÚMERO DA LICENÇA *</strong></label><br/>
                                        <input type="number" name="numero_licenca" id="numero_licenca" class="form-control"  autofocus="" />
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="ano_licenca"><strong>ANO DA LICENÇA *</strong></label><br/>
                                        <select name="ano_licenca" id="ano_licenca" class="form-control">
                                            <option value="">SELECIONE</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="data_emissao"><strong>DATA EMISSÃO *</strong></label><br/>
                                        <input type="date" name="data_emissao" id="data_emissao" class="form-control"  onblur="comparaDataAno();"/>                                       
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="data_validade"><strong>DATA VALIDADE *</strong></label><br/>
                                        <input type="date" name="data_validade" id="data_validade" class="form-control" onblur="comparaDatas()"/>                                     
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="licenca"><strong>LICENÇA *</strong></label><br/>
                                        <select name="licenca" id="licenca" class="form-control">
                                            <option value="">SELECIONE</option>

                                            <option value="ALVARÁ VERDE">ALVARÁ VERDE</option>
                                            <option value="AUTORIZAÇÃO DE LIMPEZA DE ÁREA">AUTORIZAÇÃO DE LIMPEZA DE ÁRVOERE</option>
                                            <option value="AUTORIZAÇÃO DE SUPRESSÃO">AUTORIZAÇÃO DE SUPRESSÃO</option>
                                            <option value="AUTORIZAÇÃO PARA PODA E CORTE DE ÁRVORE E SUPRESSÃO DE VEGETAÇÃO">AUTORIZAÇÃO PARA PODA E CORTE DE ÁRVORE E SUPRESSÃO DE VEGETAÇÃO</option>
                                            <option value="AUTO DE INFRAÇÃO">AUTO DE INFRAÇÃO</option>
                                            <option value="AUTO DE NOTIFICAÇÃO E INTIMAÇÃO">AUTO DE NOTIFICAÇÃO E INTIMAÇÃO</option>
                                            <option value="CORTE DE ÁRVORE">CORTE DE ÁRVORE</option>
                                            <option value="LICENÇA DE INSTALAÇÃO">LICENÇA DE INSTALAÇÃO</option>
                                            <option value="LICENÇA DE OPERAÇÃO">LICENÇA DE OPERAÇÃO</option>
                                            <option value="LICENÇA DE OPERAÇÃO CORRETIVA">LICENÇA DE OPERAÇÃO CORRETIVA</option>
                                            <option value="LICENÇA DE PRÉVIA">LICENÇA PRÉVIA</option>
                                            <option value="RENOVAÇÃO DE ALVARÁ VERDE">RENOVAÇÃO DE ALVARÁ VERDE</option>
                                            <option value="RENOVAÇÃO DE LICENCA PRÉVIA">RENOVAÇÃO DE LICENCA PRÉVIA</option>
                                            <option value="RENOVAÇÃO DE LICENÇA DE INSTALAÇÃO">RENOVAÇÃO DE LICENÇA DE INSTALAÇÃO</option>
                                            <option value="RENOVAÇÃO DE LICENÇA DE OPERAÇÃO">RENOVAÇÃO DE LICENÇA DE OPERAÇÃO</option>                          
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="atividade_realizada"><strong>RAMO DA ATIVIDADE / ATIVIDADE REALIZADA *</strong></label><br/>
                                        <input type="text" name="atividade_realizada" id="atividade_realizada" class="form-control" autofocus/>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><strong>EMPRESA  E OU Pª FÍSICA / EMPREENDIMENTO / PROCESSO </strong></a>
                        </div>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="empresa"><strong>RAZÃO SOCIAL / PESSOA FÍSICA *</strong></label><a href="cad_empresa.php" style="float: right;font-size: 16px" target="_blanck"><strong>caso não encontre,faça o cadastro - aqui</strong></a><br/>
                                        <select  name="empresa" id="empresa" class="form-control">
                                            <option value="" selected="selected">SELECIONE</option>
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

                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label for="processo"><strong>PROCESSO *</strong></label><br/>
                                        <select name="processo" id="processo" class="form-control">
                                            <option  value="">SELECIONE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label for="empreendimento"><strong>EMPREENDIMENTO *</strong></label><br/>
                                        <select  name="empreendimento" id="empreendimento" class="form-control">
                                            <option value="" selected="selected">SELECIONE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-title" style="text-align: center;"><br/>
                        <input type="submit" value="REALIZAR CADASTRO" class="btn btn-success" style="font-size: 17px; font-weight: bold;"/>
                        <button  class="btn btn-danger"><a href="home.php"  style="font-size: 17px; font-weight: bold; color: #fff;text-decoration: none;">CANCELAR CADASTRO</a></button><br/><br/>
                    </div>   
                </div>
            </dIv>
        </div>
    </form>
</div>
</body>
</html>


