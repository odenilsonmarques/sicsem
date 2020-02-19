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

$codigo_empreendimento = strtoupper(addslashes($_POST['codigo_empreendimento']));
$bairro = strtoupper(addslashes($_POST['nome_bairro']));
$municipio = strtoupper(addslashes($_POST['nome_municipio']));
$uf = strtoupper(addslashes($_POST['nome_uf']));
$nome_empreendimento = strtoupper(addslashes($_POST['nome_empreendimento']));
$nome_logradouro = strtoupper(addslashes($_POST['nome_logradouro']));
$numero_empreendimento = strtoupper(addslashes($_POST['numero_empreendimento']));
$complemento = strtoupper(addslashes($_POST['complemento']));
$localizacao_map_empre = (addslashes($_POST['localizacao_map_empre']));
$atividade_empreendimento = strtoupper(addslashes($_POST['atividade_empreendimento']));
$grau_atividade = strtoupper(addslashes($_POST['grau_atividade']));
$denominacao_comercial = strtoupper(addslashes($_POST['denominacao_comercial']));
$nome_atividade = strtoupper(addslashes($_POST['nome_atividade']));

$sql = "UPDATE tb_empreendimento SET nome_bairro='$bairro',nome_municipio='$municipio',nome_uf='$uf',nome_empreendimento='$nome_empreendimento',nome_logradouro='$nome_logradouro',numero_empreendimento ='$numero_empreendimento',complemento = '$complemento',localizacao_map_empre='$localizacao_map_empre',atividade_empreendimento='$atividade_empreendimento',grau_atividade='$grau_atividade',denominacao_comercial='$denominacao_comercial',nome_atividade='$nome_atividade' WHERE codigo_empreendimento='$codigo_empreendimento'";
mysqli_query($con, $sql);

  // O CÓDIGO ABAIXO REGISTRA O USUARIO QUE REALIZOU O CADASTRO DE CERTO EMPRESA / PESSOA FISICA
        $emailUser = $_SESSION['email'];
        $user = $_SESSION['nome'];
        $ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
        $ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
        $data = Date("Y-m-d H:i:s");
        $acaoUsuario = "Realizou alteracao no Empreendimento / atividade->$nome_atividade,$nome_empreendimento";
        $sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
        mysqli_query($con,$sqlLog);
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header btn-success">
                <h4 class="modal-title text-center" id="myModalLabel"><strong>EMPREENDIMENTO / ATIVIDADE ALTERADO COM SUCESSO!<br><br><P style="text-align: center">AGUARDE UM MOMENTO</strong></P></h4>
                <script type="text/javascript">
                    setTimeout('window.location.href="exibe_atividade.php"', 3500);
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





