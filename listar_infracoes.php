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

$infracoes = $_GET ['codigo_empresa'];
$sql = "SELECT tb_auto_infracao.codigo_auto_infracao,tb_auto_infracao.numero_auto_infracao,tb_auto_infracao.ano_auto_infracao,tb_auto_infracao.data_auto_infracao,tb_auto_infracao.profissao_atividade,tb_auto_infracao.descricao_infracao,tb_auto_infracao.auto_infracao,
        tb_auto_infracao.status_auto,tb_auto_infracao.natureza_da_infracao,tb_auto_infracao.material_apreendido,tb_auto_infracao.valor_infracao,tb_auto_infracao.valor_reais,tb_auto_infracao.status_informacoes_adicionais_auto,tb_auto_infracao.numero_notificacao_anterior_auto,
        tb_auto_infracao.numero_notificacao_ano_anterior_auto,tb_auto_infracao.numero_processo_notificacao_anterior_auto,tb_auto_infracao.ano_processo_notificacao_anterior_auto,tb_auto_infracao.status_licenca,tb_auto_infracao.numero_licenca_anterior_auto,tb_auto_infracao.ano_licenca_anterior_auto,
        tb_auto_infracao.orgao_emissor_licenca_auto,tb_auto_infracao.data_validade_licenca_anterior,tb_auto_infracao.nome_infrator,tb_auto_infracao.cpf,tb_auto_infracao.logradouro,tb_auto_infracao.numero,tb_auto_infracao.bairro,tb_auto_infracao.chefe_fiscalizacao,
        tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_processo.codigo_processo,tb_processo.numero_processo,tb_processo.ano,tb_fiscal.codigo_fiscal,tb_fiscal.nome_matricula_fiscal
        FROM 
        tb_auto_infracao,tb_empresa,tb_processo,tb_fiscal
        WHERE 
        tb_auto_infracao.fk9_codigo_empresa = tb_empresa.codigo_empresa AND tb_auto_infracao.fk5_codigo_processo = tb_processo.codigo_processo AND tb_auto_infracao.fk3_codigo_fiscal = tb_fiscal.codigo_fiscal and codigo_empresa = $infracoes";



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
                            <th style="text-align: center;font-size: 12px">NÚMERO DO AUTO</th> 
                            <th style="text-align: center;font-size: 12px">DATA DO AUTO</th>                                                                                      
                            <th style="text-align: center;font-size: 12px">Nº DO PROCESSO</th>                                            
                            <th style="width: 1%;text-align: center"><span class="glyphicon  glyphicon-eye-open" style="margin-left: 5px;color: #1b6d85"></span></th> 
                            <th style="width: 1%;text-align: center"><span class="glyphicon glyphicon-remove" style="margin-left: 5px;color: #CC0000"></span></th> 
                            <th style="width: 1%;text-align: center"><span class="glyphicon glyphicon-print" style="margin-left: 5px;color: #666"></span></th> 
                        </tr>
                    </header>
                    <?php
                    while ($linhas = mysqli_fetch_array($recebe)) {
                        $codigo_empresa = $linhas['codigo_auto_infracao'];
                        ?>
                        <tr style="font-size:13px">
                            <td style="font-size:12px"><?php echo $linhas['razaosocial_pessoafisica']; ?></td>
                            <td style="font-size:12px"><?php echo $linhas['nome_fantasia']; ?></td>
                            <td style="font-size:12px"><?php echo $linhas['numero_auto_infracao']; ?></td>
                            <td style="font-size:12px"> <?php echo date('d/m/Y', strtotime($linhas['data_auto_infracao'])); ?> </td> 
                            <td style="font-size:12px"><?php echo ($linhas['numero_processo']); ?></td>
                            <td>                               
                                <button  type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModalcad<?php echo $linhas['codigo_auto_infracao']; ?>">VISUALIZAR</button>
                            </td>
                            <?php
                            echo'<td><button  type="button" class="btn btn-xs btn-danger"><a href=detalhes_empresa.php?codigo_empresa=' . $infracoes . '><strong style="color:FFF;text-decoration:none">RETORNAR</strong></buttom></a></td>';
                            ?> 
                            <td>
                                <?php
                                echo'<button type="button" class="btn btn-xs btn-basic"><strong><a href=relatorio_licencas.php?codigo_licenca=' . $codigo_empresa . ' target="_blank">IMPRIMIR</strong></button>';
                                ?>  
                            </td>
                        </tr>
                        <!-- Inicio Modal -->
                        <div class="modal fade" id="myModalcad<?php echo $linhas['codigo_auto_infracao']; ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #d0e9c6">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title text-center" id="myModalLabel" style="color:#122b40"><strong>DADOS DO AUTO DE INFRAÇÃO</strong></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <strong>RAZÃO SOCIAL / PESSOA FISICA : </strong><?php echo $linhas['razaosocial_pessoafisica']; ?>   
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>NOME FANTASIA: </strong> <?php echo $linhas['nome_fantasia']; ?> 
                                            </div><br><hr>  
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <strong>NUMERO DO AUTO : </strong><?php echo $linhas['numero_auto_infracao']; ?>   
                                                /</strong> <?php echo $linhas['ano_auto_infracao']; ?>  
                                            </div>

                                            <div class="col-sm-4">
                                                <strong>DATA DO AUTO: </strong> <?php echo date('d/m/Y', strtotime($linhas['data_auto_infracao'])); ?>                                      
                                            </div> 

                                            <div class="col-sm-4">                                                
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
                                                <strong>DESCRIÇÃO  DA INFRAÇÃO: </strong><?php echo $linhas['descricao_infracao']; ?>                                    
                                            </div><br><hr>                               
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>STATUS: </strong><?php echo $linhas['status_auto']; ?>                                    
                                            </div><br><hr>                               
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>NATUREZA DA INFRAÇÃO: </strong><?php echo $linhas['natureza_da_infracao']; ?>                                    
                                            </div><br><hr>                              
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>MATERIAL APREENDIDO: </strong><?php echo $linhas['material_apreendido']; ?>                                    
                                            </div><br><hr>                              
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <strong>VALOR EM UFM: </strong><?php echo $linhas['valor_infracao']; ?>                                    
                                            </div>                             
                                            <div class="col-sm-6">
                                                <strong>VALOR EM R$: </strong><?php echo $linhas['valor_reais']; ?>                                    
                                            </div><br><hr>                              
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <strong>FISCAL: </strong><?php echo $linhas['nome_matricula_fiscal']; ?>                                    
                                            </div>                              

                                            <div class="col-sm-7">
                                                <strong>CHEFE FISCALIZAÇÃO: </strong><?php echo $linhas['chefe_fiscalizacao']; ?>                                    
                                            </div>                              
                                        </div>
                                        <div class="row text-center" style="background-color: #d0e9c6">
                                            <div class="col-sm-12">
                                                <h4><strong>DADOS DO AUTUADO</strong></h4>                            
                                            </div><br>                           
                                        </div><br>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <strong>NOME: </strong><?php echo $linhas['nome_infrator']; ?>                             
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
                                                <strong>HÁ NOTIFICAÇÃO ANTERIOR: </strong><?php echo $linhas['status_informacoes_adicionais_auto']; ?>                             
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>NUMERO: </strong><?php echo $linhas['numero_notificacao_anterior_auto']; ?>                                                   
                                                /</strong> <?php echo $linhas['numero_notificacao_ano_anterior_auto']; ?>   
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>NUMERO PROCESSO: </strong><?php echo $linhas['numero_processo_notificacao_anterior_auto']; ?>                           
                                                /</strong> <?php echo $linhas['ano_processo_notificacao_anterior_auto']; ?>   
                                            </div>
                                        </div><br><hr>
                                        
                                        
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <strong>HÁ LICENCA ANTERIOR: </strong><?php echo $linhas['status_licenca']; ?>                             
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>NUMERO: </strong><?php echo $linhas['numero_licenca_anterior_auto']; ?>                                                   
                                                /</strong> <?php echo $linhas['ano_licenca_anterior_auto']; ?>   
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>ORGÃO EMISSOR: </strong><?php echo $linhas['orgao_emissor_licenca_auto']; ?>                           
                                            
                                            </div>
                                            <div class="col-sm-3">
                                                    <strong>DATA DA VALIDADE: </strong> <?php echo date('d/m/Y', strtotime($linhas['data_validade_licenca_anterior'])); ?>                          
                                            
                                            </div>
                                        </div><br><hr>
                                    </div>
                                </div>
                            </div>
                            <!-- Fim Modal -->
                            <?php
                        }
                    } else {
                        
                    }
                    ?>

            </table><br>
        </div>
    </div>
</div>

<?php
require './pages/footer.php';


