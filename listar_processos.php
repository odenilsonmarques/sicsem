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


$licencas = $_GET ['codigo_empresa'];
$sql_proc = "SELECT tb_processo.codigo_processo,tb_processo.numero_processo,tb_processo.ano,tb_processo.data_processo,tb_processo.assunto,tb_processo.situacao_processo,tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica FROM tb_processo,tb_empresa WHERE tb_processo.fk3_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $licencas";
$recebe = mysqli_query($con, $sql_proc);

if (mysqli_num_rows($recebe) > 0) {
    ?>
    <div class = "row">
        <div class = "col-sm-12">
            <div class = "table-overflow"><br>
                <table class="table table-striped table-hover table-bordered">
                    <header>
                        <tr style="text-align: center;background-color:#dff0d8;color: #000000" >
                            <th style="text-align: center;font-size: 12px">NÚMERO DO PROCESSO</th> 
                            <th style="text-align: center;font-size: 12px">ANO</th> 
                            <th style="text-align: center;font-size: 12px">DATA</th> 
                            <th style="text-align: center;font-size: 12px">ASSUNTO</th> 
                            <th style="text-align: center;font-size: 12px">SITUAÇÃO</th>                    
                            <th style="width: 1%;text-align: center"><span class="glyphicon  glyphicon-eye-open" style="margin-left: 5px;color: #337ab7"></span></th> 
                            <th style="width: 1%;text-align: center"><span class="glyphicon glyphicon-print" style="margin-left: 5px;color: #666"></span></th> 
                            <th style="width: 1%;text-align: center"><span class="glyphicon glyphicon-repeat" style="margin-left: 5px;color: #CC0000"></span></th> 
                            
                        </tr>
                    </header>
                    <?php
                    while ($linhas = mysqli_fetch_array($recebe)) {
                        $codigo_empresa = $linhas['codigo_processo'];
                        ?>
                        <tr style="font-size:13px">
                            <td style="font-size:12px"><?php echo $linhas['numero_processo']; ?></td>
                            <td style="font-size:12px"><?php echo $linhas['ano']; ?></td>
                            <td style="font-size:12px"><?php echo date('d/m/Y', strtotime($linhas['data_processo'])); ?></td>
                            <td style="font-size:12px"><?php echo $linhas['assunto']; ?></td>
                            <td style="font-size:12px"><?php echo $linhas['situacao_processo']; ?></td>
                            <td>                               
                                <button  type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModalcad<?php echo $linhas['codigo_processo']; ?>">VISUALIZAR</button>
                            </td>                                
                            <td>
                                <?php 
                                echo'<button type="button" class="btn btn-xs btn-basic"><strong><a href=relatorio_processos.php?codigo_processo=' .$codigo_empresa. ' target="_blank">IMPRIMIR</strong></button>';
                                ?>  
                            </td>                            
                            <?php 
                                echo'<td><button  type="button" class="btn btn-xs btn-danger"><a href=detalhes_empresa.php?codigo_empresa=' . $licencas . '><strong style="color:FFF;text-decoration:none">RETORNAR</strong></buttom></a></td>';             
                                ?> 
                        </tr>
                        <!-- Inicio Modal -->
                        <div class="modal fade" id="myModalcad<?php echo $linhas['codigo_processo']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #d0e9c6">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title text-center" id="myModalLabel" style="color:#122b40"><strong>DADOS DO PROCESSO</strong></h4>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>RAZÃO SOCIAL / PESSOA FÍSICA: </strong> <?php echo $linhas['razaosocial_pessoafisica']; ?></p><hr>                                      
                                        <p><strong>NÚMERO DO PROCESSO: </strong> <?php echo $linhas['numero_processo']; ?></p><hr>                                      
                                        <p><strong>ANO: </strong><?php echo $linhas['ano']; ?></p><hr>
                                        <p><strong>DATA DE ABERTURA: </strong><?php echo date('d/m/Y', strtotime($linhas['data_processo'])); ?></p><hr>
                                        <p><strong>TIPO DE LICENÇA:</strong><?php echo $linhas['assunto']; ?></p><hr>
                                        <p><strong>STATUS: </strong><?php echo $linhas['situacao_processo']; ?></p>
                                    </div>                       
                                </div>
                            </div>
                        </div>
                        <!-- Fim Modal -->
                     <?php   }
                        
                                                    
                                
                        } ?>
                       
                    </table><br>
                </div>
            </div>
        </div>

        <?php
        require './pages/footer.php';


        