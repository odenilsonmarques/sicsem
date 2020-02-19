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

if (isset($_POST['empresa']) && empty($_POST['empresa']) == FALSE) {
    if (isset($_POST['processo']) && empty($_POST['processo']) == FALSE) {
        if (isset($_POST['empreendimento']) && empty($_POST['empreendimento']) == FALSE) {
            if (isset($_POST['numero_autorizacao']) && empty($_POST['numero_autorizacao']) == FALSE) {
                if (isset($_POST['ano']) && empty($_POST['ano']) == FALSE) {
                    if (isset($_POST['data_emissao']) && empty($_POST['data_emissao']) == FALSE) {
                        if (isset($_POST['data_validade']) && empty($_POST['data_validade']) == FALSE) {
                            if (isset($_POST['autorizacao']) && empty($_POST['autorizacao']) == FALSE) {
                               
                                        $empresa = strtoupper(addslashes($_POST['empresa']));
                                        $processo = strtoupper(addslashes($_POST['processo']));
                                        $empreendimento = strtoupper(addslashes($_POST['empreendimento']));
                                        $numero_autorizacao= strtoupper(addslashes($_POST['numero_autorizacao']));
                                        $ano = strtoupper(addslashes($_POST['ano']));
                                        $data_emissao = strtoupper(addslashes($_POST['data_emissao']));
                                        $data_validade = strtoupper(addslashes($_POST['data_validade']));
                                        $autorizacao = strtoupper(addslashes($_POST['autorizacao']));
                                        $informacao_autorizacao = strtoupper(addslashes($_POST['informacao_autorizacao']));
                                        $area_propried = strtoupper(addslashes($_POST['area_propried']));
                                        $area_requer = strtoupper(addslashes($_POST['area_requer']));
                                        $outro = strtoupper(addslashes($_POST['outro']));
                                        
                                        if ($data_emissao >= $data_validade) {
                                            ?>  
                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">ERRO! A DATA DE EMISSÃO NÃO PODE SER MAIOR NEM IGUAL A DATA DE VALIDADE</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="cad_autorizacao.php"><button type="button" class="btn btn-info"><strong>VOLTAR PARA O FORMULÁRIO DE CADASTRO</strong></button></a>
                                                            <a href="home.php"><button type="button" class="btn btn-danger"><strong>CANCELAR</strong></button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function () {
                                                    $('#myModal').modal('show');
                                                });
                                            </script>
                                            <?php
                                        }
                                        //verificando se ja existe uma autorizacao com o numero informado banco de dados
                                        $consulta_autorizacao = "SELECT *FROM tb_autorizacao WHERE numero_autorizacao ='" . $_POST['numero_autorizacao'] . "' ";
                                        $recebe_consulta = mysqli_query($con, $consulta_autorizacao);

                                        if (mysqli_num_rows($recebe_consulta) > 0) {
                                            ?>
                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">ERRO, JÁ EXISTE UM CADASTRO COM O NÚMERO DA AUTORIZAÇÃO INFORMADA!</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="cad_autorizacao.php"><button type="button" class="btn btn-info"><strong>VOLTAR PARA O FORMULÁRIO DE CADASTRO</strong></button></a>
                                                            <a href="home.php"><button type="button" class="btn btn-danger"><strong>CANCELAR</strong></button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function () {
                                                    $('#myModal').modal('show');
                                                });
                                            </script>
                                            <?php
                                        } else {
                                            $sql = "INSERT INTO tb_autorizacao(fk6_codigo_empresa,fk3_codigo_processo,fk2_codigo_empreendimento,numero_autorizacao,ano,data_emissao,data_validade,autorizacao,informacao_autorizacao,area_propried,area_requer,outro)"
                                                    . "VALUES('$empresa','$processo','$empreendimento','$numero_autorizacao','$ano','$data_emissao','$data_validade',UPPER('$autorizacao'),UPPER('$informacao_autorizacao'),UPPER('$area_propried'),UPPER('$area_requer'),UPPER('$outro'))";
                                            mysqli_query($con, $sql);
//                                            print_r($sql);
                                            ?>
                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title text-center" id="myModalLabel">AUTORIZAÇÃO CADASTRADA COM SUCESSO!</h4>
                                                        </div>
                                                        <div class="modal-body" style="background-color: #4cae4c">
                                                            <div class="nav">
                                                                <ul class="nav navbar-nav">
                                                                    <li class="dropdown">
                                                                        <a href="" class="dropdown-toggle btn-default" data-toggle="dropdown"><strong style="font-size: 17px;color: #000">RETORNAR PARA </strong><img src="img/sort-down.png" style="margin-left: 35px;margin-bottom: 3px"></a>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="cad_empresa.php"><strong><img src="img/man-with-company.png"> CADASTRO EMPRESA / Pª FÍSICA</strong></a></li>
                                                                            <li><a href="cad_representante.php"><strong><img src="img/user_2.png"> CADASTRO REPRESENTANTE</strong></a></li>
                                                                            <li><a href="cad_processo.php"><strong><img src="img/contract.png"> CADASTRO PROCESSO</strong></a></li>
                                                                            <li><a href="cad_empreendimento.php"><strong><img src="img/construction-worker_1.png"> CADASTRO EMPREENDIMENTO</strong></a></li>
                                                                            <li><a href="cad_licenca.php"><strong><img src="img/document_2.png"> CADASTRO LICENÇA</strong></a></li>
                                                                            <li><a href="cad_notificacao.php"><strong><img src="img/notifications-button_1.png">CADASTRO NOTIFICAÇÃO</strong></a></li>
                                                                            <li><a href="consultar_empresas.php"style="color: #2e6da4"><strong><img src="img/office-block.png"> CONSULTAR EMPRESAS</strong></a></li>
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
                                                        <div class="modal-footer">
                                                            <a href="cad_autorizacao.php"><button type="button" class="btn btn-info"><strong>REALIZAR NOVO CADASTRO</strong></button></a>
                                                            <a href="home.php"><button type="button" class="btn btn-danger"><strong>CANCELAR</strong></button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function () {
                                                    $('#myModal').modal('show');
                                                });
                                            </script>                                          
                                            <?php
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">ERRO! POR FAVOR PREENCHA O FORMULÁRIO</h4>
            </div>
            <div class="modal-footer">
                <a href="cad_autorizacao.php"><button type="button" class="btn btn-info"><strong>VOLTAR PARA O FORMULÁRIO DE CADASTRO</strong></button></a>
                <a href="home.php"><button type="button" class="btn btn-danger"><strong>CANCELAR</strong></button></a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#myModal').modal('show');
    });
</script>



