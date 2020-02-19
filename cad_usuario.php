<?php
session_start();
require './config/conexao.php';
require './pages/header.php';

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:loginadmin.php");
    exit();
}
?>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<link rel="stylesheet" href="css/estilo_cad_empresa.css">

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
        $('#frmusuario').validate({
            //na linha abaixo sao criada as regras de validacao
            rules: {
                nome: {
                    required: true,
                    minlength: 5,
                    isString: true
                },
                email: {
                    required: true
                },
                cargo: {
                    required: true,
                    minlength: 5,
                    isString: true
                },
                matricula: {
                    required: true
                },
                nivel_acesso: {
                    required: true
                },
                senha: {
                    required: true
                }
            },
            //na  linha abaixo sao criada as mensagem que serao vista pelo usuarios
            messages: {
                nome: {
                    required: "Campo Obrigatório*",
                    minlength: "Nome Inválido!"
                },
                email: {
                    required: "Campo Obrigatório*"
                },
                cargo: {
                    required: "Campo Obrigatório*",
                    minlength: "Cargo Inválido!"
                },
                matricula: {
                    required: "Campo Obrigatório*"
                },
                nivel_acesso: {
                    required: "Campo Obrigatório*"
                },
                senha: {
                    required: "Campo Obrigatório*"
                }
            }
        });
    });
</script>

<!--este scritp garante que nos campos nº matricula e senha só serão aceitos numero positivos-->
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

<div class="row">  
    <div class="col-sm-12">
        <h3><strong>CADASTRO DE USUÁRIO</strong></h3>
    </div>
</div>

<div class="panel-group">
    <form  action="recebe_cad_usuario.php"  method="POST" name="frmusuario" id="frmusuario">
        <div class="row">    
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DO USUÁRIO</strong></a>
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="nome"><strong>NOME</strong></label><br/>
                                        <input type="text" name="nome" id="nome" class="form-control" placeholder="" autofocus=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email"><strong>E-MAIL</strong></label><br/>
                                        <input type="email" name="email" id="email" class="form-control" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="cargo"><strong>CARGO</strong></label><br/>
                                        <input type="text" name="cargo" id="cargo" class="form-control" placeholder=""/>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="nivel_acesso"><strong>NIVEL DE ACESSO</strong></label><br/>
                                        <select name="nivel_acesso" id="nivel_acesso" class="form-control">
                                            <option value="">SELECIONE</option>
                                            <option value="0">Administrador - SicSem</option>
                                            <option value="1">Administrativo</option>
                                            <option value="2">Educação Ambiental</option>
                                            <option value="3">Fiscalização</option>
                                            <option value="4">Gabinete</option>
                                            <option value="5">Licencimento</option>
                                            <option value="6">Protocolo</option>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="matricula"><strong>MATRICULA</strong></label><br/>
                                        <input type="text" name="matricula" id="matricula" onkeyup="somenteNumeros(this);" class="form-control" placeholder="Insira somente números"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="senha"><strong>SENHA</strong></label><br/>
                                        <input type="password" name="senha" id="senha" class="form-control" onkeyup="somenteNumeros(this);" placeholder="Insira somente números"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-title" style="text-align: center;"><br/>
                        <button type="submit" class="btn btn-success" style="font-size: 17px; font-weight: bold;">REALIZAR CADASTRO<span class="glyphicon glyphicon-saved" style="margin-left: 10px;"></span></button>
                        <button  class="btn btn-danger"><a href="inicioadm.php"style="text-decoration: none;color:#FFF">CANCELAR CADASTRO<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a></button><br/><br/>
                    </div>   
                </div>
            </div>
        </div>
    </form>

</div>
</body>
</html>

