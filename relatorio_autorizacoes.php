<?php
include_once './config/conexaogerapdf.php';

$html = '';

$autorizacoes = $_GET ['codigo_autorizacao'];

$sql_consult = "SELECT tb_autorizacao.codigo_autorizacao,tb_autorizacao.numero_autorizacao,tb_autorizacao.autorizacao,tb_autorizacao.data_emissao,tb_autorizacao.data_validade,
tb_empresa.razaosocial_pessoafisica,tb_processo.numero_processo,tb_empreendimento.nome_empreendimento, (if(curdate() <= data_validade,'VALIDA','INVALIDA')) AS situacao
FROM 
tb_autorizacao,tb_empresa,tb_processo,tb_empreendimento
WHERE
tb_autorizacao.fk6_codigo_empresa = tb_empresa.codigo_empresa AND tb_autorizacao.fk3_codigo_processo = tb_processo.codigo_processo AND tb_autorizacao.fk2_codigo_empreendimento = tb_empreendimento.codigo_empreendimento = $autorizacoes";

//$sql_consult="SELECT *FROM tb_empresa order by razaosocial_pessoafisica";

$sql_result = mysqli_query($con, $sql_consult);

$teste = mysqli_num_rows($sql_result);

//$html.='<strong>TOTAL DE LICENCAS CADASTRADAS:</strong>'.$teste."<br><br>";

while ($linha = mysqli_fetch_assoc($sql_result)) {
    
//    $html .= "<strong style='margin-top:20;font-size:20px'><u>DADOS DO EMPREENDEDOR</u></strong>".''."<br><br>";
    
    $html .= "<strong style='margin-top:20'>CODIGO DE CADASTRO:</strong>".$linha['codigo_autorizacao']."<br><br>";
    
    $html .= "<strong style='margin-top:20font-size:18px'>NUMERO DA AUTORIZAÇÃO:</strong> ".$linha['numero_autorizacao']."<br><br>";

    $html .= "<strong style='margin-top:20'>AUTORIZAÇÃO:</strong>".$linha['autorizacao']."<br><br>";

    $html .= "<strong>DATA EMISSÃO:</strong>".date('d/m/Y', strtotime($linha['data_emissao']));

    $html .= "<strong style='margin-left:120'>DATA VALIDADE:</strong>".date('d/m/Y', strtotime($linha['data_validade'])) . "<br><br>";

    $html .= "<strong>EMPRESA:</strong><br>".$linha['razaosocial_pessoafisica']."<br><br>";

    $html .= "<strong>PROCESSO:</strong> ".$linha['numero_processo'];

    $html .= "<strong>EMPREENDIMENTO:</strong><br>".$linha['nome_empreendimento']."<br><br>";

    $html .= "<strong style='margin-left:230'>STATUS:</strong>".$linha['situacao']."<hr><br><br><br><br>";
}

//referencia o namespace
use Dompdf\Dompdf;

//include autoloader
require_once './dompdf/autoload.inc.php';

//criando a instancia
$dompdf = new Dompdf();

$dompdf->load_html('
            
                <div style="text-align:center";>
                   <img src="img/logo.png"style="height:70px";><br/><br/><br/><br/><br/>
                    <strong>
                        <p style="text-align:center;width:500px;margin-top:-65px;margin-left:130px;font-size:20px";>                   
                            PREFEITURA DE SÃO JOSÉ DE RIBAMAR<br>
                            SECRETARIA MUNICIPAL DO AMBIENTE-SEMAM     
                        </p>
                    </strong>
                         <p style="text-align:center";>COORDENAÇÃO DE PROTEÇÃO AMBIENTAL - FISCALIZAÇÃO E LICENCIAMENTO</p>          
                </div>
                
               <strong> <p style="text-align:center;font-size:22px">AUTORIZAÇÃO</p</strong>
                        
        '.$html.';
             
        ');

//renderiza o html
$dompdf->render();

//exibir a pagina
$dompdf->stream(
        "relatorio.pdf", array(
    "Attachment" => FALSE //se quiser realizar o download assim que carregar a pagina basta colocar true
        )
);
