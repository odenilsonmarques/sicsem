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

$ativ_empree = $_GET ['codigo_empreendimento'];
$sql_ativ = "select tb_atividade.codigo_atividade,tb_atividade.nome_atividade,tb_atividade.potencial_poluidor,tb_empresa.codigo_empresa,tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento
from
tb_atividade,tb_empresa,tb_empreendimento
where
tb_atividade.fk8_codigo_empresa = tb_empresa.codigo_empresa and tb_atividade.fk5_codigo_empreendimento = tb_empreendimento.codigo_empreendimento and codigo_empreendimento = $ativ_empree";

$recebe = mysqli_query($con, $sql_ativ);

if (mysqli_num_rows($recebe) > 0) {
    ?>
    <div class = "row">
        <div class = "col-sm-12">
            <div class = "table-overflow"><br>
                <table class="table table-striped table-hover table-bordered">
                    <header>
                        <tr style="text-align: center;background-color:#dff0d8;color: #000000">                         
                            <th style="text-align: center;font-size: 12px">EMPREENDIMENTO</th> 
                            <th style="text-align: center;font-size: 12px">ATIVIDADE</th> 
                            <th style="text-align: center;font-size: 12px">GRAU DE POLUIÇÃO</th> 
                            <th style="width: 1%;text-align: center"><span class="glyphicon glyphicon-repeat" style="margin-left: 5px;color: #CC0000"></span></th>                             
                            
                        </tr>
                    </header>
                    <?php
                    while ($linhas = mysqli_fetch_array($recebe)) {
                        $codigo_empreendimento = $linhas['codigo_empreendimento'];
                        ?>
                        <tr style="font-size:13px">                           
                            <td style="font-size:12px"><?php echo $linhas['nome_empreendimento']; ?></td>
                            <td style="font-size:12px"><?php echo $linhas['nome_atividade']; ?></td>
                            <td style="font-size:12px"><?php echo $linhas['potencial_poluidor']; ?></td>
                            <td>
                              <script>
                                    document.write('<button type="button" class="btn btn-xs btn-danger" ><a href="' + document.referrer + '"><strong style="color:FFF;text-decoration:none">RETORNAR</strong></a></button>');
                            </script>
                            </td>
                            
                        </tr>
                        <?php
                    }
                }else{
                    ?>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="alert-warning"><br><br>
                                    <h4><strong>Este Empreendimento Não Possui Atividades <img src="img/imgtriste.png" style="height: 20px;width: 25px" ></strong></h4><br><br>
                                    <script>
                                    document.write('<button type="button" class="btn btn-xs btn-danger" ><a href="' + document.referrer + '"><strong style="color:FFF;text-decoration:none;font-size:16px">RETORNAR<span class="glyphicon glyphicon-repeat" style="margin-left: 5px;color: #FFFF"></span> <br></strong></a></button>');
                                    </script><br><br>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>

            </table><br>
        </div>
    </div>
</div>

<?php
require './pages/footer.php';


