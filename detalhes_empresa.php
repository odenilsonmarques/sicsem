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
<h2 style="text-align:center;color: #1b6d85"><strong>DADOS DA RAZÃO SOCIAL / Pª FÍSICA</strong></h2><br><br>

<?php
$infor_empresa = $_GET['codigo_empresa']; /* link dinamico utilizando o get */
$sql_empresa = "SELECT tb_licenca.codigo_licenca,tb_licenca.numero_licenca,tb_licenca.ano_licenca,tb_licenca.data_emissao,tb_licenca.data_validade,tb_licenca.descricao_atividade,tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_empresa.pessoa_fisicajuridica,tb_empresa.cnpj_cpf,
tb_empresa.logradouro,tb_empresa.numero,tb_empresa.uf,tb_empresa.municipio,tb_empresa.bairro,tb_empresa.cep,tb_empresa.email,tb_empresa.telefone,tb_empresa.complemento,tb_empresa.localizacao_map,tb_processo.codigo_processo,tb_processo.numero_processo,tb_processo.ano,tb_processo.assunto,
tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_empreendimento.nome_logradouro,tb_empreendimento.numero_empreendimento,tb_empreendimento.nome_bairro,tb_empreendimento.nome_municipio,tb_empreendimento.localizacao_map_empre,tb_empreendimento.nome_atividade,(if(current_date()<= data_validade,'VALIDA','INVALIDA')) AS situacao
FROM 
tb_licenca,tb_empresa,tb_processo,tb_empreendimento
WHERE 
tb_licenca.fk4_codigo_empresa = tb_empresa.codigo_empresa and tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo and tb_licenca.fk1_codigo_empreendimento = tb_empreendimento.codigo_empreendimento  and codigo_empresa = $infor_empresa ORDER BY codigo_licenca DESC limit 1";
$exe_empresa = mysqli_query($con, $sql_empresa);

if (mysqli_num_rows($exe_empresa) > 0) {
    while ($linhas = mysqli_fetch_array($exe_empresa)) {
        $licencas = $linhas['codigo_empresa']; //variavel pararecupar o id do empreendimento

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>RAZÃO SOCIAL / PESSOA FÍSICA: </strong>" . $linhas['razaosocial_pessoafisica'] . "";
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-align:right'>NOME FANTASIA: </strong>" . $linhas['nome_fantasia'] . "";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>Pª JURIDICA / FISICA : </strong>" . $linhas['pessoa_fisicajuridica'] . "";
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-align:right'>CNPJ / CPF: </strong>" . $linhas['cnpj_cpf'] . "";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>ENDEREÇO: </strong>" . $linhas['logradouro'] . "";
        echo"<strong style='font-size:15px;margin-left:10px'>Nº: </strong>" . $linhas['numero'] . "";
        echo'<strong style="font-size:15px;margin-left:15px;background-color:#3CB371;border-radius:5px"><a href=' . $linhas['localizacao_map'] . ' target="_blank" style="color:#FFF;text-decoration:none"><span  class="glyphicon glyphicon-map-marker" style="text-align:center;width:40px;font-size:15px;;color:#FFF"></span></strong></a>';
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-align:right'>BAIRRO: </strong>" . $linhas['bairro'] . "";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>COMPLEMENTO: </strong>" . $linhas['complemento'] . "";
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-align:right'>CEP: </strong>" . $linhas['cep'] . "";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>MUNICÍPIO: </strong>" . $linhas['municipio'] . "";
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-aling:right'>UF: </strong>" . $linhas['uf'] . "<br>";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>TELEFONE: </strong>" . $linhas['telefone'] . "";
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-aling:right'>EMAIL: </strong>" . $linhas['email'] . "<br>";
        echo"</div><br><br>";
        echo"</div>";

//        echo"<div class='row'>";
//        echo"<div class='col-sm-12' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
//        echo"<strong style='font-size:15px;text-aling:right'>ATIVIDADE: </strong>" . $linhas['nome_atividade'] . "<br>";
//        echo"</div><br><br>";
//        echo"</div>";

        /* ESTE CÓDIGO TEM COMO PROPÓSITO INFORMAR A QTD DE LICENCA QUE CADA EMPRESA POSSUI */
        echo"<div class='row text-center'>";
        echo"<div class='col-sm-2 text-center' style='border:'>";

        $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_empresa.codigo_empresa FROM tb_licenca,tb_empresa WHERE tb_licenca.fk4_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_licencas.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#EEE9E9">LICENÇAS<span class="glyphicon glyphicon-list-alt" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#EEE9E9">LICENÇAS<span class="glyphicon glyphicon-list-alt" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo "</div>";

        echo"<div class='col-sm-2 text-center' style='border:'>";
        $sql_tipo_licenca = "SELECT tb_processo.codigo_processo,tb_empresa.codigo_empresa FROM tb_processo,tb_empresa WHERE tb_processo.fk3_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_processos.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#EEE9E9">PROCESSOS<span class="glyphicon glyphicon-th-list" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#EEE9E9">PROCESSOS<span class="glyphicon glyphicon-th-list" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo "</div>";

        echo"<div class='col-sm-2 text-center' style='border:'>";
        $sql_tipo_licenca = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_empresa.codigo_empresa FROM tb_empreendimento, tb_empresa WHERE tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa AND atividade_empreendimento = 'EMPREENDIMENTO'";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_empreendimento.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#EEE9E9">EMPREENDIMENTO<span class="glyphicon glyphicon-stats" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#EEE9E9">EMPREENDIMENTO<span class="glyphicon glyphicon-stats" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo "</div>";

        echo"<div class='col-sm-2 text-center' style='border:'>";
        $sql_tipo_licenca = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_atividade,tb_empresa.codigo_empresa FROM tb_empreendimento, tb_empresa WHERE tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa AND atividade_empreendimento = 'ATIVIDADE'";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_atividades.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#EEE9E9">ATIVIDADE<span class="glyphicon glyphicon-briefcase" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#EEE9E9">ATIVIDADE<span class="glyphicon glyphicon-briefcase" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo "</div>";

        echo"<div class='col-sm-2 text-center' style='border:'>";
        $sql_tipo_licenca = "SELECT tb_notificacao.codigo_notificacao,tb_empresa.codigo_empresa FROM tb_notificacao,tb_empresa WHERE tb_notificacao.fk5_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_notificacoes.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#EEE9E9">NOTIFICAÇÃO<span class="glyphicon glyphicon-bell" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#EEE9E9">NOTIFICACÃO<span class="glyphicon glyphicon-bell" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo "</div>";

        echo"<div class='col-sm-2 text-center' style='border:'>";
        $sql_tipo_licenca = "SELECT tb_auto_infracao.codigo_auto_infracao,tb_empresa.codigo_empresa FROM tb_auto_infracao, tb_empresa WHERE tb_auto_infracao.fk9_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_infracoes.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#EEE9E9">AUTO DE INFRAÇÃO<span class="glyphicon glyphicon-bell" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#EEE9E9">AUTO DE INFRAÇÃO<span class="glyphicon glyphicon-alert" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo "</div>";
        echo"</div>";
        echo"</div>";
        ?>
        <div class="row text-center">

            <div class="col-sm-2" style="margin-left:">
                <a href="#myModalCadLicenca" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9;"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="margin-left:">
                <a href="#myModalCadProcesso" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="margin-left:">
                <a href="#myModalcadEmpreendimento" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="margin-left:">
                <a href="#myModalcadAtividade" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="margin-left:">
                <a href="#myModalCadNotificacao" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="margin-left:">
                <a href="#myModalcadEmpreendimento" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>

        </div><br>

        <?php
        echo"<div class='row'>";
        echo"<div class='col-sm-12' style='text-align:center'>";
        echo"<div class='btn-grou'>";
        ?>
        <?php
        echo'<button type="button" class="btn btn-primary" style="margin-left:3px"><strong style="font-size:17px"><a href="consultar_empresas.php" style="font-weight:bold; color:#FFF; text-decoration:none">NOVA CONSULTA <span  class="glyphicon glyphicon-remove" style="margin-left:10px; font-size:17px"></a></strong></button>';
        echo'<button type="button" class="btn btn-danger" style="margin-left:3px"><strong style="font-size:17px"><a href="inicio.php" style="font-weight:bold; color:#FFF; text-decoration:none">PAGINA INICIAL <span  class="glyphicon glyphicon-remove" style="margin-left:10px; font-size:17px"></a></strong></button>';
        echo"</div>";
        echo"</div>";
        echo"</div><br><br><br><br>";
        echo"</div>";
    }
} else if (mysqli_num_rows($exe_empresa) > 0) {
    $sql = "SELECT tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_empresa.pessoa_fisicajuridica,tb_empresa.cnpj_cpf,tb_empresa.cep,tb_empresa.logradouro,tb_empresa.complemento,tb_empresa.localizacao_map,tb_empresa.bairro,tb_empresa.municipio,tb_empresa.uf,tb_empresa.telefone,tb_empresa.email,tb_empresa.numero,tb_notificacao.codigo_notificacao,tb_auto_infracao.codigo_auto_infracao FROM tb_empresa,tb_notificacao,tb_auto_infracao WHERE tb_notificacao.fk5_codigo_empresa = tb_empresa.codigo_empresa AND tb_auto_infracao.fk9_codigo_empresa = tb_empresa.codigo_empresa AND codigo_empresa= $infor_empresa";
    $recebe = mysqli_query($con, $sql);

    while ($linhas = mysqli_fetch_array($recebe)) {
        $codigo_empresa = $linhas['codigo_empresa']; //variavel pararecupar o id do empreendimento

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>RAZÃO SOCIAL / PESSOA FÍSICA: </strong>" . $linhas['razaosocial_pessoafisica'] . "";
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-align:right'>NOME FANTASIA: </strong>" . $linhas['nome_fantasia'] . "";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>Pª JURIDICA / FISICA : </strong>" . $linhas['pessoa_fisicajuridica'] . "";
        echo"</div>";

        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-align:right'>CNPJ / CPF: </strong>" . $linhas['cnpj_cpf'] . "";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>ENDEREÇO: </strong>" . $linhas['logradouro'] . "";
        echo"<strong style='font-size:15px;margin-left:10px'>Nº: </strong>" . $linhas['numero'] . "";
        echo'<strong style="font-size:15px;margin-left:15px;background-color:#3CB371;border-radius:5px"><a href=' . $linhas['localizacao_map'] . ' target="_blank" style="color:#FFF;text-decoration:none"><span  class="glyphicon glyphicon-map-marker" style="text-align:center;width:40px;font-size:15px;;color:#FFF"></span></strong></a>';
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-align:right'>BAIRRO: </strong>" . $linhas['bairro'] . "";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>COMPLEMENTO: </strong>" . $linhas['complemento'] . "";
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-align:right'>CEP: </strong>" . $linhas['cep'] . "";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>MUNICÍPIO: </strong>" . $linhas['municipio'] . "";
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-aling:right'>UF: </strong>" . $linhas['uf'] . "<br>";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>TELEFONE: </strong>" . $linhas['telefone'] . "";
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-aling:right'>EMAIL: </strong>" . $linhas['email'] . "<br>";
        echo"</div><br><br>";
        echo"</div>";

        /* ESTE CÓDIGO TEM COMO PROPÓSITO INFORMAR A QTD DE LICENCA QUE CADA EMPRESA POSSUI */
        echo"<div class='row text-cente'>";
        echo"<div class='col-sm-2' style='border:'>";
        $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_empresa.codigo_empresa FROM tb_licenca,tb_empresa WHERE tb_licenca.fk4_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_licencas.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">LICENÇAS<span class="glyphicon glyphicon-list-alt" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">LICENÇAS<span class="glyphicon glyphicon-list-alt" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo"</div>";

        echo"<div class='col-sm-2' style='border:'>";
        $sql_tipo_licenca = "SELECT tb_processo.codigo_processo,tb_empresa.codigo_empresa FROM tb_processo,tb_empresa WHERE tb_processo.fk3_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_processos.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">PROCESSOS<span class="glyphicon glyphicon-th-list" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">PROCESSOS<span class="glyphicon glyphicon-th-list" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo"</div>";

        echo"<div class='col-sm-2' style='border:'>";
        $sql_tipo_licenca = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_empresa.codigo_empresa FROM tb_empreendimento, tb_empresa WHERE tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa AND atividade_empreendimento = 'EMPREENDIMENTO'";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_empreendimento.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">EMPREENDIMENTOS<span class="glyphicon glyphicon-stats" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">EMPREENDIMENTOS<span class="glyphicon glyphicon-stats" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo"</div>";

        echo"<div class='col-sm-2' style='border:'>";
        $sql_tipo_licenca = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_atividade,tb_empresa.codigo_empresa FROM tb_empreendimento, tb_empresa WHERE tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa AND atividade_empreendimento = 'ATIVIDADE'";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_atividades.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">ATIVIDADES<span class="glyphicon glyphicon-briefcase" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">ATIVIDADES<span class="glyphicon glyphicon-briefcase" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo"</div>";

        echo"<div class='col-sm-2' style='border:'>";
        $sql_tipo_licenca = "SELECT tb_notificacao.codigo_notificacao,tb_empresa.codigo_empresa FROM tb_notificacao, tb_empresa WHERE tb_notificacao.fk5_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_notificacoes.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">NOTIFICAÇÃO<span class="glyphicon glyphicon-bell" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">NOTIFICAÇÃO<span class="glyphicon glyphicon-bell" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo"</div>";

        echo"<div class='col-sm-2' style='border:'>";
        $sql_tipo_licenca = "SELECT tb_auto_infracao.codigo_auto_infracao,tb_empresa.codigo_empresa FROM tb_auto_infracao, tb_empresa WHERE tb_auto_infracao.fk9_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_infracoes.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">AUTO DE INFRAÇÃO<span class="glyphicon glyphicon-bell" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">AUTO DE INFRAÇÃO<span class="glyphicon glyphicon-alert" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo"</div>";
        echo"</div>";
        echo"</div><br><br>";
        ?>
        <div class="row text-center">

            <div class="col-sm-2" style="">
                <a href="#myModalCadLicenca" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9;"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="">
                <a href="#myModalCadProcesso" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="">
                <a href="#myModalcadEmpreendimento" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="">
                <a href="#myModalcadAtividade" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="">
                <a href="#myModalCadNotificacao" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="">
                <a href="#myModalcadEmpreendimento" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>

        </div><br>
        <?php
        echo"<div class='row'>";
        echo"<div class='col-sm-12' style='text-align:center'>";
        echo"<div class='btn-group'>";
        ?>

        <?php
        echo'<button type="button" class="btn btn-primary" style="margin-left:3px"><strong style="font-size:17px"><a href="consultar_empresas.php" style="font-weight:bold; color:#FFF; text-decoration:none">NOVA CONSULTA <span  class="glyphicon glyphicon-remove" style="margin-left:10px; font-size:17px"></a></strong></button>';
        echo'<button type="button" class="btn btn-danger" style="margin-left:3px"><strong style="font-size:17px"><a href="inicio.php" style="font-weight:bold; color:#FFF; text-decoration:none">PAGINA INICIAL <span  class="glyphicon glyphicon-remove" style="margin-left:10px; font-size:17px"></a></strong></button>';

        echo"</div>";
        echo"</div>";
        echo"</div><br><br><br><br>";
        echo"</div>";
    }
} else {
    $sql = "SELECT codigo_empresa,razaosocial_pessoafisica,nome_fantasia,pessoa_fisicajuridica,cnpj_cpf,cep,logradouro,complemento,localizacao_map,bairro,municipio,uf,telefone,email,numero FROM tb_empresa WHERE codigo_empresa = $infor_empresa";
    $recebe = mysqli_query($con, $sql);

    while ($linhas = mysqli_fetch_array($recebe)) {
        $codigo_empresa = $linhas['codigo_empresa']; //variavel pararecupar o id do empreendimento

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>RAZÃO SOCIAL / PESSOA FÍSICA: </strong>" . $linhas['razaosocial_pessoafisica'] . "";
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-align:right'>NOME FANTASIA: </strong>" . $linhas['nome_fantasia'] . "";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>Pª JURIDICA / FISICA : </strong>" . $linhas['pessoa_fisicajuridica'] . "";
        echo"</div>";

        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-align:right'>CNPJ / CPF: </strong>" . $linhas['cnpj_cpf'] . "";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>ENDEREÇO: </strong>" . $linhas['logradouro'] . "";
        echo"<strong style='font-size:15px;margin-left:10px'>Nº: </strong>" . $linhas['numero'] . "";
        echo'<strong style="font-size:15px;margin-left:15px;background-color:#3CB371;border-radius:5px"><a href=' . $linhas['localizacao_map'] . ' target="_blank" style="color:#FFF;text-decoration:none"><span  class="glyphicon glyphicon-map-marker" style="text-align:center;width:40px;font-size:15px;;color:#FFF"></span></strong></a>';
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-align:right'>BAIRRO: </strong>" . $linhas['bairro'] . "";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>COMPLEMENTO: </strong>" . $linhas['complemento'] . "";
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-align:right'>CEP: </strong>" . $linhas['cep'] . "";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>MUNICÍPIO: </strong>" . $linhas['municipio'] . "";
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-aling:right'>UF: </strong>" . $linhas['uf'] . "<br>";
        echo"</div><br><br>";
        echo"</div>";

        echo"<div class='row'>";
        echo"<div class='col-sm-8' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;margin-left:10px'>TELEFONE: </strong>" . $linhas['telefone'] . "";
        echo"</div>";
        echo"<div class='col-sm-4' style='border:1px solid #EEE9E9;background-color:#EEE9E9'>";
        echo"<strong style='font-size:15px;text-aling:right'>EMAIL: </strong>" . $linhas['email'] . "<br>";
        echo"</div><br><br>";
        echo"</div>";

        /* ESTE CÓDIGO TEM COMO PROPÓSITO INFORMAR A QTD DE LICENCA QUE CADA EMPRESA POSSUI */
        echo"<div class='row text-center'>";
        echo"<div class='col-sm-2'>";
        $sql_tipo_licenca = "SELECT tb_licenca.codigo_licenca,tb_empresa.codigo_empresa FROM tb_licenca,tb_empresa WHERE tb_licenca.fk4_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_licencas.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">LICENÇAS<span class="glyphicon glyphicon-list-alt" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">LICENÇAS<span class="glyphicon glyphicon-list-alt" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo"</div>";

        echo"<div class='col-sm-2'>";
        $sql_tipo_licenca = "SELECT tb_processo.codigo_processo,tb_empresa.codigo_empresa FROM tb_processo,tb_empresa WHERE tb_processo.fk3_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_processos.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">PROCESSOS<span class="glyphicon glyphicon-th-list" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">PROCESSOS<span class="glyphicon glyphicon-th-list" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo"</div>";

        echo"<div class='col-sm-2'>";
        $sql_tipo_licenca = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_empresa.codigo_empresa FROM tb_empreendimento, tb_empresa WHERE tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa AND atividade_empreendimento = 'EMPREENDIMENTO'";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_empreendimento.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">EMPREENDIMENTOS<span class="glyphicon glyphicon-stats" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">EMPREENDIMENTOS<span class="glyphicon glyphicon-stats" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo"</div>";

        echo"<div class='col-sm-2'>";
        $sql_tipo_licenca = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_atividade,tb_empresa.codigo_empresa FROM tb_empreendimento, tb_empresa WHERE tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa AND atividade_empreendimento = 'ATIVIDADE'";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_atividades.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">ATIVIDADES<span class="glyphicon glyphicon-briefcase" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">ATIVIDADES<span class="glyphicon glyphicon-briefcase" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
//            echo'<button type="button" data-toggle="modal" data-target="#myModalcadEmpreendimento" class="btn btn-link" style="text-decoration:none;background-color:#808080;color:#F5FFFA"><strong>CADASTRAR</strong><span class="glyphicon glyphicon-plus" style="color:000;margin-left:5px;"></span></button>';
        }
        echo"</div>";

        echo"<div class='col-sm-2'>";
        $sql_tipo_licenca = "SELECT tb_notificacao.codigo_notificacao,tb_empresa.codigo_empresa FROM tb_notificacao, tb_empresa WHERE tb_notificacao.fk5_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_notificacoes.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">NOTIFICAÇÃO<span class="glyphicon glyphicon-bell" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">NOTIFICAÇÕES<span class="glyphicon glyphicon-bell" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo"</div>";

        echo"<div class='col-sm-2'>";
        $sql_tipo_licenca = "SELECT tb_auto_infracao.codigo_auto_infracao,tb_empresa.codigo_empresa FROM tb_auto_infracao, tb_empresa WHERE tb_auto_infracao.fk9_codigo_empresa = tb_empresa.codigo_empresa and codigo_empresa = $infor_empresa";
        $sql_qtd = mysqli_query($con, $sql_tipo_licenca);
        $sql_total = mysqli_num_rows($sql_qtd);
        if (mysqli_num_rows($sql_qtd) > 0) {
            echo'<a href=listar_infracoes.php?codigo_empresa=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">AUTO DE INFRAÇÃO<span class="glyphicon glyphicon-bell" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        } else {
            echo'<a href=#=' . $infor_empresa . ' class="btn btn-basic" style="margin-right:2px;font-size:15px; font-weight: bold;color:000;background-color:#D3D3D3">AUTOS DE INFRAÇÕES<span class="glyphicon glyphicon-alert" style="color:000;margin-left:5px"></span><br><span class="badge">' . $sql_total . '</span></a>';
        }
        echo"</div>";

        echo"</div>";
        echo"</div>";
        ?>

        <div class="row text-center">
            <div class="col-sm-2" style="margin-left:">
                <a href="#myModalCadLicenca" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9;"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="">
                <a href="#myModalCadProcesso" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="">
                <a href="#myModalcadEmpreendimento" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="">
                <a href="#myModalcadAtividade" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="">
                <a href="#myModalCadNotificacao" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
            <div class="col-sm-2" style="">
                <a href="#myModalcadEmpreendimento" data-toggle="modal"  class="btn btn-basic" style="font-size:15px; font-weight: bold;color:000;background-color:#000\9"><span class="glyphicon glyphicon-plus" style="color:000"></span><br><span class="badge"></span>
                    cadastrar   
                </a>
            </div>
        </div><br>
        <?php
        echo"<div class='row'>";
        echo"<div class='col-sm-12' style='text-align:center'>";
        echo"<div class='btn-group'>";
        ?>
        <?php
        echo'<button type="button" class="btn btn-primary" style="margin-left:3px"><strong style="font-size:17px"><a href="consultar_empresas.php" style="font-weight:bold; color:#FFF; text-decoration:none">NOVA CONSULTA <span  class="glyphicon glyphicon-remove" style="margin-left:10px; font-size:17px"></a></strong></button>';
        echo'<button type="button" class="btn btn-danger" style="margin-left:3px"><strong style="font-size:17px"><a href="inicio.php" style="font-weight:bold; color:#FFF; text-decoration:none">PAGINA INICIAL <span  class="glyphicon glyphicon-remove" style="margin-left:10px; font-size:17px"></a></strong></button>';

        echo"</div>";
        echo"</div>";
        echo"</div><br><br><br><br>";
        echo"</div>";
    }
}
?>
<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/valida-documento.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/validaempreendimento.js"></script>
<script type="text/javascript" src="js/validaprocesso.js"></script>
<script type="text/javascript" src="js/validaLicenca.js"></script>
<script type="text/javascript" src="js/validanotificacao.js"></script>
<script type="text/javascript" src="js/validaDatasNotificacao.js"></script>
<script type="text/javascript" src="js/auto_complete_atividades.js"></script>

<link rel="stylesheet" type="text/css" href="css/estilo_cadEmpreendimento.css">
<link rel="stylesheet" type="text/css" href="css/estilo_divEmpreendimento.css">
<link rel="stylesheet" type="text/css" href="css/estilo_cad_notificacao.css">

<div class="modal fade" id="myModalcadEmpreendimento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <?php
    if (isset($_POST['empresa']) && empty($_POST['empresa']) == FALSE) {

        $empresa = strtoupper(addslashes($_POST['empresa']));
        $nome_atividade = strtoupper(addslashes($_POST['nome_atividade']));
        $nome_empreendimento = strtoupper(addslashes($_POST['nome_empreendimento']));
        $nome_logradouro = strtoupper(addslashes($_POST['nome_logradouro']));
        $numero_empreendimento = strtoupper(addslashes($_POST['numero_empreendimento']));
        $complemento = strtoupper(addslashes($_POST['complemento']));
        $localizacao_map_empre = (addslashes($_POST['localizacao_map_empre']));
        $uf = strtoupper(addslashes($_POST['nome_uf']));
        $municipio = strtoupper(addslashes($_POST['nome_municipio']));
        $bairro = strtoupper(addslashes($_POST['nome_bairro']));
        $atividade_empreendimento = strtoupper(addslashes($_POST['atividade_empreendimento']));
        $grau_atividade = strtoupper(addslashes($_POST['grau_atividade']));


        $verifica = "SELECT fk1_codigo_empresa,nome_atividade FROM tb_empreendimento,tb_empresa WHERE tb_empreendimento.fk1_codigo_empresa='" . $_POST['empresa'] . "' AND tb_empreendimento.nome_atividade='" . $_POST['nome_atividade'] . "'";
        $recebe_consulta = mysqli_query($con, $verifica);
        if (mysqli_num_rows($recebe_consulta) > 0 && $nome_atividade != '') {
            ?>
            <script>
                alert('ERRO! ESTA RAZÃO SOCIAL / PESSOA FÍSICA JÁ POSSUI ESTA ATIVIDADE CADASTRADA');
                window.history.back();
            </script>
            <?php
        } else
        if (isset($_POST['empresa'])) {
            $sql = "INSERT INTO tb_empreendimento(fk1_codigo_empresa,nome_atividade,nome_empreendimento,nome_logradouro,numero_empreendimento,complemento,Localizacao_map_empre,nome_uf,nome_municipio,nome_bairro,atividade_empreendimento,grau_atividade)"
                    . "VALUES($empresa,UPPER('$nome_atividade'),UPPER('$nome_empreendimento'),UPPER('$nome_logradouro'),'$numero_empreendimento',UPPER('$complemento'),'$localizacao_map_empre','$uf','$municipio','$bairro','$atividade_empreendimento','$grau_atividade')";
            mysqli_query($con, $sql);
            //recuperando o ultimo id do usuario inserido
            $ultimo_cod = mysqli_insert_id($con);
            //echo $ultimo_cod;
        }
        ?>
        <script>
            alert('CADASTRADO REALIZADO COM SUCESSO!');
            window.history.back();
        </script>
        <?php
    }
    ?>

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button><br>
                <h4 class="modal-title text-center" id="myModalLabel"><strong style="color: #048C46">CADASTRO EMPREENDIMENTO</strong></h4>
            </div>
            <div class="modal-body">
                <form  action=""  method="POST" name="frmempreendimento" id="frmempreendimento">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-success">
                                <div class="panel-heading"> 
                                    <div class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DO EMPREENDIMENTO</strong></a>
                                    </div>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="empresa"><strong>RAZÃO SOCIAL E / OU PESSOA FÍSICA *</strong></label><br/>
                                                    <select name="empresa" id="empresa" class="form-control" autofocus="">
                                                        <?php
                                                        $empresa = "SELECT codigo_empresa, razaosocial_pessoafisica FROM tb_empresa WHERE codigo_empresa = $infor_empresa";
                                                        $recebe_empresas = mysqli_query($con, $empresa);
                                                        while ($linha = mysqli_fetch_array($recebe_empresas)) {
                                                            echo '<option value="' . $linha['codigo_empresa'] . '">' . $linha['razaosocial_pessoafisica'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>                                   
                                            </div>                                  
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="atividade_empreendimento"><strong>EMPREENDIMENTO / ATIVIDADE*</strong></label><br/>
                                                    <input type="text" name="atividade_empreendimento" id="atividade_empreendimento" value="EMPREENDIMENTO" readonly="" class="form-control" />

                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row" hidden="">
                                            <div class="col-sm-12" id="ATIV">
                                                <div class="form-group">
                                                    <label for="nome_atividade"><strong>ATIVIDADE A LICENCIAR *</strong></label><br/>
                                                    <input type="text" name="nome_atividade" id="nome_atividade" class="form-control" placeholder="Campo Obrigatório" autocomplete="off" />                          
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="ATIV_GRAU" hidden="">
                                            <div class="col-sm-12">                                    
                                                <div class="form-group">
                                                    <label for="grau_atividade"><strong>POTENCIAL POLUIDOR DA ATIVIDADE *</strong></label><br/>
                                                    <select name="grau_atividade" id="grau_atividade" class="form-control" />                                                                            
                                                    <option value="">SELECIONE</option>
                                                    <option value="INSIGNIFICANTE">INSIGNIFICANTE</option>
                                                    <option value="BAIXO">BAIXO</option>
                                                    <option value="MEDIO">MÉDIO</option>
                                                    <option value="ALTO">ALTO</option>
                                                    </select> 
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success" id="LOGRADOURO">
                                <div class="panel-heading"> 
                                    <div class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><strong>LOGRADOURO</strong></a>
                                    </div>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="nome_empreendimento"><strong>NOME DO EMPREENDIMENTO*</strong></label><br/>
                                                    <input type="text" name="nome_empreendimento" id="nome_empreendimento" class="form-control" placeholder="Campo Obrigatório"  />
                                                </div>
                                            </div>                                               
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label for="nome_logradouro"><strong>RUA *</strong></label><br/>
                                                    <input type="text" name="nome_logradouro" id="nome_logradouro" class="form-control" placeholder="Campo Obrigatório"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="numero_empreendimento"><strong>NÚMERO</strong></label><br/>
                                                    <input type="text" name="numero_empreendimento" id="numero_empreendimento" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="complemento"><strong>COMPLEMENTO *</strong></label><br/>
                                                <input type="text" name="complemento" id="complemento" class="form-control" autocomplete="off"/>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="localizacao_map_empre"><strong>LOCALIZAÇÃO MAP *</strong></label><br/>
                                                <input type="url" name="localizacao_map_empre" id="localizacao_map_empre" class="form-control" autocomplete="off"/>
                                            </div>
                                            <div class="col-sm-1">
                                                <label for="localizacao_map"><strong>MAPS</strong></label>
                                                <a href="https://www.google.com.br/maps/@-2.5683775,-44.0484718,15z" target="_blank"><img src="img/gmap.ico" width="50px" height="35px" style="margin-bottom: 5px"></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4" >
                                                <div class="form-group">
                                                    <label for="nome_uf"><strong>ESTADO </strong></label><br/>
                                                    <input type="text" name="nome_uf" id="nome_uf" value="MARANHÃO" readonly="" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4" >
                                                <div class="form-group">
                                                    <label for="nome_municipio"><strong>MUNICÍPIO </strong></label><br/>
                                                    <input type="text" name="nome_municipio" id="nome_municipio" value="SÃO JOSÉ DE RIBAMAR" readonly="" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="nome_bairro"><strong>BAIRRO *</strong></label><br/>
                                                    <select name="nome_bairro" id="nome_bairro"   class="form-control">
                                                        <option value="">SELECIONE</option>
                                                        <option value="Alonso Costa">Alonso Costa</option>
                                                        <option value="Alto do Itapiraco">Alto do Itapiraco</option>
                                                        <option value="Altos do Turu">Altos do Turu</option>
                                                        <option value="Altos do Turu I">Altos do Turu I</option>
                                                        <option value="Alto do Turu II">Alto do Turu II</option>
                                                        <option value="Alto do Turu III">Alto do Turu III</option>
                                                        <option value="Alto do Turu VI">Alto do Turu IV</option>
                                                        <option value="Alto Paranã">Alto Paranã</option>
                                                        <option value="Altos do Jaguarema Araçagi">Altos do Jaguarema Araçagi</option>
                                                        <option value="Andiroba">Andiroba</option>
                                                        <option value="Araçagi">Araçagi</option>
                                                        <option value="Aracagi mirititua">Aracagi mirititua</option>                                           
                                                        <option value="Bacuritiua">Bacuritiua</option>
                                                        <option value="Barbosa">Barbosa</option>
                                                        <option value="Boa Viagem">Boa Viagem</option>
                                                        <option value="Boa Vista">Boa Vista</option>
                                                        <option value="Bom Jardim">Bom Jardim</option>
                                                        <option value="Campina">Campina</option>
                                                        <option value="Canavieira">Canavieira</option>
                                                        <option value="Canudos">Canudos</option>
                                                        <option value="Casaca">Casaca</option>
                                                        <option value="Caura">Caura</option>
                                                        <option value="Centro">Centro</option>
                                                        <option value="Chacara do Itapiraco">Chacara do Itapiraco</option>
                                                        <option value="hacara Itapiraco- Cohatrac">Chacara Itapiraco- Cohatrac</option>
                                                        <option value="Ciadae Alta">Ciadae Alta</option>
                                                        <option value="Cidade Alta - Quinta">Cidade Alta - Quinta</option>
                                                        <option value="Cidade Nova">Cidade Nova</option>
                                                        <option value="Cidade Olimpica">Cidade Olimpica</option>
                                                        <option value="Cidade Operaria">Cidade Operaria</option>                                          
                                                        <option value="Cohabiano">Cohabiano</option>
                                                        <option value="Cohabiano I">Cohabiano I</option>
                                                        <option value="Cohabiano II">Cohabiano II</option>                                           
                                                        <option value="Cohatrac">Cohatrac</option>
                                                        <option value="Cohatrac IV">Cohatrac IV</option>
                                                        <option value="Cohatrac Vila">Cohatrac Vila</option>
                                                        <option value="Cohatrac Vila Villagio">Cohatrac Vila Villagio</option>                                 
                                                        <option value="Conceição">Conceição</option>
                                                        <option value="Conjunto Aracagi">Conjunto Aracagi</option>
                                                        <option value="Conjunto Geniparana">Conjunto Geniparana</option>
                                                        <option value="Conjunto Itaguara">Conjunto Itaguara</option>
                                                        <option value="Conjunto Itaguara II">Conjunto Itaguara II</option>
                                                        <option value="Conjunto José Reinaldo Tavares">Conjunto José Reinaldo Tavares</option>
                                                        <option value="Conjunto Residencial Itaguara II">Conjunto Residencial Itaguara II</option>                                            
                                                        <option value="Conjunto Residencial Solar Lusitanos">Conjunto Residencial Solar Lusitanos</option>
                                                        <option value="Cruzeiro">Cruzeiro</option>
                                                        <option value="Espaço Cideral">Espaço Cideral</option>
                                                        <option value="Espaço Sideral">Espaço Sideral</option>
                                                        <option value="Estrada do Araçagi">Estrada do Araçagi</option>               
                                                        <option value="Forquilha">Forquilha</option>
                                                        <option value="Geniparana">Geniparana</option>
                                                        <option value="Geniparana II">Geniparana II</option>
                                                        <option value="Guarapiranga">Guarapiranga</option>
                                                        <option value="I Lima">I Lima</option>
                                                        <option value="Ipem Turu">Ipem Turu</option>
                                                        <option value="Itaguara II">Itaguara II</option>
                                                        <option value="Itaguara II cohatrac">Itaguara II cohatrac</option>
                                                        <option value="Itapary">Itapary</option>
                                                        <option value="Itapiraco">Itapiraco</option>
                                                        <option value="J Câmara">J Câmara</option>
                                                        <option value="J Camara I">J Camara I</option>
                                                        <option value="J Camara II">J Camara II</option>
                                                        <option value="J Lima">J Lima</option>
                                                        <option value="Já Tropical">Já Tropical</option>
                                                        <option value="Janaína">Janaína</option>
                                                        <option value="Jardim Alvorada">Jardim Alvorada</option>
                                                        <option value="Jardim Alvorada Cohatra">Jardim Alvorada Cohatra</option>
                                                        <option value="Jardim Alvoradacohatrac Vila">Jardim Alvoradacohatrac Vila</option>
                                                        <option value="Jardim Araçagi">Jardim Araçagi</option>
                                                        <option value="Jardim Araçagi II">Jardim Araçagi II</option>
                                                        <option value="Jardim Araçagi">Jardim Araçagi</option>
                                                        <option value="Jardim Araçagi I">Jardim Araçagi I</option>
                                                        <option value="Jardim Araçagi I Cohatrac">Jardim Araçagi I Cohatrac</option>
                                                        <option value="Jardim Araçagi II">Jardim Araçagi II</option>
                                                        <option value="Jardim Araçagi III">Jardim Araçagi III</option>
                                                        <option value="Jardim das Margaridas">Jardim das Margaridas</option>
                                                        <option value="Jardim Lisboa">Jardim Lisboa</option> 
                                                        <option value="Jardim Tropical">Jardim Tropical</option>
                                                        <option value="Jardim Tropical II">Jardim Tropical II</option>
                                                        <option value="Jardim Turu">Jardim Turu</option>
                                                        <option value="Jitaguara">Jitaguara</option>
                                                        <option value="Jucatuba">Jucatuba</option>
                                                        <option value="Km 4"> Km 4</option>
                                                        <option value="Laranjal">Laranjal</option>
                                                        <option value="Lotcentral Park">Lotcentral Park</option>
                                                        <option value="Loteamento Alto Turu II">Loteamento Alto Turu II</option>                                                             
                                                        <option value="Loteamento Central Parque Jaguarema">Loteamento Central Parque Jaguarema</option>
                                                        <option value="Loteamento Cohabiano II"> Loteamento Cohabiano II</option>                                     
                                                        <option value="Loteamento Jardim Lisboa">Loteamento Jardim Lisboa</option>
                                                        <option value="Loteamento Jardim Turu">Loteamento Jardim Turu</option>
                                                        <option value="Loteamento Novo Araçagi">Loteamento Novo Araçagi</option>
                                                        <option value="Loteamento Novo Cohatrac">Loteamento Novo Cohatrac</option>
                                                        <option value="Loteamento Paraíso das Rosas">Loteamento Paraíso das Rosas</option>                                          
                                                        <option value="Loteamento Parque Palmeiras">Loteamento Parque Palmeiras</option>
                                                        <option value="Loteamento Portuário Coqueirai">Loteamento Portuário Coqueirais</option>
                                                        <option value="Loteamento Recreio de Araçagi">Loteamento Recreio de Araçagi</option>
                                                        <option value="Loteamento São José"> Loteamento São José</option>
                                                        <option value="Loteamento São Raimundo">Loteamento São Raimundo</option>
                                                        <option value="Loteamento Sítio Trizidela">Loteamento Sítio Trizidela</option>
                                                        <option value="Loteamento Sítio Verde">Loteamento Sítio Verde</option>
                                                        <option value="Loteamento Vilagio Cohatrac">Loteamento Vilagio Cohatrac</option>                                           
                                                        <option value="Maioba">Maioba</option>
                                                        <option value="Maioba Genipapeiro"> Maioba Genipapeiro</option>
                                                        <option value="Maiobinha"> Maiobinha</option>
                                                        <option value="Mata">Mata</option>
                                                        <option value="Matinha">Matinha</option>
                                                        <option value=" Mirititiua"> Mirititiua</option>
                                                        <option value="Miritiua"> Miritiua</option>
                                                        <option value="Miritiua Turu">Miritiua Turu</option>                                           
                                                        <option value=" Morada do Sol"> Morada do Sol</option>
                                                        <option value="Morada Nova">Morada Nova</option>
                                                        <option value="Morada Nova II">Morada Nova II</option>
                                                        <option value="Moropoia"> Moropoia</option>
                                                        <option value="Nova República">Nova República</option>
                                                        <option value="Novo Cohabiano"> Novo Cohabiano</option>
                                                        <option value=" Novo Cohatrac"> Novo Cohatrac</option>
                                                        <option value="Outeiro"> Outeiro</option>
                                                        <option value="Olho D'água"> Olho D'água</option>
                                                        <option value="Panaquatira">Panaquatira</option>
                                                        <option value="Paraíso das Rosas">Paraíso das Rosas</option>
                                                        <option value="Parque Araçagi">Parque Araçagi</option>
                                                        <option value="Parque Araçagi II">Parque Araçagi II</option>                                           
                                                        <option value="Parque da Vitória">Parque da Vitória</option>
                                                        <option value="Parque dos Rios">Parque dos Rios</option>
                                                        <option value="Parque Florêncio">Parque Florêncio</option>                                          
                                                        <option value="Parque Jair">Parque Jair</option>
                                                        <option value="Parque Palmeiras">Parque Palmeiras</option>
                                                        <option value="Parque São José">Parque São José</option>
                                                        <option value="Parque Vitória">Parque Vitória</option>
                                                        <option value="Parque Vitória - Turu">Parque Vitória - Turu</option>
                                                        <option value=" Parque Zuito">Parque Zuito</option>                                           
                                                        <option value="Pau Deitado">Pau Deitado</option>
                                                        <option value="Piçarreira">Piçarreira</option>
                                                        <option value=" Pindai">Pindai</option>                                          
                                                        <option value="Planalto Turu II">Planalto Turu II</option>
                                                        <option value=" Planalto Turu III">Planalto Turu III</option>
                                                        <option value="Pontal da Ilha">Pontal da Ilha</option>
                                                        <option value="Pontão Grossa">Pontão Grossa</option>
                                                        <option value="Povoação Mata"> Povoação Mata</option>
                                                        <option value=" Povoação Santa Maria">  Povoação Santa Maria</option>
                                                        <option value="Matinha"> Povoado Matinha</option>
                                                        <option value="Praia do Aracagi"> Praia do Aracagi</option>
                                                        <option value="Praia Ponta Grossa"> Praia Ponta Grossa</option> 
                                                        <option value="Quinta"> Quinta</option> 
                                                        <option value="Quinta do S João"> Quinta do S João</option>
                                                        <option value="Raposa"> Raposa</option>
                                                        <option value="ecanto do Turu"> Recanto do Turu</option>
                                                        <option value="Recanto do Turu I">Recanto do Turu I</option>
                                                        <option value="Recanto dos Signos">Recanto dos Signos</option>                                          
                                                        <option value="Recreio do Araçagi"> Recreio do Araçagi</option>
                                                        <option value="Resd Ana Carolina">Resd Ana Carolina</option>
                                                        <option value="Resd Caminho das Árvores">Resd Caminho das Árvores</option>
                                                        <option value="Residencial Buriti">Residencial Buriti</option>
                                                        <option value="Residencial Caminho Árvores">Residencial Caminho Árvores</option>
                                                        <option value="Residencial Jambus - Araçagi">Residencial Jambus - Araçagi</option>
                                                        <option value="Residencial Militar"> Residencial Militar</option>
                                                        <option value="Residencial Paraíso das Rosas">Residencial Paraíso das Rosas</option>
                                                        <option value="Residencial São José"> Residencial São José</option>
                                                        <option value="Residencial Terra Livre Turu"> Residencial Terra Livre Turu</option>
                                                        <option value="Residencial jose Reinaldo Tavares">Residencial jose Reinaldo Tavares</option>
                                                        <option value="Ribamar">Ribamar</option>
                                                        <option value="Ribamar Centro">Ribamar Centro</option>
                                                        <option value="Rio São João"> Rio São João</option>
                                                        <option value="Riozinho"> Riozinho</option>
                                                        <option value="Riozinho Cururuca">Riozinho Cururuca</option>
                                                        <option value="Roseana Sarney"> Roseana Sarney</option>
                                                        <option value="Rumo"> Rumo</option>
                                                        <option value="S José">S José</option>
                                                        <option value="S José de Ribamar">S José de Ribamar</option>
                                                        <option value="S José dos Índios">S José dos Índios</option>                                       
                                                        <option value="S Judas Tadeu">S Judas Tadeu</option>
                                                        <option value="S Raimindo">S Raimindo</option>                                         
                                                        <option value="Santa Efigênia">Santa Efigênia</option>
                                                        <option value="Santa Luzia"> Santa Luzia</option>
                                                        <option value="Santa Rosa"> Santa Rosa</option>
                                                        <option value="Santa Terezinha">Santa Terezinha</option>
                                                        <option value="Santana Turu">Santana Turu</option>
                                                        <option value="São Benedito">São Benedito</option>
                                                        <option value="São Judas Tadeu">São Judas Tadeu</option>
                                                        <option value="São Raimundo"> São Raimundo</option>
                                                        <option value="Saramanta">Saramanta</option>
                                                        <option value="Sarney Filho">Sarney Filho</option>
                                                        <option value="Sítio Apicum">Sítio Apicum</option>
                                                        <option value="Sítio Saramanta">Sítio Saramanta</option>
                                                        <option value="Sítio Trizidela">Sítio Trizidela</option>
                                                        <option value="Solar dos Lusiados"> Solar dos Lusiados</option>
                                                        <option value="Tijupa Queimado">Tijupa Queimado</option>
                                                        <option value=" Timbuba">  Timbuba</option>
                                                        <option value="Trizidela"> Trizidela</option>
                                                        <option value="Trizidela da Maioba"> Trizidela da Maioba</option>
                                                        <option value="Tropical"> Tropical</option>
                                                        <option value="Tropical II"> Tropical II</option>
                                                        <option value="Turu"> Turu</option>
                                                        <option value="Ubatuba"> Ubatuba</option>
                                                        <option value="Vieira">Vieira</option>
                                                        <option value="Vila Alonso">Vila Alonso</option>
                                                        <option value="Vila Alonso Costa">Vila Alonso Costa</option>
                                                        <option value="Vila Cafeteira"> Vila Cafeteira</option>
                                                        <option value="Vila Cidade Olímpica">Vila Cidade Olímpica</option>
                                                        <option value="Vila Cohabiano Vila">Vila Cohabiano Vila</option>
                                                        <option value="Vila Doutor José Silva">Vila Doutor José Silva</option>
                                                        <option value="Vila Doutor Julinho"> Vila Doutor Julinho</option>
                                                        <option value="Vila Epitácio Cafeteira">Vila Epitácio Cafeteira</option>
                                                        <option value="Vila Flamengo"> Vila Flamengo</option>
                                                        <option value="Vila J Lima">Vila J Lima</option>
                                                        <option value="Vila Janaína">Vila Janaína</option>
                                                        <option value="Vila Jota Lima"> Vila Jota Lima</option>
                                                        <option value="Vila Kiola"> Vila Kiola</option>
                                                        <option value="Vila Kiola Costa">Vila Kiola Costa</option>
                                                        <option value="Vila Kiola I">Vila Kiola I</option>
                                                        <option value="Vila Kiola II"> Vila Kiola II</option>
                                                        <option value="Vila Luizão"> Vila Luizão</option>
                                                        <option value="Vila Mangueirão"> Vila Mangueirão</option>
                                                        <option value="Vila Marlene">Vila Marlene</option>
                                                        <option value="Vila Nazaré">Vila Nazaré</option>
                                                        <option value="Vila Operária"> Vila Operária</option>
                                                        <option value="Vila Picarreira">Vila Picarreira</option>
                                                        <option value="Vila Riod">Vila Riod</option>
                                                        <option value="Vila Roseana Sarney">Vila Roseana Sarney</option>
                                                        <option value="Vila Rua Sarney"> Vila Rua Sarney</option>
                                                        <option value="Vila S José"> Vila S José</option>
                                                        <option value="Vila S Luís">Vila S Luís</option>
                                                        <option value="Vila Santa Efigênia">Vila Santa Efigênia</option>
                                                        <option value="Vila Santa Terezinha">Vila Santa Terezinha</option>
                                                        <option value="Vila São José"> Vila São José</option>
                                                        <option value="Vila São Luís">Vila São Luís</option>
                                                        <option value="Vila Sarnambi">Vila Sarnambi</option>
                                                        <option value=" Vila Sarney"> Vila Sarney</option>
                                                        <option value="Vila Sarney Filho">Vila Sarney Filho</option>
                                                        <option value="Vila Sarney Filho I">Vila Sarney Filho I</option>
                                                        <option value="Vila Sarney Filho II">Vila Sarney Filho II</option>
                                                        <option value="Vilaje do Cohatrac">Vilaje do Cohatrac</option>
                                                        <option value="Village do Cohatrac Vila">Village do Cohatrac Vila</option>
                                                        <option value="Villagio Cohatrac Vila">Villagio Cohatrac Vila</option>
                                                        <option value="Villagio do Cohatrac Via">Villagio do Cohatrac Via</option>
                                                        <option value="Villagio Itaguara"> Villagio Itaguara</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-title" style="text-align: center;"><br/>
                                    <button type="submit" class="btn btn-success" style="font-size: 17px; font-weight: bold;">REALIZAR CADASTRO<span class="glyphicon glyphicon-saved" style="margin-left: 10px;"></span></button>
                                </div>   
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--os dados abaixo são referentes ao cadastro das atividade-->
<div class="modal fade" id="myModalcadAtividade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button><br>
                <h4 class="modal-title text-center" id="myModalLabel"><strong style="color: #048C46">CADASTRO ATIVIDADE</strong></h4>
            </div>
            <div class="modal-body">
                <form  action=""  method="POST" name="frmempreendimento" id="frmempreendimento">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-success">
                                <div class="panel-heading"> 
                                    <div class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DA ATIVIDADE</strong></a>
                                    </div>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="empresa"><strong>RAZÃO SOCIAL E / OU PESSOA FÍSICA *</strong></label><br/>
                                                    <select name="empresa" id="empresa" class="form-control" autofocus="">
                                                        <?php
                                                        $empresa = "SELECT codigo_empresa, razaosocial_pessoafisica FROM tb_empresa WHERE codigo_empresa = $infor_empresa";
                                                        $recebe_empresas = mysqli_query($con, $empresa);
                                                        while ($linha = mysqli_fetch_array($recebe_empresas)) {
                                                            echo '<option value="' . $linha['codigo_empresa'] . '">' . $linha['razaosocial_pessoafisica'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>                                   
                                            </div>                                  
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="atividade_empreendimento"><strong>EMPREENDIMENTO / ATIVIDADE*</strong></label><br/>
                                                    <input type="text" name="atividade_empreendimento" id="atividade_empreendimento" value="ATIVIDADE" readonly="" class="form-control" />
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-12" id="ATIV">
                                                <div class="form-group">
                                                    <label for="nome_atividade"><strong>ATIVIDADE A LICENCIAR *</strong></label><br/>
                                                    <input type="text" name="nome_atividade" id="nome_atividade" class="form-control" placeholder="Campo Obrigatório" autocomplete="off" />                          
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="ATIV_GRAU">
                                            <div class="col-sm-12">                                    
                                                <div class="form-group">
                                                    <label for="grau_atividade"><strong>POTENCIAL POLUIDOR DA ATIVIDADE *</strong></label><br/>
                                                    <select name="grau_atividade" id="grau_atividade" class="form-control" />                                                                            
                                                    <option value="">SELECIONE</option>
                                                    <option value="INSIGNIFICANTE">INSIGNIFICANTE</option>
                                                    <option value="BAIXO">BAIXO</option>
                                                    <option value="MEDIO">MÉDIO</option>
                                                    <option value="ALTO">ALTO</option>
                                                    </select> 
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success" id="LOGRADOURO" hidden="">
                                <div class="panel-heading"> 
                                    <div class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><strong>LOGRADOURO</strong></a>
                                    </div>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="nome_empreendimento"><strong>NOME DO EMPREENDIMENTO*</strong></label><br/>
                                                    <input type="text" name="nome_empreendimento" id="nome_empreendimento" class="form-control" placeholder="Campo Obrigatório"  />
                                                </div>
                                            </div>                                               
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label for="nome_logradouro"><strong>RUA *</strong></label><br/>
                                                    <input type="text" name="nome_logradouro" id="nome_logradouro" class="form-control" placeholder="Campo Obrigatório"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="numero_empreendimento"><strong>NÚMERO</strong></label><br/>
                                                    <input type="text" name="numero_empreendimento" id="numero_empreendimento" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="complemento"><strong>COMPLEMENTO *</strong></label><br/>
                                                <input type="text" name="complemento" id="complemento" class="form-control" autocomplete="off"/>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="localizacao_map_empre"><strong>LOCALIZAÇÃO MAP *</strong></label><br/>
                                                <input type="url" name="localizacao_map_empre" id="localizacao_map_empre" class="form-control" autocomplete="off"/>
                                            </div>
                                            <div class="col-sm-1">
                                                <label for="localizacao_map"><strong>MAPS</strong></label>
                                                <a href="https://www.google.com.br/maps/@-2.5683775,-44.0484718,15z" target="_blank"><img src="img/gmap.ico" width="50px" height="35px" style="margin-bottom: 5px"></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4" >
                                                <div class="form-group">
                                                    <label for="nome_uf"><strong>ESTADO </strong></label><br/>
                                                    <input type="text" name="nome_uf" id="nome_uf" value="MARANHÃO" readonly="" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4" >
                                                <div class="form-group">
                                                    <label for="nome_municipio"><strong>MUNICÍPIO </strong></label><br/>
                                                    <input type="text" name="nome_municipio" id="nome_municipio" value="SÃO JOSÉ DE RIBAMAR" readonly="" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="nome_bairro"><strong>BAIRRO *</strong></label><br/>
                                                    <select name="nome_bairro" id="nome_bairro"   class="form-control">
                                                        <option value="">SELECIONE</option>
                                                        <option value="Alonso Costa">Alonso Costa</option>
                                                        <option value="Alto do Itapiraco">Alto do Itapiraco</option>
                                                        <option value="Altos do Turu">Altos do Turu</option>
                                                        <option value="Altos do Turu I">Altos do Turu I</option>
                                                        <option value="Alto do Turu II">Alto do Turu II</option>
                                                        <option value="Alto do Turu III">Alto do Turu III</option>
                                                        <option value="Alto do Turu VI">Alto do Turu IV</option>
                                                        <option value="Alto Paranã">Alto Paranã</option>
                                                        <option value="Altos do Jaguarema Araçagi">Altos do Jaguarema Araçagi</option>
                                                        <option value="Andiroba">Andiroba</option>
                                                        <option value="Araçagi">Araçagi</option>
                                                        <option value="Aracagi mirititua">Aracagi mirititua</option>                                           
                                                        <option value="Bacuritiua">Bacuritiua</option>
                                                        <option value="Barbosa">Barbosa</option>
                                                        <option value="Boa Viagem">Boa Viagem</option>
                                                        <option value="Boa Vista">Boa Vista</option>
                                                        <option value="Bom Jardim">Bom Jardim</option>
                                                        <option value="Campina">Campina</option>
                                                        <option value="Canavieira">Canavieira</option>
                                                        <option value="Canudos">Canudos</option>
                                                        <option value="Casaca">Casaca</option>
                                                        <option value="Caura">Caura</option>
                                                        <option value="Centro">Centro</option>
                                                        <option value="Chacara do Itapiraco">Chacara do Itapiraco</option>
                                                        <option value="hacara Itapiraco- Cohatrac">Chacara Itapiraco- Cohatrac</option>
                                                        <option value="Ciadae Alta">Ciadae Alta</option>
                                                        <option value="Cidade Alta - Quinta">Cidade Alta - Quinta</option>
                                                        <option value="Cidade Nova">Cidade Nova</option>
                                                        <option value="Cidade Olimpica">Cidade Olimpica</option>
                                                        <option value="Cidade Operaria">Cidade Operaria</option>                                          
                                                        <option value="Cohabiano">Cohabiano</option>
                                                        <option value="Cohabiano I">Cohabiano I</option>
                                                        <option value="Cohabiano II">Cohabiano II</option>                                           
                                                        <option value="Cohatrac">Cohatrac</option>
                                                        <option value="Cohatrac IV">Cohatrac IV</option>
                                                        <option value="Cohatrac Vila">Cohatrac Vila</option>
                                                        <option value="Cohatrac Vila Villagio">Cohatrac Vila Villagio</option>                                 
                                                        <option value="Conceição">Conceição</option>
                                                        <option value="Conjunto Aracagi">Conjunto Aracagi</option>
                                                        <option value="Conjunto Geniparana">Conjunto Geniparana</option>
                                                        <option value="Conjunto Itaguara">Conjunto Itaguara</option>
                                                        <option value="Conjunto Itaguara II">Conjunto Itaguara II</option>
                                                        <option value="Conjunto José Reinaldo Tavares">Conjunto José Reinaldo Tavares</option>
                                                        <option value="Conjunto Residencial Itaguara II">Conjunto Residencial Itaguara II</option>                                            
                                                        <option value="Conjunto Residencial Solar Lusitanos">Conjunto Residencial Solar Lusitanos</option>
                                                        <option value="Cruzeiro">Cruzeiro</option>
                                                        <option value="Espaço Cideral">Espaço Cideral</option>
                                                        <option value="Espaço Sideral">Espaço Sideral</option>
                                                        <option value="Estrada do Araçagi">Estrada do Araçagi</option>               
                                                        <option value="Forquilha">Forquilha</option>
                                                        <option value="Geniparana">Geniparana</option>
                                                        <option value="Geniparana II">Geniparana II</option>
                                                        <option value="Guarapiranga">Guarapiranga</option>
                                                        <option value="I Lima">I Lima</option>
                                                        <option value="Ipem Turu">Ipem Turu</option>
                                                        <option value="Itaguara II">Itaguara II</option>
                                                        <option value="Itaguara II cohatrac">Itaguara II cohatrac</option>
                                                        <option value="Itapary">Itapary</option>
                                                        <option value="Itapiraco">Itapiraco</option>
                                                        <option value="J Câmara">J Câmara</option>
                                                        <option value="J Camara I">J Camara I</option>
                                                        <option value="J Camara II">J Camara II</option>
                                                        <option value="J Lima">J Lima</option>
                                                        <option value="Já Tropical">Já Tropical</option>
                                                        <option value="Janaína">Janaína</option>
                                                        <option value="Jardim Alvorada">Jardim Alvorada</option>
                                                        <option value="Jardim Alvorada Cohatra">Jardim Alvorada Cohatra</option>
                                                        <option value="Jardim Alvoradacohatrac Vila">Jardim Alvoradacohatrac Vila</option>
                                                        <option value="Jardim Araçagi">Jardim Araçagi</option>
                                                        <option value="Jardim Araçagi II">Jardim Araçagi II</option>
                                                        <option value="Jardim Araçagi">Jardim Araçagi</option>
                                                        <option value="Jardim Araçagi I">Jardim Araçagi I</option>
                                                        <option value="Jardim Araçagi I Cohatrac">Jardim Araçagi I Cohatrac</option>
                                                        <option value="Jardim Araçagi II">Jardim Araçagi II</option>
                                                        <option value="Jardim Araçagi III">Jardim Araçagi III</option>
                                                        <option value="Jardim das Margaridas">Jardim das Margaridas</option>
                                                        <option value="Jardim Lisboa">Jardim Lisboa</option> 
                                                        <option value="Jardim Tropical">Jardim Tropical</option>
                                                        <option value="Jardim Tropical II">Jardim Tropical II</option>
                                                        <option value="Jardim Turu">Jardim Turu</option>
                                                        <option value="Jitaguara">Jitaguara</option>
                                                        <option value="Jucatuba">Jucatuba</option>
                                                        <option value="Km 4"> Km 4</option>
                                                        <option value="Laranjal">Laranjal</option>
                                                        <option value="Lotcentral Park">Lotcentral Park</option>
                                                        <option value="Loteamento Alto Turu II">Loteamento Alto Turu II</option>                                                             
                                                        <option value="Loteamento Central Parque Jaguarema">Loteamento Central Parque Jaguarema</option>
                                                        <option value="Loteamento Cohabiano II"> Loteamento Cohabiano II</option>                                     
                                                        <option value="Loteamento Jardim Lisboa">Loteamento Jardim Lisboa</option>
                                                        <option value="Loteamento Jardim Turu">Loteamento Jardim Turu</option>
                                                        <option value="Loteamento Novo Araçagi">Loteamento Novo Araçagi</option>
                                                        <option value="Loteamento Novo Cohatrac">Loteamento Novo Cohatrac</option>
                                                        <option value="Loteamento Paraíso das Rosas">Loteamento Paraíso das Rosas</option>                                          
                                                        <option value="Loteamento Parque Palmeiras">Loteamento Parque Palmeiras</option>
                                                        <option value="Loteamento Portuário Coqueirai">Loteamento Portuário Coqueirais</option>
                                                        <option value="Loteamento Recreio de Araçagi">Loteamento Recreio de Araçagi</option>
                                                        <option value="Loteamento São José"> Loteamento São José</option>
                                                        <option value="Loteamento São Raimundo">Loteamento São Raimundo</option>
                                                        <option value="Loteamento Sítio Trizidela">Loteamento Sítio Trizidela</option>
                                                        <option value="Loteamento Sítio Verde">Loteamento Sítio Verde</option>
                                                        <option value="Loteamento Vilagio Cohatrac">Loteamento Vilagio Cohatrac</option>                                           
                                                        <option value="Maioba">Maioba</option>
                                                        <option value="Maioba Genipapeiro"> Maioba Genipapeiro</option>
                                                        <option value="Maiobinha"> Maiobinha</option>
                                                        <option value="Mata">Mata</option>
                                                        <option value="Matinha">Matinha</option>
                                                        <option value=" Mirititiua"> Mirititiua</option>
                                                        <option value="Miritiua"> Miritiua</option>
                                                        <option value="Miritiua Turu">Miritiua Turu</option>                                           
                                                        <option value=" Morada do Sol"> Morada do Sol</option>
                                                        <option value="Morada Nova">Morada Nova</option>
                                                        <option value="Morada Nova II">Morada Nova II</option>
                                                        <option value="Moropoia"> Moropoia</option>
                                                        <option value="Nova República">Nova República</option>
                                                        <option value="Novo Cohabiano"> Novo Cohabiano</option>
                                                        <option value=" Novo Cohatrac"> Novo Cohatrac</option>
                                                        <option value="Outeiro"> Outeiro</option>
                                                        <option value="Olho D'água"> Olho D'água</option>
                                                        <option value="Panaquatira">Panaquatira</option>
                                                        <option value="Paraíso das Rosas">Paraíso das Rosas</option>
                                                        <option value="Parque Araçagi">Parque Araçagi</option>
                                                        <option value="Parque Araçagi II">Parque Araçagi II</option>                                           
                                                        <option value="Parque da Vitória">Parque da Vitória</option>
                                                        <option value="Parque dos Rios">Parque dos Rios</option>
                                                        <option value="Parque Florêncio">Parque Florêncio</option>                                          
                                                        <option value="Parque Jair">Parque Jair</option>
                                                        <option value="Parque Palmeiras">Parque Palmeiras</option>
                                                        <option value="Parque São José">Parque São José</option>
                                                        <option value="Parque Vitória">Parque Vitória</option>
                                                        <option value="Parque Vitória - Turu">Parque Vitória - Turu</option>
                                                        <option value=" Parque Zuito">Parque Zuito</option>                                           
                                                        <option value="Pau Deitado">Pau Deitado</option>
                                                        <option value="Piçarreira">Piçarreira</option>
                                                        <option value=" Pindai">Pindai</option>                                          
                                                        <option value="Planalto Turu II">Planalto Turu II</option>
                                                        <option value=" Planalto Turu III">Planalto Turu III</option>
                                                        <option value="Pontal da Ilha">Pontal da Ilha</option>
                                                        <option value="Pontão Grossa">Pontão Grossa</option>
                                                        <option value="Povoação Mata"> Povoação Mata</option>
                                                        <option value=" Povoação Santa Maria">  Povoação Santa Maria</option>
                                                        <option value="Matinha"> Povoado Matinha</option>
                                                        <option value="Praia do Aracagi"> Praia do Aracagi</option>
                                                        <option value="Praia Ponta Grossa"> Praia Ponta Grossa</option> 
                                                        <option value="Quinta"> Quinta</option> 
                                                        <option value="Quinta do S João"> Quinta do S João</option>
                                                        <option value="Raposa"> Raposa</option>
                                                        <option value="ecanto do Turu"> Recanto do Turu</option>
                                                        <option value="Recanto do Turu I">Recanto do Turu I</option>
                                                        <option value="Recanto dos Signos">Recanto dos Signos</option>                                          
                                                        <option value="Recreio do Araçagi"> Recreio do Araçagi</option>
                                                        <option value="Resd Ana Carolina">Resd Ana Carolina</option>
                                                        <option value="Resd Caminho das Árvores">Resd Caminho das Árvores</option>
                                                        <option value="Residencial Buriti">Residencial Buriti</option>
                                                        <option value="Residencial Caminho Árvores">Residencial Caminho Árvores</option>
                                                        <option value="Residencial Jambus - Araçagi">Residencial Jambus - Araçagi</option>
                                                        <option value="Residencial Militar"> Residencial Militar</option>
                                                        <option value="Residencial Paraíso das Rosas">Residencial Paraíso das Rosas</option>
                                                        <option value="Residencial São José"> Residencial São José</option>
                                                        <option value="Residencial Terra Livre Turu"> Residencial Terra Livre Turu</option>
                                                        <option value="Residencial jose Reinaldo Tavares">Residencial jose Reinaldo Tavares</option>
                                                        <option value="Ribamar">Ribamar</option>
                                                        <option value="Ribamar Centro">Ribamar Centro</option>
                                                        <option value="Rio São João"> Rio São João</option>
                                                        <option value="Riozinho"> Riozinho</option>
                                                        <option value="Riozinho Cururuca">Riozinho Cururuca</option>
                                                        <option value="Roseana Sarney"> Roseana Sarney</option>
                                                        <option value="Rumo"> Rumo</option>
                                                        <option value="S José">S José</option>
                                                        <option value="S José de Ribamar">S José de Ribamar</option>
                                                        <option value="S José dos Índios">S José dos Índios</option>                                       
                                                        <option value="S Judas Tadeu">S Judas Tadeu</option>
                                                        <option value="S Raimindo">S Raimindo</option>                                         
                                                        <option value="Santa Efigênia">Santa Efigênia</option>
                                                        <option value="Santa Luzia"> Santa Luzia</option>
                                                        <option value="Santa Rosa"> Santa Rosa</option>
                                                        <option value="Santa Terezinha">Santa Terezinha</option>
                                                        <option value="Santana Turu">Santana Turu</option>
                                                        <option value="São Benedito">São Benedito</option>
                                                        <option value="São Judas Tadeu">São Judas Tadeu</option>
                                                        <option value="São Raimundo"> São Raimundo</option>
                                                        <option value="Saramanta">Saramanta</option>
                                                        <option value="Sarney Filho">Sarney Filho</option>
                                                        <option value="Sítio Apicum">Sítio Apicum</option>
                                                        <option value="Sítio Saramanta">Sítio Saramanta</option>
                                                        <option value="Sítio Trizidela">Sítio Trizidela</option>
                                                        <option value="Solar dos Lusiados"> Solar dos Lusiados</option>
                                                        <option value="Tijupa Queimado">Tijupa Queimado</option>
                                                        <option value=" Timbuba">  Timbuba</option>
                                                        <option value="Trizidela"> Trizidela</option>
                                                        <option value="Trizidela da Maioba"> Trizidela da Maioba</option>
                                                        <option value="Tropical"> Tropical</option>
                                                        <option value="Tropical II"> Tropical II</option>
                                                        <option value="Turu"> Turu</option>
                                                        <option value="Ubatuba"> Ubatuba</option>
                                                        <option value="Vieira">Vieira</option>
                                                        <option value="Vila Alonso">Vila Alonso</option>
                                                        <option value="Vila Alonso Costa">Vila Alonso Costa</option>
                                                        <option value="Vila Cafeteira"> Vila Cafeteira</option>
                                                        <option value="Vila Cidade Olímpica">Vila Cidade Olímpica</option>
                                                        <option value="Vila Cohabiano Vila">Vila Cohabiano Vila</option>
                                                        <option value="Vila Doutor José Silva">Vila Doutor José Silva</option>
                                                        <option value="Vila Doutor Julinho"> Vila Doutor Julinho</option>
                                                        <option value="Vila Epitácio Cafeteira">Vila Epitácio Cafeteira</option>
                                                        <option value="Vila Flamengo"> Vila Flamengo</option>
                                                        <option value="Vila J Lima">Vila J Lima</option>
                                                        <option value="Vila Janaína">Vila Janaína</option>
                                                        <option value="Vila Jota Lima"> Vila Jota Lima</option>
                                                        <option value="Vila Kiola"> Vila Kiola</option>
                                                        <option value="Vila Kiola Costa">Vila Kiola Costa</option>
                                                        <option value="Vila Kiola I">Vila Kiola I</option>
                                                        <option value="Vila Kiola II"> Vila Kiola II</option>
                                                        <option value="Vila Luizão"> Vila Luizão</option>
                                                        <option value="Vila Mangueirão"> Vila Mangueirão</option>
                                                        <option value="Vila Marlene">Vila Marlene</option>
                                                        <option value="Vila Nazaré">Vila Nazaré</option>
                                                        <option value="Vila Operária"> Vila Operária</option>
                                                        <option value="Vila Picarreira">Vila Picarreira</option>
                                                        <option value="Vila Riod">Vila Riod</option>
                                                        <option value="Vila Roseana Sarney">Vila Roseana Sarney</option>
                                                        <option value="Vila Rua Sarney"> Vila Rua Sarney</option>
                                                        <option value="Vila S José"> Vila S José</option>
                                                        <option value="Vila S Luís">Vila S Luís</option>
                                                        <option value="Vila Santa Efigênia">Vila Santa Efigênia</option>
                                                        <option value="Vila Santa Terezinha">Vila Santa Terezinha</option>
                                                        <option value="Vila São José"> Vila São José</option>
                                                        <option value="Vila São Luís">Vila São Luís</option>
                                                        <option value="Vila Sarnambi">Vila Sarnambi</option>
                                                        <option value=" Vila Sarney"> Vila Sarney</option>
                                                        <option value="Vila Sarney Filho">Vila Sarney Filho</option>
                                                        <option value="Vila Sarney Filho I">Vila Sarney Filho I</option>
                                                        <option value="Vila Sarney Filho II">Vila Sarney Filho II</option>
                                                        <option value="Vilaje do Cohatrac">Vilaje do Cohatrac</option>
                                                        <option value="Village do Cohatrac Vila">Village do Cohatrac Vila</option>
                                                        <option value="Villagio Cohatrac Vila">Villagio Cohatrac Vila</option>
                                                        <option value="Villagio do Cohatrac Via">Villagio do Cohatrac Via</option>
                                                        <option value="Villagio Itaguara"> Villagio Itaguara</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-title" style="text-align: center;"><br/>
                                    <button type="submit" class="btn btn-success" style="font-size: 17px; font-weight: bold;">REALIZAR CADASTRO<span class="glyphicon glyphicon-saved" style="margin-left: 10px;"></span></button>
                                </div>   
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--os dados abaixo sao referentes ao cadadatro de processo-->
<div class="modal fade" id="myModalCadProcesso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <?php
    if (isset($_POST['empreendimento']) && empty($_POST['empreendimento']) == FALSE) {
        if (isset($_POST['numero_processo']) && empty($_POST['numero_processo']) == FALSE) {
            if (isset($_POST['data_processo']) && empty($_POST['data_processo']) == FALSE) {
                if (isset($_POST['assunto']) && empty($_POST['assunto']) == FALSE) {

                    $empresa = strtoupper(addslashes($_POST['empresa']));
                    $empreendimento = strtoupper(addslashes($_POST['empreendimento']));
                    $numero_processo = strtoupper(addslashes($_POST['numero_processo']));
                    $ano = strtoupper(addslashes($_POST['ano']));
                    $data_processo = strtoupper(addslashes($_POST['data_processo']));
                    $assunto = strtoupper(addslashes($_POST['assunto']));
                    $situacao_processo = strtoupper(addslashes($_POST['situacao_processo']));
                    $motivo_situacao = strtoupper(addslashes($_POST['motivo_situacao']));

                    //verificando se ja existe no banco de dados o numero do processo informado            
                    $consulta_processo = "SELECT numero_processo,assunto,ano FROM tb_processo WHERE numero_processo ='" . $_POST['numero_processo'] . "' AND assunto ='" . $_POST['assunto'] . "' AND ano='" . $_POST['ano'] . "' ";
                    $recebe_consulta = mysqli_query($con, $consulta_processo);

                    if (mysqli_num_rows($recebe_consulta) > 0) {
                        ?>
                        <script>
                            alert('ERRO! JÁ EXISTE UM PROCESSO COM O NÚMERO INFORMADO, POR FAVOR INFORME OUTRO NÚMERO! \n\n ATENÇÃO CASO O EMPREENDIMENTO / ATIVIDADE NÃO APAREÇA SELECIONE A RAZÃO SOCIAL / Pª FISICA NOVAMENTE ');
                            window.history.back();
                        </script>
                        <?php
                    } else {

                        $sql = "INSERT INTO tb_processo(fk3_codigo_empresa,fk4_codigo_empreendimento,numero_processo,ano,data_processo,assunto,situacao_processo,motivo_situacao)"
                                . "VALUES('$empresa','$empreendimento','$numero_processo','$ano','$data_processo','$assunto','$situacao_processo','$motivo_situacao')";
                        mysqli_query($con, $sql);

                        //recuperando o ultimo processo inserido
                        $ultimo_processo = mysqli_insert_id($con);
//                        echo $ultimo_processo;
                        $_SESSION['ultimo_processo'] = $ultimo_processo;
//                      print_r($sql);                   
//                        $_SESSION['controle_de_abas'] = 1;
                        // O CÓDIGO ABAIXO REGISTRA O USUARIO QUE REALIZOU O CADASTRO DE CERTO EMPRESA / PESSOA FISICA
                        $emailUser = $_SESSION['email'];
                        $user = $_SESSION['nome'];
                        $ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
                        $ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
                        $data = Date("Y-m-d H:i:s");
                        $acaoUsuario = "Realizou o Cadastro do processo de numero ->$numero_processo, para o empreendimento de codigo->$empreendimento, e empresa de codigo $empreendimento";
                        $sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
                        mysqli_query($con, $sqlLog);
                    }
                }
            }
        }
    }
    ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button><br>
                <h4 class="modal-title text-center" id="myModalLabel"><strong style="color: #048C46">CADASTRO DE PROCESSO</strong></h4>
            </div>
            <div class="modal-body">
                <form  action=""  method="POST" name="frmprocesso" id="frmprocesso">
                    <div class="panel panel-success">
                        <div class="panel-heading">                                
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DO PROCESSO</strong></a>
                            </div>
                        </div>
                        <div  class="panel-collapse ">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">                                                
                                            <label for="empresa"><strong>RAZÃO SOCIAL / Pª FÍSICA *</strong></label>
                                            <select name="empresa" id="empresa" class="form-control" autofocus="">                                                                                                                                  
                                                <?php
                                                $empresa = "SELECT codigo_empresa, razaosocial_pessoafisica FROM tb_empresa WHERE codigo_empresa = $infor_empresa";
                                                $recebe_empresas = mysqli_query($con, $empresa);
                                                while ($linha = mysqli_fetch_array($recebe_empresas)) {
                                                    echo '<option value="' . $linha['codigo_empresa'] . '">' . $linha['razaosocial_pessoafisica'] . '</option>';
                                                }
                                                ?>                                                                                                                    
                                            </select>
                                        </div>
                                        <div class="form-group">  
                                            <label for="empreendimento"><strong>EMPREENDIMENTO / ATIVIDADE*</strong></label>                                  
                                            <select name="empreendimento" id="empreendimento" class="form-control" autofocus="">                                                                                                      
                                                <?php
                                                $ativ_empre = "SELECT  *FROM tb_empreendimento WHERE fk1_codigo_empresa=" . $infor_empresa . " ORDER BY codigo_empreendimento ASC";
                                                $recebe_ativ_empre = mysqli_query($con, $ativ_empre);
                                                while ($linha = mysqli_fetch_array($recebe_ativ_empre)) {
                                                    echo"<option></option>";
                                                    echo"<option value='" . $linha['codigo_empreendimento'] . "'>" . $linha['nome_empreendimento'] . $linha['nome_atividade'] . "</option>";
                                                }
                                                ?>                                    
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">                                      
                                        <div class="form-group">
                                            <label for="assunto"><strong>ASSUNTO *</strong></label><br/>
                                            <select name="assunto" id="assunto" class="form-control">
                                                <option value="">SELECIONE</option>                                            
                                                <option value="AUTO DE INFRAÇÃO">AUTO DE INFRAÇÃO</option>
                                                <option value="AUTO DE NOTIFICAÇÃO E INTIMAÇÃO">AUTO DE NOTIFICAÇÃO E INTIMAÇÃO</option>                                           
                                                <option value="AUTORIZAÇÃO PARA CORTE DE ARVORE">AUTORIZAÇÃO PARA CORTE DE ARVORE</option> 
                                                <option value="AUTORIZAÇÃO PARA PODA DE ÁRVORE">AUTORIZAÇÃO PARA PODA DE ÁRVORE</option> 
                                                <option value="AUTORIZAÇÃO DE LIMPEZA DE ÁREA">AUTORIZAÇÃO DE LIMPEZA DE ÁREA</option>                                                   
                                                <option value="AUTORIZAÇÃO PARA SUPRESSÃO DE VEGETAÇÃO E LIMPEZA DE ÁREA">AUTORIZAÇÃO PARA SUPRESSÃO DE VEGETAÇÃO E LIMPEZA DE ÁREA</option>                                                  
                                                <option value="LICENCA AMBIENTAL SIMPLIFICADA">L.A.S</option>
                                                <option value="LICENÇA DE INSTALAÇÃO">L.I</option>
                                                <option value="LICENÇA DE OPERAÇÃO">L.O</option>
                                                <option value="LICENÇA DE OPERAÇÃO CORRETIVA">L.O.C</option>
                                                <option value="LICENÇA DE PRÉVIA">L.P</option>                                                                                                                   
                                                <option value="RENOVAÇÃO DE LICENCA PRÉVIA">R.L.P</option>
                                                <option value="RENOVAÇÃO DE LICENÇA DE INSTALAÇÃO">R.L.I</option>
                                                <option value="RENOVAÇÃO DE LICENÇA DE OPERAÇÃO">R.L.O</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">                          
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="numero_processo"><strong>Nº PROCESSO *</strong></label><br/>
                                            <input type="text" name="numero_processo" id="numero_processo" onkeyup="somenteNumeros(this);" maxlength="3" class="form-control" placeholder="Campo Obrigatório" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="ano"><strong>ANO *</strong></label><br/>
                                            <select name="ano" id="ano" class="form-control">
                                                <option value="">SELECIONE</option>
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                            </select>                              
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="data_processo">DATA *</label>
                                            <input type="date" name="data_processo" id="data_processo" class="form-control" onblur="comparaDataAnoProcesso()" max="2020-12-31" min="2017-01-01" />
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="situacao_processo">SITUAÇÃO</label>
                                            <input type="text" name="situacao_processo" id="situacao_processo" value="ABERTO" readonly="" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="motivo_situacao">MOTIVO DA SITUAÇÃO</label>
                                            <input type="text" name="motivo_situacao" id="motivo_situacao" value="A DEFINIR" readonly="" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-title" style="text-align: center;"><br/>
                            <button type="submit" class="btn btn-success" style="font-size: 17px; font-weight: bold;">REALIZAR CADASTRO <span class="glyphicon glyphicon-saved" style="margin-left: 10px;"></span></button>
                            <button  class="btn btn-danger"><a href="cadastros.php"style="text-decoration: none;color:#FFF">CANCELAR CADASTRO<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a></button><br/><br/>
                        </div>   
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--os dados abaixo sao referente ao cadastro de licenca-->
<div class="modal fade" id="myModalCadLicenca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <?php
    if (isset($_POST['empresa']) && empty($_POST['empresa']) == FALSE) {
        if (isset($_POST['empreendimento']) && empty($_POST['empreendimento']) == FALSE) {
            if (isset($_POST['processo']) && empty($_POST['processo']) == FALSE) {
                if (isset($_POST['numero_licenca']) && empty($_POST['numero_licenca']) == FALSE) {
                    if (isset($_POST['ano_licenca']) && empty($_POST['ano_licenca']) == FALSE) {
                        if (isset($_POST['data_emissao']) && empty($_POST['data_emissao']) == FALSE) {
                            if (isset($_POST['data_validade']) && empty($_POST['data_validade']) == FALSE) {
                                if (isset($_POST['descricao_atividade']) && empty($_POST['descricao_atividade']) == FALSE) {

                                    $empresa = strtoupper(addslashes($_POST['empresa']));
                                    $empreendimento = strtoupper(addslashes($_POST['empreendimento']));
                                    $processo = strtoupper(addslashes($_POST['processo']));
                                    $numero_licenca = strtoupper(addslashes($_POST['numero_licenca']));
                                    $ano_licenca = strtoupper(addslashes($_POST['ano_licenca']));
                                    $data_emissao = strtoupper(addslashes($_POST['data_emissao']));
                                    $data_validade = strtoupper(addslashes($_POST['data_validade']));
                                    $taxa = strtoupper(addslashes($_POST['taxa']));
                                    $descricao_atividade = strtoupper(addslashes($_POST['descricao_atividade']));

                                    /* codigo responsavel pela comparaçõa entre as data de emissoa e validade */
                                    if ($data_emissao >= $data_validade) {
                                        ?>
                                        <script>
                                            alert('ERRO! A DATA DE EMISSÃO NÃO PODE SER MAIOR OU IGUAL A DATA DE VALIDADE');
                                            window.history.back();
                                        </script>
                                        <?php
                                    }
                                    //VERIFICANDO SE JÁ EXISTE UM NÚMERO E O UM TIPO DE LICEÇA JÁ CADASTRADOS 
                                    $consulta_licenca = "SELECT fk1_codigo_processo,numero_licenca,ano_licenca FROM tb_licenca,tb_processo WHERE tb_licenca.fk1_codigo_processo='" . $_POST['processo'] . "' AND tb_licenca.numero_licenca='" . $_POST['numero_licenca'] . "'AND tb_licenca.ano_licenca='" . $_POST['ano_licenca'] . "'";

                                    $recebe_consulta = mysqli_query($con, $consulta_licenca);

                                    if (mysqli_num_rows($recebe_consulta) > 0) {
                                        ?>
                                        <script>
                                            alert('ERRO! JÁ EXISTE UM NÚMERO E O TIPO DE LICENÇA CADASTRO COM ESSAS INFORMÇÕES, POR FAVOR INFORME OUTRO NÚMERO OU TIPO DE LICENÇA!');
                                            window.history.back();
                                        </script>
                                        <?php
                                    } else {

                                        $sql = "INSERT INTO tb_licenca(fk4_codigo_empresa,fk1_codigo_empreendimento,fk1_codigo_processo,numero_licenca,ano_licenca,data_emissao,data_validade,taxa,descricao_atividade)"
                                                . "VALUES('$empresa','$empreendimento','$processo','$numero_licenca','$ano_licenca','$data_emissao','$data_validade','$taxa',UPPER('$descricao_atividade'))";
                                        mysqli_query($con, $sql);

//                                    print_r($sql);

                                        $_SESSION['controle_de_abas'] = 2;

                                        // O CÓDIGO ABAIXO REGISTRA O USUARIO QUE REALIZOU O CADASTRO DE CERTO EMPRESA / PESSOA FISICA
                                        $emailUser = $_SESSION['email'];
                                        $user = $_SESSION['nome'];
                                        $ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
                                        $ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
                                        $data = Date("Y-m-d H:i:s");
                                        $acaoUsuario = "Realizou o Cadastro da licenca de numero ->$numero_licenca, para o empreendimento de codigo->$empreendimento, empresa de codigo $empreendimento, e processo de codigo $processo";
                                        $sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
                                        mysqli_query($con, $sqlLog);
                                        ?>

                                        <?php
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button><br>
                <h4 class="modal-title text-center" id="myModalLabel"><strong style="color: #048C46">CADASTRO DE LICENÇA</strong></h4>
            </div>
            <div class="modal-body">
                <form  action=""  method="POST" name="frmlicenca" id="frmlicenca">
                    <div class="panel panel-success">
                        <div class="panel-heading"> 
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><strong>EMPRESA  E OU Pª FÍSICA / EMPREENDIMENTO / PROCESSO </strong></a>
                            </div>
                        </div>
                        <div class="panel-collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="empresa"><strong>RAZÃO SOCIAL / PESSOA FÍSICA *</strong></label><br/>
                                            <select  name="empresa" id="empresa" class="form-control">                 
                                                <?php
                                                $empresa = "SELECT codigo_empresa, razaosocial_pessoafisica FROM tb_empresa WHERE codigo_empresa = $infor_empresa";
                                                $recebe_empresas = mysqli_query($con, $empresa);
                                                while ($linha = mysqli_fetch_array($recebe_empresas)) {
                                                    echo '<option value="' . $linha['codigo_empresa'] . '">' . $linha['razaosocial_pessoafisica'] . '</option>';
                                                }
                                                ?>   
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="processo"><strong>PROCESSO *</strong></label><br/>                                                              
                                            <select name="processo" id="processo" class="form-control" autofocus="" >                                                                                                      
                                                <?php
                                                $proc_empre = "SELECT tb_processo.codigo_processo,tb_processo.numero_processo,tb_processo.assunto,tb_empresa.codigo_empresa FROM tb_processo,tb_empresa WHERE tb_processo.fk3_codigo_empresa = tb_empresa.codigo_empresa AND codigo_empresa =" . $infor_empresa . " ORDER BY codigo_processo DESC";
                                                $recebe_proc_empre = mysqli_query($con, $proc_empre);
                                                while ($linha = mysqli_fetch_array($recebe_proc_empre)) {
                                                    echo"<option value='" . $linha[''] . "'> " . $linha[''] . " " . $linha [''] . "</option>";
                                                    echo"<option value='" . $linha['codigo_processo'] . "'> " . $linha['numero_processo'] . " " . $linha ['assunto'] . "</option>";
                                                }
                                                ?>                                     
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label for="empreendimento"><strong>EMPREENDIMENTO*</strong></label><br/>
                                            <select  name="empreendimento" id="empreendimento" class="form-control">  
                                                <option value=""></option>
                                                <option value="">SELECIONE O EMPREENDIMENTO ABAIXO</option>
                                                <?php
                                                $sql = ("SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_empresa.codigo_empresa,tb_empresa.nome_fantasia FROM tb_empreendimento,tb_empresa WHERE tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa AND fk1_codigo_empresa=" . $infor_empresa . " ORDER BY nome_empreendimento ASC");
                                                $recebe_ativ_empreend = mysqli_query($con, $ativ_empre);
                                                while ($linha = mysqli_fetch_array($recebe_ativ_empreend)) {
                                                    echo"<option value='" . $linha['codigo_empreendimento'] . "'>" . $linha['nome_empreendimento'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-success">
                        <div class="panel-heading"> 
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DA LICENÇA</strong></a>
                            </div>
                        </div>
                        <div  class="panel-collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="numero_licenca"><strong>NÚMERO DA LICENÇA *</strong></label><br/>
                                            <input type="text" name="numero_licenca" id="numero_licenca" onkeyup="somenteNumeros(this);" maxlength="3" class="form-control" placeholder="Campo Obrigatório"  autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="ano_licenca"><strong>ANO DA LICENÇA *</strong></label><br/>
                                            <select name="ano_licenca" id="ano_licenca" class="form-control">
                                                <option value="">SELECIONE</option>
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="data_emissao"><strong>DATA EMISSÃO *</strong></label><br/>
                                            <input type="date" name="data_emissao" id="data_emissao" class="form-control"  onblur="comparaDataAno();" max="2019-12-31" min="2017-01-01" />                                       
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="data_validade"><strong>DATA VALIDADE *</strong></label><br/>
                                            <input type="date" name="data_validade" id="data_validade" class="form-control" onblur="comparaDatas()" max="2021-12-31" min="2017-01-01"/>                                     
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for=""><strong>VALOR DA TAXA *</strong></label><br/>
                                            <input type="text" name="taxa" id="taxa" onkeyup="somenteNumeros(this);" class="form-control"/>                                     
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--esse trecho de código, permite que a lista de auto complete de atividade apareça na frente do modal-->
                                    <style type="text/css">
                                        .ui-autocomplete{
                                            z-index: 1050 !important;
                                        }
                                    </style>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="descricao_atividade"><strong>ATIVIDADE A SER LICENCIADA*</strong></label><br/>
                                            <input type="text" name="descricao_atividade" id="descricao_atividade" class="form-control" > 
                                        </div>
                                    </div>
                                </div>                          
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-title" style="text-align: center;"><br/>                                      
                            <button type="submit" class="btn btn-success" style="font-size: 17px; font-weight: bold;">REALIZAR CADASTRO <span class="glyphicon glyphicon-saved" style="margin-left: 10px;"></span></button>
                            <button  class="btn btn-danger"><a href="cadastros.php"style="text-decoration: none;color:#FFF">CANCELAR CADASTRO<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a></button><br/><br/>                                   
                        </div>   
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--os dados abaixo é referente ao cadastro de notificaçções-->
<div class="modal fade" id="myModalCadNotificacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <?php
    if (isset($_POST['empresa']) && empty($_POST['empresa']) == FALSE) {
        if (isset($_POST['numero_notificacao']) && empty($_POST['numero_notificacao']) == FALSE) {
            if (isset($_POST['data_notificacao']) && empty($_POST['data_notificacao']) == FALSE) {
                if (isset($_POST['data_comparecimento']) && empty($_POST['data_comparecimento']) == FALSE) {
                    if (isset($_POST['profissao_atividade']) && empty($_POST['profissao_atividade']) == FALSE) {
                        if (isset($_POST['descricao_prazo']) && empty($_POST['descricao_prazo']) == FALSE) {
                            if (isset($_POST['fiscal']) && empty($_POST['fiscal']) == FALSE) {
                                if (isset($_POST['chefe_fiscalizacao']) && empty($_POST['chefe_fiscalizacao']) == FALSE) {
                                    if (isset($_POST['status_notificado']) && empty($_POST['status_notificado']) == FALSE) {
                                        if (isset($_POST['status_informacoes_adicionais']) && empty($_POST['status_informacoes_adicionais']) == FALSE) {


                                            $empresa = strtoupper(addslashes($_POST['empresa']));
                                            $processo = strtoupper(addslashes($_POST['processo']));
                                            $fiscal = strtoupper(addslashes($_POST['fiscal']));
                                            $numero_notificacao = strtoupper(addslashes($_POST['numero_notificacao']));
                                            $ano_notificacao = strtoupper(addslashes($_POST['ano_notificacao']));
                                            $data_notificacao = strtoupper(addslashes($_POST['data_notificacao']));
                                            $data_comparecimento = strtoupper(addslashes($_POST['data_comparecimento']));
                                            $profissao_atividade = strtoupper(addslashes($_POST['profissao_atividade']));
                                            $descricao_prazo = strtoupper(addslashes($_POST['descricao_prazo']));
                                            $status = strtoupper(addslashes($_POST['status']));
                                            $status_informacoes_adicionais = strtoupper(addslashes($_POST['status_informacoes_adicionais']));
                                            $numero_notificacao_anterior = strtoupper(addslashes($_POST['numero_notificacao_anterior']));
                                            $numero_notificacao_ano_anterior = strtoupper(addslashes($_POST['numero_notificacao_ano_anterior']));
                                            $numero_processo_notificacao_anterior = strtoupper(addslashes($_POST['numero_processo_notificacao_anterior']));
                                            $ano_processo_notificacao_anterior = strtoupper(addslashes($_POST['ano_processo_notificacao_anterior']));
                                            $status_licenca = strtoupper(addslashes($_POST['status_licenca']));
                                            $numero_licenca_notificacao_anterior = strtoupper(addslashes($_POST['numero_licenca_notificacao_anterior']));
                                            $ano_licenca_notificacao_anterior = strtoupper(addslashes($_POST['ano_licenca_notificacao_anterior']));
                                            $orgao_emissor_licenca = strtoupper(addslashes($_POST['orgao_emissor_licenca']));
                                            $data_validade = strtoupper(addslashes($_POST['data_validade']));
                                            $status_notificado = strtoupper(addslashes($_POST['status_notificado']));
                                            $nome_notificado = strtoupper(addslashes($_POST['nome_notificado']));
                                            $cpf = strtoupper(addslashes($_POST['cpf']));
                                            $logradouro = strtoupper(addslashes($_POST['logradouro']));
                                            $numero = strtoupper(addslashes($_POST['numero']));
                                            $bairro = strtoupper(addslashes($_POST['bairro']));
                                            $testemunha = strtoupper(addslashes($_POST['testemunha']));
                                            $chefe_fiscalizacao = strtoupper(addslashes($_POST['chefe_fiscalizacao']));

                                            //verificando se ja existe uma notificação com o numero informado banco de dados
                                            $consulta_notificacao = "SELECT *FROM tb_notificacao WHERE numero_notificacao ='" . $_POST['numero_notificacao'] . "'";
                                            $recebe_consulta = mysqli_query($con, $consulta_notificacao);

                                            if (mysqli_num_rows($recebe_consulta) > 0) {
                                                ?>
                                                <script>
                                                    alert('ERRO JÁ EXISTE UMA NOTIFICAÇÃO COM O NÚMERO INFORMADO, POR FAVOR INFORME OUTRO NÚMERO!');
                                                    window.history.back();
                                                </script>                       
                                                <?php
                                            } else {
                                                $sql = "INSERT INTO tb_notificacao(fk5_codigo_empresa,fk2_codigo_processo,fk1_codigo_fiscal,numero_notificacao,ano_notificacao,data_notificacao,data_comparecimento,profissao_atividade,descricao_prazo,status,status_informacoes_adicionais,numero_notificacao_anterior,numero_notificacao_ano_anterior,numero_processo_notificacao_anterior,ano_processo_notificacao_anterior,status_licenca,numero_licenca_notificacao_anterior,ano_licenca_notificacao_anterior,orgao_emissor_licenca,data_validade,status_notificado,nome_notificado,cpf,logradouro,numero,bairro,testemunha,chefe_fiscalizacao)"
                                                        . "VALUES('$empresa','$processo','$fiscal','$numero_notificacao','$ano_notificacao','$data_notificacao','$data_comparecimento',UPPER('$profissao_atividade'),UPPER('$descricao_prazo'),'$status','$status_informacoes_adicionais','$numero_notificacao_anterior','$numero_notificacao_ano_anterior','$numero_processo_notificacao_anterior','$ano_processo_notificacao_anterior','$status_licenca','$numero_licenca_notificacao_anterior','$ano_licenca_notificacao_anterior',UPPER('$orgao_emissor_licenca'),'$data_validade',UPPER('$status_notificado'),UPPER('$nome_notificado'),'$cpf',UPPER('$logradouro'),'$numero',UPPER('$bairro'),UPPER('$testemunha'),UPPER('$chefe_fiscalizacao'))";
                                                mysqli_query($con, $sql);
//                                            print_r($sql);
                                                // O CÓDIGO ABAIXO REGISTRA O USUARIO QUE REALIZOU O CADASTRO DE CERTO EMPRESA / PESSOA FISICA
                                                $emailUser = $_SESSION['email'];
                                                $user = $_SESSION['nome'];
                                                $ip_rem = getenv('REMOTE_ADDR'); //pega o ip da maquina ususario
                                                $ip_maq = $_SERVER["REMOTE_ADDR"]; //Pego o IP
                                                $data = Date("Y-m-d H:i:s");
                                                $acaoUsuario = "Realizou o Cadastro da Notificação de Numero ->$numero_notificacao, para empresa de codigo $empresa, e processo de codigo $processo";
                                                $sqlLog = "INSERT INTO tb_controle_usuario(acao,data_acesso,ip_maquina,ip_remoto,email,nome)VALUES(UPPER('$acaoUsuario'),'$data','$ip_maq','$ip_rem','$emailUser','$user')";
                                                mysqli_query($con, $sqlLog);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    ?>
    <link rel="stylesheet" type="text/css" href="css/estilo_divsNotificacao.css">
    <script type="text/javascript" src="js/scriptExibeDivs.js"></script>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times</span></button><br>
                <h4 class="modal-title text-center" id="myModalLabel"><strong style="color: #048C46">CADASTRO DE NOTIFICAÇÃO</strong></h4>
            </div>
            <div class="modal-body">
                <form  action=""  method="POST" name="frmnotificacao" id="frmnotificacao">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-success">
                                <div class="panel-heading"> 
                                    <div class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><strong>DADOS DA NOTIFICAÇÃO</strong></a>
                                    </div>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">                
                                        <div class="row">
                                            <div class="col-sm-12" >
                                                <div class="form-group">
                                                    <label for="empresa"><strong>RAZÃO SOCIAL / PESSOA FÍSICA *</strong></label>
                                                    <select name="empresa" id="empresa" class="form-control" autofocus="">            
                                                        <?php
                                                        $empresa = "SELECT codigo_empresa, razaosocial_pessoafisica FROM tb_empresa WHERE codigo_empresa = $infor_empresa";
                                                        $recebe_empresas = mysqli_query($con, $empresa);
                                                        while ($linha = mysqli_fetch_array($recebe_empresas)) {
                                                            echo '<option value="' . $linha['codigo_empresa'] . '">' . $linha['razaosocial_pessoafisica'] . '</option>';
                                                        }
                                                        ?> 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="processo"><strong>PROCESSO *</strong></label><br/>
                                                    <select  name="processo" id="processo" class="form-control">
                                                        <option value="">SELECIONE</option>
                                                        <?php
                                                        $sql = "SELECT *FROM tb_processo WHERE fk3_codigo_empresa= $infor_empresa" . " and assunto='AUTO DE NOTIFICAÇÃO E INTIMAÇÃO' ORDER BY codigo_processo DESC";
                                                        $recebesql = (mysqli_query($con, $sql));
                                                        while ($linha = mysqli_fetch_array($recebesql)) {
                                                            echo"<option value='" . $linha[''] . "'> " . $linha[''] . " " . $linha [''] . "</option>";
                                                            echo"<option value='" . $linha['codigo_processo'] . "'> " . $linha['numero_processo'] . " </option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="numero_notificacao"><strong>Nº NOTIFICAÇÃO *</strong></label><br/>
                                                    <input type="text" name="numero_notificacao" id="numero_notificacao" onkeyup="somenteNumeros(this);" maxlength="3" class="form-control" placeholder="Campo Obrigatório" autocomplete="off"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="ano_notificacao"><strong>ANO *</strong></label><br/>
                                                    <select name="ano_notificacao" id="ano_notificacao" class="form-control">
                                                        <option value="">SELECIONE</option>                                          
                                                        <option value="2017">2017</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2019">2019</option>
                                                    </select>  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="data_notificacao"><strong>DATA DA NOTIFICAÇÃO *</strong></label><br/>
                                                    <input type="date" name="data_notificacao" id="data_notificacao" class="form-control" onblur="comparaAnoData()" max="2019-12-01"  min="2017-01-01"/>             
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="data_comparecimento"><strong>DATA PARA COMPARECIMENTO *</strong></label><br/>
                                                    <input type="date" name="data_comparecimento" id="data_comparecimento" class="form-control" onblur="comparadatas()" max="2019-12-01"  min="2017-01-01"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="profissao_atividade"><strong>PROFISSÃO E / OU  ATIVIDADE REALIZADA *</strong></label><br/>
                                                    <input type="text" name="profissao_atividade" id="profissao_atividade" class="form-control" onKeypress="return letras(event)"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="descricao_prazo"><strong>DESCRICÃO E PRAZO *</strong></label><br/>
                                                    <input type="text" name="descricao_prazo" id="descricao_prazo" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="testemunha"><strong>NOME DA TESTEMUNHA</strong></label><br/>
                                                    <input type="text" name="testemunha" id="testemunha" class="form-control" onKeypress="return letras(event)"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="status">SITUAÇÃO</label>
                                                    <input type="text" name="status" id="status" value="NOTIFICADO" readonly="" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-success">
                                <div class="panel-heading"> 
                                    <div class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" ><strong>INFORMAÇÕES ADICIONAIS (NOTIFICAÇÃO / PROCESSO / LICENÇA)</strong></a>
                                    </div>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse in">
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="status_informacoes_adicionais"><strong>A INFORMAÇÕES ADICIONAIS ? *</strong></label><br/>
                                                    <select name="status_informacoes_adicionais" id="status_informacoes_adicionais" class="form-control" onchange="mostrardivinformacoes(this.value)">
                                                        <option value="">SELECIONE</option>
                                                        <option value="SIM">SIM</option>
                                                        <option value="NAO">NÃO</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>                        
                                        <div class="row">
                                            <div class="col-sm-3" id="NUMNOTANTERIOR">
                                                <div class="form-group">
                                                    <label for="numero_notificacao_anterior"><strong>NÚMERO DA NOTICAÇÃO ANTERIOR</strong></label><br/>
                                                    <input type="text" name="numero_notificacao_anterior" id="numero_notificacao_anterior"  onkeyup="somenteNumeros(this);" maxlength="3" class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" id="NUMANOANTERIOR">
                                                <div class="form-group">
                                                    <label for="numero_notificacao_ano_anterior"><strong>ANO DA NOTIFICAÇÃO ANTERIOR</strong></label><br/>
                                                    <input type="text" name="numero_notificacao_ano_anterior" id="numero_notificacao_ano_anterior"  onkeyup="somenteNumeros(this);"  maxlength="4" class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" id="NUMPROANTERIOR">
                                                <div class="form-group">
                                                    <label for="numero_processo_notificacao_anterior"><strong>NÚMERO DO PROCESSO ANTERIOR</strong></label><br/>
                                                    <input type="text" name="numero_processo_notificacao_anterior" id="numero_processo_notificacao_anterior"  onkeyup="somenteNumeros(this);" maxlength="3" class="form-control" placeholder=""/>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" id="NUMANOPROANTERIOR">
                                                <div class="form-group">
                                                    <label for="ano_processo_notificacao_anterior"><strong>ANO DO PROCESSO ANTERIOR</strong></label><br/>
                                                    <input type="text" name="ano_processo_notificacao_anterior" id="ano_processo_notificacao_anterior"  onkeyup="somenteNumeros(this);" maxlength="4"  class="form-control" placeholder=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12" id="LICENCAANTERIOR">
                                                <div class="form-group">
                                                    <label for="status_licenca"><strong>A LICENCA AMBIENTAL</strong></label><br/>
                                                    <select name="status_licenca" id="status_licenca" class="form-control" onchange="mostrarDivLicencas(this.value)">
                                                        <option value="NAO">NÃO</option>
                                                        <option value="SIM">SIM</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6" id="NUMLICENCA">
                                                <div class="form-group" >
                                                    <label for="numero_licenca_notificacao_anterior"><strong>NÚMERO DA LICENÇA</strong></label><br/>
                                                    <input type="text" name="numero_licenca_notificacao_anterior" id="numero_licenca_notificacao_anterior" class="form-control"  onkeyup="somenteNumeros(this);" maxlength="3">
                                                </div>
                                            </div>
                                            <div class="col-sm-6" id="NUMANOLICENCA">
                                                <div class="form-group" >
                                                    <label for="ano_licenca_notificacao_anterior"><strong>ANO DA LICENÇA</strong></label><br/>
                                                    <input type="text" name="ano_licenca_notificacao_anterior" id="ano_licenca_notificacao_anterior" class="form-control"  onkeyup="somenteNumeros(this);" maxlength="4">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6" id="ORGAOEMISSOR">
                                                <div class="form-group" >
                                                    <label for="orgao_emissor_licenca"><strong>ORGÃO EMITENTE DA LICENÇA</strong></label><br/>
                                                    <input type="text" name="orgao_emissor_licenca" id="orgao_emissor_licenca" class="form-control" onKeypress="return letras(event)">
                                                </div>
                                            </div>
                                            <div class="col-sm-6" id="DATAVALIDADE">
                                                <div class="form-group" >
                                                    <label for="data_validade"><strong>DATA VALIDADE</strong></label><br/>
                                                    <input type="date" name="data_validade" id="data_validade" class="form-control" max="2019-12-31">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-success">
                                <div class="panel-heading"> 
                                    <div class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><strong>DADOS DO RESPONSÁVEL E / OU NOTIFICADO</strong></a>
                                    </div>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="status_notificado"><strong>O NOTIFICADO INFORMOU SEU DADOS ? *</strong></label><br/>
                                                    <select name="status_notificado" id="status_notificado" class="form-control" onchange="mostrarDivNotificados(this.value)">
                                                        <option value="">SELECIONE</option>
                                                        <option value="SIM">SIM</option>
                                                        <option value="NAO">NÃO</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-8" id="NOMENOTIFICADO">
                                                <div class="form-group">
                                                    <label for="nome_notificado"><strong>NOME DO NOTIFICADO E / OU REPONSÁVEL</strong></label><br/>
                                                    <input type="text" name="nome_notificado" id="nome_notificado" class="form-control" onKeypress="return letras(event)"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id="CPFNOTIFICADO">
                                                <div class="form-group">
                                                    <label for="cpf"><strong>CPF</strong></label><br/>
                                                    <input type="text" name="cpf" id="cpf" class="form-control" onblur="validaFormato(this);" />
                                                    <div id="divResultado"></div>         
                                                    <style>
                                                        #divResultado{
                                                            font-family: serif;
                                                            font-size: 14px;
                                                            color: #f00;
                                                            margin-top:5px;
                                                            font-weight: bold;
                                                        }
                                                    </style>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6" id="LOGRADOURONOTIFICADO">
                                                <div class="form-group">
                                                    <label for="logradouro"><strong>RUA</strong></label><br/>
                                                    <input type="text" name="logradouro" id="logradouroR" class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-2" id="NUMERONOTIFICADO">
                                                <div class="form-group">
                                                    <label for="numero"><strong>NÚMERO</strong></label><br/>
                                                    <input type="text" name="numero" id="numero" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4" id=BAIRRONOTIFICADO>
                                                <div class="form-group">
                                                    <label for="bairro"><strong>BAIRRO</strong></label><br/>
                                                    <input type="text" name="bairro" id="bairro" class="form-control" onKeypress="return letras(event)"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-success">
                                <div class="panel-heading"> 
                                    <div class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4"><strong>DADOS DO FISCAL E CHEFE DE FISCALIZAÇÃO</strong></a>
                                    </div>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="fiscal"><strong>FISCAL *</strong></label><br/>
                                                    <select name="fiscal" id="fiscal" class="form-control">
                                                        <option value="">SELECIONE O FISCAL</option>
                                                        <?php
                                                        $fiscal = "SELECT *FROM tb_fiscal";
                                                        $recebe_fiscal = mysqli_query($con, $fiscal);
                                                        while ($linha = mysqli_fetch_array($recebe_fiscal)) {
                                                            echo '<option value="' . $linha['codigo_fiscal'] . '">' . $linha['nome_matricula_fiscal'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="chefe_fiscalizacao"><strong>CHEFE DE FISCALIZAÇÃO *</strong></label><br/>
                                                    <input type="text" name="chefe_fiscalizacao" id="chefe_fiscalizacao" value="CLAUDIO BASTOS FILGUEIRAS JUNIOR - 993200 " readonly="" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-title" style="text-align: center;"><br/>
                                    <button type="submit" class="btn btn-success" style="font-size: 17px; font-weight: bold;">REALIZAR CADASTRO<span class="glyphicon glyphicon-saved" style="margin-left: 10px;"></span></button>
                                    <button  class="btn btn-danger"><a href="cadastros.php"style="text-decoration: none;color:#FFF">CANCELAR CADASTRO<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a></button><br/><br/>
                                </div>   
                            </div>
                        </dIv>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
