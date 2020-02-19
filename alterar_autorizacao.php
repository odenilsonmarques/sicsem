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
$codigo_autorizacao = $_GET['codigo_autorizacao']; /* link dinamico utilizando o get */
$sql = "SELECT *FROM tb_autorizacao WHERE codigo_autorizacao  = '$codigo_autorizacao'";
$exe_sql = mysqli_query($con, $sql);
$linha_sql = mysqli_fetch_array($exe_sql);
?>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>

<script type="text/javascript">
    function comparaDatas() {
        var data_emissao = document.getElementById("data_emissao").value;
        var data_validade = document.getElementById("data_validade").value;
        if (data_emissao >= data_validade) {
            data_emissao = document.getElementById('data_emissao').value = '';
            data_validade = document.getElementById('data_validade').value = '';
            alert("ERRO! A DATA DE EMISSÃO NÃO PODE SER MAIOR OU IGUAL A DATA DE VALIDADE");
        }
    }
</script>

<script type="text/javascript">
    function comparaAnoData() {
        var ano = document.getElementById("ano").value;
        var data_emissao = document.getElementById("data_emissao").value;
        var data = data_emissao.substr(0, 4); // pega só o ano
        if (ano !== data) {
            ano = document.getElementById("ano").value = '';
            data_emissao = document.getElementById("data_emissao").value = '';
            alert("ERRO! O ANO INFORMADO, NÃO ESTÁ COM O MESMO ANO DA DATA DE EMISSSÃO");
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
    function mostrartipoautorizacao(valor) {
        if (valor === "AUTORIZAÇÃO PARA CORTE DE ÁRVORE" | valor === "AUTORIZAÇÃO PARA PODA DE ÁRVORE" | valor === "AUTORIZAÇÃO DE LIMPEZA DE ÁREA") {
            document.getElementById("DETALHES_AUTORIZACAO").style.display = "block";
        } else {
            document.getElementById("DETALHES_AUTORIZACAO").style.display = "none";

        }
        if (valor === "AUTORIZAÇÃO PARA SUPRESSÃO DE VEGETAÇÃO E LIMPEZA DE ÁRVORE") {
            document.getElementById("AREA_PROPRIEDADE").style.display = "block";
            document.getElementById("AREA_REQUERIDA").style.display = "block";
        } else {
            document.getElementById("AREA_PROPRIEDADE").style.display = "none";
            document.getElementById("AREA_REQUERIDA").style.display = "none";

        }
        if (valor === "OUTROS") {
            document.getElementById("OUTRO_TIPO").style.display = "block";

        } else {
            document.getElementById("OUTRO_TIPO").style.display = "none";

        }

    }
</script>

<style type="text/css">
    #DETALHES_AUTORIZACAO,
    #AREA_PROPRIEDADE,#AREA_REQUERIDA,
    #OUTRO_TIPO
    {
        /*display:none;*/
    }
</style>

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
        $('#frmautorizacao').validate({
            //na linha abaixo sao criada as regras de validacao
            rules: {
                empresa: {
                    required: true
                },
                processo: {
                    required: true
                },
                empreendimento: {
                    required: true
                },
                numero_autorizacao: {
                    required: true,
                    maxlength: 3
                },
                ano: {
                    required: true
                },
                data_emissao: {
                    required: true
                },
                data_validade: {
                    required: true
                },
                autorizacao: {
                    required: true
                },
                informacao_autorizacao: {
                    minlength: 15
                },
                outro: {
                    minlength: 15,
                    isString: true
                },
                informacao_outro_tipo: {
                    minlength: 15
                }
            },
            //na  linha abaixo sao criada as mensagem que serao vista pelo usuarios
            messages: {

                empresa: {
                    required: "Campo Obrigatório*"
                },
                processo: {
                    required: "Campo Obrigatório*"

                },
                empreendimento: {
                    required: "Campo Obrigatório*"

                },
                numero_autorizacao: {
                    required: "Campo Obrigatório*",
                    maxlength: "Insira apenas 3 Digitos"
                },
                ano: {
                    required: "Campo Obrigatório*"
                },
                data_emissao: {
                    required: "Campo Obrigatório*"
                },
                data_validade: {
                    required: "Campo Obrigatório*"
                },
                autorizacao: {
                    required: "Campo Obrigatório*"
                },
                informacao_autorizacao: {
                    minlength: "Informação Inválida! Por Favor, Insira Mais Detalhes"
                },
                outro: {
                    minlength: "Informação Inválida! Por Favor, Insira Mais Detalhes"
                },
                informacao_outro_tipo: {
                    minlength: "Informação Inválida! Por Favor, Insira Mais Detalhes"

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
</div>

<div class="row">
    <div class="col-sm-6">
        <h3><strong>ALTERAÇÃO AUTORIZAÇÃO</strong></h3>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3">     
        <div class="nav">
            <ul class="nav navbar-nav navbar-right" style="font-size: 14px;border-radius:5px;margin-right: 3px">
                <li class="dropdown">
                    <a href=""  data-toggle="dropdown" class="btn btn-default">Ir Para <span class="caret"></span></a>
                    <ul class="dropdown-menu ">
                        <li><a href="cad_empresa.php"><strong><img src="img/man-with-company.png"> CADASTRO EMPRESA / Pª FÍSICA</strong></a></li>
                        <li><a href="cad_representante.php"><strong><img src="img/user_2.png"> CADASTRO REPRESENTANTE</strong></a></li>
                        <li><a href="cad_processo.php"><strong><img src="img/contract.png"> CADASTRO PROCESSO</strong></a></li>
                        <li><a href="cad_empreendimento.php"><strong><img src="img/construction-worker_1.png"> CADASTRO EMPREENDIMENTO</strong></a></li>
                        <li><a href="cad_notificacao.php"><strong><img src="img/notifications-button_1.png">CADASTRO NOTIFICAÇÃO</strong></a></li>
                        <li><a href="consultar_empresas.php"style="color: #2e6da4"><strong><img src="img/office-block.png"> CONSULTAR EMPRESAS</strong></a></li>
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
    <form  action="salvar_alteracao_autorizacao.php"  method="POST" name="frmautorizacao" id="frmautorizacao">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>RAZÃO SOCIAL OU Pª FÍSICA / PROCESSO / EMPREENDIMENTO</strong></a>
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <!--<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Exibir / Ocultar</button>-->
                                    <div class="alert alert-warning"><!---Alert-->
                                        <!--<a href="#" class="close" data-dismiss="alert" aria-label="close"><strong>&times;</strong></a>-->
                                        <p><a href="consultar_autorizacoes.php"><strong>ANTES DE REALIZAR O CADASTRO, VERIFIQUE SE A AUTORIZAÇÃO JÁ ESTÁ CADASTRADA - CLICANDO AQUI</strong></a></hP>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="empresa"><strong>RAZÃO OSOCIAL / Pª FÍSICA *</strong></label><a href="cad_empresa.php" style="float: right;font-size: 16px" target="_blanck"><strong>caso não encontre,faça o cadastro - aqui</strong></a><br/>
                                        <select  name="empresa" id="empresa" class="form-control">
                                            <option value="" selected="selected">SELECIONE</option>
                                            <?php
                                            $empresa = "SELECT *FROM tb_empresa";
                                            $recebe_empresa = mysqli_query($con, $empresa);
                                            while ($linha = mysqli_fetch_array($recebe_empresa)) {
                                                echo '<option value="' . $linha['codigo_empresa'] . '">' . $linha['razaosocial_pessoafisica'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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

                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" ><strong>DADOS DA AUTORIZAÇÃO</strong></a>
                        </div>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="numero_autorizacao"><strong>Nº DA AUTORIZAÇÃO *</strong></label><br/>
                                        <input type="number" name="numero_autorizacao" id="numero_autorizacao" value="<?= $linha_sql['numero_autorizacao']; ?>" readonly="" class="form-control"/>     
                                        
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="ano"><strong>SELECIONE O ANO *</strong></label><br/>
                                        <input type="text" name="ano" id="ano" value="<?= $linha_sql['ano']; ?>"  class="form-control">                            
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="data_emissao"><strong>DATA EMISSÃO *</strong></label><br/>
                                        <input type="date" name="data_emissao" id="data_emissao" value="<?= $linha_sql['data_emissao']; ?>" onblur="comparaAnoData()" class="form-control"/>                                       
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="data_validade"><strong>DATA VALIDADE *</strong></label><br/>
                                        <input type="date" name="data_validade" id="data_validade" value="<?= $linha_sql['data_validade']; ?>"  onblur="comparaDatas()" class="form-control">                                     
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="autorizacao"><strong>AUTORIZAÇÃO PARA *</strong></label><br/>
                                        <input type="text" name="autorizacao" id="autorizacao" value="<?= $linha_sql['autorizacao']; ?>" readonly="" class="form-control"/>     
<!--                                        <select name="autorizacao" id="autorizacao" class="form-control" onchange="mostrartipoautorizacao(this.value)">
                                            <option value="" >SELECIONE</option>                                                                              
                                            <option value="AUTORIZAÇÃO PARA CORTE DE ÁRVORE">AUTORIZAÇÃO PARA CORTE DE ARVORE</option>  
                                            <option value="AUTORIZAÇÃO PARA PODA DE ÁRVORE">AUTORIZAÇÃO PARA PODA DE ÁRVORE</option>
                                            <option value="AUTORIZAÇÃO DE LIMPEZA DE ÁREA">AUTORIZAÇÃO DE LIMPEZA DE ÁREA</option>                                            
                                            <option value="AUTORIZAÇÃO PARA SUPRESSÃO DE VEGETAÇÃO E LIMPEZA DE ÁRVORE">AUTORIZAÇÃO PARA SUPRESSÃO DE VEGETAÇÃO E LIMPEZA DE ÁRVORE</option>
                                            <option value="OUTROS">OUTROS</option>
                                        </select>  -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" id="DETALHES_AUTORIZACAO">
                                    <div class="form-group">
                                        <label for="informacao_autorizacao"><strong>INFORMAÇÕES DA AUTORIZACÃO </strong></label><br/>
                                        <input type="text" name="informacao_autorizacao" id="informacao_autorizacao" value="<?= $linha_sql['informacao_autorizacao']; ?>" readonly="" class="form-control"/>                                     
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6" id="AREA_PROPRIEDADE">
                                    <div class="form-group">
                                        <label for="area_propried"><strong>ÁREA DA PROPRIEDADE</strong></label><br/>
                                        <input type="text" name="area_propried" id="area_propried" value="<?= $linha_sql['area_propried']; ?>"  readonly="" class="form-control"/>                                     
                                    </div>
                                </div>
                                <div class="col-sm-6" id="AREA_REQUERIDA">
                                    <div class="form-group">
                                        <label for="area_requer"><strong>ÁREA REQUERIDA PARA SUPRESSÃO</strong></label><br/>
                                        <input type="text" name="area_requer" id="area_requer" value="<?= $linha_sql['area_requer']; ?>" readonly="" class="form-control"/>                                     
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" id="OUTRO_TIPO">
                                    <div class="form-group">
                                        <label for="outro"><strong>VOCÊ OPTOU POR OUTRO TIPO DE AUTORIZAÇÃO! ESPECIFIQUE</strong></label><br/>
                                        <input type="text" name="outro" id="outro" value="<?= $linha_sql['outro']; ?>" readonly="" class="form-control"/>                                     
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <input type = "hidden" name = "codigo_autorizacao" value = "<?= $linha_sql['codigo_autorizacao']; ?>">
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


