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

$notificacoes = $_GET ['codigo_empresa'];
$sql = "SELECT tb_notificacao.codigo_notificacao,tb_notificacao.numero_notificacao,tb_notificacao.ano_notificacao,tb_notificacao.data_notificacao,tb_notificacao.data_comparecimento,tb_notificacao.profissao_atividade,tb_notificacao.descricao_prazo,
               tb_notificacao.status,tb_notificacao.cpf,tb_notificacao.nome_notificado,tb_notificacao.logradouro,tb_notificacao.bairro,tb_notificacao.numero,tb_notificacao.status_informacoes_adicionais,tb_notificacao.testemunha,
               tb_notificacao.numero_notificacao_anterior,tb_notificacao.numero_notificacao_ano_anterior,tb_notificacao.numero_processo_notificacao_anterior,tb_notificacao.ano_processo_notificacao_anterior,tb_notificacao.status_licenca,tb_notificacao.ano_licenca_notificacao_anterior,tb_notificacao.numero_licenca_notificacao_anterior,tb_notificacao.orgao_emissor_licenca,tb_notificacao.data_validade,tb_notificacao.chefe_fiscalizacao,
               tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_processo.codigo_processo,tb_processo.numero_processo,tb_processo.ano,tb_fiscal.codigo_fiscal,tb_fiscal.nome_matricula_fiscal    
               FROM 
               tb_notificacao,tb_empresa,tb_processo,tb_fiscal
               WHERE 
               tb_notificacao.fk5_codigo_empresa = tb_empresa.codigo_empresa AND tb_notificacao.fk2_codigo_processo = tb_processo.codigo_processo AND tb_notificacao.fk1_codigo_fiscal = tb_fiscal.codigo_fiscal and codigo_empresa = $notificacoes";

$recebe = mysqli_query($con, $sql);

if (mysqli_num_rows($recebe) > 0) {
    ?>
    <div class = "row">
        <div class = "col-sm-12">
            <div class = "table-overflow"><br>
                <table class="table table-striped table-hover table-bordered">
                    <header>
                        <tr style="text-align: center;background-color:#dff0d8;color: #000000" >
                            <th style="text-align: center;font-size: 12px">RAZÃO SOCIAL / PESSOA FÍSICA</th> 
                            <th style="text-align: center;font-size: 12px">NOME FANTASIA</th> 
                            <th style="text-align: center;font-size: 12px">DATA DA NOTIFICAÇÃO</th> 
                            <th style="text-align: center;font-size: 12px">DATA PARA COMPARECIMENTO</th>                                            
                            <th style="text-align: center;font-size: 12px">Nº DA NOTIFICAÇÃO</th>                                            
                            <th style="text-align: center;font-size: 12px">Nº DO PROCESSO</th>                                            
                            <th style="width: 1%;text-align: center"><span class="glyphicon  glyphicon-eye-open" style="margin-left: 5px;color: #1b6d85"></span></th> 
                            <th style="width: 1%;text-align: center"><span class="glyphicon glyphicon-remove" style="margin-left: 5px;color: #CC0000"></span></th> 
                            <th style="width: 1%;text-align: center"><span class="glyphicon glyphicon-print" style="margin-left: 5px;color: #666"></span></th> 
                        </tr>
                    </header>
                    <?php
                    while ($linhas = mysqli_fetch_array($recebe)) {
                        $codigo_empresa = $linhas['codigo_notificacao'];
                        ?>
                        <tr style="font-size:13px">
                            <td style="font-size:12px"><?php echo $linhas['razaosocial_pessoafisica']; ?></td>
                            <td style="font-size:12px"><?php echo $linhas['nome_fantasia']; ?></td>
                            <td style="font-size:12px"><?php echo date('d/m/Y', strtotime($linhas['data_notificacao'])); ?></td>
                            <td style="font-size:12px"><?php echo date('d/m/Y', strtotime($linhas['data_comparecimento'])); ?></td>
                            <td style="font-size:12px"><?php echo ($linhas['numero_notificacao']); ?></td>
                            <td style="font-size:12px"><?php echo ($linhas['numero_processo']); ?></td>

                            <td>                               
                                <button  type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModalcad<?php echo $linhas['codigo_notificacao']; ?>">VISUALIZAR</button>
                            </td>
                            <?php
                            echo'<td><button  type="button" class="btn btn-xs btn-danger"><a href=detalhes_empresa.php?codigo_empresa=' . $notificacoes . '><strong style="color:FFF;text-decoration:none">RETORNAR</strong></buttom></a></td>';
                            ?> 
                            <td>
                                <?php
                                echo'<button type="button" class="btn btn-xs btn-basic"><strong><a href=relatorio_licencas.php?codigo_licenca=' . $codigo_empresa . ' target="_blank">IMPRIMIR</strong></button>';
                                ?>  
                            </td>
                        </tr>
                        <!-- Inicio Modal -->
                        <div class="modal fade" id="myModalcad<?php echo $linhas['codigo_notificacao']; ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #d0e9c6">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title text-center" id="myModalLabel" style="color:#122b40"><strong>DADOS DA NOTIFICAÇÃO</strong></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <strong>RAZÃO SOCIAL / PESSOA FISICA : </strong><?php echo $linhas['razaosocial_pessoafisica']; ?>   
                                            </div>
                                            <div class="col-sm-6">
                                                <strong>NOME FANTASIA: </strong> <?php echo $linhas['nome_fantasia']; ?> 
                                            </div><br><hr>  
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <strong>DATA DA NOTIFICAÇÃO: </strong> <?php echo date('d/m/Y', strtotime($linhas['data_notificacao'])); ?> 
                                            </div> 
                                            <div class="col-sm-6">
                                                <strong>DATA PARA COMPARECIMENTO: </strong> <?php echo date('d/m/Y', strtotime($linhas['data_comparecimento'])); ?>                            
                                            </div><br><hr>                     
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <strong>NUMERO DA NOTIFICAÇÃO: </strong><?php echo $linhas['numero_notificacao']; ?>   
                                                /</strong> <?php echo $linhas['ano_notificacao']; ?>  
                                            </div>
                                            <div class="col-sm-6">
                                                <strong>NUMERO DO PROCESSO: </strong><?php echo $linhas['numero_processo']; ?>   
                                                /</strong> <?php echo $linhas['ano']; ?>   
                                            </div><br><hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>PROFISSÃO / ATIVIDADE: </strong><?php echo $linhas['profissao_atividade']; ?>                                    
                                            </div><br><hr>                            
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>DESCRIÇÃO E PRAZO: </strong><?php echo $linhas['descricao_prazo']; ?>                                    
                                            </div><br><hr>                               
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>TESTEMUNHA: </strong><?php echo $linhas['testemunha']; ?>                                    
                                            </div><br><hr>                               
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>CHEFE DA FISCALIZAÇÃO: </strong><?php echo $linhas['chefe_fiscalizacao']; ?>                                    
                                            </div><br><hr>                              
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>FISCAL: </strong><?php echo $linhas['nome_matricula_fiscal']; ?>                                    
                                            </div>                              
                                        </div>
                                        <div class="row text-center" style="background-color: #d0e9c6">
                                            <div class="col-sm-12">
                                                <h4><strong>DADOS DO NOTIFICADO</strong></h4>                            
                                            </div><br>                           
                                        </div><br>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <strong>NOTIFICADO: </strong><?php echo $linhas['nome_notificado']; ?>                             
                                            </div>               
                                            <div class="col-sm-4">
                                                <strong>CNPJ/CPF: </strong><?php echo $linhas['cpf']; ?>                             
                                            </div> <br><hr> 
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>ENDEREÇO: </strong><?php echo $linhas['logradouro']; ?>                             
                                            </div><br><hr> 
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <strong>NUMERO: </strong><?php echo $linhas['numero']; ?>                             
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>BAIRRO: </strong><?php echo $linhas['bairro']; ?>                             
                                            </div>
                                        </div>  
                                         <div class="row text-center" style="background-color: #d0e9c6">
                                             <div class="col-sm-12">
                                                <h4><strong>INFORMAÇÕES ADICIONAIS ( NOTIFICAÇÃO / PROCESSO / LICENÇA )</strong></h4>                            
                                            </div><br>                           
                                        </div><br>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <strong>HÁ NOTIFICAÇÃO ANTERIOR: </strong><?php echo $linhas['status_informacoes_adicionais']; ?>                             
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>NUMERO: </strong><?php echo $linhas['numero_notificacao_anterior']; ?>                                                   
                                                /</strong> <?php echo $linhas['numero_notificacao_ano_anterior']; ?>   
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>Nº PROCESSO ANTERIOR: </strong><?php echo $linhas['numero_processo_notificacao_anterior']; ?>                             
                                                /</strong> <?php echo $linhas['ano_processo_notificacao_anterior']; ?>   
                                               
                                            </div><br><hr> 
                                        </div> 
                                        
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <strong>HÁ LICENÇA ANTERIOR: </strong><?php echo $linhas['status_licenca']; ?>                             
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>NUMERO: </strong><?php echo $linhas['numero_licenca_notificacao_anterior']; ?>                                                   
                                                /</strong> <?php echo $linhas['ano_licenca_notificacao_anterior']; ?>   
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>ORGÃO EMISSOR: </strong><?php echo $linhas['orgao_emissor_licenca']; ?>                                                                            
                                            </div> 
                                            <div class="col-sm-3">
                                                <strong>DATA DE VALIDADE: </strong> <?php echo date('d/m/Y', strtotime($linhas['data_validade'])); ?>                     
                                            </div><br><hr> 
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <!-- Fim Modal -->
                            <?php
                        }
                    }else {
                        
                        
                        
                    }
                    ?>

            </table><br>
        </div>
    </div>
</div>

<?php
require './pages/footer.php';


