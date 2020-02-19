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

$atividade = $_GET ['codigo_empresa'];
$sql_ativ = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_atividade,tb_empreendimento.grau_atividade,tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica
FROM
tb_empreendimento,tb_empresa
WHERE
tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa AND codigo_empresa = $atividade and nome_atividade != nome_empreendimento and nome_atividade != ''";

$recebe = mysqli_query($con, $sql_ativ);

if (mysqli_num_rows($recebe) > 0) {
    ?>
    <div class = "row">
        <div class = "col-sm-12">
            <div class = "table-overflow"><br>
                <table class="table table-striped table-hover table-bordered">
                    <header>
                        <tr style="text-align: center;background-color:#dff0d8;color: #000000">                         
                            <th style="text-align: center;font-size: 12px">RAZÃO SOCIAL / PESSOA FISICA</th> 
                            <th style="text-align: center;font-size: 12px">ATIVIDADE</th> 
                            <th style="text-align: center;font-size: 12px">GRAU DE POLUIÇÃO</th>                    
                            <th style="width: 1%;text-align: center"><span class="glyphicon glyphicon-repeat" style="margin-left: 5px;color: #CC0000"></span></th>                                                                                       
                        </tr>
                    </header>
                    <?php
                    while ($linhas = mysqli_fetch_array($recebe)) {
                        $codigo_empresa = $linhas['codigo_empreendimento'];
                        ?>
                        <tr style="font-size:13px">                           
                            <td style="font-size:12px"><?php echo $linhas['razaosocial_pessoafisica']; ?></td>
                            <td style="font-size:12px"><?php echo $linhas['nome_atividade']; ?></td>
                            <td style="font-size:12px"><?php echo $linhas['grau_atividade']; ?></td>    
                            <td>
                                <?php
                                echo'<button  type="button" class="btn btn-xs btn-danger"><a href=detalhes_empresa.php?codigo_empresa=' . $atividade . '><strong style="color:FFF;text-decoration:none">RETORNAR</strong></buttom></a>';
                                ?> 
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<div class="alert alert-warning text-center"><strong>OPS! NÃO FOI ENCONTRADO ATIVIDADES PARA ESSE EMPREENDIMENTO</strong><br><br><button  type="button" class="btn btn-xs btn-primary"><a href=detalhes_empresa.php?codigo_empresa=' . $atividade . '><strong style="color:FFF;text-decoration:none">RETORNAR</strong></buttom></a></div>';
                }
                ?>

            </table><br>
        </div>
    </div>
</div>

<?php
require './pages/footer.php';


