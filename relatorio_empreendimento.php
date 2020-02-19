<?php

include_once './config/conexaogerapdf.php';

$html = '';

$empreendimento = $_GET ['codigo_empreendimento'];

$sql_consult = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_empreendimento.descricao_atividade,tb_empreendimento.nome_logradouro,tb_empreendimento.nome_municipio,tb_empreendimento.nome_uf,tb_empreendimento.nome_bairro,tb_empreendimento.numero_empreendimento,
tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_empresa.pessoa_fisicajuridica,tb_empresa.cnpj_cpf,tb_empresa.logradouro,tb_empresa.numero,tb_empresa.bairro,tb_empresa.municipio,tb_empresa.uf,tb_empresa.telefone,tb_empresa.email
FROM 
tb_empreendimento,tb_empresa
WHERE tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa AND codigo_empreendimento = $empreendimento";

//$sql_consult="SELECT *FROM tb_empresa order by razaosocial_pessoafisica";

$sql_result = mysqli_query($con, $sql_consult);

$teste = mysqli_num_rows($sql_result);

//$html.='<strong>TOTAL DE LICENCAS CADASTRADAS:</strong>'.$teste."<br><br>";

while ($linha = mysqli_fetch_assoc($sql_result)) {

    $html .= "<strong style='margin-top:20;color:red'>DADOS DO EMPREENDIMENTO</strong>";

    $html .= "<strong style='margin-top:20;margin-left:215;color:red'>COD DE CADASTRO:</strong> " . $linha['codigo_empreendimento'] . "<hr>";

//    $html .= "<strong style='margin-top:20;'>RAZÃO SOCIAIL E / OU Pª FÍSICA</strong><br> ".$linha['razaosocial_pessoafisica']."<br><br>";

    $html .= "<strong style='margin-top:20;'>NOME DO EMPREENDIMENTO<br></strong> " . $linha['nome_empreendimento'] . "<br><br>";

    $html .= "<strong style='margin-top:20;'>DESCRIÇÃO DA ATIVIDADE<br></strong> " . $linha['descricao_atividade'] . "<br><br>";

    $html .= "<strong style='margin-top:20;color:red'>ENDEREÇO DO EMPREENDIMENTO</strong>" . "<hr>";

    $html .= "<strong style='margin-top:20;'>RUA</strong>: " . $linha['nome_logradouro'] . "";

    $html .= "<strong style='margin-top:20;margin-left:220''>Nº:</strong> " . $linha['numero_empreendimento'] . "<br><br>";

    $html .= "<strong style='margin-top:20'>BAIRRO:</strong> " . $linha['nome_bairro'] . "<br><br>";

    $html .= "<strong style='margin-top:20'>MUNICÍPIO:</strong> " . $linha['nome_municipio'] . "";

    $html .= "<strong style='margin-top:20;margin-left:40'>UF:</strong> " . $linha['nome_uf'] . "<br><br>";

    $html .= "<strong style='margin-top:20;color:red'>DADOS DO RAZÃO SOCIAL / Pª FÍSICA RESPONSÁVEL PELO EMPREENDIMENTO</strong>" . "<hr>";

    $html .= "<strong style='margin-top:20'>NOME DA RAZÃO SOCIAL / PESSOA FÍSICA</strong><br> " . $linha['razaosocial_pessoafisica'] . "<br><br>";

    $html .= "<strong style='margin-top:20'>NOME FANTASIA</strong>: " . $linha['nome_fantasia'] . "<br><br>";

    $html .= "<strong style='margin-top:20'>PESSOA</strong>: " . $linha['pessoa_fisicajuridica'] . "";

    $html .= "<strong style='margin-top:20;margin-left:150'>CNPJ / CPF</strong>: " . $linha['cnpj_cpf'] . "<br><br>";

    $html .= "<strong style='margin-top:20;color:red'>ENDEREÇO DA RAZÃO SOCIAL / Pª FISICA</strong>" . "<hr>";

    $html .= "<strong style='margin-top:20'>RUA</strong>: " . $linha['logradouro'] . "";
    
    $html .= "<strong style='margin-top:20;margin-left:220'>Nº</strong>: " . $linha['numero'] . "<br><br>";
    
    $html .= "<strong style='margin-top:20;'>BAIRRO</strong>: " . $linha['bairro'] . "";
    
    $html .= "<strong style='margin-left:50'>MUNICÍPIO</strong>: " . $linha['municipio'] . "";
    
    $html .= "<strong style='margin-top:20;margin-left:50'>UF</strong>: " . $linha['uf'] . "<br><br>";
    
    $html .= "<strong '>TELEFONE</strong>: " . $linha['telefone'] . "";
    
    $html .= "<strong style='margin-left:60'>E-MAIL</strong>: " . $linha['email'] . "<br><br>";

    $html .= "<strong style='margin-left:180;color:red'>INFORMAÇÕES DA SECRETARIA</strong>" . "<br>";
    $html .= "<strong style='margin-left:150'>SECRETARIA MUNICIPAL DO AMBIENTE</strong>" . "<br>";
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
            
                 <div style="text-align:center;">
                   <img src="img/logo.png"style="height:70px";><br/><br/><br/><br/><br/>
                    <strong>
                        <p style="text-align:center;width:500px;margin-top:-65px;margin-left:130px;font-size:20px";>                   
                            PREFEITURA DE SÃO JOSÉ DE RIBAMAR<br>
                            SECRETARIA MUNICIPAL DO AMBIENTE-SEMAM
                            www.sjr.ma.gov.br
                        </p>
                         <p style="text-align:center;font-size:20px;"><strong>DADOS DO EMPREENDIMENTO</strong></p><br>   
                    </strong>
                               
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

