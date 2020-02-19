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
$sql = "SELECT tb_licenca.codigo_licenca,tb_licenca.numero_licenca,tb_licenca.data_emissao,tb_licenca.data_validade,tb_licenca.descricao_atividade,tb_licenca.ano_licenca,
            tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica,tb_empresa.cnpj_cpf,tb_empresa.logradouro,tb_empresa.numero,tb_empresa.bairro,tb_empresa.municipio,tb_empresa.cep,tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_empreendimento.nome_bairro,tb_empreendimento.nome_logradouro,tb_empreendimento.numero_empreendimento,tb_empreendimento.nome_bairro,tb_empreendimento.nome_municipio,tb_processo.numero_processo,tb_processo.ano,tb_processo.assunto, (if(current_date()<= data_validade,'<strong>VALIDA</strong>','<strong style=color:#F4C430>INVALIDA<strong>')) AS situacao
            FROM 
            tb_licenca,tb_empresa,tb_empreendimento,tb_processo 
            WHERE
            tb_licenca.fk4_codigo_empresa = tb_empresa.codigo_empresa AND tb_licenca.fk1_codigo_empreendimento = tb_empreendimento.codigo_empreendimento  AND tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND codigo_empresa = $licencas";
$recebe = mysqli_query($con, $sql);

if (mysqli_num_rows($recebe) > 0) {
    ?>
    <div class = "row">
        <div class = "col-sm-12">
            <div class = "table-overflow"><br>
                <table class="table table-striped table-hover table-bordered">
                    <header>
                        <tr style="text-align: center;background-color:#dff0d8;color: #000000" >
                            <th style="text-align: center;font-size: 12px">LICENÇA</th> 
                            <th style="text-align: center;font-size: 12px">NÚMERO DA LICENÇA</th> 
                            <th style="text-align: center;font-size: 12px">DATA DE EMISSÃO</th> 
                            <th style="text-align: center;font-size: 12px">DATA DE VALIDADE</th>                                            
                            <th style="width: 1%;text-align: center"><span class="glyphicon  glyphicon-eye-open" style="margin-left: 5px;color: #1b6d85"></span></th> 
                            <th style="width: 1%;text-align: center"><span class="glyphicon glyphicon-remove" style="margin-left: 5px;color: #CC0000"></span></th> 
                            <th style="width: 1%;text-align: center"><span class="glyphicon glyphicon-print" style="margin-left: 5px;color: #666"></span></th> 
                        </tr>
                    </header>
                    <?php
                    while ($linhas = mysqli_fetch_array($recebe)) {
                        $codigo_empresa = $linhas['codigo_licenca'];
                        ?>
                        <tr style="font-size:13px">
                            <td style="font-size:12px"><?php echo $linhas['assunto']; ?></td>
                            <td style="font-size:12px"><?php echo $linhas['numero_licenca']; ?></td>
                            <td style="font-size:12px"><?php echo date('d/m/Y', strtotime($linhas['data_emissao'])); ?></td>
                            <td style="font-size:12px"><?php echo date('d/m/Y', strtotime($linhas['data_validade'])); ?></td>
                            <td>                               
                                <button  type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModalcad<?php echo $linhas['codigo_licenca']; ?>">VISUALIZAR</button>
                            </td>
                            <?php
                            echo'<td><button  type="button" class="btn btn-xs btn-danger"><a href=detalhes_empresa.php?codigo_empresa=' . $licencas . '><strong style="color:FFF;text-decoration:none">RETORNAR</strong></buttom></a></td>';
                            ?> 
                            <td>
                                <?php
                                echo'<button type="button" class="btn btn-xs btn-basic"><strong><a href=relatorio_licencas.php?codigo_licenca=' . $codigo_empresa. ' target="_blank">IMPRIMIR</strong></button>';
                                ?>  
                            </td>
                        </tr>
                        <!-- Inicio Modal -->
                        <div class="modal fade" id="myModalcad<?php echo $linhas['codigo_licenca']; ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #d0e9c6">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title text-center" id="myModalLabel" style="color:#122b40"><strong>DADOS DA LICENÇA</strong></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <strong>LICENÇA: </strong><?php echo $linhas['assunto']; ?>   
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>DATA EMISSÃO: </strong> <?php echo date('d/m/Y', strtotime($linhas['data_emissao'])); ?> 
                                            </div><br><hr>  
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <strong>NUMERO DA LICENÇA: </strong> <?php echo $linhas['numero_licenca']; ?>   
                                                /</strong> <?php echo $linhas['ano_licenca']; ?>   
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>DATA VALIDADE: </strong> <?php echo date('d/m/Y', strtotime($linhas['data_validade'])); ?> 
                                            </div><br><hr>  
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <strong>NUMERO DO PROCESSO: </strong><?php echo $linhas['numero_processo']; ?>   
                                                /</strong> <?php echo $linhas['ano']; ?>   
                                            </div>
                                            <div class="col-sm-3">
                                                <strong>SITUAÇÃO: </strong> <?php echo $linhas['situacao']; ?> 
                                            </div><br><hr>  
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>DESCRIÇÃO DA ATIVIDADE: </strong><?php echo $linhas['descricao_atividade']; ?>                             
                                            </div><br><hr>                            
                                        </div>
                                        
                                        <div class="row text-center" style="background-color: #d0e9c6">
                                            <div class="col-sm-12">
                                                <h4><strong>DADOS DO EMPREENDIMENTO</strong></h4>                            
                                            </div><br>                           
                                        </div><br>
                                        
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>EMPREEDIMENTO: </strong><?php echo $linhas['nome_empreendimento']; ?>                             
                                            </div><br><hr> 
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>LOCALIZAÇÃO: </strong><?php echo $linhas['nome_logradouro']; ?>                             
                                            </div><br><hr> 
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <strong>NUMERO: </strong><?php echo $linhas['numero_empreendimento']; ?>                                                                                                       
                                            </div>
                                            <div class="col-sm-3">                                                                   
                                                <strong>BAIRRO: </strong><?php echo $linhas['nome_bairro']; ?>                                                                                              
                                            </div> 
                                            <div class="col-sm-6">                                                                     
                                                <strong>MUNICÍPIO: </strong><?php echo $linhas['nome_municipio']; ?>                             
                                            </div><br><hr> 
                                        </div> 
                                       
                                        <div class="row text-center" style="background-color: #d0e9c6">
                                            <div class="col-sm-12">
                                                <h4><strong>DADOS DA EMPRESA</strong></h4>                            
                                            </div><br>                           
                                        </div><br>
                                        
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>RAZÃO SOCIAL / PESSOA FÍSICA: </strong><?php echo $linhas['razaosocial_pessoafisica']; ?>                             
                                            </div><br><hr> 
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <strong>CNPJ/CPF: </strong><?php echo $linhas['cnpj_cpf']; ?>                             
                                            </div> <br><hr> 
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong>ENDEREÇO: </strong><?php echo $linhas['logradouro']; ?>                             
                                            </div><br><hr> 
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <strong>NUMERO: </strong><?php echo $linhas['numero']; ?>                             
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>BAIRRO: </strong><?php echo $linhas['bairro']; ?>                             
                                            </div>
                                            <div class="col-sm-4">
                                                <strong>MUNICIPIO: </strong><?php echo $linhas['municipio']; ?>                             
                                            </div>
                                            <div class="col-sm-2">
                                                <strong>CEP: </strong><?php echo $linhas['cep']; ?>                             
                                            </div><br><hr> 
                                        </div> 
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


