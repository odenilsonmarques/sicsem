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

$codigo_atividade = strtoupper(addslashes($_POST['codigo_atividade']));
$nome_atividade = strtoupper(addslashes($_POST['nome_atividade']));
$potencial_poluidor = strtoupper(addslashes($_POST['potencial_poluidor']));

$sql = "UPDATE tb_atividade SET nome_atividade='$nome_atividade', potencial_poluidor='$potencial_poluidor' WHERE codigo_atividade='$codigo_atividade'";
mysqli_query($con, $sql);


  // O CÓDIGO ABAIXO REGISTRA O USUARIO QUE REALIZOU O CADASTRO DE CERTO EMPRESA / PESSOA FISICA
        $emailUser = $_SESSION['email'];
        $user = $_SESSION['nome'];
        $ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
        $ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
        $data = Date("Y-m-d H:i:s");
        $acaoUsuario = "Realizou alteracao na atividade->$nome_atividade";
        $sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
        mysqli_query($con,$sqlLog);
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header btn-success">
              
            <h4 class="modal-title text-center" id="myModalLabel"><strong>ATIVIDADE ALTERADA COM SUCESSO!<br><br><P style="text-align: center">AGUARDE UM MOMENTO</strong></P></h4>
                <script type="text/javascript">
                    setTimeout('window.location.href="exibe_atividade_empreendimento.php"', 3000);
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





