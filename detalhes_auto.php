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
?>
<h2 style="text-align:center;color: #1b6d85"><strong>DADOS DO AUTO DE INFRAÇÃO</strong></h2><br><br>
<?php

/* INFORMAÇÕES REFERENTES A EMPRESA */
$infor_auto = $_GET['codigo_auto_infracao']; /* link dinamico utilizando o get */
$sql_processo = "SELECT tb_auto_infracao.codigo_auto_infracao,tb_auto_infracao.numero_auto_infracao,tb_auto_infracao.ano_auto_infracao,tb_auto_infracao.data_auto_infracao,tb_auto_infracao.profissao_atividade,tb_auto_infracao.descricao_infracao,tb_auto_infracao.auto_infracao,tb_auto_infracao.status_auto,tb_auto_infracao.natureza_da_infracao,tb_auto_infracao.material_apreendido,
            tb_auto_infracao.valor_infracao,tb_auto_infracao.valor_reais,tb_auto_infracao.status_informacoes_adicionais_auto,tb_auto_infracao.numero_notificacao_anterior_auto,tb_auto_infracao.numero_notificacao_ano_anterior_auto,tb_auto_infracao.numero_processo_notificacao_anterior_auto,tb_auto_infracao.ano_processo_notificacao_anterior_auto,tb_auto_infracao.status_licenca,
            tb_auto_infracao.numero_licenca_anterior_auto,tb_auto_infracao.ano_licenca_anterior_auto,tb_auto_infracao.orgao_emissor_licenca_auto,tb_auto_infracao.data_validade_licenca_anterior,tb_auto_infracao.nome_infrator,tb_auto_infracao.cpf,tb_auto_infracao.logradouro,tb_auto_infracao.numero,tb_auto_infracao.bairro,tb_auto_infracao.chefe_fiscalizacao,tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_processo.numero_processo,tb_processo.ano,tb_fiscal.nome_matricula_fiscal    
            FROM 
            tb_auto_infracao,tb_empresa,tb_processo,tb_fiscal
            WHERE
            tb_auto_infracao.fk9_codigo_empresa = tb_empresa.codigo_empresa AND tb_auto_infracao.fk5_codigo_processo = tb_processo.codigo_processo AND tb_auto_infracao.fk3_codigo_fiscal = tb_fiscal.codigo_fiscal  AND codigo_auto_infracao = $infor_auto ORDER BY codigo_auto_infracao";

$exe_processo = mysqli_query($con, $sql_processo);
if (mysqli_num_rows($exe_processo)) {
    while ($linhas = mysqli_fetch_array($exe_processo)) {
        $processos = $linhas['codigo_auto_infracao']; //variavel para recupar o id do processo
        echo"<div class='row'>";
        echo"<div class='col-sm-6' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>RAZÃO SOCIAL / PESSOA FÍSICA: </strong>" . $linhas['razaosocial_pessoafisica'] . "";
        echo"</div>";
        
        echo"<div class='col-sm-6'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>NOME FANTASIA: </strong>" . $linhas['nome_fantasia'] . "";
        echo"</div>";
        echo"</div><br>";
       
        echo"<div class='row'>";
        echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>Nº PROCESSO: </strong>" . $linhas['numero_processo'] . "";
        echo"<style='font-size:16px'>/" . $linhas['ano'] . "";
        echo"</div>";
        
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:80px'>Nº DO AUTO: </strong>" . $linhas['numero_auto_infracao'] . "";
        echo"<style='font-size:16px'>/" . $linhas['ano_auto_infracao'] . "";
        echo"</div>";
      
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:115px'>DATA DO AUTO: </strong>" . date('d/m/Y', strtotime($linhas['data_auto_infracao'])) . "";     
        echo"</div>";
        echo"</div><br>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-12'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>PROFISSÃO / ATIVIDADE: </strong>" . $linhas['profissao_atividade'] . "";
        echo"</div><br><br>";
        echo"</div>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-12'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>DESCRIÇÃO DA INFRAÇÃO: </strong>" . $linhas['descricao_infracao'] . "";
        echo"</div>";
        echo"</div><br>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-12'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>SITUAÇÃO: </strong>" . $linhas['status_auto'] . "";
        echo"</div>";
        echo"</div><br>";
        
        
        echo"<div class='row'>";
        echo"<div class='col-sm-6'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>FISCAL: </strong>" . $linhas['nome_matricula_fiscal'] . "";
        echo"</div>";
        echo"<div class='col-sm-6'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>CHEFE DA FISCALIZAÇÃO: </strong>" . $linhas['chefe_fiscalizacao'] . "";
        echo"</div><br><br>";
        echo"</div>";
        
        
        
        echo"<div class='row'>";
        echo"<div class='col-sm-12 text-center'>";
        echo"<h3 style='color: #1b6d85'><strong>INFORMAÇÕES DO AUTUADO</strong></h3>";
        echo"</div><br><br><br><br>";
        echo"</div>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-6' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>NOTIFICADO: </strong>" . $linhas['nome_infrator'] . "";   
        echo"</div>";
        
        echo"<div class='col-sm-6' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>CPF: </strong>" . $linhas['cpf'] . ""; 
        echo"</div>";
        echo"</div><br>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>ENDEREÇO: </strong>" . $linhas['logradouro'] . "";   
        echo"</div>";
        
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:80px'>NÚMERO: </strong>" . $linhas['numero'] . ""; 
        echo"</div>";
        
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:115px'>BAIRRO: </strong>" . $linhas['bairro'] . ""; 
        echo"</div>";
        echo"</div><br>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-12 text-center'>";
        echo"<h3 style='color: #1b6d85'><strong>INFORMAÇÕES ADICIONAIS (NOTIFICAÇÃO / PROCESSO / LICENÇA)</strong></h3>";
        echo"</div><br><br><br><br>";
        echo"</div>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>EXISTE NOTIFICAÇÃO : </strong>" . $linhas['status_informacoes_adicionais_auto'] . "";
        echo"</div>";
        
        echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>Nº NOTIFICACAO ANTERIOR : </strong>" . $linhas['numero_notificacao_anterior_auto'] . "";
        echo"<style='font-size:16px'>/" . $linhas['numero_notificacao_ano_anterior_auto'] . "";
        echo"</div>";
        
     
        echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:px'>Nº PROCESSO NOTIFICAÇÃO ANTERIOR : </strong>" . $linhas['numero_processo_notificacao_anterior_auto'] . "";
        echo"<style='font-size:16px'>/" . $linhas['ano_processo_notificacao_anterior_auto'] . "";
        echo"</div><br><br>";
        echo"</div>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-3'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>EXISTE LICENÇA : </strong>" . $linhas['status_licenca'] . "";
        echo"</div>";
        
        echo"<div class='col-sm-3'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>Nº LICENÇA ANTERIOR : </strong>" . $linhas['numero_licenca_anterior_auto'] . "";
        echo"<style='font-size:16px'>/" . $linhas['ano_licenca_anterior_auto'] . "";
        echo"</div>";
        
        echo"<div class='col-sm-3'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:px'>ORGÃO EMISSOR : </strong>" . $linhas['orgao_emissor_licenca_auto'] . "";
        echo"</div>";
        
        echo"<div class='col-sm-3'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>DATA VALIDADE: </strong>" . date('d/m/Y', strtotime($linhas['data_validade_licenca_anterior'])) . "";
        echo"</div><br><br><br><br>";
        echo"</div>";
                
        echo"<div class='row'>";
            echo"<div class='col-sm-12' style='text-align:center'>";
                 echo"<div class='btn-group'>";
                 ?>
                    <script>
                       document.write("<button type='button' class='btn btn-primary'><a href=" + document.referrer + "><strong style='font-weight:bold; color:#FFF; text-decoration:none; font-size:17px'>RETORNAR PARA CONSULTA <span class='glyphicon glyphicon-repeat' ></span><br></strong></a>");
                    </script>
                <?php
            
                     echo'<button type="button" class="btn" style="margin-left:10px;font-size:17px"><strong><a href=#>GERAR IMPRESSÃO <span  class="glyphicon glyphicon-print" style=""></strong></button>';                   
                          
                    echo "<div  class='btn btn-danger' style='margin-left:10px;font-size:17px'>";
                            echo"<a href='inicio.php' style='font-weight:bold; color:#FFF; text-decoration:none'>CANCELAR CONSULTA <span  class='glyphicon glyphicon-remove'></a>";
                    echo"</div>"; 
                echo"</div>";           
            echo"</div>";
        echo"</div><br><br><br><br>";
    }
}







