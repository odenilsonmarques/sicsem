<?php

include_once './config/conexaogerapdf.php';

$html = '';

$representante = $_GET ['codigo_representante'];

$sql_consult = "SELECT tb_representante.codigo_representante,tb_representante.nome_representante,tb_representante.cpf,tb_representante.procuracao,tb_representante.cep,tb_representante.logradouro,tb_representante.numero,tb_representante.uf,tb_representante.municipio,tb_representante.bairro,tb_representante.email,tb_representante.telefone,
        tb_empresa.razaosocial_pessoafisica
        FROM tb_representante,tb_empresa
        WHERE tb_representante.fk2_codigo_empresa = tb_empresa.codigo_empresa AND codigo_representante = $representante";

//$sql_consult="SELECT *FROM tb_empresa order by razaosocial_pessoafisica";

$sql_result = mysqli_query($con, $sql_consult);

$teste = mysqli_num_rows($sql_result);

//$html.='<strong>TOTAL DE LICENCAS CADASTRADAS:</strong>'.$teste."<br><br>";

while ($linha = mysqli_fetch_assoc($sql_result)) {

    $html .= "<strong style='margin-top:20;color:red'>DADOS DO REPRESENTANTE</strong>";

    $html .= "<strong style='margin-left:225;color:red'>COD DE CADASTRO:</strong> " . $linha['codigo_representante']. "<hr>";
    
    $html .= "<strong>NOME DO REPRESENTANTE</strong><br> " . $linha['nome_representante']. "<br><br>";

    $html .= "<strong>CPF: </strong> " . $linha['cpf'] ;
    
    $html .= "<strong style='margin-top:20;margin-left:75'>PROCURAÇÃO </strong>: " . $linha['procuracao'] . "<br><br>";
    
    $html .= "<strong style='margin-top:20;color:red'>RAZÃO SOCIAL / Pª FÍSICA REPRESANTADA<br></strong> " . $linha['razaosocial_pessoafisica'] . "<br><br>";

    $html .= "<strong style='margin-top:20;color:red'>ENDEREÇO DO REPRESENTANTE</strong>" . "<hr>";

    $html.="<strong style='margin-top:20'>RUA: </strong> ". $linha['logradouro']."<br><br>";

    $html .= "<strong style='margin-top:20'>NÚMERO: </strong> " . $linha['numero'];
    
    $html .= "<strong style='margin-left:110'>BAIRRO: </strong> " . $linha['bairro'] . "<br><br>";
    
    $html .= "<strong>MUNICÍPIO: </strong> " . $linha['municipio'];
    
     $html .= "<strong style='margin-left:85'>UF: </strong> " . $linha['uf'];

    $html .= "<strong style='margin-left:110'>CEP: </strong> " . $linha['cep']."<br><br>";

    $html .= "<strong style='margin-top:20;color:red'>CONTATOS DO REPRESENTANTE</strong>" . "<hr>";
    
    $html .= "<strong>TELEFONE: </strong> " . $linha['telefone'];
    
    $html .= "<strong style='margin-left:90'>EMAIL: </strong>" . $linha['email'] . "<br><br><br><br><br><br><br><br><br><br><br><br<br><br><br>";

   
    
    $html .= "<strong style='margin-left:180;color:red'>INFORMAÇÕES DA SECRETARIA</strong>";
    $html .= "<strong style='margin-left:150'>SECRETARIA MUNICIPAL DO AMBIENTE</strong>"."<br>";
    $html .= "<strong style='margin-left:170'>Praça de São José de Ribamar - Centro</strong>" . "<br>";
    $html .= "<strong style='margin-left:160'>Cep: 65110-000 - São José de Ribamar - MA</strong>" . "<br>";
    $html .= "<strong style='margin-left:210'>Fone Fax: (98) 3224 - 0170</strong>" . "";
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
                            www.sjr.ma.gov.br
                        </p>
                    </strong>
                         <p style="text-align:center;font-size:20px;"><strong>DADOS DO REPRESENTANTE</strong></p>          
                </div>
                        
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

