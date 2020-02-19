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


$codigo_auto_infracao = strtoupper(addslashes($_POST['codigo_auto_infracao']));
$empresa = strtoupper(addslashes($_POST['empresa']));
//$processo = strtoupper(addslashes($_POST['processo']));
$fiscal = strtoupper(addslashes($_POST['fiscal']));
$numero_auto_infracao = strtoupper(addslashes($_POST['numero_auto_infracao']));
$ano_auto_infracao = strtoupper(addslashes($_POST['ano_auto_infracao']));
$data_auto_infracao = strtoupper(addslashes($_POST['data_auto_infracao']));
$profissao_atividade = strtoupper(addslashes($_POST['profissao_atividade']));
$descricao_infracao = strtoupper(addslashes($_POST['descricao_infracao']));
$auto_infracao = strtoupper(addslashes($_POST['auto_infracao']));
$status_auto = strtoupper(addslashes($_POST['status_auto']));
$natureza_da_infracao = strtoupper(addslashes($_POST['natureza_da_infracao']));
$material_apreendido = strtoupper(addslashes($_POST['material_apreendido']));
$valor_infracao = strtoupper(addslashes($_POST['valor_infracao']));
$valor_reais = strtoupper(addslashes($_POST['valor_reais']));
$status_informacoes_adicionais_auto = strtoupper(addslashes($_POST['status_informacoes_adicionais_auto']));
$numero_notificacao_anterior_auto = strtoupper(addslashes($_POST['numero_notificacao_anterior_auto']));
$numero_notificacao_ano_anterior_auto = strtoupper(addslashes($_POST['numero_notificacao_ano_anterior_auto']));
$numero_processo_notificacao_anterior_auto = strtoupper(addslashes($_POST['numero_processo_notificacao_anterior_auto']));
$ano_processo_notificacao_anterior_auto = strtoupper(addslashes($_POST['ano_processo_notificacao_anterior_auto']));
$status_licenca = strtoupper(addslashes($_POST['status_licenca']));
$numero_licenca_anterior_auto = strtoupper(addslashes($_POST['numero_licenca_anterior_auto']));
$ano_licenca_anterior_auto = strtoupper(addslashes($_POST['ano_licenca_anterior_auto']));
$orgao_emissor_licenca_auto = strtoupper(addslashes($_POST['orgao_emissor_licenca_auto']));
$data_validade_licenca_anterior = strtoupper(addslashes($_POST['data_validade_licenca_anterior']));
$nome_infrator = strtoupper(addslashes($_POST['nome_infrator']));
$cpf = strtoupper(addslashes($_POST['cpf']));
$logradouro = strtoupper(addslashes($_POST['logradouro']));
$numero = strtoupper(addslashes($_POST['numero']));
$bairro = strtoupper(addslashes($_POST['bairro']));
$chefe_fiscalizacao = strtoupper(addslashes($_POST['chefe_fiscalizacao']));

$sql = "UPDATE tb_auto_infracao SET fk9_codigo_empresa='$empresa',fk3_codigo_fiscal='$fiscal',numero_auto_infracao='$numero_auto_infracao',ano_auto_infracao='$ano_auto_infracao',"
        . "data_auto_infracao='$data_auto_infracao',profissao_atividade='$profissao_atividade',descricao_infracao='$descricao_infracao',auto_infracao='$auto_infracao',status_auto='$status_auto',natureza_da_infracao='$natureza_da_infracao',material_apreendido='$material_apreendido',valor_infracao='$valor_infracao',valor_reais='$valor_reais',"
        . "status_informacoes_adicionais_auto='$status_informacoes_adicionais_auto',numero_notificacao_anterior_auto='$numero_notificacao_anterior_auto',numero_processo_notificacao_anterior_auto='$numero_processo_notificacao_anterior_auto',ano_processo_notificacao_anterior_auto='$ano_processo_notificacao_anterior_auto',status_licenca='$status_licenca',"
        . "numero_licenca_anterior_auto='$numero_licenca_anterior_auto',ano_licenca_anterior_auto='$ano_licenca_anterior_auto',orgao_emissor_licenca_auto='$orgao_emissor_licenca_auto',data_validade_licenca_anterior='$data_validade_licenca_anterior',nome_infrator='$nome_infrator',cpf='$cpf',logradouro='$logradouro',numero='$numero',bairro='$bairro',chefe_fiscalizacao='$chefe_fiscalizacao'";

mysqli_query($con, $sql);
//print_r($sql);




$emailUser = $_SESSION['email'];
$user = $_SESSION['nome'];
$ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
$ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
$data = Date("Y-m-d H:i:s");
$acaoUsuario = "Realizou alteração do auto de inifração de numero ->$numero_auto_infracao, para empresa de codigo $empresa";
$sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
mysqli_query($con, $sqlLog);
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog" role="document">
        <div class="modal-content btn-success">
            <div class="modal-header btn-success">
                <h4 class="modal-title text-center" id="myModalLabel"><strong>AUTO DE INFRAÇÃO ALTERADO COM SUCESSO!<br><br><P style="text-align: center">AGUARDE UM MOMENTO</strong></P></h4>
                <script type="text/javascript">
                    setTimeout('window.location.href="exibe_autos.php"', 3000);
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
