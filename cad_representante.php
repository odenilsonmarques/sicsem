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
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/valida_cpf_representante.js"></script>

<script type="text/javascript" >
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
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    }
    ;

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
        $('#frmrepresentante').validate({
            //na linha abaixo sao criada as regras de validacao
            rules: {
                nome_representante: {
                    required: true,
                    minlength: 10,
                    isString: true
                },
                empresa: {
                    required: true
                },
                cpf: {
                    required: true
                },
                procuracao: {
                    required: true
                },
                cep: {
                    required: true,
                    minlength: 10
                },
                logradouro: {
                    required: true,
                    minlength: 5
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
                nome_representante: {
                    required: "Campo Obrigatório*",
                    minlength: "Nome Inválido!"
                },
                empresa: {
                    required: "Campo Obrigatório*"
                },
                cpf: {
                    required: "Campo Obrigatório*"
                },
                procuracao: {
                    required: "Campo Obrigatório*"
                },
                cep: {
                    required: "Campo Obrigatório*",
                    minlength: "Cep Inválido!"
                },
                logradouro: {
                    required: "Campo Obrigatório*",
                    minlength: "Endereço InválidoI"
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
    <div class="col-sm-12 text-center">
        <!--<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Exibir / Ocultar</button>-->
        <div class="alert alert-warning"><!---Alert-->
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><strong>&times;</strong></a>
            <p class="text-center"><strong>ATENÇÃO: TODOS OS CAMPOS COM ASTERISCOS (*) SÃO OBRIGATÓRIOS</strong></p>

        </div>
    </div>
</div>

<div class="row">   
    <div class="col-sm-6">
        <h3><strong>CADASTRO REPRESENTANTE</strong></h3>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3">     
        <div class="nav">
            <ul class="nav navbar-nav navbar-right" style="font-size: 14px;border-radius:5px;margin-right: 3px" >
                <li class="dropdown">
                    <a href=""  data-toggle="dropdown" class="btn btn-default">Ir Para <span class="caret"></span></a>
                    <ul class="dropdown-menu ">
                        <li><a href="cad_empresa.php"><strong><img src="img/man-with-company.png"> CADASTRO RAZÃO SOCIAL / Pª FÍSICA</strong></a></li>
                        <li><a href="cad_processo.php"><strong><img src="img/contract.png"> CADASTRO PROCESSO</strong></a></li>
                        <li><a href="cad_empreendimento.php"><strong><img src="img/construction-worker_1.png"> CADASTRO EMPREENDIMENTO</strong></a></li>
                        <li><a href="cad_licenca.php"><strong><img src="img/document_2.png"> CADASTRO LICENÇA</strong></a></li>
                        <li><a href="cad_notificacao.php"><strong><img src="img/notifications-button_1.png">CADASTRO NOTIFICAÇÃO</strong></a></li>
                        <li><a href="cad_autorizacao.php"><strong><img src="img/police-shield-with-a-star-symbol (2).png"> CADASTRO AUTORIZAÇÃO</strong></a></li>
                        <li><a href="consultar_empresas.php"style="color: #2e6da4"><strong><img src="img/office-block.png"> CONSULTAR RAZÃO SOCIAL / Pª FÍSICA</strong></a></li>
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
    <form  action="recebe_cad_representante.php"  method="POST" name="frmrepresentante" id="frmrepresentante">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DO REPRESENTANTE</strong></a>
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in ">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <!--<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Exibir / Ocultar</button>-->
                                    <div class="alert alert-warning"><!---Alert-->
                                        <!--<a href="#" class="close" data-dismiss="alert" aria-label="close"><strong>&times;</strong></a>-->
                                        <p><a href="consultar_representante.php"><strong>ANTES DE REALIZAR O CADASTRO, VERIFIQUE SE O REPRESENTANTE JÁ ESTÁ CADASTRADO - CLICANDO AQUI</strong></a></hP>
                                    </div>
                                </div>
                            </div>    

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="empresa"><strong>RAZÃO SOCIAL E / OU Pª FÍSICA *</strong></label><a href="cad_empresa.php" style="float: right;font-size: 16px" target="_blanck"><strong>caso não encontre,faça o cadastro - aqui</strong></a><br/>
                                        <select name="empresa" id="empresa" class="form-control">
                                            <option value="">SELECIONE</option>
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

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nome_representante"><strong>NOME DO REPRESENTANTE *</strong></label><br/>
                                        <input type="text" name="nome_representante" id="nome_representante" class="form-control" autofocus="" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="cpf"><strong>CPF *</strong></label><br/>
                                        <input type="text" name="cpf" id="cpf" onblur="validaFormato(this);" onkeypress="return (apenasNumeros(event))" class="form-control"/> 
                                        <div id="divResultado"></div>
                                        <!--<div id="divValido"></div>-->
                                        
                                        <style>
                                            #divResultado{
                                                font-family: serif;
                                                font-size: 14px;
                                                color: #000;
                                                margin-top:5px;
                                                font-weight: bold;
                                            }
                                            
                                        </style>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="procuracao"><strong>ANEXAR PROCURAÇÃO *</strong></label><br/>
                                        <select name="procuracao" id="procuracao" class="form-control">
                                            <option value="">SELECIONE</option>                                           
                                            <option value="SIM">SIM</option>
                                            <option value="NAO">NÃO</option>
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
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="cep"><strong>CEP *</strong></label><br/>
                                        <input type="text" name="cep" id="cep" class="form-control" onblur="pesquisacep(this.value);"/>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="logradouro"><strong>RUA *</strong></label><br/>
                                        <input type="text" name="logradouro" id="logradouro" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="numero"><strong>NÚMERO</strong></label><br/>
                                        <input type="text" name="numero" id="numero" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-sm-4" >
                                    <div class="form-group">
                                        <label for="uf"><strong>ESTADO *</strong></label><br/>
                                        <input type="text" name="uf" id="uf" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="municipio"><strong>MUNICÍPIO *</strong></label><br/>
                                        <input type="text" name="municipio" id="municipio" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="bairro"><strong>BAIRRO *</strong></label><br/>
                                        <input type="text" name="bairro" id="bairro" class="form-control">
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
                                        <input type="email" name="email" id="email" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="telefone"><strong>TELEFONE *</strong></label><br/>
                                        <input type="text" name="telefone" id="telefone" class="form-control" />
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
</body>
</html>

