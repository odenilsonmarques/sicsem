<?php
session_start();
require './config/conexao.php';


if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
    exit();
}
if (isset($_POST['nome_empreendimento']) && empty($_POST['nome_empreendimento']) == FALSE) {

    $nome_empreendimento = strtoupper(addslashes($_POST['nome_empreendimento']));

    $sql = "INSERT INTO tb_empreendimento(nome_empreendimento)"
            . "VALUES(UPPER('$nome_empreendimento')";
    mysqli_query($con, $sql);
    ?>               
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">EMPREENDIMENTO CADASTRADO COM SUCESSO!</h4>
                </div>
                <div class="modal-footer">
                    <a href="cad_licenca.php"><button type="button" class="btn btn-danger">CONTINUAR CADASTRO</button></a>
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





