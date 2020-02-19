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

$codigo_empresa = $_GET['codigo_empresa']; /* link dinamico utilizando o get */
$sql = "SELECT *FROM tb_empresa WHERE codigo_empresa = '$codigo_empresa'";
$exe_sql = mysqli_query($con, $sql);
$linha_sql = mysqli_fetch_array($exe_sql);
?>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/valida-documento.js"></script>
<link rel="stylesheet" href="css/estilo_alteraEmpresa.css">
<script type="text/javascript">
    function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('logradouro').value = ("");
        document.getElementById('bairro').value = ("");
        document.getElementById('municipio').value = ("");
        document.getElementById('uf').value = ("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('logradouro').value = (conteudo.logradouro);
            document.getElementById('bairro').value = (conteudo.bairro);
            document.getElementById('municipio').value = (conteudo.localidade);
            document.getElementById('uf').value = (conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');
        //Verifica se campo cep possui valor informado.
        if (cep !== "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
            //Valida o formato do CEP.
            if (validacep.test(cep)) {
                document.getElementById('logradouro').value = "...";
                document.getElementById('bairro').value = "...";
                document.getElementById('municipio').value = "...";
                document.getElementById('uf').value = "...";
                //Cria um elemento javascript.
                var script = document.createElement('script');
                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';
                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        }
        else {
            limpa_formulário_cep();
        }
    };
</script>

<script type="text/javascript">
    jQuery(function ($) {
        $('#pessoa_fisicajuridica').blur(function () {
            var campo = $(this).val();
            if (campo === "fisica") {
                $("#cnpj_cpf").mask("999.999.999-99");
            } else if (campo === "juridica") {
                $("#cnpj_cpf").mask("99.999.999/9999-99");
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#municipio').change(function () {
            $('#bairro').load('exibe_bairros.php?municipio=' + $('#municipio').val());
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        //Na linha abaixo, quando o form for submetido ele faz o validate 
        $('#frmempresapessoafisica').validate({
            //na linha abaixo sao criada as regras de validacao
            rules: {
                razaosocial_pessoafisica: {
                    required: true,
                    minlength: 5
                },
                nome_fantasia: {
                    required: true,
                    minlength: 5
                },
                pessoa_fisicajuridica: {
                    required: true
                },
                cnpj_cpf: {
                    required: true

                },
                logradouro: {
                    required: true
                },
                uf: {
                    required: true
                },
                municipio: {
                    required: true
                },
                bairro: {
                    required: true
                },
                telefone: {
                    required: true
                }
            },
            //na  linha abaixo sao criada as mensagem que serao vista pelo usuarios
            messages: {
                razaosocial_pessoafisica: {
                    required: "Campo Obrigatório*",
                    minlength: "Nome Inválido!"
                },
                nome_fantasia: {
                    required: "Campo Obrigatório*",
                    minlength: "Nome Inválido!"
                },
                pessoa_fisicajuridica: {
                    required: "Campo Obrigatório*"
                },
                cnpj_cpf: {
                    required: "Campo Obrigatório*"

                },
                logradouro: {
                    required: "Campo Obrigatório*"
                },
                uf: {
                    required: "Campo Obrigatório*"
                },
                municipio: {
                    required: "Campo Obrigatório*"
                },
                bairro: {
                    required: "Campo Obrigatório*"
                },
                telefone: {
                    required: "Campo Obrigatório*"
                }
            }
        });
    });
</script>

<div class="row">
    <div class="col-sm-6">
        <h3><strong>ALTERAÇÃO RAZÃO SOCIAL E / OU Pª FÍSICA</strong></h3>
    </div>
    <div class="col-sm-6"></div>
</div>
<div class="panel-group">
    <form  action="salvar_alteracao_empresa.php"  method="POST" name="frmempresapessoafisica" id="frmempresapessoafisica">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DA RAZÃO SOCIAL E / OU PESSOA FÍSICA</strong></a>                           
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">          
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="razaosocial_pessoafisica"><strong>RAZÃO SOCIAL E / OU PESSOA FÍSICA *</strong></label><br/>
                                        <input type="text" name="razaosocial_pessoafisica" id="razaosocial_pessoafisica" value="<?= $linha_sql['razaosocial_pessoafisica']; ?>" class="form-control" autofocus="" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nome_fantasia"><strong>NOME FANTASIA *</strong></label><br/>
                                        <input type="text" name="nome_fantasia" id="nome_fantasia" value="<?= $linha_sql['nome_fantasia']; ?>" class="form-control" autofocus  />
                                    </div>
                                </div>
                            </div>
                            <div class="row">                               
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pessoa_fisicajuridica"><strong>PESSOA JURÍDICA / FÍSICA*</strong></label><br/>
                                        <input type="text"  class="form-control" id="pessoa_fisicajuridica" name="pessoa_fisicajuridica" value="<?= $linha_sql['pessoa_fisicajuridica'];?>" readonly="">                   
                                    </div>
                                </div>
                                <div class = "col-sm-6" id = "JURIDICA">
                                    <div class = "form-group">
                                        <label for = "cnpj_cpf"><strong>CNPJ / CPF *</strong></label><br/>
                                        <input type = "text" name='cnpj_cpf' id='cnpj_cpf' value = "<?= $linha_sql['cnpj_cpf']; ?>" onblur="validaFormato(this);" onkeypress="return (apenasNumeros(event))" readonly="" class="form-control"/>
                                    </div>
                                </div>
                            </div>      
                        </div>
                    </div>
                </div>
                <div class = "panel panel-success">
                    <div class = "panel-heading">
                        <div class = "panel-title">
                            <a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse2" ><strong>LOGRADOURO</strong></a>
                        </div>
                    </div>
                    <div id = "collapse2" class = "panel-collapse collapse in">
                        <div class = "panel-body">
                            <div class = "row">
                                <div class = "col-sm-4">
                                    <div class = "form-group">
                                        <label for = "cep"><strong>CEP *</strong></label><br/>
                                        <input type = "text" name = "cep" id = "cep" value = "<?= $linha_sql['cep']; ?>" class = "form-control" onblur = "pesquisacep(this.value);"/>
                                    </div>
                                </div>

                                <div class = "col-sm-7">
                                    <div class = "form-group">
                                        <label for = "logradouro"><strong>RUA *</strong></label><br/>
                                        <input type = "text" name = "logradouro" id = "logradouro" value = "<?= $linha_sql['logradouro']; ?>" class = "form-control"/>
                                    </div>
                                </div>
                                <div class = "col-sm-1">
                                    <div class = "form-group">
                                        <label for = "numero"><strong>NÚMERO</strong></label><br/>
                                        <input type = "text" name = "numero" id = "numero" value = "<?= $linha_sql['numero']; ?>" class = "form-control" placeholder = "S/N"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="complemento"><strong>COMPLEMENTO *</strong></label><br/>
                                    <input type="text" name="complemento" id="complemento" value = "<?= $linha_sql['complemento']; ?>" class="form-control"/>
                                </div>
                                <div class="col-sm-3">
                                    <label for="localizacao_map"><strong>LOCALIZAÇÃO MAP *</strong></label><br/>
                                    <input type="url" name="localizacao_map" id="localizacao_map" value = "<?= $linha_sql['localizacao_map']; ?>" class="form-control"/>
                                </div>
                                <div class="col-sm-1">
                                    <label for="localizacao_map"><strong>MAPS</strong></label>
                                    <a href="https://www.google.com.br/maps/@-2.5683775,-44.0484718,15z" target="_blank"><img src="img/gmap.ico" width="50px" height="35px" style="margin-bottom: 5px"></a>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class = "col-sm-4" >
                                    <div class = "form-group">
                                        <label for = "uf"><strong>ESTADO *</strong></label><br/>
                                        <input type = "text" name = "uf" id = "uf" value = "<?= $linha_sql['uf']; ?>" class = "form-control">
                                    </div>
                                </div>
                                <div class = "col-sm-4" >
                                    <div class = "form-group">
                                        <label for = "municipio"><strong>MUNICÍPIO *</strong></label><br/>
                                        <input type = "text" name = "municipio" id = "municipio" value = "<?= $linha_sql['municipio']; ?>" class = "form-control">
                                    </div>
                                </div>
                                <div class = "col-sm-4">
                                    <div class = "form-group">
                                        <label for = "bairro"><strong>BAIRRO *</strong></label><br/>
                                        <input type = "text" name = "bairro" id = "bairro" value = "<?= $linha_sql['bairro']; ?>" class = "form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "panel panel-success">
                    <div class = "panel-heading">
                        <div class = "panel-title">
                            <a data-toggle = "collapse" data-parent = "#accordion" href = "#collapse3"><strong>CONTATOS</strong></a>
                        </div>
                    </div>
                    <div id = "collapse3" class = "panel-collapse collapse in">
                        <div class = "panel-body">
                            <div class = "row">
                                <div class = "col-sm-8">
                                    <div class = "form-group">
                                        <label for = "email"><strong>EMAIL</strong></label><br/>
                                        <input type = "email" name = "email" id = "email" value = "<?= $linha_sql['email']; ?>" class = "form-control"/>
                                    </div>
                                </div>
                                <div class = "col-sm-4">
                                    <div class = "form-group">
                                        <label for = "telefone"><strong>TELEFONE *</strong></label><br/>
                                        <input type = "text" name = "telefone" id = "telefone" value = "<?= $linha_sql['telefone']; ?>" class = "form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "panel panel-default">
                    <input type = "hidden" name = "codigo_empresa" value = "<?= $linha_sql['codigo_empresa']; ?>">
                    <div class = "panel-title" style = "text-align: center;"><br/>
                        <button type = "submit"  class = "btn btn-success" style = "font-size: 17px; font-weight: bold;">REALIZAR ALTERAÇÃO<span class="glyphicon glyphicon-saved" style="margin-left: 10px;"></span></button>
                        <button class = "btn btn-danger"><a href = "editar.php" style = "font-size: 17px; font-weight: bold; color: #fff;text-decoration: none;">CANCELAR ALTERAÇÃO<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a></button><br/><br/>
                    </div>
                </div>
            </dIv>
        </div>
    </form>
</div>
</body>
</html>

