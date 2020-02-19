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

    $empresa = strtoupper(addslashes($_POST['empresa']));
    $empreendimento = strtoupper(addslashes($_POST['empreendimento']));
    $nome_atividade = strtoupper(addslashes($_POST['nome_atividade']));
    $potencial_poluidor = strtoupper(addslashes($_POST['potencial_poluidor']));

    $verifica = "SELECT fk8_codigo_empresa,nome_atividade FROM tb_atividade,tb_empresa WHERE tb_atividade.fk8_codigo_empresa='" . $_POST['empresa'] . "' AND tb_atividade.nome_atividade='" . $_POST['nome_atividade'] . "'";
    $recebe_consulta = mysqli_query($con, $verifica);

    if (mysqli_num_rows($recebe_consulta) > 0) {
        ?>
        <script>
            alert('ERRO! ESTA RAZÃO SOCIAL / PESSOA FÍSICA JÁ POSSUI ESTA ATIVIDADE CADASTRADA');
            window.history.back();
        </script>
        <?php
    } else

    if (isset($_POST['empresa'])) {

        $sql = "INSERT INTO tb_atividade(fk8_codigo_empresa,fk5_codigo_empreendimento,nome_atividade,potencial_poluidor)"
                . "VALUES($empresa,$empreendimento,UPPER('$nome_atividade'),'$potencial_poluidor')";
        mysqli_query($con, $sql);
//        print_r($sql);
        
        
        // O CÓDIGO ABAIXO REGISTRA O USUARIO QUE REALIZOU O CADASTRO DE CERTO EMPRESA / PESSOA FISICA
        $emailUser = $_SESSION['email'];
        $user = $_SESSION['nome'];
        $ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
        $ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
        $data = Date("Y-m-d H:i:s");
        $acaoUsuario = "Realizou o Cadastro da Atividade ->$nome_atividade, para o empreendimento de codigo->$empreendimento, e empresa de codigo $empreendimento";
        $sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
        mysqli_query($con,$sqlLog);
        
        ?>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header btn-success">
                        <h4 class="modal-title text-center" id="myModalLabel"><strong>ATIVIDADE CADASTRADA COM SUCESSO!<br><br><P style="text-align: center">AGUARDE UM MOMENTO</strong></P></h4>
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
    } else {

        $sql = "INSERT INTO tb_atividade(fk8_codigo_empresa,descricao_atividade,potencial_poluidor)"
                . "VALUES($empresa,UPPER('$descricao_atividade'),'$potencial_poluidor')";
        mysqli_query($con, $sql);
        print_r($sql);
        ?>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
            <div class="modal-dialog btn-success" role="document">                                
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><strong>ATIVIDADE CADASTRADA COM SUCESSO!<br><br><P style="text-align: center">AGUARDE UM MOMENTO</strong></P></h4>
                    <script type="text/javascript">
                        setTimeout('window.location.href="cadastros.php"', 3500);
                    </script>
                </div> 
                <div class="modal-footer">
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
?>
<!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">ERRO! POR FAVOR PREENCHA O FORMULÁRIO</h4>
            </div>
            <div class="modal-footer">
                <a href="cad_empreendimento.php"><button type="button" class="btn btn-info"><strong>VOLTAR PARA O FORMULÁRIO DE CADASTRO</strong></button></a>
                <a href="home.php"><button type="button" class="btn btn-danger"><strong>CANCELAR</strong></button></a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#myModal').modal('show');
    });
</script>-->


