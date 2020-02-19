<?php
session_start();
include_once './config/conexaogerapdf.php';

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
    exit();
}

$html = '';

$processo = $_GET ['codigo_processo'];

$sql_consult = "SELECT tb_processo.codigo_processo,tb_processo.numero_processo,tb_processo.data_processo,tb_processo.ano,tb_processo.assunto,tb_empresa.razaosocial_pessoafisica
FROM 
tb_processo,tb_empresa
WHERE
tb_processo.fk3_codigo_empresa = tb_empresa.codigo_empresa AND codigo_processo = $processo";

//$sql_consult="SELECT *FROM tb_empresa order by razaosocial_pessoafisica";

$sql_result = mysqli_query($con, $sql_consult);

$teste = mysqli_num_rows($sql_result);

//$html.='<strong>TOTAL DE LICENCAS CADASTRADAS:</strong>'.$teste."<br><br>";

while ($linha = mysqli_fetch_assoc($sql_result)) {

    $html .= "<div class='row'><br><br><br><br><br><br>";           
            $html .="<div class='col-sm-8' style='border:1px solid #4682B4;text-align:center;width:400px;margin-left:160px'><h2 style='color:#4682B4'><strong>PREFEFEITURA DE SÃO JOSÉ<br>DE RIBAMAR</h2><h4><strong style='color:#4682B4'>WWW.SJR.MA.GOV.BR</strong></h4></strong></div>";
    $html .= "</div><br><br><br><br><br>";
    
    
    $html .= "<div class='row'>";           
            $html .="<table width='550' border='1' style='color:#4682B4'>";
                $html .="<tr style='text-align:center'>";
                   $html .="<td>ORGÃO<br><br></td>";
                   $html .="<td>NÚMERO<br><br></td>";
                   $html .="<td>DATA<br><br></td>";
                $html. "</tr>";
                                
                $html .="<tr style='text-align:center'>";
                   $html .="<td>SEMAM<br><br><br></td>";
                    $html .= "<td><strong style='margin-left:10'></strong>" . $linha['numero_processo'] . "<br><br><br></td>";
                    $html .= "<td></strong>" . date('d/m/Y', strtotime($linha['data_processo'])) . "<br><br><br></td>";           
                $html. "</tr>";
            $html. "</table>";
    $html .= "</div>";
    
    $html .= "<div class='row'>";           
            $html .="<div class='col-sm-12' style='border:1px solid #4682B4;text-align:center;width:720px;margin-left:10px'><h4 style='color:#4682B4'>". $linha['razaosocial_pessoafisica']."</h4></div><br>";
            $html .="<div class='col-sm-12' style='border:1px solid #4682B4;text-align:center;width:720px;margin-left:10px'><h4 style='color:#4682B4'>". $linha['assunto']."</h4></div>";
    
    $html .= "</div><br><br><br><br><br>";
    
    
    


    
}

//referencia o namespace
use Dompdf\Dompdf;

//include autoloader
require_once './dompdf/autoload.inc.php';

//criando a instancia
$dompdf = new Dompdf();

$dompdf->load_html('
            
        ' . $html . '
             
        ');

//renderiza o html
$dompdf->render();

//exibir a pagina
$dompdf->stream(
        "relatorio.pdf", array(
    "Attachment" => FALSE //se quiser realizar o download assim que carregar a pagina basta colocar true
        )
);
