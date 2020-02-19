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
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/validaempreendimento.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/estilo_cadEmpreendimento.css">

<script type="text/javascript">
    $(document).ready(function () {
        $('#empresa').change(function () {
            $('#denominacao_comercial').load('exibe_denominacao_comercial.php?empresa=' + $('#empresa').val());
        });
    });
</script>

<script type='text/javascript' >
    $(function () {
        $("#nome_atividade").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "auto_complete_licenca.php",
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
                $('#nome_atividade').val(ui.item.label); // display the selected text
                $('#selectuser_id').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });
</script>


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
        $('#frmempreendimento').validate({
            //na linha abaixo sao criada as regras de validacao
            rules: {
                empresa: {
                    required: true
                },
                nome_empreendimento: {
                    required: true,
                    minlength: 5
                },
                atividade_empreendimento: {
                    required: true
                },
                descricao_atividade: {
                    required: true,
                    minlength: 15,
                    isString: true
                },
                grau_atividade: {
                    required: true
                },
                nome_logradouro: {
                    required: true,
                    minlength: 5
                },
                nome_atividade: {
                    required: true
                },
                nome_bairro: {
                    required: true
                },
//                complemento: {
//                    required: true,
//                    minlength: 10
//                },
                localizacao_map_empre: {
                    required: true
                }
            },
            //na  linha abaixo sao criada as mensagem que serao vista pelo usuarios
            messages: {
                empresa: {
                    required: "Campo Obrigatório*"
                },
                nome_empreendimento: {
                    required: "Campo Obrigatório*",
                    minlength: "Nome do Empreendimento Inválido! Por Favor Informe Mais Detalhes"
                },
                atividade_empreendimento: {
                    required: "Campo Obrigatório*"
                },
                descricao_atividade: {
                    required: "Campo Obrigatório*",
                    minlength: "Descrição Inválida! Por Favor Informe Mais Detalhes"
                },
                grau_atividade: {
                    required: "Campo Obrigatório*"
                },
                nome_logradouro: {
                    required: "Campo Obrigatório*",
                    minlength: "Endereço Inválido! Por Favor Informe Mais Detalhes"
                },
                nome_atividade: {
                    required: "Campo Obrigatório*"
                },
                nome_bairro: {
                    required: "Campo Obrigatório*"
                },
                telefone: {
                    required: "Campo Obrigatório*"
                },
//                complemento: {
//                    required: "Campo Obrigatório*",
//                    minlength: "Complemento Inválido, Por Favor Informe Mais Detalhes"
//                },
                localizacao_map_empre: {
                    required: "Campo Obrigatório*"

                }
            }
        });
    });
</script>
<!--O scritp ACIMA TEM COMO PROPÓSITO, APLICAR UMA SEGURANÇA NO FRONT-END, EXIGINDO QUE OS INPUT SEJAM PREENCHIDOS -->

<div class="row">  
    <div class="col-sm-6">
        <h3><strong>CADASTRO EMPREENDIMENTO / ATIVIDADE</strong></h3>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3" style="text-align:right;">  
        <button class="btn btn-danger"><a href="cadastros.php" style="text-decoration: none;font-size: 14px;color:#fff"><strong>CANCELAR</strong><span class="glyphicon glyphicon-remove" style="margin-left: 5px;"></span></a></button>
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">-------  <strong>IR PARA</strong> -------
            <span class="caret"></span></button>
        <ul class="dropdown-menu">     
            <li><a href="cadastros.php" style="font-weight:bold; color:#006600; text-decoration:none;margin-right: 20px">CADASTRO<span class="glyphicon glyphicon-plus" style="margin-left: 5px"></a></li>
            <li><a href="cad_empresa.php" style="font-weight:bold; color:#67b168; text-decoration:none;margin-right: 20px">CADASTRAR RAZÃO SOCIAL / PESSOA FÍSICA<span class="glyphicon glyphicon-home" style="margin-left: 5px"></a></li>         
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
                <?php if ($_SESSION['nivel_acesso'] == "4" || $_SESSION['nivel_acesso'] == "5" || $_SESSION['nivel_acesso'] == "6")  {
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
<form  action="recebe_cad_empreendimento.php"  method="POST" name="frmempreendimento" id="frmempreendimento">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading"> 
                    <div class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DO EMPREENDIMENTO / ATIVIDADE - <span style="color: #d58512">Atenção Todos os Campos Com Asteriscos(*) São Obrigatórios</span></strong></a>
                    </div>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <style type="text/css">
                                #LOGRADOURO,#ATIV,#ATIV_GRAU
                                {
                                    display:none;
                                }
                            </style>

                            <script type="text/javascript">
                                function mostrardivinformacoes(valor) {
                                    if (valor === "EMPREENDIMENTO") {
                                        document.getElementById("LOGRADOURO").style.display = "block";
                                        document.getElementById("ATIV").style.display = "none";
                                        document.getElementById("ATIV_GRAU").style.display = "none";
                                    } else if (valor === "ATIVIDADE") {
                                        document.getElementById("ATIV").style.display = "block";
                                        document.getElementById("ATIV_GRAU").style.display = "block";
                                        document.getElementById("LOGRADOURO").style.display = "none";
                                    }
                                }
                            </script>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="empresa"><strong> RAZÃO SOCIAL / PESSOA FÍSICA *</strong></label>                                   
                                    <select name="empresa" id="empresa" class="form-control" autofocus="" onblur="verificaCampo()">
                                        <option value="">SELECIONE</option>
                                        <?php
                                        $empresa = "SELECT codigo_empresa, razaosocial_pessoafisica FROM tb_empresa ORDER BY codigo_empresa DESC";
                                        $recebe_empresas = mysqli_query($con, $empresa);
                                        while ($linha = mysqli_fetch_array($recebe_empresas)) {
                                            echo '<option value="' . $linha['codigo_empresa'] . '">' . $linha['razaosocial_pessoafisica'] . '</option>';
                                            echo '<option></option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
<!--                            <div class="col-sm-12" >
                                <div class="form-group">
                                    <label for="denominacao_comercial"><strong>DENOMINACÃO COMERCIAL / NOME FANTASIA*</strong></label><br/>
                                    <select  name="denominacao_comercial" id="denominacao_comercial" class="form-control">  
                                        <option value="" selected="selected">SELECIONE</option>  
                                    </select>
                                </div>
                            </div>-->
                        </div>    
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="atividade_empreendimento"><strong>EMPREENDIMENTO / ATIVIDADE*</strong></label><br/>
                                    <select name="atividade_empreendimento" id="atividade_empreendimento" class="form-control" onchange="mostrardivinformacoes(this.value)">
                                        <option value="">SELECIONE</option>
                                        <option value="EMPREENDIMENTO">EMPREENDIMENTO</option>
                                        <option value="ATIVIDADE">ATIVIDADE</option>
                                    </select>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-sm-12" id="ATIV">
                                <div class="form-group">
                                    <label for="nome_atividade"><strong>ATIVIDADE A LICENCIAR *</strong></label><br/>
                                    <input type="text" name="nome_atividade" id="nome_atividade" class="form-control" placeholder="Campo Obrigatório" autocomplete="on|of"/>                          
                                </div>
                            </div>
                        </div>
                        <div class="row" id="ATIV_GRAU">
                            <div class="col-sm-12">                                    
                                <div class="form-group">
                                    <label for="grau_atividade"><strong>POTENCIAL POLUIDOR DA ATIVIDADE *</strong></label><br/>
                                    <select name="grau_atividade" id="grau_atividade" class="form-control" />                                                                            
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
            <div class="panel panel-success" id="LOGRADOURO" >
                <div class="panel-heading"> 
                    <div class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><strong>LOGRADOURO</strong></a>
                    </div>
                </div>
                <div id="collapse2" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12" >
                                <div class="form-group">
                                    <label for="nome_empreendimento"><strong>NOME DO EMPREENDIMENTO*</strong></label><br/>
                                    <input type="text" name="nome_empreendimento" id="nome_empreendimento" class="form-control" placeholder="Campo Obrigatório"  autocomplete="off"/>
                                </div>
                            </div>                                               
                        </div> 
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="nome_logradouro"><strong>RUA *</strong></label><br/>
                                    <input type="text" name="nome_logradouro" id="nome_logradouro" class="form-control" placeholder="Campo Obrigatório" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="numero_empreendimento"><strong>NÚMERO</strong></label><br/>
                                    <input type="text" name="numero_empreendimento" id="numero_empreendimento" class="form-control" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <label for="complemento"><strong>COMPLEMENTO *</strong></label><br/>
                                <input type="text" name="complemento" id="complemento" class="form-control" autocomplete="off"/>
                            </div>
                            <div class="col-sm-3">
                                <label for="localizacao_map_empre"><strong>LOCALIZAÇÃO MAP *</strong></label><br/>
                                <input type="url" name="localizacao_map_empre" id="localizacao_map_empre" class="form-control" autocomplete="off"/>
                            </div>
                            <div class="col-sm-1">
                                <label for="localizacao_map"><strong>MAPS</strong></label>
                                <a href="https://www.google.com.br/maps/@-2.5683775,-44.0484718,15z" target="_blank"><img src="img/gmap.ico" width="50px" height="35px" style="margin-bottom: 5px"></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4" >
                                <div class="form-group">
                                    <label for="nome_uf"><strong>ESTADO </strong></label><br/>
                                    <input type="text" name="nome_uf" id="nome_uf" value="MARANHÃO" readonly="" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-4" >
                                <div class="form-group">
                                    <label for="nome_municipio"><strong>MUNICÍPIO </strong></label><br/>
                                    <input type="text" name="nome_municipio" id="nome_municipio" value="SÃO JOSÉ DE RIBAMAR" readonly="" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="nome_bairro"><strong>BAIRRO *</strong></label><br/>
                                    <select name="nome_bairro" id="nome_bairro"   class="form-control">
                                        <option value="">SELECIONE</option>
                                        <option value="Alonso Costa">Alonso Costa</option>
                                        <option value="Alto do Itapiraco">Alto do Itapiraco</option>
                                        <option value="Altos do Turu">Altos do Turu</option>
                                        <option value="Altos do Turu I">Altos do Turu I</option>
                                        <option value="Alto do Turu II">Alto do Turu II</option>
                                        <option value="Alto do Turu III">Alto do Turu III</option>
                                        <option value="Alto do Turu VI">Alto do Turu IV</option>
                                        <option value="Alto Paranã">Alto Paranã</option>
                                        <option value="Altos do Jaguarema Araçagi">Altos do Jaguarema Araçagi</option>
                                        <option value="Andiroba">Andiroba</option>
                                        <option value="Araçagi">Araçagi</option>
                                        <option value="Aracagi mirititua">Aracagi mirititua</option>                                           
                                        <option value="Bacuritiua">Bacuritiua</option>
                                        <option value="Barbosa">Barbosa</option>
                                        <option value="Boa Viagem">Boa Viagem</option>
                                        <option value="Boa Vista">Boa Vista</option>
                                        <option value="Bom Jardim">Bom Jardim</option>
                                        <option value="Campina">Campina</option>
                                        <option value="Canavieira">Canavieira</option>
                                        <option value="Canudos">Canudos</option>
                                        <option value="Casaca">Casaca</option>
                                        <option value="Caura">Caura</option>
                                        <option value="Centro">Centro</option>
                                        <option value="Chacara do Itapiraco">Chacara do Itapiraco</option>
                                        <option value="hacara Itapiraco- Cohatrac">Chacara Itapiraco- Cohatrac</option>
                                        <option value="Ciadae Alta">Ciadae Alta</option>
                                        <option value="Cidade Alta - Quinta">Cidade Alta - Quinta</option>
                                        <option value="Cidade Nova">Cidade Nova</option>
                                        <option value="Cidade Olimpica">Cidade Olimpica</option>
                                        <option value="Cidade Operaria">Cidade Operaria</option>                                          
                                        <option value="Cohabiano">Cohabiano</option>
                                        <option value="Cohabiano I">Cohabiano I</option>
                                        <option value="Cohabiano II">Cohabiano II</option>                                           
                                        <option value="Cohatrac">Cohatrac</option>
                                        <option value="Cohatrac IV">Cohatrac IV</option>
                                        <option value="Cohatrac Vila">Cohatrac Vila</option>
                                        <option value="Cohatrac Vila Villagio">Cohatrac Vila Villagio</option>                                 
                                        <option value="Conceição">Conceição</option>
                                        <option value="Conjunto Aracagi">Conjunto Aracagi</option>
                                        <option value="Conjunto Geniparana">Conjunto Geniparana</option>
                                        <option value="Conjunto Itaguara">Conjunto Itaguara</option>
                                        <option value="Conjunto Itaguara II">Conjunto Itaguara II</option>
                                        <option value="Conjunto José Reinaldo Tavares">Conjunto José Reinaldo Tavares</option>
                                        <option value="Conjunto Residencial Itaguara II">Conjunto Residencial Itaguara II</option>                                            
                                        <option value="Conjunto Residencial Solar Lusitanos">Conjunto Residencial Solar Lusitanos</option>
                                        <option value="Cruzeiro">Cruzeiro</option>
                                        <option value="Espaço Cideral">Espaço Cideral</option>
                                        <option value="Espaço Sideral">Espaço Sideral</option>
                                        <option value="Estrada do Araçagi">Estrada do Araçagi</option>               
                                        <option value="Forquilha">Forquilha</option>
                                        <option value="Geniparana">Geniparana</option>
                                        <option value="Geniparana II">Geniparana II</option>
                                        <option value="Guarapiranga">Guarapiranga</option>
                                        <option value="I Lima">I Lima</option>
                                        <option value="Ipem Turu">Ipem Turu</option>
                                        <option value="Itaguara II">Itaguara II</option>
                                        <option value="Itaguara II cohatrac">Itaguara II cohatrac</option>
                                        <option value="Itapary">Itapary</option>
                                        <option value="Itapiraco">Itapiraco</option>
                                        <option value="J Câmara">J Câmara</option>
                                        <option value="J Camara I">J Camara I</option>
                                        <option value="J Camara II">J Camara II</option>
                                        <option value="J Lima">J Lima</option>
                                        <option value="Já Tropical">Já Tropical</option>
                                        <option value="Janaína">Janaína</option>
                                        <option value="Jardim Alvorada">Jardim Alvorada</option>
                                        <option value="Jardim Alvorada Cohatra">Jardim Alvorada Cohatra</option>
                                        <option value="Jardim Alvoradacohatrac Vila">Jardim Alvoradacohatrac Vila</option>
                                        <option value="Jardim Araçagi">Jardim Araçagi</option>
                                        <option value="Jardim Araçagi II">Jardim Araçagi II</option>
                                        <option value="Jardim Araçagi">Jardim Araçagi</option>
                                        <option value="Jardim Araçagi I">Jardim Araçagi I</option>
                                        <option value="Jardim Araçagi I Cohatrac">Jardim Araçagi I Cohatrac</option>
                                        <option value="Jardim Araçagi II">Jardim Araçagi II</option>
                                        <option value="Jardim Araçagi III">Jardim Araçagi III</option>
                                        <option value="Jardim das Margaridas">Jardim das Margaridas</option>
                                        <option value="Jardim Lisboa">Jardim Lisboa</option> 
                                        <option value="Jardim Tropical">Jardim Tropical</option>
                                        <option value="Jardim Tropical II">Jardim Tropical II</option>
                                        <option value="Jardim Turu">Jardim Turu</option>
                                        <option value="Jitaguara">Jitaguara</option>
                                        <option value="Jucatuba">Jucatuba</option>
                                        <option value="Km 4"> Km 4</option>
                                        <option value="Laranjal">Laranjal</option>
                                        <option value="Lotcentral Park">Lotcentral Park</option>
                                        <option value="Loteamento Alto Turu II">Loteamento Alto Turu II</option>                                                             
                                        <option value="Loteamento Central Parque Jaguarema">Loteamento Central Parque Jaguarema</option>
                                        <option value="Loteamento Cohabiano II"> Loteamento Cohabiano II</option>                                     
                                        <option value="Loteamento Jardim Lisboa">Loteamento Jardim Lisboa</option>
                                        <option value="Loteamento Jardim Turu">Loteamento Jardim Turu</option>
                                        <option value="Loteamento Novo Araçagi">Loteamento Novo Araçagi</option>
                                        <option value="Loteamento Novo Cohatrac">Loteamento Novo Cohatrac</option>
                                        <option value="Loteamento Paraíso das Rosas">Loteamento Paraíso das Rosas</option>                                          
                                        <option value="Loteamento Parque Palmeiras">Loteamento Parque Palmeiras</option>
                                        <option value="Loteamento Portuário Coqueirai">Loteamento Portuário Coqueirais</option>
                                        <option value="Loteamento Recreio de Araçagi">Loteamento Recreio de Araçagi</option>
                                        <option value="Loteamento São José"> Loteamento São José</option>
                                        <option value="Loteamento São Raimundo">Loteamento São Raimundo</option>
                                        <option value="Loteamento Sítio Trizidela">Loteamento Sítio Trizidela</option>
                                        <option value="Loteamento Sítio Verde">Loteamento Sítio Verde</option>
                                        <option value="Loteamento Vilagio Cohatrac">Loteamento Vilagio Cohatrac</option>                                           
                                        <option value="Maioba">Maioba</option>
                                        <option value="Maioba Genipapeiro"> Maioba Genipapeiro</option>
                                        <option value="Maiobinha"> Maiobinha</option>
                                        <option value="Mata">Mata</option>
                                        <option value="Matinha">Matinha</option>
                                        <option value=" Mirititiua"> Mirititiua</option>
                                        <option value="Miritiua"> Miritiua</option>
                                        <option value="Miritiua Turu">Miritiua Turu</option>                                           
                                        <option value=" Morada do Sol"> Morada do Sol</option>
                                        <option value="Morada Nova">Morada Nova</option>
                                        <option value="Morada Nova II">Morada Nova II</option>
                                        <option value="Moropoia"> Moropoia</option>
                                        <option value="Nova República">Nova República</option>
                                        <option value="Novo Cohabiano"> Novo Cohabiano</option>
                                        <option value=" Novo Cohatrac"> Novo Cohatrac</option>
                                        <option value="Outeiro"> Outeiro</option>
                                        <option value="Olho D'água"> Olho D'água</option>
                                        <option value="Panaquatira">Panaquatira</option>
                                        <option value="Paraíso das Rosas">Paraíso das Rosas</option>
                                        <option value="Parque Araçagi">Parque Araçagi</option>
                                        <option value="Parque Araçagi II">Parque Araçagi II</option>                                           
                                        <option value="Parque da Vitória">Parque da Vitória</option>
                                        <option value="Parque dos Rios">Parque dos Rios</option>
                                        <option value="Parque Florêncio">Parque Florêncio</option>                                          
                                        <option value="Parque Jair">Parque Jair</option>
                                        <option value="Parque Palmeiras">Parque Palmeiras</option>
                                        <option value="Parque São José">Parque São José</option>
                                        <option value="Parque Vitória">Parque Vitória</option>
                                        <option value="Parque Vitória - Turu">Parque Vitória - Turu</option>
                                        <option value=" Parque Zuito">Parque Zuito</option>                                           
                                        <option value="Pau Deitado">Pau Deitado</option>
                                        <option value="Piçarreira">Piçarreira</option>
                                        <option value=" Pindai">Pindai</option>                                          
                                        <option value="Planalto Turu II">Planalto Turu II</option>
                                        <option value=" Planalto Turu III">Planalto Turu III</option>
                                        <option value="Pontal da Ilha">Pontal da Ilha</option>
                                        <option value="Pontão Grossa">Pontão Grossa</option>
                                        <option value="Povoação Mata"> Povoação Mata</option>
                                        <option value=" Povoação Santa Maria">  Povoação Santa Maria</option>
                                        <option value="Matinha"> Povoado Matinha</option>
                                        <option value="Praia do Aracagi"> Praia do Aracagi</option>
                                        <option value="Praia Ponta Grossa"> Praia Ponta Grossa</option> 
                                        <option value="Quinta"> Quinta</option> 
                                        <option value="Quinta do S João"> Quinta do S João</option>
                                        <option value="Raposa"> Raposa</option>
                                        <option value="ecanto do Turu"> Recanto do Turu</option>
                                        <option value="Recanto do Turu I">Recanto do Turu I</option>
                                        <option value="Recanto dos Signos">Recanto dos Signos</option>                                          
                                        <option value=" Recreio do Araçagi"> Recreio do Araçagi</option>
                                        <option value="Resd Ana Carolina">Resd Ana Carolina</option>
                                        <option value="Resd Caminho das Árvores">Resd Caminho das Árvores</option>
                                        <option value="Residencial Buriti">Residencial Buriti</option>
                                        <option value="Residencial Caminho Árvores">Residencial Caminho Árvores</option>
                                        <option value="Residencial Jambus - Araçagi">Residencial Jambus - Araçagi</option>
                                        <option value="Residencial Militar"> Residencial Militar</option>
                                        <option value="Residencial Paraíso das Rosas">Residencial Paraíso das Rosas</option>
                                        <option value="Residencial São José"> Residencial São José</option>
                                        <option value="Residencial Terra Livre Turu"> Residencial Terra Livre Turu</option>
                                        <option value="Residencial jose Reinaldo Tavares">Residencial jose Reinaldo Tavares</option>
                                        <option value="Ribamar">Ribamar</option>
                                        <option value="Ribamar Centro">Ribamar Centro</option>
                                        <option value="Rio São João"> Rio São João</option>
                                        <option value="Riozinho"> Riozinho</option>
                                        <option value="Riozinho Cururuca">Riozinho Cururuca</option>
                                        <option value="Roseana Sarney"> Roseana Sarney</option>
                                        <option value="Rumo"> Rumo</option>
                                        <option value="S José">S José</option>
                                        <option value="S José de Ribamar">S José de Ribamar</option>
                                        <option value="S José dos Índios">S José dos Índios</option>                                       
                                        <option value="S Judas Tadeu">S Judas Tadeu</option>
                                        <option value="S Raimindo">S Raimindo</option>                                         
                                        <option value="Santa Efigênia">Santa Efigênia</option>
                                        <option value="Santa Luzia"> Santa Luzia</option>
                                        <option value="Santa Rosa"> Santa Rosa</option>
                                        <option value="Santa Terezinha">Santa Terezinha</option>
                                        <option value="Santana Turu">Santana Turu</option>
                                        <option value="São Benedito">São Benedito</option>
                                        <option value="São Judas Tadeu">São Judas Tadeu</option>
                                        <option value="São Raimundo"> São Raimundo</option>
                                        <option value="Saramanta">Saramanta</option>
                                        <option value="Sarney Filho">Sarney Filho</option>
                                        <option value="Sítio Apicum">Sítio Apicum</option>
                                        <option value="Sítio Saramanta">Sítio Saramanta</option>
                                        <option value="Sítio Trizidela">Sítio Trizidela</option>
                                        <option value="Solar dos Lusiados"> Solar dos Lusiados</option>
                                        <option value="Tijupa Queimado">Tijupa Queimado</option>
                                        <option value=" Timbuba">  Timbuba</option>
                                        <option value="Trizidela"> Trizidela</option>
                                        <option value="Trizidela da Maioba"> Trizidela da Maioba</option>
                                        <option value="Tropical"> Tropical</option>
                                        <option value="Tropical II"> Tropical II</option>
                                        <option value="Turu"> Turu</option>
                                        <option value="Ubatuba"> Ubatuba</option>
                                        <option value="Vieira">Vieira</option>
                                        <option value="Vila Alonso">Vila Alonso</option>
                                        <option value="Vila Alonso Costa">Vila Alonso Costa</option>
                                        <option value="Vila Cafeteira"> Vila Cafeteira</option>
                                        <option value="Vila Cidade Olímpica">Vila Cidade Olímpica</option>
                                        <option value="Vila Cohabiano Vila">Vila Cohabiano Vila</option>
                                        <option value="Vila Doutor José Silva">Vila Doutor José Silva</option>
                                        <option value="Vila Doutor Julinho"> Vila Doutor Julinho</option>
                                        <option value="Vila Epitácio Cafeteira">Vila Epitácio Cafeteira</option>
                                        <option value="Vila Flamengo"> Vila Flamengo</option>
                                        <option value="Vila J Lima">Vila J Lima</option>
                                        <option value="Vila Janaína">Vila Janaína</option>
                                        <option value="Vila Jota Lima"> Vila Jota Lima</option>
                                        <option value="Vila Kiola"> Vila Kiola</option>
                                        <option value="Vila Kiola Costa">Vila Kiola Costa</option>
                                        <option value="Vila Kiola I">Vila Kiola I</option>
                                        <option value="Vila Kiola II"> Vila Kiola II</option>
                                        <option value="Vila Luizão"> Vila Luizão</option>
                                        <option value="Vila Mangueirão"> Vila Mangueirão</option>
                                        <option value="Vila Marlene">Vila Marlene</option>
                                        <option value="Vila Nazaré">Vila Nazaré</option>
                                        <option value="Vila Operária"> Vila Operária</option>
                                        <option value="Vila Picarreira">Vila Picarreira</option>
                                        <option value="Vila Riod">Vila Riod</option>
                                        <option value="Vila Roseana Sarney">Vila Roseana Sarney</option>
                                        <option value="Vila Rua Sarney"> Vila Rua Sarney</option>
                                        <option value="Vila S José"> Vila S José</option>
                                        <option value="Vila S Luís">Vila S Luís</option>
                                        <option value="Vila Santa Efigênia">Vila Santa Efigênia</option>
                                        <option value="Vila Santa Terezinha">Vila Santa Terezinha</option>
                                        <option value="Vila São José"> Vila São José</option>
                                        <option value="Vila São Luís">Vila São Luís</option>
                                        <option value="Vila Sarnambi">Vila Sarnambi</option>
                                        <option value=" Vila Sarney"> Vila Sarney</option>
                                        <option value="Vila Sarney Filho">Vila Sarney Filho</option>
                                        <option value="Vila Sarney Filho I">Vila Sarney Filho I</option>
                                        <option value="Vila Sarney Filho II">Vila Sarney Filho II</option>
                                        <option value="Vilaje do Cohatrac">Vilaje do Cohatrac</option>
                                        <option value="Village do Cohatrac Vila">Village do Cohatrac Vila</option>
                                        <option value="Villagio Cohatrac Vila">Villagio Cohatrac Vila</option>
                                        <option value="Villagio do Cohatrac Via">Villagio do Cohatrac Via</option>
                                        <option value="Villagio Itaguara"> Villagio Itaguara</option>
                                    </select>
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
        </div>
    </div>
</form>
</div>
</div>
</body>
</html>

