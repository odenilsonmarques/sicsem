<!DOCTYPE html>
<?php
session_start();
require './pages/header.php';
?>
<!--este scritp garante que nos campos nº matricula e senha só serão aceitos numero positivos-->
<script type="text/javascript">
    function somenteNumeros(num) {
        var er = /[^0-9.]/;
        er.lastIndex = 0;
        var campo = num;
        if (er.test(campo.value)) {
            campo.value = "";
        }
    }
</script>

<link rel="stylesheet" href="./css/estilo_login.css"/>
<script type="text/javascript" src="js/valida_login.js"></script>
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<div class="row">
    <div class="col-sm-4" id="sm4"></div>
    <div class="col-sm-4" id="login">
        <form method="POST" action="valida.php" name="frmlogin" id="frmlogin" autocomplete="off">
            <div class="login-header">
                <p style="font-family:initial;font-size:30px;color: #006600"><strong>Bem - Vindo!</strong></p>
                <img src="img/user (2).png"><br>
                <p style="font-size: 20px;font-family:initial;color: #006600"><strong>SicSem</strong><br>Sistema de Controle Semam</p>
            </div><br>
            <?php
            if (isset($_SESSION['msg'])) {
                echo ($_SESSION['msg']);
                unset($_SESSION['msg']);
            }
            ?>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="secsem@sec.com" autofocus=""/>            
            </div>
            <div class="form-group" id="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control" onkeyup="somenteNumeros(this);" placeholder="********"/>
            </div><br>
            <input type="submit" value="Acessar" class="btn"/>
        </form><br>
        <div class="direito-reservados">
            <strong>&copy 2017 Secretaria Municipal do Ambiente</strong>
        </div><br><br><br>
    </div>
    <div class="col-sm-4" style="text-align: center"></div>
</div>
</body>
</html>
