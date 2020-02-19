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

//if (isset($_POST['razaosocial_pessoafisica']) && empty($_POST['razaosocial_pessoafisica']) == FALSE) {
//    if (isset($_POST['nome_fantasia']) && empty($_POST['nome_fantasia']) == FALSE) {
//        if (isset($_POST['pessoa_fisicajuridica']) && empty($_POST['pessoa_fisicajuridica']) == FALSE) {
//            if (isset($_POST['cnpj_cpf']) && empty($_POST['cnpj_cpf']) == FALSE) {
//                if (isset($_POST['cep']) && empty($_POST['cep']) == FALSE) {
//                    if (isset($_POST['logradouro']) && empty($_POST['logradouro']) == FALSE) {
//                        if (isset($_POST['uf']) && empty($_POST['uf']) == FALSE) {
//                            if (isset($_POST['municipio']) && empty($_POST['municipio']) == FALSE) {
//                                if (isset($_POST['bairro']) && empty($_POST['bairro']) == FALSE) {
//                                    if (isset($_POST['telefone']) && empty($_POST['telefone']) == FALSE) {

$codigo_licenca = strtoupper(addslashes($_POST['codigo_licenca']));
$empresa = strtoupper(addslashes($_POST['empresa']));
$empreendimento = strtoupper(addslashes($_POST['empreendimento']));
$processo = strtoupper(addslashes($_POST['processo']));
$numero_licenca = strtoupper(addslashes($_POST['numero_licenca']));
$ano_licenca = strtoupper(addslashes($_POST['ano_licenca']));
$data_emissao = strtoupper(addslashes($_POST['data_emissao']));
$data_validade = strtoupper(addslashes($_POST['data_validade']));
$descricao_atividade = strtoupper(addslashes($_POST['descricao_atividade']));

$sql = "UPDATE tb_licenca SET fk4_codigo_empresa='$empresa',fk1_codigo_empreendimento='$empreendimento',fk1_codigo_processo='$processo',numero_licenca='$numero_licenca',ano_licenca='$ano_licenca',data_emissao='$data_emissao',data_validade='$data_validade',descricao_atividade='$descricao_atividade' WHERE codigo_licenca='$codigo_licenca'";
mysqli_query($con, $sql);

// O CÓDIGO ABAIXO REGISTRA O USUARIO QUE REALIZOU O CADASTRO DE CERTO EMPRESA / PESSOA FISICA
$emailUser = $_SESSION['email'];
$user = $_SESSION['nome'];
$ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
$ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
$data = Date("Y-m-d H:i:s");
$acaoUsuario = "Realizou alteração da licenca de numero ->$numero_licenca, para o empreendimento de codigo->$empreendimento, empresa de codigo $empreendimento, e processo de codigo $processo";
$sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
mysqli_query($con, $sqlLog);
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header btn-success">
                <h4 class="modal-title text-center" id="myModalLabel"><strong>LICENÇA ALTERADA COM SUCESSO!<br><br><P style="text-align: center">AGUARDE UM MOMENTO</strong></P></h4>
                <script type="text/javascript">
                    setTimeout('window.location.href="exibe_licencas.php"', 3500);
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





