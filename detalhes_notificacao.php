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
<h2 style="text-align:center;color: #1b6d85"><strong>DADOS DA NOTIFICAÇÃO</strong></h2><br><br>
<?php

/* INFORMAÇÕES REFERENTES A EMPRESA */
$infor_notificacao = $_GET['codigo_notificacao']; /* link dinamico utilizando o get */
$sql_processo = "SELECT tb_notificacao.codigo_notificacao,tb_notificacao.numero_notificacao,tb_notificacao.ano_notificacao,tb_notificacao.data_notificacao,tb_notificacao.data_comparecimento,tb_notificacao.profissao_atividade,tb_notificacao.descricao_prazo,tb_notificacao.status,tb_notificacao.status_informacoes_adicionais,tb_notificacao.numero_notificacao_anterior,tb_notificacao.numero_notificacao_ano_anterior,tb_notificacao.ano_processo_notificacao_anterior,tb_notificacao.numero_processo_notificacao_anterior,tb_notificacao.status_licenca,tb_notificacao.numero_licenca_notificacao_anterior,tb_notificacao.ano_licenca_notificacao_anterior,tb_notificacao.orgao_emissor_licenca,tb_notificacao.data_validade,tb_notificacao.status_notificado,tb_notificacao.nome_notificado,tb_notificacao.cpf,tb_notificacao.testemunha,tb_notificacao.logradouro,tb_notificacao.numero,tb_notificacao.bairro,tb_notificacao.chefe_fiscalizacao,tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_processo.numero_processo,tb_processo.ano,tb_fiscal.nome_matricula_fiscal,
            (if(current_date()<= data_comparecimento,'<strong>DENTRO DO PRAZO</strong>','<strong style=color:#F4C430>PRAZO VENCIDO<strong>')) AS situacao    
            FROM 
            tb_notificacao,tb_empresa,tb_processo,tb_fiscal
            WHERE 
            tb_notificacao.fk5_codigo_empresa = tb_empresa.codigo_empresa AND tb_notificacao.fk2_codigo_processo = tb_processo.codigo_processo AND tb_notificacao.fk1_codigo_fiscal = tb_fiscal.codigo_fiscal  AND codigo_notificacao = $infor_notificacao ORDER BY codigo_notificacao";

$exe_processo = mysqli_query($con, $sql_processo);
if (mysqli_num_rows($exe_processo)) {
    while ($linhas = mysqli_fetch_array($exe_processo)) {
        $processos = $linhas['codigo_notificacao']; //variavel para recupar o id do processo
        echo"<div class='row'>";
        echo"<div class='col-sm-5' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>RAZÃO SOCIAL / PESSOA FÍSICA: </strong>" . $linhas['razaosocial_pessoafisica'] . "";
        echo"</div>";
        
        echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>NOME FANTASIA: </strong>" . $linhas['nome_fantasia'] . "";
        echo"</div>";
       
        echo"<div class='col-sm-3'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:100px'>Nº PROCESSO: </strong>" . $linhas['numero_processo'] . "";
        echo"<style='font-size:16px'>/" . $linhas['ano'] . "";
        echo"</div>";
        echo"</div><br>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-5' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>DATA DA NOTIFICAÇÃO: </strong>" . date('d/m/Y', strtotime($linhas['data_notificacao'])) . "";     
        echo"</div>";
        
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>DATA PARA COMPARECIMENTO: </strong>" . date('d/m/Y', strtotime($linhas['data_notificacao'])) . ""; 
        echo"</div>";
        
        echo"<div class='col-sm-3' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:80px'>Nº NOTIFICAÇÃO: </strong>" . $linhas['numero_notificacao'] . "";
        echo"<style='font-size:16px'>/" . $linhas['ano_notificacao'] . "";
        echo"</div>";
        echo"</div><br>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-12'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>PROFISSÃO / ATIVIDADE: </strong>" . $linhas['profissao_atividade'] . "";
        echo"</div><br><br>";
        echo"</div>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-12'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>DESCRIÇÃO E PRAZO: </strong>" . $linhas['descricao_prazo'] . "";
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
        echo"<div class='col-sm-12'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>TESTEMUNHA: </strong>" . $linhas['testemunha'] . "";
        echo"</div><br><br>";
        echo"</div>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-12 text-center'>";
        echo"<h3 style='color: #1b6d85'><strong>INFORMAÇÕES DO NOTIFICADO</strong></h3>";
        echo"</div><br><br><br><br>";
        echo"</div>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-6' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>NOTIFICADO: </strong>" . $linhas['nome_notificado'] . "";   
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
        echo"<strong style='font-size:15px;margin-left:10px'>NÚMERO: </strong>" . $linhas['numero'] . ""; 
        echo"</div>";
        
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>BAIRRO: </strong>" . $linhas['bairro'] . ""; 
        echo"</div>";
        echo"</div><br>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-12 text-center'>";
        echo"<h3 style='color: #1b6d85'><strong>INFORMAÇÕES ADICIONAIS (NOTIFICAÇÃO / PROCESSO / LICENÇA)</strong></h3>";
        echo"</div><br><br><br><br>";
        echo"</div>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>EXISTE NOTIFICAÇÃO : </strong>" . $linhas['status_informacoes_adicionais'] . "";
        echo"</div>";
        
        echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>Nº NOTIFICACAO ANTERIOR : </strong>" . $linhas['numero_notificacao_anterior'] . "";
        echo"<style='font-size:16px'>/" . $linhas['numero_notificacao_ano_anterior'] . "";
        echo"</div>";
        
        echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:px'>Nº PROCESSO NOTIFICAÇÃO ANTERIOR : </strong>" . $linhas['numero_processo_notificacao_anterior'] . "";
        echo"<style='font-size:16px'>/" . $linhas['ano_processo_notificacao_anterior'] . "";
        echo"</div><br><br>";
        echo"</div>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-3'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>EXISTE LICENÇA : </strong>" . $linhas['status_licenca'] . "";
        echo"</div>";
        
        echo"<div class='col-sm-3'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>Nº LICENÇA ANTERIOR : </strong>" . $linhas['numero_licenca_notificacao_anterior'] . "";
        echo"<style='font-size:16px'>/" . $linhas['ano_licenca_notificacao_anterior'] . "";
        echo"</div>";
        
        echo"<div class='col-sm-3'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:px'>ORGÃO EMISSOR : </strong>" . $linhas['orgao_emissor_licenca'] . "";
        echo"</div>";
        
        echo"<div class='col-sm-3'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>DATA VALIDADE: </strong>" . date('d/m/Y', strtotime($linhas['data_validade'])) . "";
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







