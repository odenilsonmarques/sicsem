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
$codigo_licenca = $_GET['codigo_licenca']; /* link dinamico utilizando o get */
$sql = "SELECT *FROM tb_licenca WHERE codigo_licenca = '$codigo_licenca'";
$exe_sql = mysqli_query($con, $sql);
$linha_sql = mysqli_fetch_array($exe_sql);
?>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<link rel="stylesheet" href="css/estilo_alteraLicenca.css">


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
    function comparadatas()
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
                    required: true,
                    maxlength: 4
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
                    required: "Campo Obrigatório*",
                    maxlength: "Erro! Informe no Máximo 4 Digitos!"
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
    <div class="col-sm-6">
        <h3><strong>ALTERAÇÃO LICENÇA</strong></h3>
    </div>
    <div class="col-sm-6"></div>
</div>

<div class="panel-group">
    <form  action="salvar_alteracao_licenca.php"  method="POST" name="frmlicenca" id="frmlicenca">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><strong>RAZÃO SOCIAL OU Pª FÍSICA / EMPREENDIMENTO / PROCESSO </strong></a>
                        </div>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">               
                                        <label for="empresa"><strong>RAZÃO SOCIAL / PESSOA FÍSICA *</strong></label><br/>
                                        <select  name="empresa" id="empresa" readonly="" class="form-control">                     
                                            <?php
                                            $licenca = "SELECT tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica,tb_licenca.codigo_licenca
                                                        FROM 
                                                        tb_empresa,tb_licenca
                                                        WHERE 
                                                        tb_licenca.fk4_codigo_empresa = tb_empresa.codigo_empresa AND codigo_licenca =  $codigo_licenca";
                                            $recebe_licencas = mysqli_query($con, $licenca);
                                            while ($linha = mysqli_fetch_array($recebe_licencas)) {
                                                echo '<option value="' . $linha['codigo_empresa'] . '">' . $linha['razaosocial_pessoafisica'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label for="processo"><strong>PROCESSO *</strong></label><br/>
                                        <select  name="processo" id="processo" readonly="" class="form-control">                     
                                            <?php
                                            $processo = "SELECT tb_processo.codigo_processo,tb_processo.assunto,tb_licenca.codigo_licenca
                                                        FROM 
                                                        tb_processo,tb_licenca
                                                        WHERE 
                                                        tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND codigo_licenca =  $codigo_licenca";
                                            $recebe_processo = mysqli_query($con, $processo);
                                            while ($linha = mysqli_fetch_array($recebe_processo)) {
                                                echo '<option value="' . $linha['codigo_processo'] . '">' . $linha['assunto'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label for="empreendimento"><strong>EMPREENDIMENTO *</strong></label><br/>
                                        <select  name="empreendimento" id="empreedimento" readonly="" class="form-control">                     
                                            <?php
                                            $empreendimento = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_licenca.codigo_licenca
                                                        FROM 
                                                        tb_empreendimento,tb_licenca
                                                        WHERE 
                                                        tb_licenca.fk1_codigo_empreendimento = tb_empreendimento.codigo_empreendimento AND codigo_licenca =  $codigo_licenca";
                                            $recebe_empreendimento = mysqli_query($con, $empreendimento);
                                            while ($linha = mysqli_fetch_array($recebe_empreendimento)) {
                                                echo '<option value="' . $linha['codigo_empreendimento'] . '">' . $linha['nome_empreendimento'] . '</option>';
                                            }
                                            ?>
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
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DA LICENÇA</strong></a>
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="numero_licenca"><strong>NÚMERO DA LICENÇA *</strong></label><br/>
                                        <input type="number" name="numero_licenca" id="numero_licenca" value="<?= $linha_sql['numero_licenca']; ?>" class="form-control"  autofocus="" />
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="ano_licenca"><strong>ANO DA LICENÇA *</strong></label><br/>
                                        <input  type="text" name="ano_licenca" id="ano_licenca" maxlength="4" value="<?= $linha_sql['ano_licenca']; ?>" class="form-control" autofocus/> 
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="data_emissao"><strong>DATA EMISSÃO *</strong></label><br/>
                                        <input type="date" name="data_emissao" id="data_emissao" value="<?= $linha_sql['data_emissao']; ?>" class="form-control" onblur="comparaDataAno()" />                                       
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="data_validade"><strong>DATA VALIDADE *</strong></label><br/>
                                        <input type="date" name="data_validade" id="data_validade" value="<?= $linha_sql['data_validade']; ?>" class="form-control" onblur="comparadatas()" autofocus/>                                     
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="descricao_atividade"><strong>ATIVIDADE A SER LICENCIADA *</strong></label><br>
                                        <input type="text" name="descricao_atividade" id="descricao_atividade" value="<?= $linha_sql['descricao_atividade']; ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>                
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <input type = "hidden" name = "codigo_licenca" value = "<?= $linha_sql['codigo_licenca']; ?>">
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


