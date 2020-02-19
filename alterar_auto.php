<meta charset="UTF-8">
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

$codigo_auto_infracao = $_GET['codigo_auto_infracao']; /* link dinamico utilizando o get */
$sql = "SELECT *FROM tb_auto_infracao WHERE codigo_auto_infracao = '$codigo_auto_infracao'";
$exe_sql = mysqli_query($con, $sql);
$linha_sql = mysqli_fetch_array($exe_sql);
?>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/estilo_cad_notificacao.css">
<script type="text/javascript" src="js/valida_cpf_representante.js"></script>
<script type="text/javascript" src="js/calculaUfm.js"></script>

<!--o script abaixo permite que somente letras sejam digitas nos campos que recebem essa validação-->
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
<!--o script acima permite que somente letras sejam digitas nos campos que recebem essa validação-->

<!--este scritp garante que no campo nº processo só serão aceitos numero positivos-->
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
<!--OS DADOS ACIMA SÃO REFERENTES AO CADASTRO DE PROCESSO-->

<script type="text/javascript">
    function comparaAnoData()
    {
        var ano_auto_infracao = document.getElementById("ano_auto_infracao").value;
        var data_auto_infracao = document.getElementById("data_auto_infracao").value;
        var data = data_auto_infracao.substr(0, 4); // pega só o ano
        if (ano_auto_infracao !== data) {
            alert("ERRO! O ANO INFORMADO, NÃO ESTÁ COM O MESMO ANO DA DATA DO AUTO");
            var ano_auto_infracao = document.getElementById("ano_auto_infracao").value = '';
            var data_auto_infracao = document.getElementById("data_auto_infracao").value = '';
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#empresa').change(function () {
            $('#processo').load('exibe_processo_infracoes.php?empresa=' + $('#empresa').val());
        });
    });
</script>



<script type="text/javascript">
    function mostrardivlicencas(valor) {

        if (valor === "SIM") {
            document.getElementById("NUMLICENCA").style.display = "block";
            document.getElementById("NUMANOLICENCA").style.display = "block";
            document.getElementById("ORGAOEMISSOR").style.display = "block";
            document.getElementById("DATAVALIDADE").style.display = "block";
        } else if (valor === "NAO") {
            document.getElementById("NUMLICENCA").style.display = "none";
            document.getElementById("NUMANOLICENCA").style.display = "none";
            document.getElementById("ORGAOEMISSOR").style.display = "none";
            document.getElementById("DATAVALIDADE").style.display = "none";
        }
    }

    function mostrardivnotificados(valor_notificado) {

        if (valor_notificado === "SIM") {
            document.getElementById("NOMENOTIFICADO").style.display = "block";
            document.getElementById("CPFNOTIFICADO").style.display = "block";
            document.getElementById("LOGRADOURONOTIFICADO").style.display = "block";
            document.getElementById("NUMERONOTIFICADO").style.display = "block";
            document.getElementById("BAIRRONOTIFICADO").style.display = "block";
            document.getElementById("TESTEMUNHANOTIFICADO").style.display = "block";
        } else if (valor_notificado === "NAO") {
            document.getElementById("NOMENOTIFICADO").style.display = "none";
            document.getElementById("CPFNOTIFICADO").style.display = "none";
            document.getElementById("LOGRADOURONOTIFICADO").style.display = "none";
            document.getElementById("NUMERONOTIFICADO").style.display = "none";
            document.getElementById("BAIRRONOTIFICADO").style.display = "none";
            document.getElementById("TESTEMUNHANOTIFICADO").style.display = "none";
        }
    }
    function mostrardivinformacoes(valor_informacoes) {
        if (valor_informacoes === "SIM") {
            document.getElementById("NUMNOTANTERIOR").style.display = "block";
            document.getElementById("NUMANOANTERIOR").style.display = "block";
            document.getElementById("NUMPROANTERIOR").style.display = "block";
            document.getElementById("NUMANOPROANTERIOR").style.display = "block";
            document.getElementById("LICENCAANTERIOR").style.display = "block";
        } else if (valor_informacoes === "NAO") {
            document.getElementById("NUMNOTANTERIOR").style.display = "none";
            document.getElementById("NUMANOANTERIOR").style.display = "none";
            document.getElementById("NUMPROANTERIOR").style.display = "none";
            document.getElementById("NUMANOPROANTERIOR").style.display = "none";
            document.getElementById("LICENCAANTERIOR").style.display = "none";
        }
    }
</script>

<style type="text/css">
/*    #NUMLICENCA,#ORGAOEMISSOR,#DATAVALIDADE,
    #NOMENOTIFICADO,#CPFNOTIFICADO,#LOGRADOURONOTIFICADO,#NUMERONOTIFICADO,#BAIRRONOTIFICADO,
    #NUMNOTANTERIOR,#NUMANOANTERIOR,#NUMPROANTERIOR,#NUMANOLICENCA,#NUMANOPROANTERIOR,#LICENCAANTERIOR
    {
        display:none;
    }*/
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
        $('#frminfracao').validate({
            //na linha abaixo sao criada as regras de validacao
            rules: {
                empresa: {
                    required: true
                },
                processo: {
                    required: true
                },
                numero_auto_infracao: {
                    required: true,
                    maxlength: 3
                },
                ano_auto_infracao: {
                    required: true
                },
                data_auto_infracao: {
                    required: true
                },
                profissao_atividade: {
                    required: true
                },
                descricao_infracao: {
                    required: true,
                    minlength: 10
                    
                },
                descricao_prazo: {
                    required: true,
                    minlength: 30
                },
                natureza_da_infracao: {
                    required: true

                },
                material_apreendido: {
                    required: true,
                    minlength: 15
                },
                valor_infracao: {
                    required: true
                },
                auto_infracao: {
                    required: true
                },
                status_informacoes_adicionais: {
                    required: true,
                    minlength: 15
                },
                numero_notificacao_ano_anterior: {
                    maxlength: 4

                },
                numero_notificacao_anterior: {
                    maxlength: 3
                },
                numero_processo_notificacao_anterior: {
                    maxlength: 3
                },
                ano_processo_notificacao_anterior: {
                    maxlength: 4
                },
                numero_licenca_notificacao_anterior: {
                    maxlength: 3
                },
                ano_licenca_notificacao_anterior: {
                    maxlength: 4
                },
                orgao_emissor_licenca: {

                    minlength: 4,
                    isString: true
                },

                nome_notificado: {
                    minlength: 12,
                    isString: true
                },
                logradouro: {
                    minlength: 5
                },
                bairro: {
                    minlength: 5
                },
                testemunha: {
                    minlength: 8,
                    isString: true
                },
                status_notificado: {
                    required: true
                },
                fiscal: {
                    required: true
                },
                chefe: {
                    required: true
                },
                status_licenca: {
                    required: true
                },
               status_informacoes_adicionais_auto: {
                    required: true
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
                numero_auto_infracao: {
                    required: "Campo Obrigatório*",
                    maxlength: "Erro! Informe no Máximo 3 Digitos!"
                },
                ano_auto_infracao: {
                    required: "Campo Obrigatório*"
                },
                data_auto_infracao: {
                    required: "Campo Obrigatório*"
                },
                profissao_atividade: {
                    required: "Campo Obrigatório*"
                },
                descricao_infracao: {
                    required: "Campo Obrigatório*",
                    minlength: "Profisssão e / ou Atividade Realizada Inválida, Por Favor Informe Mais Detalhes!"
                },
                descricao_prazo: {
                    required: "Campo Obrigatório*",
                    minlength: "Descrição e / ou Prazo Inválidos, Por Favor Informe Mais Detalhes!"
                },
                natureza_da_infracao: {
                    required: "Campo Obrigatório*"

                },
                material_apreendido: {
                    required: "Campo Obrigatório*",
                    minlength: "Informacao Inválida, Por Favor Informe Mais Detalhes! Caso Não Houve Apreensão de Material, Informe (Não Houve Material Aprrendido) "
                },
                valor_infracao: {
                    required: "Campo Obrigatório*"

                },
                auto_infracao: {
                    required: "Campo Obrigatório"

                },
                status_informacoes_adicionais: {
                    required: "Campo Obrigatório*"
                },
                numero_notificacao_ano_anterior: {
                    maxlength: "Erro! Por Favor Insira no Máximo 4 numeros"

                },
                numero_notificacao_anterior: {
                    maxlength: "Erro! Por Favor Insira somente 3 numeros"
                },
                numero_processo_notificacao_anterior: {
                    maxlength: "Erro! Por Favor Insira somente 3 numeros"
                },
                ano_processo_notificacao_anterior: {
                    maxlength: "Erro! Por Favor Insira somente 4 numeros"
                },
                numero_licenca_notificacao_anterior: {
                    maxlength: "Erro! Por Favor Insira somente 3 numeros"
                },
                ano_licenca_notificacao_anterior: {
                    maxlength: "Erro! Por Favor Insira somente 4 numeros"
                },
                orgao_emissor_licenca: {
                    minlength: "Erro! Por Favor, Mais Detalhes"
                },
                nome_notificado: {
                    minlength: "Erro! Por Favor Informe Mais Detalhes"
                },
                logradouro: {
                    minlength: "Erro! Por Favor Informe Mais Detalhes"
                },
                bairro: {
                    minlength: "Erro! Por Favor Informe Mais Detalhes"
                },
                testemunha: {
                    minlength: "Erro! Por Favor Informe Mais Detalhes"
                },

                status_notificado: {
                    required: "Campo Obrigatório*"
                },
                fiscal: {
                    required: "Campo Obrigatório*"
                },
                chefe: {
                    required: "Campo Obrigatório*"
                },
                status_licenca: {
                    required: "Campo Obrigatório*"
                },
                status_informacoes_adicionais_auto: {
                    required: "Campo Obrigatório*"
                }
            }
        });
    });
</script>
<div class="row"> 
    <div class="col-sm-6">
        <h3><strong>ALTERAÇÃO AUTO DE INFRAÇÃO</strong></h3>
    </div>
</div>

<div class="panel-group">
    <form  action="salvar_alteracao_infracao.php"  method="POST" name="frminfracao" id="frminfracao">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DO AUTO DE INFRAÇÃO</strong></a>
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">                
                            <div class="row">
                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label for="empresa"><strong>RAZÃO SOCIAL / PESSOA FÍSICA *</strong><a href="cad_empresa.php" style="margin-left: 865px ">caso não encontre, clique aqui </a></label>
                                        <select name="empresa" id="empresa" class="form-control" readonly="" autofocus="">
                                
                                            <?php
                                           
                                            $empresa = "SELECT tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica,tb_auto_infracao.codigo_auto_infracao FROM tb_empresa, tb_auto_infracao WHERE tb_auto_infracao.fk9_codigo_empresa = tb_empresa.codigo_empresa AND codigo_auto_infracao =  $codigo_auto_infracao";
                                            $recebe_empresas = mysqli_query($con, $empresa);
                                            while ($linha = mysqli_fetch_array($recebe_empresas)) {
                                                echo '<option value="' . $linha['codigo_empresa'] . '">' . $linha['razaosocial_pessoafisica'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="processo"><strong>PROCESSO *</strong></label><br/>
                                        <select  name="processo" id="processo" class="form-control">
                                            <option>SELECIONE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="numero_auto_infracao"><strong>Nº DO AUTO DE INFRAÇÃO *</strong></label><br/>
                                        <input type="text" name="numero_auto_infracao" id="numero_auto_infracao" value="<?= $linha_sql ['numero_auto_infracao'] ;?>"  onkeyup="somenteNumeros(this);" maxlength="3" class="form-control" placeholder="Campo Obrigatório" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="ano_auto_infracao"><strong>ANO *</strong></label><br/>
                                        <input type="text" name="ano_auto_infracao" id="ano_auto_infracao"  value="<?= $linha_sql['ano_auto_infracao'] ;?>" class="form-control"> 
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="data_auto_infracao"><strong>DATA DO AUTO DE INFRAÇÃO *</strong></label><br/>
                                        <input type="date" name="data_auto_infracao" id="data_auto_infracao" value="<?= $linha_sql['data_auto_infracao'] ;?>" class="form-control" onblur="comparaAnoData()" max="2019-12-01"  min="2017-01-01"/>             
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="profissao_atividade"><strong>PROFISSÃO E / OU  ATIVIDADE REALIZADA *</strong></label><br/>
                                        <input type="text" name="profissao_atividade" id="profissao_atividade" value="<?= $linha_sql['profissao_atividade'] ;?>" class="form-control" onKeypress="return letras(event)"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="descricao_infracao"><strong>DESCRICÃO DA INFRAÇÃO E DISPOSITIVOS LEGAIS INFRIGIDOS *</strong></label><br/>
                                        <input type="text" name="descricao_infracao" id="descricao_infracao" value="<?= $linha_sql['descricao_infracao'] ;?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>       
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="natureza_da_infracao">NATUREZA DA INFRAÇÃO</label>
                                        <input type="text" name="ano_auto_infracao" id="ano_auto_infracao"  value="<?= $linha_sql['natureza_da_infracao'] ;?>" class="form-control">          
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="material_apreendido">MATERIAL APREENDIDO</label>
                                        <input type="text" name="material_apreendido" id="material_apreendido" value="<?= $linha_sql['material_apreendido'] ;?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="valor_infracao">VALOR DA MULTA EM UFM</label>
                                        <input type="text" name="valor_infracao" id="valor_infracao" value="<?= $linha_sql['valor_infracao'] ;?>"  onblur="calcularUFM()" onkeyup="somenteNumeros(this);" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="valor_reais">VALOR DA MULTA EM R$</label>
                                        <input type="text" name="valor_reais" id="valor_reais" value="<?= $linha_sql['valor_reais'] ;?>"   class="form-control" readonly="" />
                                    </div>
                                </div>
                            </div>
                            <div class="row"><br>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <fieldset style="border: 1px solid gainsboro ;text-align: center;color: #048C46"><strong>AUTO DE INFRAÇÃO</strong></label><br><br>
                                            <input type="radio"  name="auto_infracao" value="ADVERTÊNCIA" required="">ADVERTÊNCIA</label>
                                            <input type="radio" name="auto_infracao" value="APREENSÃO">APREENSÃO</label>
                                            <input type="radio" name="auto_infracao" value="EMBARGO">EMBARGO</label>                           
                                            <input type="radio" name="auto_infracao" value="DESTRUIÇÃO">DESTRUIÇÃO</label>
                                            <input type="radio" name="auto_infracao" value="DEMOLIÇÃO">DEMOLIÇÃO</label>
                                            <input type="radio" name="auto_infracao" value="MULTA">MULTA</label>
                                            <input type="radio" name="auto_infracao" value="MULTA DIARIA">MULTA DIARIA</label>
                                            <input type="radio" name="auto_infracao" value="SUSPENSÃO">SUSPENSÃO</label>                  
                                            <input type="radio" name="auto_infracao" value="OUTROS">OUTROS</label><br><br>             
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="status_auto">SITUAÇÃO</label>
                                        <input type="text" name="status_auto" id="status_auto" value="<?= $linha_sql['status_auto'] ;?>"  value="AUTUADO" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>     
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><strong>DADOS DO AUTUADO</strong></a>
                        </div>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="nome_infrator"><strong>NOME DO AUTUADO E / OU REPONSÁVEL</strong></label><br/>
                                        <input type="text" name="nome_infrator" id="nome_infrator" value="<?= $linha_sql['nome_infrator'] ;?>" class="form-control" onKeypress="return letras(event)"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="cpf"><strong>CPF</strong></label><br/>
                                        <input type="text" name="cpf" id="cpf" value="<?= $linha_sql['cpf'] ;?>"  class="form-control" onblur="validaFormato(this);" />
                                        <div id="divResultado"></div>         
                                        <style>
                                            #divResultado{
                                                font-family: serif;
                                                font-size: 14px;
                                                color: #f00;
                                                margin-top:5px;
                                                font-weight: bold;
                                            }
                                        </style>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6" >
                                    <div class="form-group">
                                        <label for="logradouro"><strong>RUA</strong></label><br/>
                                        <input type="text" name="logradouro" value="<?= $linha_sql['logradouro'] ;?>" id="logradouro" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="numero"><strong>NÚMERO</strong></label><br/>
                                        <input type="text" name="numero" value="<?= $linha_sql['numero'] ;?>" id="numero" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-4" >
                                    <div class="form-group">
                                        <label for="bairro"><strong>BAIRRO</strong></label><br/>
                                        <input type="text" name="bairro" value="<?= $linha_sql['bairro'] ;?>"  id="bairro" class="form-control" onKeypress="return letras(event)"/>
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
                                    <label for="chefe_fiscalizacao"><strong>CHEFE DE FISCALIZAÇÃO *</strong></label><br/>
                                    <select name="chefe_fiscalizacao" id="chefe_fiscalizacao" class="form-control">
                                        <option value="">SELECIONE</option>
                                        <option value="CLAUDIO BASTOS FILGUEIRAS JUNIOR - 993200">CLAUDIO BASTOS FILGUEIRAS JUNIOR - 993200</option>
                                        <option value="NÃO ESTAVA PRESENTE">NÃO ESTAVA PRESENTE</option>
                                    </select>
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
                                        <label for="status_informacoes_adicionais_auto"><strong>A INFORMAÇÕES ADICIONAIS ? *</strong></label><br/>
                                        <select name="status_informacoes_adicionais_auto" id="status_informacoes_adicionais_auto" class="form-control" onchange="mostrardivinformacoes(this.value)">
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
                                        <label for="numero_notificacao_anterior_auto"><strong>NÚMERO DA NOTICAÇÃO ANTERIOR</strong></label><br/>
                                        <input type="text" name="numero_notificacao_anterior_auto" id="numero_notificacao_anterior_auto" value="<?= $linha_sql['numero_notificacao_anterior_auto'] ;?>"   onkeyup="somenteNumeros(this);" maxlength="3" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="NUMANOANTERIOR">
                                    <div class="form-group">
                                        <label for="numero_notificacao_ano_anterior_auto"><strong>ANO DA NOTIFICAÇÃO ANTERIOR</strong></label><br/>
                                        <input type="text" name="numero_notificacao_ano_anterior_auto" id="numero_notificacao_ano_anterior_auto" value="<?= $linha_sql['numero_notificacao_ano_anterior_auto'] ;?>"   onkeyup="somenteNumeros(this);"  maxlength="4" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="NUMPROANTERIOR">
                                    <div class="form-group">
                                        <label for="numero_processo_notificacao_anterior_auto"><strong>NÚMERO DO PROCESSO ANTERIOR</strong></label><br/>
                                        <input type="text" name="numero_processo_notificacao_anterior_auto" id="numero_processo_notificacao_anterior_auto" value="<?= $linha_sql['numero_processo_notificacao_anterior_auto'] ;?>"   onkeyup="somenteNumeros(this);" maxlength="3" class="form-control" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="NUMANOPROANTERIOR">
                                    <div class="form-group">
                                        <label for="ano_processo_notificacao_anterior_auto"><strong>ANO DO PROCESSO ANTERIOR</strong></label><br/>
                                        <input type="text" name="ano_processo_notificacao_anterior_auto" id="ano_processo_notificacao_anterior_auto" value="<?= $linha_sql['ano_processo_notificacao_anterior_auto'] ;?>"  onkeyup="somenteNumeros(this);" maxlength="4"  class="form-control" placeholder=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" id="LICENCAANTERIOR">
                                    <div class="form-group">
                                        <label for="status_licenca"><strong>A LICENCA AMBIENTAL</strong></label><br/>
                                        <select name="status_licenca" id="status_licenca" class="form-control" onchange="mostrardivlicencas(this.value)">
                                            <option value="">SELECIONE</option>
                                            <option value="NAO">NÃO</option>
                                            <option value="SIM">SIM</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3" id="NUMLICENCA">
                                    <div class="form-group" >
                                        <label for="numero_licenca_anterior_auto"><strong>NÚMERO DA LICENÇA</strong></label><br/>
                                        <input type="text" name="numero_licenca_anterior_auto" value="<?= $linha_sql['numero_licenca_anterior_auto'] ;?>" id="numero_licenca_anterior_auto" class="form-control"  onkeyup="somenteNumeros(this);" maxlength="3">
                                    </div>
                                </div>
                                <div class="col-sm-3" id="NUMANOLICENCA">
                                    <div class="form-group" >
                                        <label for="ano_licenca_anterior_auto"><strong>ANO DA LICENÇA</strong></label><br/>
                                        <input type="text" name="ano_licenca_anterior_auto" value="<?= $linha_sql['ano_licenca_anterior_auto'] ;?>" id="ano_licenca_anterior_auto" class="form-control"  onkeyup="somenteNumeros(this);" maxlength="4">
                                    </div>
                                </div>

                                <div class="col-sm-3" id="ORGAOEMISSOR">
                                    <div class="form-group" >
                                        <label for="orgao_emissor_licenca_auto"><strong>ORGÃO EMITENTE DA LICENÇA</strong></label><br/>
                                        <input type="text" name="orgao_emissor_licenca_auto" value="<?= $linha_sql['orgao_emissor_licenca_auto'] ;?>" id="orgao_emissor_licenca_auto" class="form-control" onKeypress="return letras(event)">
                                    </div>
                                </div>
                                <div class="col-sm-3" id="DATAVALIDADE">
                                    <div class="form-group" >
                                        <label for="data_validade_licenca_anterior"><strong>DATA VALIDADE</strong></label><br/>
                                        <input type="date" name="data_validade_licenca_anterior" value="<?= $linha_sql['data_validade_licenca_anterior'] ;?>" id="data_validade_licenca_anterior" class="form-control" max="2019-12-31">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>          
                <div class="panel panel-default">
                    <input type = "hidden" name = "codigo_auto_infracao" value = "<?= $linha_sql['codigo_auto_infracao']; ?>">
                    <div class="panel-title" style="text-align: center;"><br/>
                        <button type="submit" class="btn btn-success" style="font-size: 17px; font-weight: bold;">REALIZAR ALTERAÇÃO<span class="glyphicon glyphicon-saved" style="margin-left: 10px;"></span></button>
                        <button  class="btn btn-danger"><a href="cadastros.php"style="text-decoration: none;color:#FFF">CANCELAR CADASTRO<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a></button><br/><br/>
                    </div>   
                </div>
            </dIv>
        </div>
    </form>
</div>
</body>
</html>

