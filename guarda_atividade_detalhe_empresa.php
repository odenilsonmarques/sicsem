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
    $nome_atividade = strtoupper(addslashes($_POST['nome_atividade']));
//    $nome_empreendimento = strtoupper(addslashes($_POST['nome_empreendimento']));
//    $nome_logradouro = strtoupper(addslashes($_POST['nome_logradouro']));
//    $numero_empreendimento = strtoupper(addslashes($_POST['numero_empreendimento']));
//    $complemento = strtoupper(addslashes($_POST['complemento']));
//    $localizacao_map_empre = (addslashes($_POST['localizacao_map_empre']));
//    $uf = strtoupper(addslashes($_POST['nome_uf']));
//    $municipio = strtoupper(addslashes($_POST['nome_municipio']));
//    $bairro = strtoupper(addslashes($_POST['nome_bairro']));
    $atividade_empreendimento = strtoupper(addslashes($_POST['atividade_empreendimento']));
    $grau_atividade = strtoupper(addslashes($_POST['grau_atividade']));
//    $denominacao_comercial = strtoupper(addslashes($_POST['denominacao_comercial']));

    $verifica = "SELECT fk1_codigo_empresa,nome_atividade FROM tb_empreendimento,tb_empresa WHERE tb_empreendimento.fk1_codigo_empresa='" . $_POST['empresa'] . "' AND tb_empreendimento.nome_atividade='" . $_POST['nome_atividade'] . "'";
    $recebe_consulta = mysqli_query($con, $verifica);
    if (mysqli_num_rows($recebe_consulta) > 0 && $nome_atividade != '') {
        ?>
        <script>
            alert('ERRO! ESTA RAZÃO SOCIAL / PESSOA FÍSICA JÁ POSSUI ESTA ATIVIDADE CADASTRADA');
            window.history.back();

        </script>
        <?php
    } else
    if (isset($_POST['empresa'])) {
        $sql = "INSERT INTO tb_empreendimento(fk1_codigo_empresa,nome_atividade,atividade_empreendimento,grau_atividade)"
                . "VALUES($empresa,UPPER('$nome_atividade'),'$atividade_empreendimento','$grau_atividade')";
        mysqli_query($con, $sql);

        //recuperando o ultimo id do usuario inserido
        $ultimo_cod = mysqli_insert_id($con);
        echo $ultimo_cod;
        ?>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header btn-success">
                        <h4 class="modal-title " id="myModalLabel">EMPREENDIMENTO CADASTRADO COM SUCESSO, AGUARDE UM MOMENTO!</h4>
                        <script type="text/javascript">
                            setTimeout('window.location.href="detalhes_empresa.php"', 3500);
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



