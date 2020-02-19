<?php
session_start();
require './config/conexao.php';
require './pages/header.php';

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
}
?>

<link rel="stylesheet" href="css/estilo_exibeLicencas.css">
<form name="fmrpesquisa">
    <div class="row">
        <div class="col-sm-4" style="">
            <input type="text" name="parametro_numero_auto" class="form-control" placeholder="Digite o Número do Auto">
        </div>  
        <div class="col-sm-8" style="text-align: left"  >
            <input type="submit" value="Clique Para Buscar" class="btn btn-primary pull-left" style="font-size: 15px; font-weight: bold;margin-left: -20px;color: #fff">
            <div  class="btn btn-danger" style="margin-left: 10px">              
                <a href="editar.php" style="font-weight:bold; color:#FFF; text-decoration:none;">Cancelar<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a>
            </div> 
        </div>
    </div>
</form>

<h2>AUTOS DE INFRAÇÕES</h2>
<!--ESTE CSS RESPONSVEL POR AJUDAR NA INSERÇÃO DA BARRA DE ROLAGEM DA TABELA-->
<style type="text/css">
    .table-overflow {
        max-height:400px;
        overflow-x:auto;
    }
</style>
<div class="table-overflow">
    <table class="table table-striped table-hover table-bordered">
        <header>
            <tr style="text-align: center;background-color:#dff0d8;color: #000000" >
                <th style="text-align: center;font-size: 12px"><strong>Nº DO AUTO</strong></th>
                <th style="text-align: center;font-size: 12px">DATA</th>
                <th style="text-align: center;font-size: 12px">NATUREZA</th>
                <th style="text-align: center;font-size: 12px">VALOR UFM</th>
                <th style="text-align: center;font-size: 12px">VALOR R$</th>
                <th style="text-align: center;font-size: 12px">SITUAÇÃO</th>             
                <th style="width: 1%"><img  src="img/user.png" title="Editar" style="margin-left: 7px"></th>             
            </tr>
        </header>
        <?php
        $parametro_numero_auto = filter_input(INPUT_GET, "parametro_numero_auto");
        $sql = "SELECT tb_auto_infracao.codigo_auto_infracao,tb_auto_infracao.numero_auto_infracao,tb_auto_infracao.ano_auto_infracao,tb_auto_infracao.data_auto_infracao,tb_auto_infracao.profissao_atividade,tb_auto_infracao.descricao_infracao,tb_auto_infracao.auto_infracao,tb_auto_infracao.status_auto,tb_auto_infracao.natureza_da_infracao,tb_auto_infracao.material_apreendido,
            tb_auto_infracao.valor_infracao,tb_auto_infracao.valor_reais,tb_auto_infracao.status_informacoes_adicionais_auto,tb_auto_infracao.numero_notificacao_anterior_auto,tb_auto_infracao.numero_notificacao_ano_anterior_auto,tb_auto_infracao.numero_processo_notificacao_anterior_auto,tb_auto_infracao.ano_processo_notificacao_anterior_auto,tb_auto_infracao.status_licenca,
            tb_auto_infracao.numero_licenca_anterior_auto,tb_auto_infracao.ano_licenca_anterior_auto,tb_auto_infracao.orgao_emissor_licenca_auto,tb_auto_infracao.data_validade_licenca_anterior,tb_auto_infracao.nome_infrator,tb_auto_infracao.cpf,tb_auto_infracao.logradouro,tb_auto_infracao.numero,tb_auto_infracao.bairro,tb_auto_infracao.chefe_fiscalizacao,tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_processo.numero_processo,tb_fiscal.nome_matricula_fiscal    
            FROM 
            tb_auto_infracao,tb_empresa,tb_processo,tb_fiscal
            WHERE(numero_auto_infracao LIKE '$parametro_numero_auto%')AND 
            tb_auto_infracao.fk9_codigo_empresa = tb_empresa.codigo_empresa AND tb_auto_infracao.fk5_codigo_processo = tb_processo.codigo_processo AND tb_auto_infracao.fk3_codigo_fiscal = tb_fiscal.codigo_fiscal ORDER BY codigo_auto_infracao";

        $recebe = mysqli_query($con, $sql);

        if (mysqli_num_rows($recebe) > 0) {

            while ($linhas = mysqli_fetch_array($recebe)) {
                $autos = $linhas['codigo_auto_infracao']; //variavel para recupar o id da notificação
                echo'<tr style="font-size:13px">';
                echo'<td style="font-size:12px">' . $linhas['numero_auto_infracao'] . '</td>';
                echo'<td style="font-size:12px">' . date('d/m/Y', strtotime($linhas['data_auto_infracao'])) . '</td>'; 
                echo'<td style="font-size:12px">' . $linhas['natureza_da_infracao'] . '</td>';
                echo'<td style="font-size:12px">' . $linhas['valor_infracao'] . '</td>';
                echo'<td style="font-size:12px">' . $linhas['valor_reais'] . '</td>';
                echo'<td style="font-size:12px">' . $linhas['status_auto'] . '</td>';
                echo'<td  style="height:30px;text-align:center" title="Editar"><a href=alterar_auto.php?codigo_auto_infracao=' . $autos . '><span class="glyphicon glyphicon-pencil"></a></td>';
                echo'</tr>';
            }
        } else {
            echo "<div class='alert alert-danger fade in' style='text-align:center'><strong>NENHUM RESULTADO ENCONTRADO <img src=' img/sad-face-in-rounded-square (1).png' style='margin-bottom:5px'></strong><br/><br/>";
            echo "<a href='#'style='color:blue'><strong>EXIBIR AUTOS DE INFRAÇÕES</strong></a></div>";
        }
        ?>
    </table><br>
</div>
<br><br><br>

<?php
require './pages/footer.php';




