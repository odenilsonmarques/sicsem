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
$codigo_empreendimento = $_GET['codigo_empreendimento']; /* link dinamico utilizando o get */
$sql = "SELECT *FROM tb_empreendimento WHERE codigo_empreendimento = '$codigo_empreendimento'";
$exe_sql = mysqli_query($con, $sql);
$linha_sql = mysqli_fetch_array($exe_sql);
?>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<link rel="stylesheet" href="css/estilo_alteraEmpreendimento.css">

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
        $('#frmempreendimento').validate({
            //na linha abaixo sao criada as regras de validacao
            rules: {
               
                empresa: {
                    required: true
                },
                descricao_atividade: {
                    required: true,
                    minlength: 15,
                    isString: true
                },
                grau_atividade: {
                    required: true
                   
                }
               
            },
            //na  linha abaixo sao criada as mensagem que serao vista pelo usuarios
            messages: {
               
                empresa: {
                    required: "Campo Obrigatório*"
                },
                descricao_atividade: {
                    required: "Campo Obrigatório*",
                    minlength: "Descrição Inválida! Por Favor Informe Mais Detalhes"
                },
               
                telefone: {
                    required: "Campo Obrigatório*"
                },
                grau_atividade: {
                    required: "Campo Obrigatório*"
                }
            }
        });
    });
</script>
<div class="row">   
    <div class="col-sm-6">
        <h3><strong>ALTERAÇÃO EMPREENDIMENTO</strong></h3>
    </div>
    <div class="col-sm-6"></div>
</div>

<div class="panel-group">
    <form  action="salvar_alteracao_empreendimento.php"  method="POST" name="frmempreendimento" id="frmempreendimento">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DO EMPREENDIMENTO</strong></a>
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="empresa"><strong>RAZÃO SOCIAL E / OU Pª FÍSICA *</strong></label><br/>                                    
                                        <select  name="empresa" id="empresa" readonly="" class="form-control">

                                            <?php
                                            $empreendimento = "SELECT tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica,tb_empreendimento.codigo_empreendimento
                                                          FROM 
                                                          tb_empresa,tb_empreendimento
                                                          WHERE
                                                          tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa and codigo_empreendimento = $codigo_empreendimento";
                                            $recebe_empresas = mysqli_query($con, $empreendimento);
                                            while ($linha = mysqli_fetch_array($recebe_empresas)) {
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
                                        <label for="denominacao_comercial"><strong>DENOMINACAO COMERCIAL*</strong></label><br/>
                                        <input type="text" name="denominacao_comercial" id="denominacao_comercial" value="<?= $linha_sql['denominacao_comercial']; ?>" class="form-control">                 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="atividade_empreendimento"><strong>EMPREENDIMENTO / ATIVIDADE*</strong></label><br/>
                                        <input type="text" name="atividade_empreendimento" id="atividade_empreendimento" class="form-control" value="<?= $linha_sql['atividade_empreendimento']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" id="ATIV">
                                    <div class="form-group">
                                        <label for="nome_atividade"><strong>ATIVIDADE *</strong></label><br/>
                                        <input type="text" name="nome_atividade" id="nome_atividade" class="form-control" value="<?= $linha_sql['nome_atividade']; ?>"  />
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-sm-12">                                    
                                    <div class="form-group">
                                        <label for="grau_atividade"><strong>POTENCIAL POLUIDOR DA ATIVIDADE *</strong></label><br/>
                                        <select name="grau_atividade" id="grau_atividade" class="form-control"  value="<?= $linha_sql['grau_atividade']; ?>"/>                                                                            l">
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

                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><strong>LOGRADOURO</strong></a>
                        </div>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="nome_empreendimento"><strong>NOME DO EMPREENDIMENTO E / OU ATIVIDADE *</strong></label><br/>
                                        <input type="text" name="nome_empreendimento" id="nome_empreendimento" value="<?= $linha_sql['nome_empreendimento']; ?>" class="form-control"  autofocus="" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="nome_logradouro"><strong>RUA *</strong></label><br/>
                                        <input type="text" name="nome_logradouro" id="nome_logradouro" value="<?= $linha_sql['nome_logradouro']; ?>" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="numero_empreendimento"><strong>NÚMERO</strong></label><br/>
                                        <input type="text" name="numero_empreendimento" id="numero_empreendimento" value="<?= $linha_sql['numero_empreendimento']; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="complemento"><strong>COMPLEMENTO *</strong></label><br/>
                                    <input type="text" name="complemento" id="complemento" value="<?= $linha_sql['complemento']; ?>" class="form-control"/>
                                </div>
                                <div class="col-sm-3">
                                    <label for="localizacao_map_empre"><strong>LOCALIZAÇÃO MAP *</strong></label><br/>
                                    <input type="url" name="localizacao_map_empre" id="localizacao_map_empre" value="<?= $linha_sql['localizacao_map_empre']; ?>"  class="form-control"/>
                                </div>
                                <div class="col-sm-1">
                                    <label for="localizacao_map"><strong>MAPS</strong></label>
                                    <a href="https://www.google.com.br/maps/@-2.5683775,-44.0484718,15z" target="_blank"><img src="img/gmap.ico" width="50px" height="35px" style="margin-bottom: 5px"></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4" >
                                    <div class="form-group">
                                        <label for="nome_uf"><strong>ESTADO *</strong></label><br/>
                                        <input type="text" name="nome_uf" id="nome_uf" value="MARANHÃO" value="<?= $linha_sql['nome_uf']; ?>" readonly="" class="form-control" autofocus=""/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="nome_municipio"><strong>MUNICÍPIO *</strong></label><br/>
                                        <input type="text" name="nome_municipio" id="nome_municipio" value="SÃO JOSÉ DE RIBAMAR" value="<?= $linha_sql['nome_municipio']; ?>" readonly="" class="form-control" autofocus=""/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="bairro"><strong>BAIRRO *</strong></label><br/>
                                        <input type="text" name="nome_bairro" id="nome_bairro"  value="<?= $linha_sql['nome_bairro']; ?>"  class="form-control" autofocus=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <input type = "hidden" name = "codigo_empreendimento" value = "<?= $linha_sql['codigo_empreendimento']; ?>">
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

