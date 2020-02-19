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

<form  action="recebe_cad_empreendimento.php"  method="POST" name="frmempreendimento" id="frmempreendimento">
    <div class="panel panel-success">
        <div class="panel-heading"> 
            <div class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DO EMPREENDIMENTO / ATIVIDADE</strong></a>
            </div>
        </div>
        <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="empreendimento"><strong>NOME DO EMPREENDIMENTO*</strong></label>                                  
                            <input type="text" name="empreendimento" id="empreendimento" class="form-control">   
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