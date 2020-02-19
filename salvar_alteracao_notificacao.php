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

$codigo_notificacao = strtoupper(addslashes($_POST['codigo_notificacao']));
$empresa = strtoupper(addslashes($_POST['empresa']));
//$processo = strtoupper(addslashes($_POST['processo']));
$fiscal = strtoupper(addslashes($_POST['fiscal']));
$numero_notificacao = strtoupper(addslashes($_POST['numero_notificacao']));
$ano_notificacao = strtoupper(addslashes($_POST['ano_notificacao']));
$data_notificacao = strtoupper(addslashes($_POST['data_notificacao']));
$data_comparecimento = strtoupper(addslashes($_POST['data_comparecimento']));
$profissao_atividade = strtoupper(addslashes($_POST['profissao_atividade']));
$descricao_prazo = strtoupper(addslashes($_POST['descricao_prazo']));
$status = strtoupper(addslashes($_POST['status']));
$status_informacoes_adicionais = strtoupper(addslashes($_POST['status_informacoes_adicionais']));
$numero_notificacao_anterior = strtoupper(addslashes($_POST['numero_notificacao_anterior']));
$numero_notificacao_ano_anterior = strtoupper(addslashes($_POST['numero_notificacao_ano_anterior']));
$numero_processo_notificacao_anterior = strtoupper(addslashes($_POST['numero_processo_notificacao_anterior']));
$ano_processo_notificacao_anterior = strtoupper(addslashes($_POST['ano_processo_notificacao_anterior']));
$status_licenca = strtoupper(addslashes($_POST['status_licenca']));
$numero_licenca_notificacao_anterior = strtoupper(addslashes($_POST['numero_licenca_notificacao_anterior']));
$ano_licenca_notificacao_anterior = strtoupper(addslashes($_POST['ano_licenca_notificacao_anterior']));
$orgao_emissor_licenca = strtoupper(addslashes($_POST['orgao_emissor_licenca']));
$data_validade = strtoupper(addslashes($_POST['data_validade']));
$status_notificado = strtoupper(addslashes($_POST['status_notificado']));
$nome_notificado = strtoupper(addslashes($_POST['nome_notificado']));
$cpf = strtoupper(addslashes($_POST['cpf']));
$logradouro = strtoupper(addslashes($_POST['logradouro']));
$numero = strtoupper(addslashes($_POST['numero']));
$bairro = strtoupper(addslashes($_POST['bairro']));
$testemunha = strtoupper(addslashes($_POST['testemunha']));
$chefe_fiscalizacao = strtoupper(addslashes($_POST['chefe_fiscalizacao']));


$sql = "UPDATE tb_notificacao SET fk5_codigo_empresa='$empresa',fk1_codigo_fiscal='$fiscal',numero_notificacao='$numero_notificacao',ano_notificacao='$ano_notificacao',data_notificacao='$data_notificacao',"
        . "data_comparecimento='$data_comparecimento',profissao_atividade='$profissao_atividade',descricao_prazo='$descricao_prazo',status='$status',status_informacoes_adicionais='$status_informacoes_adicionais',numero_notificacao_anterior='$numero_notificacao_anterior',numero_notificacao_ano_anterior='$numero_notificacao_ano_anterior',"
        . "numero_processo_notificacao_anterior='$numero_processo_notificacao_anterior',status_licenca='$status_licenca',numero_licenca_notificacao_anterior='$numero_licenca_notificacao_anterior',ano_licenca_notificacao_anterior='$ano_licenca_notificacao_anterior',"
        . "orgao_emissor_licenca='$orgao_emissor_licenca',data_validade='$data_validade',status_notificado='$status_notificado',nome_notificado='$nome_notificado',cpf='$cpf',logradouro='$logradouro',numero='$numero',bairro='$bairro',testemunha='$testemunha',chefe_fiscalizacao='$chefe_fiscalizacao' WHERE codigo_notificacao='$codigo_notificacao'";
mysqli_query($con, $sql);
//print_r($sql);

// O CÓDIGO ABAIXO REGISTRA O USUARIO QUE REALIZOU O CADASTRO DE CERTO EMPRESA / PESSOA FISICA
$emailUser = $_SESSION['email'];
$user = $_SESSION['nome'];
$ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
$ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
$data = Date("Y-m-d H:i:s");
$acaoUsuario = "Realizou alteração da Notificação de Numero ->$numero_notificacao, para empresa de codigo $empresa";
$sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
mysqli_query($con, $sqlLog);
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog" role="document">
        <div class="modal-content btn-success">
            <div class="modal-header btn-success">
                <h4 class="modal-title text-center" id="myModalLabel"><strong>NOTIFICAÇÃO ALTERADA COM SUCESSO!<br><br><P style="text-align: center">AGUARDE UM MOMENTO</strong></P></h4>
                <script type="text/javascript">
                    setTimeout('window.location.href="exibe_notificacoes.php"', 3000);
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





