
<?php

include_once './config/conexaogerapdf.php';
$html = ' ';

$sql_consult = "SELECT tb_licenca.codigo_licenca,tb_licenca.licenca,tb_licenca.numero_licenca,tb_licenca.data_emissao,tb_licenca.data_validade,tb_licenca.atividade_realizada,
            tb_empresa.razaosocial_pessoafisica,tb_empreendimento.nome_empreendimento,tb_processo.numero_processo,(if(curdate()<= data_validade,'<strong>VALIDA</strong>','<strong style=color:red>INVALIDA<strong>')) AS situacao 
            FROM 
            tb_licenca,tb_empresa,tb_empreendimento,tb_processo  
            WHERE data_validade < curdate() AND 
            tb_licenca.fk4_codigo_empresa = tb_empresa.codigo_empresa AND tb_licenca.fk1_codigo_empreendimento = tb_empreendimento.codigo_empreendimento  AND tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo  ORDER BY codigo_licenca";

$sql_result = mysqli_query($con, $sql_consult);


$teste = mysqli_num_rows($sql_result);

while ($linha = mysqli_fetch_assoc($sql_result)) {

    $html .= "<strong style='color:red;margin-top:20'>COD:</strong>" . $linha['codigo_licenca'] ." ";
    
    $html .= "<strong style='color:red;margin-top:20'>LICENÇA:</strong>" . $linha['licenca'] . "<br><br>";
    
    $html .= "<strong style='color:red;margin-top:20'>NUMERO LICENÇA:</strong>" . $linha['numero_licenca'] . "<br><br>";
    
    $html .= "<strong style='color:red;margin-top:20'>DATA EMISSÃO:</strong>"  . date('d/m/Y', strtotime($linha['data_emissao']));
    
    $html .= "<strong style='color:red;margin-top:20'>DATA VALIDADE:</strong>" . date('d/m/Y', strtotime($linha['data_validade']));
    
    $html .= "<strong style='color:red;margin-top:20'>ATIVIDADE REALIZADA:</strong>" . $linha['atividade_realizada'] . "<br><br>";

    $html .= "<strong>EMPRESA</strong><br>" . $linha['razaosocial_pessoafisica'] . "<br><br>";

    $html .= "<strong>EMPREENDIMENTO</strong><br> " . $linha['nome_empreendimento'] . "<br><br>";

    $html .= "<strong>NUMERO PROCESSO</strong><br> " . $linha['numero_processo'] . "<br><br>";

//    $html .= "<strong>DATA EMISSÃO:</strong>" . date('d/m/Y', strtotime($linha['data_emissao']));

   

   
    $html .= "<strong style='margin-left:265;color:red'>SITUAÇÃO:</strong>" . $linha['situacao'] . "<hr><br>";

    
}

//referencia o namespace
use Dompdf\Dompdf;

//include autoloader
require_once './dompdf/autoload.inc.php';

//criando a instancia
$dompdf = new Dompdf();

$dompdf->load_html('
            
                <div style="text-align:left ";>
                   <img src="img/brazao.jpg"style="height:70px";>
                   
                    <strong><p style="text-align:center;width:550px;margin-top:-65px;margin-left:130px;font-size:20px";>
                    
                    PREFEITURA MUNICIPAL DE SÃO JOSÉ DE RIBAMAR<br>
                     SECRETARIA MUNICIPAL DO AMBIENTE-SEMAM</p></strong>
                     
                </div>
               <strong> <p style="text-align:center";>RELATÓRIO INDIVIDUAL DA SITUAÇÃO DA EMPRESA</p</strong>
                      
        ' . $html . ';
             
        ');

//renderiza o html
$dompdf->render();

//exibir a pagina
$dompdf->stream(
        "relatorio.pdf", array(
    "Attachment" => FALSE //se quiser realizar o download assim que carregar a pagina basta colocar true
        )
);
