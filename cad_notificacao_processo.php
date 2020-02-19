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
?>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>



<script type="text/javascript">

    $(document).ready(function () {
        $("input[name='numero_notificacao']").blur(function () {

            
            var $descricao_prazo = $("input[name='descricao_prazo']");
            var $profissao_atividade = $("input[name='profissao_atividade']");
            var $status_informacoes_adicionais = $("input[name='status_informacoes_adicionais']");
            var $numero_notificacao_anterior = $("input[name='numero_notificacao_anterior']");
            var $numero_processo_notificacao = $("input[name='numero_processo_notificacao']");
            var $status_licenca = $("input[name='status_licenca']");
            var $numero_licenca_notificacao = $("input[name='numero_licenca_notificacao']");
            var $orgao_emissor_licenca = $("input[name='orgao_emissor_licenca']");
            var $data_validade = $("input[name='data_validade']");
            
            
            $.getJSON('function.php', {
                numero_notificacao: $(this).val()
            }, function(json) {
                
                $descricao_prazo.val(json.descricao_prazo);
                $profissao_atividade.val(json.profissao_atividade);
                $status_informacoes_adicionais.val(json.status_informacoes_adicionais);
                $numero_notificacao_anterior.val(json.numero_notificacao_anterior);
                $numero_processo_notificacao.val(json.numero_processo_notificacao);
                $status_licenca.val(json.status_licenca);
                $numero_licenca_notificacao.val(json.numero_licenca_notificacao);
                $orgao_emissor_licenca.val(json.orgao_emissor_licenca);
                $data_validade.val(json.data_validade);
                
            });
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
                    required: true
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
                status_notificado: {
                    required: true
                },

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
                    required: "Campo Obrigatório*"
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
                status_notificado: {
                    required: "Campo Obrigatório*"
                },
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
    <div class="col-sm-12">
        <?php
        if (isset($_SESSION['msgcad'])) {
            echo $_SESSION['msgcad'];
            unset($_SESSION['msgcad']);
        }
        if (isset($_SESSION['msgcad'])) {
            echo $_SESSION['msgcad'];
            unset($_SESSION['msgcad']);
        }
        ?>
    </div>
    <div class="col-sm-12">
        <h3><strong>CADASTRO NOTIFICAÇÃO</strong></h3>
    </div>
</div>

<div class="panel-group">
    <form  action=""  method="POST" name="frmnotificacao" id="frmnotificacao">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <strong>DADOS DA NOTIFICAÇÃO</strong>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="empresa"><strong>RAZÃO SOCIAL / NOME</strong></label><br/>
                                    <!--<input type="text" name="empresa" id="empresa" class="form-control" autofocus  />-->
                                    <select name="empresa" class="form-control"></select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="numero_notificacao"><strong>Nº NOTIFICAÇÃO</strong></label><br/>
                                    <input type="text" name="numero_notificacao" id="numero_notificacao" class="form-control" autofocus  />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="data_hora_notificacao"><strong>DATA E HORA DA NOTIFICAÇÃO</strong></label><br/>
                                    <input type="datetime-local" name="data_hora_notificacao" id="data_hora_notificacao" class="form-control" autofocus  />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="data_hora_comparecimento"><strong>DATA E HORA PARA COMPARECIMENTO</strong></label><br/>
                                    <input type="datetime-local" name="data_hora_comparecimento" id="data_hora_comparecimento" class="form-control" onblur="comparadatas()"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="profissao_atividade"><strong>PROFISSÃO E / OU  ATIVIDADE REALIZADA</strong></label><br/>
                                    <input type="text" name="profissao_atividade" id="profissao_atividade" class="form-control" autofocus  />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="descricao_prazo"><strong>DESCRICÃO E PRAZO</strong></label><br/>
                                    <input type="text" name="descricao_prazo" id="descricao_prazo" class="form-control" autofocus/>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <strong>INFORMAÇÕES ADICIONAIS (NOTIFICAÇÃO / PROCESSO / LICENÇA)</strong>
                        </div>
                    </div>                   
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="status_informacoes_adicionais"><strong>HÁ INFORMAÇÕES ADICIONAIS ?</strong></label><br/>
                                    <input type="text" name="status_informacoes_adicionais" id="status_informacoes_adicionais" class="form-control"/>
                                </div>
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="col-sm-6" id="NUMNOTANTERIOR">
                                <div class="form-group">
                                    <label for="numero_notificacao_anterior"><strong>NÚMERO DA NOTICAÇÃO ANTERIOR</strong></label><br/>
                                    <input type="text" name="numero_notificacao_anterior" id="numero_notificacao_anterior" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-6" id="NUMPROANTERIOR">
                                <div class="form-group">
                                    <label for="numero_processo_notificacao"><strong>NÚMERO DO PROCESSO DA NOTIFICAÇÃO ANTERIOR</strong></label><br/>
                                    <input type="text" name="numero_processo_notificacao" id="numero_processo_notificacao" class="form-control" placeholder=""/>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12" id="LICENCAANTERIOR">
                                <div class="form-group">
                                    <label for="status_licenca"><strong>HÁ LICENCA AMBIENTAL?</strong></label><br/>
                                    <input type="text" name="status_licenca" id="status_licenca" class="form-control" placeholder=""/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4" id="NUMLICENCA">
                                <div class="form-group" >
                                    <label for="numero_licenca_notificacao"><strong>NUMERO DA LICENÇA</strong></label><br/>
                                    <input type="text" name="numero_licenca_notificacao" id="numero_licenca_notificacao" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-4" id="ORGAOEMISSOR">
                                <div class="form-group" >
                                    <label for="orgao_emissor_licenca"><strong>ORGÃO EMITENTE DA LICENÇA</strong></label><br/>
                                    <input type="text" name="orgao_emissor_licenca" id="orgao_emissor_licenca" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4" id="DATAVALIDADE">
                                <div class="form-group" >
                                    <label for="data_validade"><strong>DATA VALIDADE</strong></label><br/>
                                    <input type="date" name="data_validade" id="data_validade" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <strong>DADOS DO RESPONSÁVEL E / OU NOTIFICADO</strong>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="status_notificado"><strong>O NOTIFICADO INFORMOU SEU DADOS ?</strong></label><br/>
                                    <input type="status_notificado" name="status_notificado" id="status_notificado" class="form-control"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8" id="NOMENOTIFICADO">
                                <div class="form-group">
                                    <label for="nome_notificado"><strong>NOME DO NOTIFICADO E / OU REPONSÁVEL</strong></label><br/>
                                    <input type="nome_notificado" name="nome_notificado" id="nome_notificado" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-4" id="CPFNOTIFICADO">
                                <div class="form-group">
                                    <label for="cpf"><strong>CPF</strong></label><br/>
                                    <input type="text" name="cpf" id="cpf" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6" id="LOGRADOURONOTIFICADO">
                                <div class="form-group">
                                    <label for="logradouro"><strong>LOGRADOURO</strong></label><br/>
                                    <input type="logradouro" name="logradouro" id="logradouro" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-sm-2" id="NUMERONOTIFICADO">
                                <div class="form-group">
                                    <label for="numero"><strong>NÚMERO</strong></label><br/>
                                    <input type="text" name="numero" id="numero" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-4" id=BAIRRONOTIFICADO>
                                <div class="form-group">
                                    <label for="bairro"><strong>BAIRRO</strong></label><br/>
                                    <input type="text" name="bairro" id="bairro" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" id="TESTEMUNHANOTIFICADO">
                                <div class="form-group">
                                    <label for="testemunha"><strong>NOME DA TESTEMUNHA</strong></label><br/>
                                    <input type="text" name="testemunha" id="testemunha" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <strong>DADOS DO FISCAL E CHEFE DE FISCALIZAÇÃO</strong>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="fiscal"><strong>FISCAL</strong></label><br/>
                                    <input type="text" name="fiscal" id="fiscal" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="chefe"><strong>CHEFE DE FISCALIZAÇÃO</strong></label><br/>
                                    <input type="text" name="chefe" id="chefe" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel panel-default">
                    <div class="panel-title" style="text-align: center;"><br/>
                        <input type="submit" value="REALIZAR CADASTRO" class="btn btn-success" style="font-size: 17px; font-weight: bold">
                        <button  class="btn btn-danger"><a href="home.php"  style="font-size: 17px; font-weight: bold; color: #fff;text-decoration: none;">CANCELAR CADASTRO</a></button><br/><br/>
                    </div>   
                </div>
            </dIv>
        </div>
    </form>
</div>
</body>
</html>

