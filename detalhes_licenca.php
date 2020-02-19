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
<h2 style="text-align:center;color: #1b6d85"><strong>DADOS DA LICENÇA</strong></h2><br><br>
<?php

/*INFORMAÇÕES REFERENTES A EMPRESA */
$infor_lincenca = $_GET['codigo_licenca']; /* link dinamico utilizando o get */
$sql_empresa = "SELECT tb_licenca.codigo_licenca,tb_licenca.numero_licenca,tb_licenca.ano_licenca,tb_licenca.data_emissao,tb_licenca.data_validade,tb_licenca.descricao_atividade,tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_empresa.pessoa_fisicajuridica,tb_empresa.cnpj_cpf,
tb_empresa.logradouro,tb_empresa.numero,tb_empresa.uf,tb_empresa.municipio,tb_empresa.bairro,tb_empresa.cep,tb_empresa.email,tb_empresa.telefone,tb_processo.codigo_processo,tb_processo.numero_processo,tb_processo.ano,tb_processo.assunto,
tb_empreendimento.codigo_empreendimento, tb_empreendimento.nome_empreendimento,tb_empreendimento.nome_logradouro,tb_empreendimento.numero_empreendimento,tb_empreendimento.nome_bairro,tb_empreendimento.nome_municipio,(if(current_date()<= data_validade,'VALIDA','INVALIDA')) AS situacao
FROM 
tb_licenca,tb_empresa,tb_processo,tb_empreendimento
WHERE 
tb_licenca.fk4_codigo_empresa = tb_empresa.codigo_empresa and tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo and tb_licenca.fk1_codigo_empreendimento = tb_empreendimento.codigo_empreendimento and codigo_licenca = $infor_lincenca ORDER BY codigo_licenca DESC limit 1";

$exe_empresa = mysqli_query($con, $sql_empresa);
if (mysqli_num_rows($exe_empresa)) {
    while ($linhas = mysqli_fetch_array($exe_empresa)) {
        $licencas = $linhas['codigo_licenca']; //variavel pararecupar o id do empreendimento
        echo"<div class='row'>";
            echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
                echo"<strong style='font-size:15px;margin-left:10px'>TIPO DE LICENÇA: </strong>" . $linhas['assunto'] . "";
            echo"</div>";
            echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
                echo"<strong style='font-size:15px;text-align:right'>DATA DE EMISSÃO: </strong>" . date('d/m/Y', strtotime ($linhas['data_emissao'])) . "";
            echo"</div><br><br>";
        echo"</div>";
        
        echo"<div class='row'>";
            echo"<div class='col-sm-8'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";       
                echo"<strong style='font-size:15px;margin-left:10px'>NÚMERO DA LICENÇA: </strong>" . $linhas['numero_licenca'] . "";
                echo"<style='font-size:16px;text-align:right'>/" . $linhas['ano_licenca'] . "";
            echo"</div>";
            echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";       
                echo"<strong style='font-size:15px;text-align:right'>DATA DE VALIDADE: </strong>" . date('d/m/Y', strtotime ($linhas['data_validade'])) . ""; 
            echo"</div><br><br>";
        echo"</div>";
        
         echo"<div class='row'>";
            echo"<div class='col-sm-8'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";   
                echo"<strong style='font-size:15px;margin-left:10px'>NÚMERO PROCESSO: </strong>" . $linhas['numero_processo'] . "";  
                echo"<strong style='font-size:15px;margin-left:px'>/</strong>" . $linhas['ano'] . "";
            echo"</div>";
            echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";                   
                echo"<strong style='font-size:15px;text-align:right'>SITUAÇÃO: </strong>" . $linhas['situacao'] . ""; 
                echo"</div><br><br>";
        echo"</div>";
        
        echo"<div class='row'>";
        echo"<div class='col-sm-12'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";                   
                echo"<strong style='font-size:15px;margin-left:10px'>DESCRIÇÃO DA ATIVIDADE: </strong>" . $linhas['descricao_atividade'] . "";            
             echo"</div>";
//             echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";                   
//                echo"<strong style='font-size:15px;text-align:right'>NÍVEL DE POLUIÇÃO: </strong>" . $linhas['potencial_poluidor'] . ""; 
//                echo"</div><hr style='border:1px solid black'>";
        echo"</div><br>";
        
         echo"<div class='row'>";
            echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";   
                echo"<strong style='font-size:15px;margin-left:10px'>RAZÃO SOCIAL / PESSOA FÍSICA: </strong>" . $linhas['razaosocial_pessoafisica'] . "";
            echo"</div>";
            echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";   
                 echo"<strong style='font-size:15px;text-align:right'>CNPJ / CPF: </strong>" . $linhas['cnpj_cpf'] . "";  
            echo"</div><br><br>";
           
        echo"</div>";
              
        echo"<div class='row'>";
              echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";   
                  echo"<strong style='font-size:15px;margin-left:10px'>ENDEREÇO: </strong>" . $linhas['logradouro'] . "";
                  echo"<strong style='font-size:15px;margin-left:10px'>Nº: </strong>" . $linhas['numero'] . "";
              echo"</div>";
              echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";                   
                  echo"<strong style='font-size:15px;text-align:right'>BAIRRO: </strong>" . $linhas['bairro'] . "";         
              echo"</div><br><br>";
          echo"</div>";
               
        echo"<div class='row'>";
            echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";   
                 echo"<strong style='font-size:15px;margin-left:10px'>MUNICÍPIO: </strong>" . $linhas['municipio'] . "";
              echo"</div>";
              echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";                   
                  echo"<strong style='font-size:15px;text-aling:right'>CEP: </strong>" . $linhas['cep'] . "<br>";       
              echo"</div><hr style='border:1px solid black'>";
          echo"</div>";
        
          
           echo"<div class='row'>";
            echo"<div class='col-sm-8'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";   
                  echo"<strong style='font-size:15px;margin-left:10px'>EMPREEENDIMENTO: </strong>" . $linhas['nome_empreendimento'] . "";
              echo"</div>";
              echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";                   
                 echo"<strong style='font-size:15px;text-align:right'>LOCALIZADO EM: </strong>" . $linhas['nome_logradouro'] . "";      
              echo"</div><br><br>";
          echo"</div>";
          
          echo"<div class='row'>";
            echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";   
                   echo"<strong style='font-size:15px;margin-left:10px'>NÚMERO: </strong>" . $linhas['numero_empreendimento'] . "";
              echo"</div>";
              echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";                   
                 echo"<strong style='font-size:15px;text-align:right'>BAIRRO: </strong>" . $linhas['nome_bairro'] . "";      
              echo"</div>";
              echo"<div class='col-sm-4'style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";                   
                 echo"<strong style='font-size:15px;text-align:right'>MUNICÍPIO: </strong>" . $linhas['nome_municipio'] . "";      
              echo"</div><br><hr>";
          echo"</div>";
          
          echo"<div class='row'>";
            echo"<div class='col-sm-12' style='text-align:center'>";
                 echo"<div class='btn-group'>";
                 ?>
                    <script>
                       document.write("<button type='button' class='btn btn-primary'><a href=" + document.referrer + "><strong style='font-weight:bold; color:#FFF; text-decoration:none; font-size:17px'>RETORNAR PARA CONSULTA <span class='glyphicon glyphicon-repeat' ></span><br></strong></a>");
                    </script>
                <?php
            
                     echo'<button type="button" class="btn" style="margin-left:10px;font-size:17px"><strong><a href=relatorio_licencas.php?codigo_licenca='.$licencas.' target="_blank">GERAR IMPRESSÃO <span  class="glyphicon glyphicon-print" style=""></strong></button>';                   
                          
                    echo "<div  class='btn btn-danger' style='margin-left:10px;font-size:17px'>";
                            echo"<a href='inicio.php' style='font-weight:bold; color:#FFF; text-decoration:none'>PAGINA INICIAL <span  class='glyphicon glyphicon-remove'></a>";
                    echo"</div>"; 
                echo"</div>";           
            echo"</div>";
        echo"</div><br><br><br><br>";
 
     
    }
}





