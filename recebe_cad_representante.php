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

if (isset($_POST['nome_representante']) && empty($_POST['nome_representante']) == FALSE) {
    if (isset($_POST['cpf']) && empty($_POST['cpf']) == FALSE) {
        if (isset($_POST['empresa']) && empty($_POST['empresa']) == FALSE) {
            if (isset($_POST['procuracao']) && empty($_POST['procuracao']) == FALSE) {
                if (isset($_POST['cep']) && empty($_POST['cep']) == FALSE) {
                    if (isset($_POST['logradouro']) && empty($_POST['logradouro']) == FALSE) {
                        if (isset($_POST['municipio']) && empty($_POST['municipio']) == FALSE) {
                            if (isset($_POST['uf']) && empty($_POST['uf']) == FALSE) {
                                if (isset($_POST['telefone']) && empty($_POST['telefone']) == FALSE) {

                                    $empresa = strtoupper(addslashes($_POST['empresa']));
                                    $nome_representante = strtoupper(addslashes($_POST['nome_representante']));
                                    $cpf = strtoupper(addslashes($_POST['cpf']));
                                    $procuracao = strtoupper(addslashes($_POST['procuracao']));
                                    $cep = strtoupper(addslashes($_POST['cep']));
                                    $logradouro = strtoupper(addslashes($_POST['logradouro']));
                                    $numero = strtoupper(addslashes($_POST['numero']));
                                    $uf = strtoupper(addslashes($_POST['uf']));
                                    $municipio = strtoupper(addslashes($_POST['municipio']));
                                    $bairro = strtoupper(addslashes($_POST['bairro']));
                                    $email = strtoupper(addslashes($_POST['email']));
                                    $telefone = strtoupper(addslashes($_POST['telefone']));

                                    //verrificando se o cpf ja existe no banco de dados
                                    $consulta_cpf = "SELECT *FROM tb_representante WHERE cpf ='" . $_POST['cpf'] . "' ";
                                    $recebe_consulta = mysqli_query($con, $consulta_cpf);

                                    if (mysqli_num_rows($recebe_consulta) > 0) {
                                        ?>

                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">ERRO! O NÚMERO DO DOCUMENTO INFORMADO JÁ EXISTE, O REPRESENTANTE JÁ PODE ESTÁ CADASTRADO <a href="consultar_representante.php">  VERIFIQUE AQUI</a></h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="cad_representante.php"><button type="button" class="btn btn-info">POR FAVOR! INFORME OUTRO NÚMERO</button></a>
                                                        <a href="home.php"><button type="button" class="btn btn-danger">CANCELAR</button></a>
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

                                        $sql = "INSERT INTO tb_representante(fk2_codigo_empresa,nome_representante,cpf,procuracao,cep,logradouro,numero,uf,municipio,bairro,email,telefone)"
                                                . "VALUES('$empresa',UPPER('$nome_representante'),'$cpf','$procuracao','$cep',UPPER('$logradouro'),'$numero',UPPER('$uf'),UPPER('$municipio'),UPPER('$bairro'),'$email','$telefone')";
                                        mysqli_query($con, $sql);
//                                        print_r($sql);
                                        ?>
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-center" id="myModalLabel">REPRESENTANTE CADASTRADO COM SUCESSO!</h4>
                                                    </div>
                                                    <div class="modal-body" style="background-color: #4cae4c">
                                                        <div class="nav">
                                                            <ul class="nav navbar-nav">
                                                                <li class="dropdown">
                                                                    <a href="" class="dropdown-toggle btn-default" data-toggle="dropdown"><strong style="font-size: 17px;color: #000">RETORNAR PARA </strong><img src="img/sort-down.png" style="margin-left: 35px;margin-bottom: 3px"></a>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="cad_empresa.php"><strong><img src="img/man-with-company.png"> CADASTRO RAZÃO SOCIAL E / OU Pª FÍSICA</strong></a></li>
                                                                        <li><a href="cad_processo.php"><strong><img src="img/contract.png"> CADASTRO PROCESSO</strong></a></li>
                                                                        <li><a href="cad_empreendimento.php"><strong><img src="img/construction-worker_1.png"> CADASTRO EMPREENDIMENTO</strong></a></li>
                                                                        <li><a href="cad_licenca.php"><strong><img src="img/document_2.png"> CADASTRO LICENÇA</strong></a></li>
                                                                        <li><a href="cad_notificacao.php"><strong><img src="img/notifications-button_1.png">CADASTRO NOTIFICAÇÃO</strong></a></li>
                                                                        <li><a href="cad_autorizacao.php"><strong><img src="img/police-shield-with-a-star-symbol (2).png"> CADASTRO AUTORIZAÇÃO</strong></a></li>
                                                                        <li><a href="consultar_empresas.php"style="color: #2e6da4"><strong><img src="img/office-block.png"> CONSULTAR  RAZÃO SOCIAL E / OU Pª FÍSICA</strong></a></li>
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
                                                        <a href="cad_representante.php"><button type="button" class="btn btn-info"><strong>REALIZAR NOVO CADASTRO</strong></button></a>
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
}
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">ERRO! POR FAVOR O PREENCHA O FORMULÁRIO</h4>

            </div>
            <div class="modal-footer">
                <a href="cad_representante.php"><button type="button" class="btn btn-info"><strong>VOLTAR PARA O FORMULÁRIO DE CADASTRO</strong></button></a>
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
