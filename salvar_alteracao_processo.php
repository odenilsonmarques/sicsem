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


$codigo_processo = strtoupper(addslashes($_POST['codigo_processo']));
$empresa = strtoupper(addslashes($_POST['empresa']));
$numero_processo = strtoupper(addslashes($_POST['numero_processo']));
$ano = strtoupper(addslashes($_POST['ano']));
$data_processo = strtoupper(addslashes($_POST['data_processo']));
$assunto = strtoupper(addslashes($_POST['assunto']));
$situacao_processo = strtoupper(addslashes($_POST['situacao_processo']));
$motivo_situacao = strtoupper(addslashes($_POST['motivo_situacao']));



$sql = "UPDATE tb_processo SET numero_processo='$numero_processo',ano='$ano',data_processo='$data_processo',assunto='$assunto',situacao_processo='$situacao_processo',motivo_situacao='$motivo_situacao' WHERE codigo_processo='$codigo_processo'";
mysqli_query($con, $sql);

// O CÓDIGO ABAIXO REGISTRA O USUARIO QUE REALIZOU O CADASTRO DE CERTO EMPRESA / PESSOA FISICA
$emailUser = $_SESSION['email'];
$user = $_SESSION['nome'];
$ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
$ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
$data = Date("Y-m-d H:i:s");
$acaoUsuario = "Realizou a Alteração do processo de numero ->$numero_processo";
$sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
 mysqli_query($con, $sqlLog);
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header btn-success">
                <h4 class="modal-title text-center" id="myModalLabel"><strong>PROCESSO ALTERADO COM SUCESSO!<br><br><P style="text-align: center">AGUARDE UM MOMENTO</strong></P></h4>
                <script type="text/javascript">
                    setTimeout('window.location.href="exibe_processo.php"', 3500);
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





