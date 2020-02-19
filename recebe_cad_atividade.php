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
    if (isset($_POST['descricao_atividade']) && empty($_POST['descricao_atividade']) == FALSE) {
    if (isset($_POST['potencial_poluidor']) && empty($_POST['potencial_poluidor']) == FALSE) {

        $empresa = strtoupper(addslashes($_POST['empresa']));
        $empreendimento = strtoupper(addslashes($_POST['empreendimento']));
        $descricao_atividade = strtoupper(addslashes($_POST['descricao_atividade']));
        $potencial_poluidor = strtoupper(addslashes($_POST['potencial_poluidor']));


        $sql = "INSERT INTO tb_atividade(fk8_codigo_empresa,fk5_codigo_empreendimento,descricao_atividade,potencial_poluidor)"
                . "VALUES($empresa,$empreendimento,UPPER('$descricao_atividade'),'$potencial_poluidor')";
        mysqli_query($con, $sql);
//        print_r($sql);

        ?>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">ATIVIDADE CADASTRADA COM SUCESSO!</h4>
                    </div>
                    <div class="modal-footer">
                        <a href="cadastros.php"><button type="button" class="btn btn-success">CONTINUAR CADASTRO</button></a>
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
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
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
</script>



