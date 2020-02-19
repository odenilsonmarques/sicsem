<?php

include_once './config/conexaogerapdf.php';

$html = '';

$notificacoes = $_GET ['codigo_notificacao'];

$sql_consult = "SELECT tb_notificacao.codigo_notificacao,tb_notificacao.numero_notificacao,tb_notificacao.ano,tb_notificacao.data_hora_notificacao,tb_notificacao.data_hora_comparecimento,tb_notificacao.profissao_atividade,tb_notificacao.descricao_prazo,
tb_notificacao.status,tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_empresa.pessoa_fisicajuridica,tb_empresa.cnpj_cpf,tb_empresa.logradouro,tb_empresa.numero,tb_empresa.uf,tb_empresa.municipio,tb_empresa.bairro,tb_empresa.email,tb_empresa.telefone,
tb_processo.numero_processo,tb_processo.ano,tb_processo.data_processo,tb_processo.assunto,tb_processo.situacao_processo,tb_fiscal.nome_matricula_fiscal,tb_chefe_fiscalizacao.nome_matricula_chefe,(if(current_date()<= data_hora_comparecimento,' DENTRO DO PRAZO','<strong style=color:#F4C430>PRAZO VENCIDO<strong>')) AS situacao
FROM 
tb_notificacao,tb_empresa,tb_processo,tb_fiscal,tb_chefe_fiscalizacao
WHERE
tb_notificacao.fk5_codigo_empresa = tb_empresa.codigo_empresa AND tb_notificacao.fk2_codigo_processo = tb_processo.codigo_processo AND tb_notificacao.fk1_codigo_fiscal = tb_fiscal.codigo_fiscal AND tb_notificacao.fk1_codigo_chefefiscalizacao = tb_chefe_fiscalizacao.codigo_chefe_fiscalizacao AND codigo_notificacao = $notificacoes";

//$sql_consult="SELECT *FROM tb_empresa order by razaosocial_pessoafisica";

$sql_result = mysqli_query($con, $sql_consult);

$teste = mysqli_num_rows($sql_result);

//$html.='<strong>TOTAL DE LICENCAS CADASTRADAS:</strong>'.$teste."<br><br>";

while ($linha = mysqli_fetch_assoc($sql_result)) {

    $html .= "<strong style='margin-top:20;color:red'>DADOS DA NOTIFICAÇÃO</strong>";

    $html .= "<strong style='margin-left:250;color:red'>COD DE CADASTRO:</strong> " . $linha['codigo_notificacao'] . "<hr>";

    $html .= "<strong>RAZÃO SOCIAL / Pª FÍSICA: </strong> " . $linha['razaosocial_pessoafisica'] . "<br><br>";
    
    $html .= "<strong>NOME FANTASIA: </strong> " . $linha['nome_fantasia'] . "<br><br>";
    
    $html .= "<strong>NOTIFICAÇÃO Nº: </strong> " . $linha['numero_notificacao']."";
    
    $html .= "<strong>/</strong>" . $linha['ano'] . "<br><br>";
    
    $html .= "<strong>DATA DA NOTIFICAÇÃO:</strong> " . date('d/m/Y', strtotime($linha['data_hora_notificacao'])) . "";
    
    $html .= "<strong style='margin-left:20'>DATA PARA COMPARECIMENTO:</strong> " . date('d/m/Y', strtotime($linha['data_hora_comparecimento'])) . "<br><br>";
    
    $html .= "<strong >PROFISSÃO / ATVIDADE:</strong> " . $linha['profissao_atividade'] . "<br><br>";
    
    $html .= "<strong >DESCRIÇÃO/PRAZO:</strong> " . $linha['descricao_prazo'] . "<br><br>";
    
    $html .= "<strong >STATUS:</strong> " . $linha['status'] . "";
    
    $html .= "<strong style='margin-left:100'>SITUACÃO:</strong>" . $linha['situacao'] . "<br><br>";
    
    

    $html .= "<strong style='margin-left:50'>PROCESSO Nº:</strong> " . $linha['numero_processo'] . "";

   
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
            
                <div style="text-align:center";>
                   <img src="img/logo.png"style="height:70px";><br/><br/><br/><br/><br/>
                    <strong>
                        <p style="text-align:center;width:500px;margin-top:-65px;margin-left:130px;font-size:20px";>                   
                            PREFEITURA DE SÃO JOSÉ DE RIBAMAR<br>
                            SECRETARIA MUNICIPAL DO AMBIENTE-SEMAM 
                            www.sjr.ma.gov.br
                        </p>
                         <p style="text-align:center;font-size:20px;"><strong>DADOS DA NOTIFICAÇÃO</strong></p> 
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
