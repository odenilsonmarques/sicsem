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

$licencas = $_GET ['codigo_licenca'];

$sql_consult = "SELECT tb_licenca.codigo_licenca,tb_licenca.numero_licenca,tb_licenca.ano_licenca,tb_licenca.data_emissao,tb_licenca.data_validade,tb_licenca.descricao_atividade,
tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_empresa.pessoa_fisicajuridica,tb_empresa.cnpj_cpf,tb_empresa.logradouro,tb_empresa.numero,tb_empresa.uf,tb_empresa.municipio,tb_empresa.bairro,tb_empresa.email,tb_empresa.telefone,
tb_empreendimento.nome_empreendimento,tb_empreendimento.nome_logradouro,tb_empreendimento.numero_empreendimento,tb_empreendimento.nome_uf,tb_empreendimento.nome_municipio,tb_empreendimento.nome_bairro,
tb_processo.numero_processo,tb_processo.ano,tb_processo.data_processo,tb_processo.assunto,tb_processo.situacao_processo,(if(curdate() <= data_validade,'VÁLIDA','INVÁLIDA')) AS situacao
FROM 
tb_licenca,tb_empresa,tb_empreendimento,tb_processo
WHERE
tb_licenca.fk4_codigo_empresa = tb_empresa.codigo_empresa AND tb_licenca.fk1_codigo_empreendimento = tb_empreendimento.codigo_empreendimento AND tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo AND codigo_licenca = $licencas";

//$sql_consult="SELECT *FROM tb_empresa order by razaosocial_pessoafisica";

$sql_result = mysqli_query($con, $sql_consult);

$teste = mysqli_num_rows($sql_result);

//$html.='<strong>TOTAL DE LICENCAS CADASTRADAS:</strong>'.$teste."<br><br>";

while ($linha = mysqli_fetch_assoc($sql_result)) {

//    $html .= "<strong style='margin-top:20;color:red'>DADOS DA LICENÇA: </strong>";

    $html .= "<strong style='margin-left:10'></strong> " . $linha['assunto'] . "";

    $html .= "<strong style='margin-left:10'>Nº</strong> " . $linha['numero_licenca'] . "";

    $html .= "<strong>/</strong>" . $linha['ano_licenca'] . "";

    $html .= "<strong style='margin-left:90'>VALIDADE ATÉ:</strong>" . date('d/m/Y', strtotime($linha['data_validade'])) . "<br>";

    $html .= "<strong>PROC Nº:</strong> " . $linha['numero_processo'] . "";

    $html .= "<strong>/</strong>" . $linha['ano'] . "<hr>";

    $html .= "<strong style='text-align:justify'>A SECRETARIA MUNICIPAL DO AMBIENTE - SEMAM</strong>, com base no artigo º6 "
            . "inciso 2º da lei Municipal Nº 573 de 06 de Setembro de 2005, certifica, para fins de Licenciamento  Ambeintal,"
            . "conforme Resolução CONAMA Nº 237/97; ART.10, parágrafo 1º   " . "<br><br>";

    $html .= "RAZÃO SOCIAL / Pª FÍSICA<br>";

    $html .= "<strong><p style='text-align:center'>" . $linha['razaosocial_pessoafisica'] . "</p></strong><hr>";

    $html .= "<strong '>CNPJ / CPF<br><br></strong>" . $linha['cnpj_cpf'] . "<hr>";

    $html .= "<strong>ENDEREÇO<br><br></strong> " . $linha['logradouro'] . ",";


//    $html .= "<strong>NOME FANTASIA:</strong>" . $linha['nome_fantasia'] . "<br><br>";


    $html .= "<strong style='margin-left:10'>Nº</strong> " . $linha['numero'] . ",";

    $html .= "<strong  style='margin-left:10'>BAIRRO:</strong> " . $linha['bairro'] . "<hr>";

    $html .= "<strong>MUNICÍPIO<br><br></strong> " . $linha['municipio'] . "";

    $html .= "<strong style='margin-left:20'>UF:</strong> " . $linha['uf'] . "<hr>";

    $html .= "<strong >ATIVIDADE A OPERAR<br><br></strong> " . $linha['descricao_atividade'] . "<hr>";

    $html .= "<strong>A LOCALIZAR - SE EM<br><br></strong> " . $linha['nome_logradouro'] . ",";

    $html .= "<strong style='margin-left:5'>Nº:</strong> " . $linha['numero_empreendimento'] . ",";

    $html .= "<strong style='margin-left:5'>BAIRRO:</strong> " . $linha['nome_bairro'] . ",";

    $html .= "<strong style='margin-left:20'>MUNICÍPIO:</strong> " . $linha['nome_municipio'] . "<hr>";

    $html .= "<strong style='font-size:13px;text-align:center'>"
            . "<span style='color:red'>OBS: - Vide verso desta licença as CONDICIONANTES / EXIGÊNCIAS</span>;<br>"
            . "- Esta licença restringe-se somente a operação da atividade;<br>"
            . "- O presente documento não desobriga o licenciamento de outras providências junto a órgão municipais"
            . ", estaduais e/ou federais para a legibilidade plena do estabelecimento</strong><br>";
    
    $html .= "<p strong style='text-align:center'>São José de Ribamar - MA, </strong>" . date('d/m/Y', strtotime($linha['data_emissao'])) . "</p>";

    $html .= "<p style='margin-left:50px'>Jeder de Jesus M. de Oliveira <span style='margin-left:250px'>Nelson Weber Júnior</span><br>Coordenador de Proteção Ambiental<span style='margin-left:180px'>Secretário Municipal do Ambiente</span></p>";
    
    $html .= "<p strong style='font-size:11px;text-align:center'>"
            . "<span >PREFEITURA MUNICIPAL DE SÃO JOSÉ DE RIBAMAR</span><br>"
            . "SECRETARIA MUNICIPAL DO AMBIENTE<br>"
            . "Praça São José, nº 305 - Centro- São José de Ribamar - MA - 65110-000 - CNPJ:06.351.514/0001-78, 98 - 322240107";
            
}

//referencia o namespace
use Dompdf\Dompdf;

//include autoloader
require_once './dompdf/autoload.inc.php';

//criando a instancia
$dompdf = new Dompdf();

$dompdf->load_html('
            
                <div style="text-align:center";>
                   <img src="img/LOGO_1.png"style="height:70px;margin-top:-40px"><br/><br/><br/><br/><br/><br/>
                    
                        <p style="text-align:center;width:500px;margin-top:-80px;margin-left:130px;font-size:15px";>                   
                            PREFEITURA DE SÃO JOSÉ DE RIBAMAR<br>
                            SECRETARIA MUNICIPAL DO AMBIENTE-SEMAM<br>
                            <span style="font-size:11px;margin-left:5px">COORDENAÇÃO DE PROTEÇÃO AMBIENTAL - FISCALLIZAÇÃO E LICENCIAMENTO</span>
                        </p>          
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
