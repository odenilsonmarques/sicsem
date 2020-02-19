<meta charset="UTF-8">
<?php
session_start();
setcookie("ck_authorized", "true", 0, "/");
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

<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/valida-documento.js"></script>
<link rel="stylesheet" type="text/css"  href="css/jquery-ui.min.css">
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/estilo_cad_empresa.css">

<script type='text/javascript' >
    $(function () {
        $("#razaosocial_pessoafisica").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "auto_complete_contribuinte.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $('#razaosocial_pessoafisica').val(ui.item.label); // display the selected text
                $('#selectuser_id').val(ui.item.value); // save selected id to input
                
                return false;
            }
        });
    });
</script>


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

<!--O SCRIPT ABAIXO TEM COMO PROPÓSITO RESETAR OS CAMPOS REFERENTES AO ENDEREÇOS -->
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
            alert("CEP NÃO ENCONTRADO!");
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
                //Preenche os campos com "..." enquanto consulta webservice.
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
                alert("FORMATO DE CEP INVÁLIDO!");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }
    ;</script>
<!--O SCRIPT ACIMA TEM COMO PROPÓSITO RESETAR OS CAMPOS REFERENTES AO ENDEREÇOS -->

<!--O SCRIPT ABAIXO TEM COMO PROPÓSITO PREENCHER OS CAMPO DE ENDEREÇO DINAMICAMENTE, ASSIM QUE FOR INFORMADO O CEP -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#municipio').change(function () {
            $('#bairro').load('exibe_bairros.php?municipio=' + $('#municipio').val());
        });
    });</script>
<!--O SCRIPT ACIMA TEM COMO PROPÓSITO PREENCHER OS CAMPO DE ENDEREÇO DINAMICAMENTE, ASSIM QUE FOR INFORMADO O CEP -->

<!--O scritp ABAIXO TEM COMO PROPÓSITO, APLICAR UMA MASCARA NOS CAMPOS CPF/CNPJ QUANDO FOR SELECIONADO UMA OPÇÃO-->
<script type="text/javascript">
    jQuery(function ($) {
        $('#pessoa_fisicajuridica').change(function () {
            var campo = $(this).val();
            if (campo === "física") {
                $("#cnpj_cpf").val('');
                $("#cnpj_cpf").mask("999.999.999-99");
            } else if (campo === "jurídica") {
                $("#cnpj_cpf").val('');
                $("#cnpj_cpf").mask("99.999.999/9999-99");
            }
        });
    });
</script>
<!--O scritp ACIMA TEM COMO PROPÓSITO, APLICAR UMA MASCARA NOS CAMPOS CPF/CNPJ QUANDO FOR SELECIONADO UMA OPÇÃO-->

<!--O scritp ABAIXO TEM COMO PROPÓSITO, APLICAR UMA SEGURANÇA NO FRONT-END, EXIGINDO QUE OS INPUT SEJAM PREENCHIDOS -->
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
                localizacao_map: {
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
                    minlength: "Razão Social / Pª Física Inválido!"
                },
                nome_fantasia: {
                    required: "Campo Obrigatório*",
                    minlength: "Nome Fantasia Inválido!"
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
                localizacao_map: {
                    required: "Campo Obrigatório*"
                },
                telefone: {
                    required: "Campo Obrigatório*"
                }
            }
        });
    });</script>


<div class="row">  
    <div class="col-sm-6">
        <h3><strong>CADASTRO RAZÃO SOCIAL / PESSOA FÍSICA</strong></h3>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3" style="text-align:right;">  
        <button class="btn btn-danger"><a href="cadastros.php" style="text-decoration: none;font-size: 14px;color:#fff"><strong>CANCELAR</strong><span class="glyphicon glyphicon-remove" style="margin-left: 5px;"></span></a></button>
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">-------  <strong>IR PARA</strong> -------
            <span class="caret"></span></button>
        <ul class="dropdown-menu">     
            <li><a href="cadastros.php" style="font-weight:bold; color:#006600; text-decoration:none;margin-right: 20px">CADASTRO<span class="glyphicon glyphicon-plus" style="margin-left: 5px"></a></li>          
            <li><a href="cad_empreendimento.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR EMPREENDIMENTO / ATIVIDADE<span class="glyphicon glyphicon-stats" style="margin-left: 5px"></a></li>
            <li><a href="cad_atividade.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR ATIVIDADE PARA UM EMPREENDIMENTO<span class="glyphicon glyphicon-briefcase" style="margin-left: 5px"></a></li>
            <li><a href="cad_processo.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR PROCESSO<span class="glyphicon glyphicon-list-alt" style="margin-left: 5px"></a></li>
            <li><a href="cad_licenca.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR LICENÇA<span class="glyphicon glyphicon-duplicate" style="margin-left: 5px"></a></li>
            <li><a href="cad_notificacao.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR NOTIFICAÇÃO<span class="glyphicon  glyphicon-bell" style="margin-left: 5px"></a></li>
            <li><a href="cad_infracao.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR AUTO DE INFRAÇÃO<span class="glyphicon  glyphicon-alert" style="margin-left: 5px"></a></li>
            <li><a href="inicio.php" style="font-weight:bold; color:#0A246A; text-decoration:none;margin-right: 15px">CONSULTA<span class="glyphicon glyphicon-search" style="margin-left: 5px"></a></li>
            <li><a href="consultar_empresas.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR RAZÃO SOCIAL / PESSOA FÍSICA<span class="glyphicon glyphicon-home" style="margin-left: 5px"></a></li>
            <li><a href="#" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR EMPREENDIMENTO / ATIVIDADE<span class="glyphicon glyphicon-stats" style="margin-left: 5px"></a></li>
            <li><a href="consultar_atividades.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR ATIVIDADE PARA UM EMPREENDIMENTO<span class="glyphicon glyphicon-briefcase" style="margin-left: 5px"></a></li>
            <li><a href="consultar_processos.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR PROCESSO<span class="glyphicon glyphicon-list-alt" style="margin-left: 5px"></a></li>
            <li><a href="consultar_licencas.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR LICENÇA<span class="glyphicon glyphicon-duplicate" style="margin-left: 5px"></a></li>
            <li><a href="consultar_notificacoes.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR NOTIFICAÇÃO<span class="glyphicon glyphicon-bell" style="margin-left: 5px"></a></li>
            <li><a href="#" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">CONSULTAR AUTO DE INFRAÇÕES<span class="glyphicon glyphicon-alert" style="margin-left: 5px"></a></li>
            
            <li>
                <?php if ($_SESSION['nivel_acesso'] == "4" || $_SESSION['nivel_acesso'] == "5" || $_SESSION['nivel_acesso'] == "6") {
                    ?>  
                    <a href="editar.php" style="color:#2e6da4">
                        <strong>REALIZAR EDICÃO<span class="glyphicon glyphicon-pencil" style="margin-left: 10px"></strong></a>
                    <?php
                } else {
                    ?>                        
                    <a href="#myModal" data-toggle="modal" style="color:#2e6da4" >
                        <strong>REALIZAR EDICÃO<span class="glyphicon glyphicon-pencil" style="margin-left: 10px"></strong></a><?php }
                ?>                  
            </li>
            <li><a href="cadastros.php" style="font-weight:bold; color: #ce8483">CANCELAR<span class="glyphicon glyphicon-remove" style="margin-left: 5px"></a></li>
            <li><a href="logout.php" style="font-weight:bold; color: #ce8483">SAIR DO SISTEMA<span class="glyphicon glyphicon-off" style="margin-left: 5px"></a></li>
        </ul>
    </div>
</div>
<div class="panel-group">
    <form  action="recebe_cad_empresa.php"  method="POST" name="frmempresapessoafisica" id="frmempresapessoafisica">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DA RAZÃO SOCIAL / PESSOA FÍSICA - <span style="color: #d58512">Atenção Todos os Campos Com Asteriscos(*) São Obrigatórios</span></strong></a>                           
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12 text-center"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="razaosocial_pessoafisica"><strong>RAZÃO SOCIAL / PESSOA FÍSICA *</strong></label><br/>
                                        <input type="text" name="razaosocial_pessoafisica" id="razaosocial_pessoafisica"  class="form-control" autocomplete="on|of"/>                                                   
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nome_fantasia"><strong>NOME FANTASIA *</strong></label><br/>
                                        <input type="text" name="nome_fantasia" id="nome_fantasia" class="form-control" autocomplete="on|of"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pessoa_fisicajuridica"><strong>PESSOA JURÍDICA / FÍSICA*</strong></label><br/>
                                        <select name="pessoa_fisicajuridica" id="pessoa_fisicajuridica" class="form-control" autocomplete="on|of">
                                            <option  value="">SELECIONE</option>
                                            <option  value="física">FÍSICA</option>
                                            <option  value="jurídica">JURÍDICA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6" id="JURIDICA">
                                    <div class="form-group">
                                        <label for="cnpj_cpf"><strong>CNPJ / CPF *</strong></label><br/>
                                        <input type="text" name="cnpj_cpf" id="cnpj_cpf" onblur="validaFormato(this);" onkeypress="return (apenasNumeros(event))" class="form-control" autocomplete="off"/>                                        
                                        <div id="divResultado"></div>                                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" ><strong>LOGRADOURO</strong></a>
                        </div>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="cep"><strong>CEP *</strong></label><br/>
                                        <input type="text" name="cep" id="cep" class="form-control" onblur="pesquisacep(this.value);" autocomplete="on|of"/>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="logradouro"><strong>RUA *</strong></label><br/>
                                        <input type="text" name="logradouro" id="logradouro" class="form-control" autocomplete="on|of"/>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="numero"><strong>NÚMERO</strong></label><br/>
                                        <input type="text" name="numero" id="numero" class="form-control" placeholder="S/N" autocomplete="on|of"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <label for="complemento"><strong>COMPLEMENTO *</strong></label><br/>
                                    <input type="text" name="complemento" id="complemento" class="form-control" autocomplete="on|of"/>
                                </div>
                                <div class="col-sm-3">
                                    <label for="localizacao_map"><strong>LOCALIZAÇÃO MAP *</strong></label><br/>
                                    <input type="url" name="localizacao_map" id="localizacao_map" class="form-control" autocomplete="on|of"/>
                                </div>
                                <div class="col-sm-1">
                                    <label for="localizacao_map"><strong>MAPS</strong></label>
                                    <a href="https://www.google.com.br/maps/@-2.5683775,-44.0484718,15z" target="_blank"><img src="img/gmap.ico" width="50px" height="35px" style="margin-bottom: 5px"></a>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="uf"><strong>ESTADO *</strong></label><br/>
                                        <input type="text" name="uf" id="uf" class="form-control" onKeypress="return letras(event)" autocomplete="on|of">
                                    </div>
                                </div>
                                <div class="col-sm-4" >
                                    <div class="form-group">
                                        <label for="municipio"><strong>MUNICÍPIO *</strong></label><br/>
                                        <input type="text" name="municipio" id="municipio" class="form-control" onKeypress="return letras(event)" autocomplete="on|of">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="bairro"><strong>BAIRRO *</strong></label><br/>
                                        <input type="text" name="bairro" id="bairro" class="form-control" onKeypress="return letras(event)" autocomplete="on|of">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><strong>CONTATOS</strong></a>
                        </div>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="email"><strong>EMAIL</strong></label><br/>
                                        <input type="email" name="email" id="email" class="form-control" autocomplete="on|of"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="telefone"><strong>TELEFONE *</strong></label><br/>
                                        <input type="text" name="telefone" id="telefone" class="form-control" autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-title" style="text-align: center;"><br/>
                        <button type="submit" class="btn btn-success" style="font-size: 17px; font-weight: bold;">REALIZAR CADASTRO<span class="glyphicon glyphicon-saved" style="margin-left: 10px;"></span></button>
                        <button  class="btn btn-danger"><a href="cadastros.php"style="text-decoration: none;color:#FFF">CANCELAR CADASTRO<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a></button><br/><br/>
                    </div>   
                </div>
            </dIv>
        </div>
    </form>
</div>
</body>
</html>

