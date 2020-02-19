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


<!--<script type="text/javascript">
    function mensagem() {
        if (document.frmautorizacao.autorizacao.value === 'AUTORIZAÇÃO PARA CORTE DE ÁRVORE' && document.frmautorizacao.informacao_autorizacao.value === '' || document.frmautorizacao.autorizacao.value === 'AUTORIZAÇÃO PARA PODA DE ÁRVORE' && document.frmautorizacao.informacao_autorizacao.value === '' || document.frmautorizacao.autorizacao.value === 'AUTORIZAÇÃO DE LIMPEZA DE ÁREA' && document.frmautorizacao.informacao_autorizacao.value === '') {
            alert("PREENCHA O CAMPO, INFORMAÇÕES DA AUTORIZAÇÃO !");
            document.frmautorizacao.autorizacao.focus();
            document.frmautorizacao.informacao_autorizacao.focus();
            return false;//garante que o campo nao pode ser nulo
        }
        if (document.frmautorizacao.autorizacao.value === 'AUTORIZAÇÃO PARA SUPRESSÃO DE VEGETAÇÃO E LIMPEZA DE ÁRVORE' && document.frmautorizacao.area_propried.value === "") {
            alert("PREENCHA O CAMPOS, ÁREA DA PROPRIEDADE!");
            document.frmautorizacao.autorizacao.focus();
            document.frmautorizacao.area_propried.focus();
            return false;//garante que o campo nao pode ser nulo
        }
        if (document.frmautorizacao.autorizacao.value === 'AUTORIZAÇÃO PARA SUPRESSÃO DE VEGETAÇÃO E LIMPEZA DE ÁRVORE' && document.frmautorizacao.area_requer.value === "") {
            alert("PREENCHA O CAMPOS, ÁREA DA REQUERIDA!");
            document.frmautorizacao.autorizacao.focus();
            document.frmautorizacao.area_requer.focus();
            return false;//garante que o campo nao pode ser nulo
        }
        if (document.frmautorizacao.autorizacao.value === 'OUTROS' && document.frmautorizacao.outro.value === "") {
            alert("PREENCHA O CAMPO OUTRO TIPO DE AUTORIZAÇÃO!");
            document.frmautorizacao.autorizacao.focus();
            document.frmautorizacao.outro.focus();
            return false;//garante que o campo nao pode ser nulo
        }
    }

</script>-->

<!--<script type="text/javascript">
    function comparaDatas() {
        var data_emissao = document.getElementById("data_emissao").value;
        var data_validade = document.getElementById("data_validade").value;
        if (data_emissao >= data_validade) {
            data_emissao = document.getElementById('data_emissao').value = '';
            data_validade = document.getElementById('data_validade').value = '';
            alert("ERRO! A DATA DE EMISSÃO NÃO PODE SER MAIOR OU IGUAL A DATA DE VALIDADE");
        }
    }
</script>-->

<!--<script type="text/javascript">
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
</script>-->

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

<!--<script type="text/javascript">
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
</script>-->

<!--<style type="text/css">
    #DETALHES_AUTORIZACAO,
    #AREA_PROPRIEDADE,#AREA_REQUERIDA,
    #OUTRO_TIPO
    {
        display:none;
    }
</style>-->

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
        $('#frmvistoria').validate({
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
                atividade: {
                    required: true,
                    minlength: 20,
                    isString: true
                },
                data_vistoria: {
                    required: true
                },
                situacao: {
                    required: true
                },
                caracteristica: {
                    required: true
                },
                instalacao: {
                    required: true
                },
                situacao_meioambiente: {
                    required: true,
                    minlength: 20,
                    isString: true
                },
                conclusao: {
                    required: true,
                    minlength: 20,
                    isString: true
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
                atividade: {
                    required: "Campo Obrigatório",
                    minlength: "Atividade Inválida! Por Favor Informe Mais Detalhes"
                },
                data_vistoria: {
                    required: "Campo Obrigatório"
                },
                situacao: {
                    required: "Campo Obrigatório"
                },
                caracteristica: {
                    required: "Campo Obrigatório"
                },
                instalacao: {
                    required: "Campo Obrigatório"
                },
                situacao_meioambiente: {
                    required: "Campo Obrigatório",
                    minlength: "Situacao Inválida! Por Favor Informe Mais Detalhes"
                },
                conclusao: {
                    required: "Campo Obrigatório",
                    minlength: "Conclusão Inválida! Por Favor Informe Mais Detalhes"
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
        <h3><strong>CADASTRO VISTORIA</strong></h3>
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
    <form  action="recebe_cad_vistoria.php"  method="POST" name="frmvistoria" id="frmvistoria">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>RAZÃO SOCIAL OU Pª FÍSICA / PROCESSO / EMPREENDIMENTO / FISCALIZAÇÃO</strong></a>
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <!--<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Exibir / Ocultar</button>-->
                                    <div class="alert alert-warning"><!---Alert-->
                                        <!--<a href="#" class="close" data-dismiss="alert" aria-label="close"><strong>&times;</strong></a>-->
                                        <p><a href="#"><strong>ANTES DE REALIZAR O CADASTRO, VERIFIQUE SE A AUTORIZAÇÃO JÁ ESTÁ CADASTRADA - CLICANDO AQUI</strong></a></hP>
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
                            </div>
                            <div class="row">
                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label for="empreendimento"><strong>EMPREENDIMENTO *</strong></label><br/>
                                        <select  name="empreendimento" id="empreendimento" class="form-control">
                                            <option value="" selected="selected">SELECIONE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
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
                            <div class="row">
                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label for="atividade"><strong>ATIVIDADE *</strong></label><br/>
                                        <input type="text" name="atividade" id="atividade" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" ><strong>DADOS DA VISTORIA</strong></a>
                        </div>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">               
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="data_vistoria"><strong>DATA DA VISTORIA *</strong></label><br/>
                                        <input type="date" name="data_vistoria" id="data_vistoria" onblur="comparaAnoData()" class="form-control"/>                                       
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="situacao"><strong>SITUAÇÃO DA RAZÃO SOCIAL / Pª FÍSICA *</strong></label><br/>
                                        <select name="situacao" id="situacao" class="form-control">
                                            <option value="" >SELECIONE</option>   
                                            <option value="FECHADO">FECHADO</option>                                                                                   
                                            <option value="INADEQUADO">INADEQUADO</option>
                                            <option value="NÃO LOCALIZADO">NÃO LOCALIZADO</option>
                                            <option value="LOCALIZADO">LOCALIZADO</option>                                                                                                                    
                                        </select>                              
                                    </div>
                                </div>                          
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="caracteristica"><strong>CARACTERÍSTICA DO RAZÃO SOCIAL / Pª FÍSICA *</strong></label><br/>
                                        <select name="caracteristica" id="caracteristica" class="form-control">
                                            <option value="" >SELECIONE</option>   
                                            <option value="COMERCIAL">COMERCIAL</option> 
                                            <option value="RESIDENCIAL">RESIDENCIAL</option>
                                            <option value="TERRENO EM CONSTRUÇÃO">TERRENO EM CONSTRUÇÃO</option>  
                                            <option value="TERRENO SEM CONSTRUÇÃO">TERRENO SEM CONSTRUÇÃO</option>                                                                                                                     
                                        </select>                              
                                    </div>
                                </div> 
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="instalacao"><strong>INSTALAÇÕES*</strong></label><br/>
                                        <select name="instalacao" id="instalacao" class="form-control">
                                            <option value="" >SELECIONE</option>   
                                            <option value="ADEQUADO">ADEQUADO</option> 
                                            <option value="INADEQUADO">INADEQUADO</option>

                                        </select>                              
                                    </div>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="situacao_meioambiente"><strong>SITUAÇÃO EM RELAÇÃO AO MEIO AMBIENTE</strong></label><br/>
                                        <input type="text" name="situacao_meioambiente" id="situacao_meioambiente" class="form-control"/>                                     
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="conclusao"><strong>CONCLUSÃO DA VISTORIA</strong></label><br/>
                                        <input type="text" name="conclusao" id="conclusao" class="form-control"/>                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-title" style="text-align: center;"><br/>
                        <input type="submit" value="REALIZAR CADASTRO" onclick="return mensagem()" class="btn btn-success" style="font-size: 17px; font-weight: bold;"/>
                        <button  class="btn btn-danger"><a href="home.php"  style="font-size: 17px; font-weight: bold; color: #fff;text-decoration: none;">CANCELAR CADASTRO</a></button><br/><br/>
                    </div>   
                </div>
            </dIv>
        </div>
    </form>
</div>
</body>
</html>


