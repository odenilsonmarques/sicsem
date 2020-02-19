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


$empresa = strtoupper(addslashes($_POST['empresa']));
$processo = strtoupper(addslashes($_POST['processo']));
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


$consulta_auto = "SELECT *FROM tb_auto_infracao WHERE numero_auto_infracao ='" . $_POST['numero_auto_infracao'] . "'";
$recebe_consulta = mysqli_query($con, $consulta_auto);

if (mysqli_num_rows($recebe_consulta) > 0) {
    ?>
    <script>
        alert('ERRO JÁ EXISTE UM AUTO DE INFRAÇÃO COM O NÚMERO INFORMADO, POR FAVOR INFORME OUTRO NÚMERO!');
        window.history.back();
    </script>                       
    <?php
} else {

    $sql = "INSERT INTO tb_auto_infracao(fk9_codigo_empresa,fk5_codigo_processo,fk3_codigo_fiscal,numero_auto_infracao,ano_auto_infracao,data_auto_infracao,profissao_atividade,descricao_infracao,auto_infracao,status_auto,natureza_da_infracao,material_apreendido,valor_infracao,valor_reais,status_informacoes_adicionais_auto,numero_notificacao_anterior_auto,numero_notificacao_ano_anterior_auto,numero_processo_notificacao_anterior_auto,ano_processo_notificacao_anterior_auto,status_licenca,numero_licenca_anterior_auto,ano_licenca_anterior_auto,orgao_emissor_licenca_auto,data_validade_licenca_anterior,nome_infrator,cpf,logradouro,numero,bairro,chefe_fiscalizacao)"
            . "VALUES('$empresa','$processo','$fiscal','$numero_auto_infracao','$ano_auto_infracao','$data_auto_infracao',UPPER('$profissao_atividade'),UPPER('$descricao_infracao'),UPPER('$auto_infracao'),'$status_auto',UPPER('$natureza_da_infracao'),UPPER('$material_apreendido'),'$valor_infracao','$valor_reais','$status_informacoes_adicionais_auto','$numero_notificacao_anterior_auto','$numero_notificacao_ano_anterior_auto','$numero_processo_notificacao_anterior_auto','$ano_processo_notificacao_anterior_auto','$status_licenca','$numero_licenca_anterior_auto','$ano_licenca_anterior_auto','$orgao_emissor_licenca_auto','$data_validade_licenca_anterior','$nome_infrator','$cpf','$logradouro','$numero','$bairro','$chefe_fiscalizacao')";
    mysqli_query($con, $sql);


    $emailUser = $_SESSION['email'];
    $user = $_SESSION['nome'];
    $ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
    $ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
    $data = Date("Y-m-d H:i:s");
    $acaoUsuario = "Realizou o Cadastro do auto de inifração de numero ->$numero_auto_infracao, para empresa de codigo $empresa, e processo de codigo $processo";
    $sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
    mysqli_query($con, $sqlLog);
    ?>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header btn-success">
                    <h4 class="modal-title text-center" id="myModalLabel"><strong>AUTO DE INFRAÇÃO CADASTRADO COM SUCESSO!<br><br><P style="text-align: center">AGUARDE UM MOMENTO</strong></P></h4>
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
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">ERRO! POR FAVOR PREENCHA O FORMULÁRIO</h4>
            </div>
            <div class="modal-footer">
                <a href="cad_notificacao.php"><button type="button" class="btn btn-info"><strong>VOLTAR PARA O FORMULÁRIO DE CADASTRO</strong></button></a>
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