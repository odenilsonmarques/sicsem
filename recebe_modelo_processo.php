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

if (isset($_POST['empreendimento']) && empty($_POST['empreendimento']) == FALSE) {
    if (isset($_POST['numero_processo']) && empty($_POST['numero_processo']) == FALSE) {

        $empreendimento = strtoupper(addslashes($_POST['empreendimento']));
        $numero_processo = strtoupper(addslashes($_POST['numero_processo']));

        if ($numero_processo < 0) {
            ?>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">ERRO! O NÚMERO DO PROCESSO INFORMADO É INVÁLIDO</h4>                           
                        </div>
                        <div class="modal-footer">
                            <a href="cad_licenca.php"><button type="button" class="btn btn-info">POR FAVOR! INFORME OUTRO NÚMERO</button></a>
                            <a href="home.php"><button type="button" class="btn btn-danger">CANCELAR</button></a>
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

//verrificando se ja existe no banco de dados o numero do processo informado
        $consulta_processo = "SELECT *FROM tb_processo WHERE numero_processo ='" . $_POST['numero_processo'] . "' ";
        $recebe_consulta = mysqli_query($con, $consulta_processo);

        if (mysqli_num_rows($recebe_consulta) > 0) {
            ?>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">ERRO! JÁ EXISTE UM PROCESSO COM O NÚMERO INFORMADO</h4>                           
                        </div>
                        <div class="modal-footer">
                            <a href="cad_licenca.php"><button type="button" class="btn btn-info">POR FAVOR! INFORME OUTRO NÚMERO</button></a>
                            <a href="home.php"><button type="button" class="btn btn-danger">CANCELAR</button></a>
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

            $sql = "INSERT INTO tb_processo(fk4_codigo_empreendimento,numero_processo)"
                    . "VALUES('$empreendimento','$numero_processo')";
            mysqli_query($con, $sql);
            ?>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">PROCESSO CADASTRADO COM SUCESSO!</h4>
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
                <a href="cad_processo.php"><button type="button" class="btn btn-info"><strong>VOLTAR PARA O FORMULÁRIO DE CADASTRO</strong></button></a>
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


