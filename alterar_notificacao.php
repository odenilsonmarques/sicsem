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

$codigo_notificacao = $_GET['codigo_notificacao']; /* link dinamico utilizando o get */
$sql = "SELECT *FROM tb_notificacao WHERE codigo_notificacao = '$codigo_notificacao'";
$exe_sql = mysqli_query($con, $sql);
$linha_sql = mysqli_fetch_array($exe_sql);
?>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>

<script type="text/javascript">
    function comparadatas()
    {
        var data_hora_notificacao = document.getElementById("data_hora_notificacao");
        var data_hora_comparecimento = document.getElementById("data_hora_comparecimento");

        if (data_hora_notificacao.value > data_hora_comparecimento.value) {
            alert("ERRO! A DATA DE NOTIFICAÇÃO NÃO PODE SER MAIOR OU IGUAL A DATA DE COMPARECIMENTO");
            data_hora_notificacao = document.getElementById('data_hora_notificacao').value = '';
            data_hora_comparecimento = document.getElementById('data_hora_comparecimento').value = '';

        }
    }
</script>

<script type="text/javascript">
    function comparaAnoData()
    {
        var ano = document.getElementById("ano").value;
        var data_hora_notificacao = document.getElementById("data_hora_notificacao").value;
        var data = data_hora_notificacao.substr(0, 4); // pega só o ano
        if (ano !== data) {
            alert("ERRO! O ANO INFORMADO, NÃO ESTÁ COM O MESMO ANO DA DATA DA NOTIFICAÇÃO");
            var ano = document.getElementById("ano").value = '';
            var data_hora_notificacao = document.getElementById("data_hora_notificacao").value = '';

        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#empresa').change(function () {
            $('#processo').load('exibe_processo_notificacoes.php?empresa=' + $('#empresa').val());
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

<!--<style type="text/css">
    #NUMLICENCA,#ORGAOEMISSOR,#DATAVALIDADE,
    #NOMENOTIFICADO,#CPFNOTIFICADO,#LOGRADOURONOTIFICADO,#NUMERONOTIFICADO,#BAIRRONOTIFICADO,#TESTEMUNHANOTIFICADO,
    #NUMNOTANTERIOR,#NUMANOANTERIOR,#NUMPROANTERIOR,#NUMANOLICENCA,#NUMANOPROANTERIOR,#LICENCAANTERIOR
    {
        /*display:none;*/
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
        $('#frmnotificacao').validate({
            //na linha abaixo sao criada as regras de validacao
            rules: {
                empresa: {
                    required: true
                },
                processo: {
                    required: true
                },
                numero_notificacao: {
                    required: true,
                    maxlength: 3
                },
                ano: {
                    required: true,
                    maxlength: 4
                },
                data_hora_notificacao: {
                    required: true
                },
                data_hora_comparecimento: {
                    required: true
                },
                profissao_atividade: {
                    required: true,
                    minlength: 10,
                    isString: true
                },
                descricao_prazo: {
                    required: true,
                    minlength: 30
                },
                status_informacoes_adicionais: {
                    required: true
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
                    minlength: 5,
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
                }
                fiscal: {
                    required: true
                },
                chefe: {
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
                numero_notificacao: {
                    required: "Campo Obrigatório*",
                    maxlength: "Erro! Informe no Máximo 3 Digitos!"
                },
                ano: {
                    required: "Campo Obrigatório*",
                    maxlength: "Erro! Informe no Máximo 4 Digitos!"
                },
                data_hora_notificacao: {
                    required: "Campo Obrigatório*"
                },
                data_hora_comparecimento: {
                    required: "Campo Obrigatório*"
                },
                profissao_atividade: {
                    required: "Campo Obrigatório*",
                    minlength: "Profisssão e / ou Atividade Realizada Inválida, Por Favor Informe Mais Detalhes!"

                },
                descricao_prazo: {
                    required: "Campo Obrigatório*",
                    minlength: "Descrição e / ou Prazo Inválidos, Por Favor Informe Mais Detalhes!"
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
                }
                fiscal: {
                    required: "Campo Obrigatório*"
                },
                chefe: {
                    required: "Campo Obrigatório*"
                }
            }
        });
    });
</script>

<div class="row"> 
    <div class="col-sm-6">
        <h3><strong>ALTERAÇÃO NOTIFICAÇÃO</strong></h3>
    </div>
    <div class="col-sm-3"></div>
</div>

<div class="panel-group">
    <form  action="salvar_alteracao_notificacao.php"  method="POST" name="frmnotificacao" id="frmnotificacao">

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
                                        <label for="empresa"><strong>RAZÃO SOCIAL / PESSOA FÍSICA *</strong></label>
                                        <a href="cad_empresa.php" style="float: right;font-size: 16px" target="_blanck"></a><br/>
                                        <select name="empresa" id="empresa" readonly="" class="form-control">
                                           
                                            <?php
                                           
                                            $empresa = "SELECT tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica,tb_notificacao.codigo_notificacao FROM tb_empresa, tb_notificacao WHERE tb_notificacao.fk5_codigo_empresa = tb_empresa.codigo_empresa AND codigo_notificacao =  $codigo_notificacao";
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
                                        <input type="number" name="numero_notificacao" id="numero_notificacao"  readonly="" value="<?= $linha_sql ['numero_notificacao'] ;?>"  class="form-control" />                                        
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="ano_notificacao"><strong>ANO *</strong></label><br/>
                                        <input type="text" name="ano_notificacao" id="ano_notificacao" readonly="" value="<?= $linha_sql['ano_notificacao'] ;?>" class="form-control"> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="data_notificacao"><strong>DATA E HORA DA NOTIFICAÇÃO *</strong></label><br/>
                                        <input type="date" name="data_notificacao" id="data_notificacao" readonly="" value="<?= $linha_sql['data_notificacao'] ;?>" class="form-control" onblur="comparaAnoData()"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="data_comparecimento"><strong>DATA E HORA PARA COMPARECIMENTO *</strong></label><br/>
                                        <input type="date" name="data_comparecimento" id="data_comparecimento" readonly=""  value="<?= $linha_sql['data_comparecimento'] ;?>" class="form-control" onblur="comparadatas()"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="profissao_atividade"><strong>PROFISSÃO E / OU  ATIVIDADE REALIZADA *</strong></label><br/>
                                        <input type="text" name="profissao_atividade" id="profissao_atividade" value="<?= $linha_sql['profissao_atividade'] ;?>" class="form-control" autofocus  />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="descricao_prazo"><strong>DESCRICÃO E PRAZO *</strong></label><br/>
                                        <input type="text" name="descricao_prazo" id="descricao_prazo" value="<?= $linha_sql['descricao_prazo'] ;?>" class="form-control" autofocus/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="testemunha"><strong>NOME DA TESTEMUNHA</strong></label><br/>
                                        <input type="text" name="testemunha" id="testemunha" value="<?= $linha_sql['testemunha'];?>"  readonly=""  class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="status">SITUAÇÃO</label>
                                        <input type="text" name="status" id="status" value="NOTIFICADO"  class="form-control" autofocus=""/>
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
                                        <input type="text" name="status_informacoes_adicionais" id="status_informacoes_adicionais" value="<?= $linha_sql['status_informacoes_adicionais'];?>"  readonly="" class="form-control">
                                    </div>
                                </div>
                            </div>                        
                            <div class="row">
                                <div class="col-sm-3" id="NUMNOTANTERIOR">
                                    <div class="form-group">
                                        <label for="numero_notificacao_anterior"><strong>NÚMERO DA NOTICAÇÃO ANTERIOR</strong></label><br/>
                                        <input type="number" name="numero_notificacao_anterior" id="numero_notificacao_anterior" value="<?= $linha_sql['numero_notificacao_anterior'];?>"  readonly="" maxlength="3"  class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="NUMANOANTERIOR">
                                    <div class="form-group">
                                        <label for="numero_notificacao_ano_anterior"><strong>ANO DA NOTIFICAÇÃO ANTERIOR</strong></label><br/>
                                        <input type="number" name="numero_notificacao_ano_anterior" id="numero_notificacao_ano_anterior" value="<?= $linha_sql['numero_notificacao_ano_anterior'];?>"  readonly=""  maxlength="4" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="NUMPROANTERIOR">
                                    <div class="form-group">
                                        <label for="numero_processo_notificacao_anterior"><strong>NÚMERO DO PROCESSO ANTERIOR</strong></label><br/>
                                        <input type="number" name="numero_processo_notificacao_anterior" id="numero_processo_notificacao_anterior" value="<?= $linha_sql['numero_processo_notificacao_anterior'];?>"  readonly="" maxlength="3" class="form-control" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="NUMANOPROANTERIOR">
                                    <div class="form-group">
                                        <label for="ano_processo_notificacao_anterior"><strong>ANO DO PROCESSO ANTERIOR</strong></label><br/>
                                        <input type="number" name="ano_processo_notificacao_anterior" id="ano_processo_notificacao_anterior"  value="<?= $linha_sql['ano_processo_notificacao_anterior'];?>"  readonly=""  maxlength="4"  class="form-control" placeholder=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" id="LICENCAANTERIOR">
                                    <div class="form-group">
                                        <label for="status_licenca"><strong>A LICENCA AMBIENTAL</strong></label><br/>
                                        <input type="text" name="status_licenca" id="status_licenca" value="<?= $linha_sql['status_licenca'];?>"  readonly="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3" id="NUMLICENCA">
                                    <div class="form-group" >
                                        <label for="numero_licenca_notificacao_anterior"><strong>NÚMERO DA LICENÇA</strong></label><br/>
                                        <input type="number" name="numero_licenca_notificacao_anterior" id="numero_licenca_notificacao_anterior" value="<?= $linha_sql['numero_licenca_notificacao_anterior'];?>"  readonly="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-3" id="NUMANOLICENCA">
                                    <div class="form-group" >
                                        <label for="ano_licenca_notificacao_anterior"><strong>ANO DA LICENÇA</strong></label><br/>
                                        <input type="number" name="ano_licenca_notificacao_anterior" id="ano_licenca_notificacao_anterior" value="<?= $linha_sql['ano_licenca_notificacao_anterior'];?>"  readonly="" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-3" id="ORGAOEMISSOR">
                                    <div class="form-group" >
                                        <label for="orgao_emissor_licenca"><strong>ORGÃO EMITENTE DA LICENÇA</strong></label><br/>
                                        <input type="text" name="orgao_emissor_licenca" id="orgao_emissor_licenca" value="<?= $linha_sql['orgao_emissor_licenca'];?>"  readonly="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-3" id="DATAVALIDADE">
                                    <div class="form-group" >
                                        <label for="data_validade"><strong>DATA VALIDADE</strong></label><br/>
                                        <input type="date" name="data_validade" id="data_validade" value="<?= $linha_sql['data_validade'];?>"  readonly="" class="form-control">
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
                                         <input type="text" name="status_notificado" id="status_notificado" value="<?= $linha_sql['status_notificado'];?>"  readonly="" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8" id="NOMENOTIFICADO">
                                    <div class="form-group">
                                        <label for="nome_notificado"><strong>NOME DO NOTIFICADO E / OU REPONSÁVEL</strong></label><br/>
                                        <input type="text" name="nome_notificado" id="nome_notificado" value="<?= $linha_sql['nome_notificado'];?>"  readonly="" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-4" id="CPFNOTIFICADO">
                                    <div class="form-group">
                                        <label for="cpf"><strong>CPF</strong></label><br/>
                                        <input type="text" name="cpf" id="cpf" value="<?= $linha_sql['cpf'];?>"  readonly="" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6" id="LOGRADOURONOTIFICADO">
                                    <div class="form-group">
                                        <label for="logradouro"><strong>RUA</strong></label><br/>
                                        <input type="text" name="logradouro" id="logradouro" value="<?= $linha_sql['logradouro'];?>"  readonly="" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-2" id="NUMERONOTIFICADO">
                                    <div class="form-group">
                                        <label for="numero"><strong>NÚMERO</strong></label><br/>
                                        <input type="text" name="numero" id="numero"  value="<?= $linha_sql['numero'];?>"  readonly=""  class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-4" id=BAIRRONOTIFICADO>
                                    <div class="form-group">
                                        <label for="bairro"><strong>BAIRRO</strong></label><br/>
                                        <input type="text" name="bairro" id="bairro"  value="<?= $linha_sql['bairro'];?>"  readonly=""  class="form-control" />
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
                                        <select name="fiscal" id="fiscal"  readonly="" class="form-control">
                                            
                                            <?php
                                            $fiscal = "SELECT tb_fiscal.codigo_fiscal,tb_fiscal.nome_matricula_fiscal,tb_notificacao.codigo_notificacao FROM tb_fiscal, tb_notificacao WHERE tb_notificacao.fk1_codigo_fiscal = tb_fiscal.codigo_fiscal AND codigo_notificacao =  $codigo_notificacao";
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
                                        <label for="chefe_fiscalizacao"><strong>CHEFE DE FISCALIZAÇÃO *</strong></label><br/>
                                        <input type="text" name="chefe_fiscalizacao" id="chefe_fiscalizacao"  value="<?= $linha_sql['chefe_fiscalizacao'];?>"  readonly=""  class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <input type = "hidden" name = "codigo_notificacao" value = "<?= $linha_sql['codigo_notificacao']; ?>">
                    <div class="panel-title" style="text-align: center;"><br/>
                        <button type = "submit"  class = "btn btn-success" style = "font-size: 17px; font-weight: bold;">REALIZAR ALTERAÇÃO<span class="glyphicon glyphicon-saved" style="margin-left: 10px;"></span></button>
                        <button  class="btn btn-danger"><a href="editar.php"  style="font-size: 17px; font-weight: bold; color: #fff;text-decoration: none;">CANCELAR ALTERAÇÃO<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a></button><br/><br/>
                    </div>   
                </div>
            </dIv>
        </div>
    </form>
</div>
</body>
</html>

