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
$codigo_atividade = $_GET['codigo_atividade']; /* link dinamico utilizando o get */
$sql = "SELECT *FROM tb_atividade WHERE codigo_atividade = '$codigo_atividade'";
$exe_sql = mysqli_query($con, $sql);
$linha_sql = mysqli_fetch_array($exe_sql);
?>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<link rel="stylesheet" href="css/estilo_alteraAtividade.css">

<script type="text/javascript">
    $(document).ready(function () {
        jQuery.validator.addMethod("isString", function (value, element) {
            var regExp = /[0-9]/;
            if (regExp.test(value))
                return false;
            return true;
        },
                "Por Favor! Insira Somente Letras");

        //Na linha abaixo, quando o form for submetido ele faz o validate 
        $('#frmatividade').validate({
            //na linha abaixo sao criada as regras de validacao
            rules: {
               
                potencial_poluidor: {
                    required: true
                }
               
            },
            //na  linha abaixo sao criada as mensagem que serao vista pelo usuarios
            messages: {
               
                potencial_poluidor: {
                    required: "Campo Obrigatório*"
                }
            }
        });
    });
</script>


<div class="row">   
    <div class="col-sm-6">
        <h3><strong>ALTERAÇÃO DA ATIVIDADE</strong></h3>
    </div>
    <div class="col-sm-6"></div>
</div>

<div class="panel-group">
    <form  action="salvar_alteracao_atividade.php"  method="POST" name="frmatividade" id="frmatividade">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading"> 
                        <div class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DA ATIVIDADE</strong></a>
                        </div>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">                              
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="empreendimento"><strong>EMPREENDIMENTO*</strong></label><br/>                                    
                                       <select  name="empreendimento" id="empreendimento" readonly="" class="form-control">                
                                            <?php                                           
                                            $empreendimento = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_atividade.codigo_atividade
                                                          FROM 
                                                          tb_empreendimento,tb_atividade
                                                          WHERE
                                                          tb_atividade.fk5_codigo_empreendimento = tb_empreendimento.codigo_empreendimento AND codigo_atividade = $codigo_atividade";                 
                                            $recebe_empreendimento = mysqli_query($con, $empreendimento);
                                            while ($linha = mysqli_fetch_array($recebe_empreendimento)) {
                                                echo '<option value="' . $linha['codigo_empreendimento'] . '">' . $linha['nome_empreendimento'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="nome_atividade"><strong>ATIVIDADE *</strong></label><br/>
                                        <input type="text" name="nome_atividade" id="nome_atividade" value="<?= $linha_sql['nome_atividade']; ?>" class="form-control"  autofocus="" />
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-12">                                    
                                    <div class="form-group">
                                        <label for="potencial_poluidor"><strong>POTENCIAL POLUIDOR DA ATIVIDADE *</strong></label><br/>
                                            <select name="potencial_poluidor" id="potencial_poluidor" value="<?= $linha_sql['potencial_poluidor']; ?>"class="form-control">
                                                <option value="">SELECIONE</option>
                                                <option value="INSIGNIFICANTE">INSIGNIFICANTE</option>
                                                <option value="BAIXO">BAIXO</option>
                                                <option value="MEDIO">MEDIO</option>
                                                <option value="ALTO">ALTO</option>
                                            </select> 
                                     </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <input type = "hidden" name = "codigo_atividade" value = "<?= $linha_sql['codigo_atividade']; ?>">
                    <div class="panel-title" style="text-align: center;"><br/>
                        <button type = "submit"  class = "btn btn-success" style = "font-size: 17px; font-weight: bold;">REALIZAR ALTERAÇÃO<span class="glyphicon glyphicon-saved" style="margin-left: 10px;"></span></button>
                         <button  class="btn btn-danger"><a href="editar.php"  style="font-size: 17px; font-weight: bold; color: #fff;text-decoration: none;">CANCELAR ALTERAÇÃO<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a></button><br/><br/>
                    </div>   
                </div>
            </dIv>
        </div>
    </form>
</div>
</body>
</html>

