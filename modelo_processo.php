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
?>
<form  action="recebe_cad_processo.php"  method="POST" name="frmprocesso" id="frmprocesso">
    <div class="panel panel-success">
        <div class="panel-heading"> 
            <div class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DO PROCESSO</strong></a>
            </div>
        </div>
        <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">                                                
                            <label for="empreendimento"><strong>SELECIONE O EMPREENDIMENTO*</strong></label><a href="cad_empreendimento.php" style="float: right;font-size: 16px"><strong>caso não encontre,faça o cadastro - aqui</strong></a><br/>
                            <select name="empreendimento" id="empreendimento" class="form-control" autofocus="">
                                <option value="">--- SELECIONE ---</option>
                                <?php
                                $parametro_empreendimento = filter_input(INPUT_GET, "parametro_empreendimento");
                                $empreendimento = "SELECT *FROM tb_empreendimento WHERE nome_empreendimento LIKE '%$parametro_empreendimento' ORDER BY nome_empreendimento";
                                $recebe_empreendimento = mysqli_query($con, $empreendimento);
                                while ($linha = mysqli_fetch_array($recebe_empreendimento)) {
                                    echo '<option value="' . $linha['codigo_empreendimento'] . '">' . $linha['nome_empreendimento'] . '</option>';
                                }
                                ?>                                                                       
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="numero_processo"><strong>NÚMERO DO PROCESSO *</strong></label><br/>
                                <input type="number" name="numero_processo" id="numero_processo" class="form-control" autofocus=""/>
                            </div>
                        </div>
                    </div>
                </div>                                     
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-title" style="text-align: center;"><br/>
            <input type="submit" value="REALIZAR CADASTRO" class="btn btn-success" style="font-size: 17px; font-weight: bold;"/>
            <button  class="btn btn-danger"><a href="home.php"  style="font-size: 17px; font-weight: bold; color: #fff;text-decoration: none;">CANCELAR CADASTRO</a></button><br/><br/>
        </div>   
    </div>
</form>