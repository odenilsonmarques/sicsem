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
    if (isset($_POST['empreendimento']) && empty($_POST['empreendimento']) == FALSE) {
        if (isset($_POST['numero_processo']) && empty($_POST['numero_processo']) == FALSE) {
            if (isset($_POST['data_processo']) && empty($_POST['data_processo']) == FALSE) {
                if (isset($_POST['assunto']) && empty($_POST['assunto']) == FALSE) {

                    $empresa = strtoupper(addslashes($_POST['empresa']));
                    $empreendimento = strtoupper(addslashes($_POST['empreendimento']));
                    $numero_processo = strtoupper(addslashes($_POST['numero_processo']));
                    $ano = strtoupper(addslashes($_POST['ano']));
                    $data_processo = strtoupper(addslashes($_POST['data_processo']));
                    $assunto = strtoupper(addslashes($_POST['assunto']));
                    $situacao_processo = strtoupper(addslashes($_POST['situacao_processo']));
                    $motivo_situacao = strtoupper(addslashes($_POST['motivo_situacao']));

                    //verificando se ja existe no banco de dados o numero do processo informado            
                    $consulta_processo = "SELECT numero_processo,assunto,ano FROM tb_processo WHERE numero_processo ='" . $_POST['numero_processo'] . "' AND assunto ='" . $_POST['assunto'] . "' AND ano='" . $_POST['ano'] . "' ";
                    $recebe_consulta = mysqli_query($con, $consulta_processo);

                    if (mysqli_num_rows($recebe_consulta) > 0) {
                        ?>
                        <script>
                            alert('ERRO! JÁ EXISTE UM PROCESSO COM O NÚMERO INFORMADO, POR FAVOR INFORME OUTRO NÚMERO! \n\n ATENÇÃO CASO O EMPREENDIMENTO / ATIVIDADE NÃO APAREÇA SELECIONE A RAZÃO SOCIAL / Pª FISICA NOVAMENTE ');
                            window.history.back();
                        </script>
                        <?php
                    } else {

                        $sql = "INSERT INTO tb_processo(fk3_codigo_empresa,fk4_codigo_empreendimento,numero_processo,ano,data_processo,assunto,situacao_processo,motivo_situacao)"
                                . "VALUES('$empresa','$empreendimento','$numero_processo','$ano','$data_processo','$assunto','$situacao_processo','$motivo_situacao')";
                        mysqli_query($con, $sql);

                        //recuperando o ultimo processo inserido
                        $ultimo_processo = mysqli_insert_id($con);
//                        echo $ultimo_processo;
                        $_SESSION['ultimo_processo'] = $ultimo_processo;
//                      print_r($sql);                   
//                        $_SESSION['controle_de_abas'] = 1;
                        // O CÓDIGO ABAIXO REGISTRA O USUARIO QUE REALIZOU O CADASTRO DE CERTO EMPRESA / PESSOA FISICA
                        $emailUser = $_SESSION['email'];
                        $user = $_SESSION['nome'];
                        $ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
                        $ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
                        $data = Date("Y-m-d H:i:s");
                        $acaoUsuario = "Realizou o Cadastro do processo de numero ->$numero_processo, para o empreendimento de codigo->$empreendimento, e empresa de codigo $empreendimento";
                        $sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
                        mysqli_query($con, $sqlLog);
                        ?>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header btn-success">
                                        <h4 class="modal-title text-center"  id="myModalLabel"><strong>PROCESSO CADASTRADO COM SUCESSO!<br><br><P style="text-align: center">AGUARDE UM MOMENTO<br></strong></P></h4>
                                         
                                        <div class="spinner"></div>

                                        <script type="text/javascript">
                                            setTimeout('window.location.href="cadastros.php"', 3500);
                                        </script>      
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





