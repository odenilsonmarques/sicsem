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
<h2 style="text-align:center;color: #1b6d85"><strong>DADOS DA PROCESSO</strong></h2><br><br>
<?php

/* INFORMAÇÕES REFERENTES A EMPRESA */
$infor_processo = $_GET['codigo_processo']; /* link dinamico utilizando o get */
$sql_processo = "SELECT tb_processo.codigo_processo,tb_processo.numero_processo,tb_processo.ano,tb_processo.data_processo,tb_processo.assunto,tb_processo.situacao_processo,tb_processo.motivo_situacao,tb_empresa.razaosocial_pessoafisica,tb_empreendimento.nome_empreendimento,tb_empreendimento.nome_atividade 
            FROM 
            tb_processo, tb_empresa, tb_empreendimento
            WHERE
            tb_processo.fk3_codigo_empresa = tb_empresa.codigo_empresa AND tb_processo.fk4_codigo_empreendimento = tb_empreendimento.codigo_empreendimento AND codigo_processo = $infor_processo ORDER BY codigo_processo";

$exe_processo = mysqli_query($con, $sql_processo);
if (mysqli_num_rows($exe_processo)) {
    while ($linhas = mysqli_fetch_array($exe_processo)) {
        $processos = $linhas['codigo_processo']; //variavel para recupar o id do processo
        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>RAZÃO SOCIAL / PESSOA FÍSICA: </strong>" . $linhas['razaosocial_pessoafisica'] . "";
        echo"</div>";
        
        echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>NÚMERO DO PROCESSO: </strong>" . $linhas['numero_processo'] . "";
        echo"<style='font-size:16px;text-align:right'>/" . $linhas['ano'] . "";
        echo"</div>";
        echo"</div><br>";
       
        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>ASSUNTO: </strong>" . $linhas['assunto'] . "";
        echo"</div>";
        
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>DATA DA ABERTURA: </strong>" . date('d/m/Y', strtotime($linhas['data_processo'])) . ""; 
        echo"</div><br><br>";
        echo"</div>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-12'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>ATIVIDADE: </strong>" . $linhas['nome_atividade'] . "";
        echo"</div><br><br>";
        echo"</div>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-12'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>EMPREENDIMENTO: </strong>" . $linhas['nome_empreendimento'] . "";
        echo"</div><br><br>";
        echo"</div>";
               
        echo"<div class='row'>";
        echo"<div class='col-sm-8'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>SITUAÇÃO: </strong>" . $linhas['situacao_processo'] . "";
        echo"</div>";

        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>MOTIVO DA SITUAÇÃO: </strong>" . $linhas['motivo_situacao'] . "";
        echo"</div><br><br><br>";
        echo"</div>";

        
        echo"<div class='row'>";
            echo"<div class='col-sm-12' style='text-align:center'>";
                 echo"<div class='btn-group'>";
                 ?>
                    <script>
                       document.write("<button type='button' class='btn btn-primary'><a href=" + document.referrer + "><strong style='font-weight:bold; color:#FFF; text-decoration:none; font-size:17px'>RETORNAR PARA CONSULTA <span class='glyphicon glyphicon-repeat' ></span><br></strong></a>");
                    </script>
                <?php
            
                     echo'<button type="button" class="btn" style="margin-left:10px;font-size:17px"><strong><a href=relatorio_processos.php?codigo_processo='.$processos.' target="_blank">GERAR IMPRESSÃO <span  class="glyphicon glyphicon-print" style=""></strong></button>';                   
                          
                    echo "<div  class='btn btn-danger' style='margin-left:10px;font-size:17px'>";
                            echo"<a href='inicio.php' style='font-weight:bold; color:#FFF; text-decoration:none'>CANCELAR CONSULTA <span  class='glyphicon glyphicon-remove'></a>";
                    echo"</div>"; 
                echo"</div>";           
            echo"</div>";
        echo"</div><br><br><br><br>";
    }
}







