<?php

require './config/conexao.php';
session_start();

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
}

$codigo_empresas = $_GET['empresa'];
$codigo_empresass = $_GET['empreendimento'];

$sql = ("SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_empresa.codigo_empresa,tb_empresa.nome_fantasia FROM tb_empreendimento,tb_empresa WHERE  tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa AND fk1_codigo_empresa=" . $codigo_empresas . " ORDER BY nome_empreendimento asc");
//$sql = ("SELECT codigo_empresa,nome_fantasia FROM tb_empresa WHERE codigo_empresa = ".$codigo_empresas." UNION SELECT codigo_empreendimento,nome_empreendimento FROM tb_empreendimento WHERE codigo_empreendimento = fk1_codigo_empresa");
//$sql = ("SELECT  *FROM tb_empreendimento WHERE fk1_codigo_empresa=" . $codigo_empresas . " ORDER BY nome_empreendimento DESC limit 1");

//$sql = "SELECT tb_empresa.codigo_empresa,tb_empresa.nome_fantasia,tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento FROM tb_empreendimento,tb_empresa
//        WHERE 
//tb_empreendimento.fk1_codigo_empresa  = tb_empresa.codigo_empresa and codigo_empresa = $codigo_empresas";

$recebesql = (mysqli_query($con, $sql));

while ($linha = mysqli_fetch_array($recebesql)) {

    echo"<option value='" . $linha['codigo_empreendimento'] . "'>" . $linha['nome_empreendimento'] . "</option>";
}
    