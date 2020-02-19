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

$codigo_processo = $_GET['codigo_processo']; /* link dinamico utilizando o get */
$sql = "SELECT *FROM tb_processo WHERE codigo_processo = '$codigo_processo'";
$exe_sql = mysqli_query($con, $sql);
$linha_sql = mysqli_fetch_array($exe_sql);
?>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<link rel="stylesheet" href="css/estilo_alteraProcesso.css">

<script type="text/javascript">
    function comparaDataAno() {
        var ano = document.getElementById("ano").value;
        var data_processo = document.getElementById("data_processo").value;
        var data = data_processo.substr(0, 4); // pega só o ano
        if (ano !== data) {
            ano = document.getElementById("ano").value = '';
            alert("ERRO! O ANO INFORMADO, NÃO ESTÁ COM O MESMO ANO DA DATA DO PROCESSO");
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
                situacao_processo: {
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
                situacao_processo: {
                    required: "Campo Obrigatório*"

                }
            }
        });
    });
</script>
<div class="row">  
    <div class="col-sm-6">
        <h3><strong>ALTERAÇÃO PROCESSO</strong></h3>
    </div>
    <div class="col-sm-6"></div>
</div>

<div class="panel-group">
    <form  action="salvar_alteracao_processo.php"  method="POST" name="frmprocesso" id="frmprocesso">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DO PROCESSO</strong></a>
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">     
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="empresa"><strong>RAZÃO SOCIAL / PESSOA FÍSICA *</strong></label><br/>
                                        <select  name="empresa" id="empresa" readonly="" class="form-control">

                                            <?php
                                            $processo = "SELECT tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica,tb_processo.codigo_processo,tb_processo.numero_processo
                                                          FROM 
                                                          tb_empresa,tb_processo
                                                          WHERE
                                                          tb_processo.fk3_codigo_empresa = tb_empresa.codigo_empresa and codigo_processo = $codigo_processo";
                                            $recebe_empresas = mysqli_query($con, $processo);
                                            while ($linha = mysqli_fetch_array($recebe_empresas)) {
                                                echo '<option value="' . $linha['codigo_empresa'] . '">' . $linha['razaosocial_pessoafisica'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="empreedimento"><strong>EMPREENDIMENTO / ATIVIDADE *</strong></label><br/>
                                        <select  name="empreedimento" id="empreedimento"readonly="" class="form-control">

                                            <?php
                                            $empreendimento = "select tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_empreendimento.nome_atividade,tb_processo.codigo_processo,tb_processo.numero_processo
                                            FROM 
                                            tb_empreendimento,tb_processo
                                            WHERE
                                            tb_processo.fk4_codigo_empreendimento = tb_empreendimento.codigo_empreendimento and codigo_processo = $codigo_processo";
                                            $recebe_empreendimento = mysqli_query($con, $empreendimento);
                                            while ($linha = mysqli_fetch_array($recebe_empreendimento)) {
                                                echo '<option value="' . $linha['codigo_empreendimento'] . '">' . $linha['nome_empreendimento'] . '</option>';
                                                echo '<option value="' . $linha['codigo_empreendimento'] . '">' . $linha['nome_atividade'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="assunto"><strong>ASSUNTO *</strong></label><br/>
                                        <input type="text" name="assunto" id="assunto" value="<?= $linha_sql['assunto']; ?>"  class="form-control" />
                                    </div>
                                </div>
                            </div> 
                            <div class="row">                          
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="numero_processo"><strong>NÚMERO DO PROCESSO *</strong></label><br/>
                                        <input type="text" name="numero_processo" id="numero_processo"   value="<?= $linha_sql['numero_processo']; ?>" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="ano_processo"><strong>ANO *</strong></label><br/>
                                        <input type="text" name="ano" id="ano" value="<?= $linha_sql['ano']; ?>" onblur="comparaDataAno()" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="data_processo">DATA *</label>
                                        <input type="date" name="data_processo" id="data_processo" value="<?= $linha_sql['data_processo']; ?>" onblur="comparaDataAno()" class="form-control" />
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="situacao_processo">SITUAÇÃO</label>
                                        <!--<input type="text" name="situacao_processo" id="situacao_processo" value="<?= $linha_sql['situacao_processo']; ?>" class="form-control" />-->
                                        <select name="situacao_processo" id="situacao_processo" value="<?= $linha_sql['situacao_processo']; ?>"class="form-control">
                                            <option value="">SELECIONE</option>
                                            <option value="ABERTO">ABERTO</option>
                                            <option value="AGUARDANDO PAGAMENTO">AGUARDANDO PAGAMENTO</option>
                                            <option value="AGUARDANDO COMANDA">AGUARDANDO COMANDA</option>
                                            <option value="ANALISE">ANALISE</option>
                                            <option value="FISCALIZACAO">FISCALIZACAO</option>
                                            <option value="EMITIDO">EMITIDO</option>
                                            <option value="SEMREC">SEMREC</option>
                                            <option value="INDEFERIDO">INDEFERIDO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="situacao_processo">MOTIVO DA SITUAÇÃO</label>
                                        <input type="text" name="motivo_situacao" id="motivo_situacao" value="<?= $linha_sql['motivo_situacao']; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <input type = "hidden" name = "codigo_processo" value = "<?= $linha_sql['codigo_processo']; ?>">
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



