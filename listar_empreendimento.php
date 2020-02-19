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

$sql_proc = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_empreendimento.nome_logradouro,tb_empreendimento.nome_bairro,tb_empreendimento.nome_uf,tb_empreendimento.nome_municipio,tb_empreendimento.numero_empreendimento,tb_empreendimento.complemento,localizacao_map_empre,
             tb_empresa.razaosocial_pessoafisica
FROM
tb_empreendimento,tb_empresa
WHERE
 tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $licencas and nome_empreendimento != nome_atividade and nome_empreendimento != '' ";

$recebe = mysqli_query($con, $sql_proc);

if (mysqli_num_rows($recebe) > 0) {
    ?>
    <div class = "row">
        <div class = "col-sm-12">
            <div class = "table-overflow"><br>
                <table class="table table-striped table-hover table-bordered">
                    <header>
                        <tr style="text-align: center;background-color:#dff0d8;color: #000000">                         
                            <th style="text-align: center;font-size: 12px">EMPREENDIMENTO / ATIVIDADE</th> 
                            <th style="text-align: center;font-size: 12px">ENDEREÇO</th> 
                            <th style="text-align: center;font-size: 12px">BAIRRO</th> 
                            <th style="text-align: center;font-size: 12px">MUNICIPIO</th>                    
                            <th style="width: 1%;text-align: center"><span class="glyphicon  glyphicon-eye-open" style="margin-left: 5px;color: #337ab7"></span></th>                                 
                            <th style="width: 1%;text-align: center"><span class="glyphicon glyphicon-map-marker" style="margin-left: 5px;color: #007fff"></span></th>
                            <th style="width: 1%;text-align: center"><span class="glyphicon glyphicon-briefcase" style="margin-left: 5px;color: #048C46"></span></th>                             
                            <th style="width: 1%;text-align: center"><span class="glyphicon glyphicon-repeat" style="margin-left: 5px;color: #CC0000"></span></th> 
                        </tr>
                    </header>
                    <?php
                    while ($linhas = mysqli_fetch_array($recebe)) {
                        $codigo_empresa = $linhas['codigo_empreendimento'];
                        ?>
                        <tr style="font-size:13px">                           
                            <td style="font-size:12px"><?php echo $linhas['nome_empreendimento']; ?></td>
                            <td style="font-size:12px"><?php echo $linhas['nome_logradouro']; ?></td>
                            <td style="font-size:12px"><?php echo $linhas['nome_bairro']; ?></td>
                            <td style="font-size:12px"><?php echo $linhas['nome_municipio']; ?></td>
                            <td>
                                <button  type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModalcad<?php echo $linhas['codigo_empreendimento']; ?>">VISUALIZAR</button>
                            </td> 
                            <td>
                                <?php
                                echo'<button type="button" class="btn btn-xs btn-info"><strong><a href='.$linhas['localizacao_map_empre'].' target="_blank"><strong style="color:FFF;">LOCALIZAÇÃO</strong></strong></button>';
                                ?>  
                            </td>
                            <td>
                                <?php 
                                
                                if(mysqli_num_rows($recebe)>0){
                                echo'<button type="button" class="btn btn-xs btn-success"><a href=listar_ativ_empree.php?codigo_empreendimento=' .$codigo_empresa.' style="color:#FFF" >ATIVIDADE</a></strong></button>';
                                }else{
                                    echo'<button type="button" class="btn btn-xs btn-success"><a href=#' .$codigo_empresa.' style="color:#FFF" >ATIVIDADE</a></strong></button>';
                                }
                                ?>  
                            </td>
                            <td>
                            <?php
                            echo'<button  type="button" class="btn btn-xs btn-danger"><a href=detalhes_empresa.php?codigo_empresa=' . $licencas . '><strong style="color:FFF;text-decoration:none">RETORNAR</strong></buttom></a>';
                            ?> 
                            </td>
                        </tr>
                        <!-- Inicio Modal -->
                        <div class="modal fade" id="myModalcad<?php echo $linhas['codigo_empreendimento']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #d0e9c6">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title text-center" id="myModalLabel" style="color:#122b40"><strong>DADOS DO EMPREENDIMENTO</strong></h4>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>RAZÃO SOCIAL / PESSOA FÍSICA: </strong> <?php echo $linhas['razaosocial_pessoafisica']; ?></p><hr>                                      
                                        <p><strong>EMPREENDIMENTO / ATIVIDADE: </strong> <?php echo $linhas['nome_empreendimento']; ?></p><hr>                                      
                                        <p><strong>ENDEREÇO: </strong> <?php echo $linhas['nome_logradouro']; ?></p><hr>                                      
                                        <p><strong>NÚMERO: </strong> <?php echo $linhas['numero_empreendimento']; ?></p><hr>                                      
                                        <p><strong>COMLPLEMENTO: </strong><?php echo $linhas['complemento']; ?></p><hr>              
                                        <p><strong>UF: </strong><?php echo $linhas['nome_uf']; ?></p><hr>              
                                        <p><strong>MUNICIPIO: </strong><?php echo $linhas['nome_municipio']; ?></p><hr>              
                                        <p><strong>BAIRRO: </strong><?php echo $linhas['nome_bairro']; ?></p><hr>              
                                    </div>                       
                                </div>
                            </div>
                        </div>
                        <!-- Fim Modal -->
                        <?php
                    }
                }
                ?>

            </table><br>
        </div>
    </div>
</div>

<?php
require './pages/footer.php';


