<?php
session_start();
require './config/conexao.php';
require './pages/header.php';

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:loginadmin.php");
    exit();
}

if (isset($_POST['nome']) && empty($_POST['nome']) == FALSE) {
    if (isset($_POST['email']) && empty($_POST['email']) == FALSE) {
        if (isset($_POST['senha']) && empty($_POST['senha']) == FALSE) {

            $nome = strtolower(addslashes($_POST['nome']));
            $email = strtolower(addslashes($_POST['email']));
            $cargo = strtolower(addslashes($_POST['cargo']));
            $matricula = strtoupper(addslashes($_POST['matricula']));
            $nivel_acesso = strtoupper(addslashes($_POST['nivel_acesso']));
            $senha = strtoupper(addslashes($_POST['senha']));

            //verifacando se o nome da erazao social / pessoa fisica já está cadastrado
            $consulta_email = "SELECT *FROM tb_usuario WHERE email  = '" . $_POST['email'] . "'";
            $recebe_consulta_email = mysqli_query($con, $consulta_email);

            //verificando se o cpf ou o cnpj ja existe no banco de dados
            $consulta_matricula = "SELECT *FROM tb_usuario WHERE matricula ='" . $_POST['matricula'] . "' ";
            $recebe_consulta_matricula = mysqli_query($con, $consulta_matricula);

            if (mysqli_num_rows($recebe_consulta_email) > 0) {
                ?>
                <script>
                    alert('ERRO O EMAIL INFORMADO JÁ EXISTE!');
                    window.history.back();
                </script>
                <?php
            } else if (mysqli_num_rows($recebe_consulta_matricula) > 0) {
                ?>
                <script>
                    alert('ERRO A MATRICULA INFORMADA JÁ EXISTE!');
                    window.history.back();
                </script>
                <?php
            } else {
                $sql = "INSERT INTO tb_usuario(nome,email,cargo,matricula,nivel_acesso,senha)VALUES(('$nome'),'$email',('$cargo'),('$matricula'),('$nivel_acesso'),md5('$senha'))";
                mysqli_query($con, $sql);
//                print_r($sql);
                ?>
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-center" id="myModalLabel"><strong>USUÁRIO CADASTRADO COM SUCESSO!<br><br><P style="text-align: center">AGUARDE UM MOMENTO</strong></P></h4>
                                <script type="text/javascript">
                                    setTimeout('window.location.href="inicioadm.php"', 3500);
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
    }
}

//$_SESSION['msgcad'] = "<div class='alert alert-warning fade in' style='text-align:center' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>POR FAVOR, PREENCHA TODOS OS CAMPOS PARA QUE O CADASTRO SEJA EFETUADO!</strong></div>";
//header("Location: cad_usuario.php");
//exit();


