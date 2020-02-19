<?php
session_start();
require './config/conexao.php';
require './pages/header_table.php';

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
}
?>

<form name="fmrpesquisa">
    <!--<p style="background-color: #dff0d8"><strong>Pesquisar Licença Por</strong></p>-->
    <div class="row">

        <div class="col-sm-2" style="">
            <input type="text" name="parametro_empresa" class="form-control" placeholder="Empresa / Pessoa Fisica" >
        </div>
        <div class="col-sm-2" style="">
            <input type="text" name="parametro_licenca" class="form-control" placeholder="Nome da Licença" >
        </div>
        <div class="col-sm-1" style="">
            <input type="text" name="parametro_numero" class="form-control" placeholder="Número" >
        </div>

        <div class="col-sm-1" style="text-align: left">
            <input type="submit" value="BUSCAR" class="btn btn-success pull-left" style="font-size: 15px; font-weight: bold;margin-left: -20px"> 
        </div>
        <div class="col-sm-6" style="text-align: right"> 

            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">IR PARA
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="cadastros.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 20px">REALIZAR CADASTRO<span class="glyphicon glyphicon-plus" style="margin-left: 5px"></a></li>
                <li><a href="inicio.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 15px">REALIZAR CONSULTA<span class="glyphicon glyphicon-search" style="margin-left: 5px"></a></li>
                <li><a href="editar.php" style="font-weight:bold; color:#2e6da4; text-decoration:none;margin-right: 15px">REALIZAR EDIÇÃO<span class="glyphicon glyphicon-pencil" style="margin-left: 5px"></a></li>
                <li><a href="inicio.php" style="font-weight:bold; color: #ce8483">CANCELAR<span class="glyphicon glyphicon-remove" style="margin-left: 5px"></a></li>
                <li><a href="logout.php" style="font-weight:bold; color: #ce8483">SAIR DO SISTEMA<span class="glyphicon glyphicon-off" style="margin-left: 5px"></a></li>
            </ul>
            <div  class="btn btn-success">
                <a href="consultar_licencas.php" style=" font-weight:bold; color:white; text-decoration:none">LICENÇAS</a>
            </div>

            <?php
            $sql_invalidas = "SELECT *FROM  tb_licenca WHERE data_validade < current_date()";
            $linhas_invalidas = mysqli_query($con, $sql_invalidas);
            $total_invalidas = mysqli_num_rows($linhas_invalidas);
            echo'<a href="#" class="btn btn-warning" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"><strong>TOTAL</strong> <span class="badge">' . $total_invalidas . '</span></a>';
            ?>

            <div  class="btn btn-danger">
                <a href="inicio.php" style="font-weight:bold; color:white; text-decoration:none">CANCELAR <span class="glyphicon glyphicon-remove"></span></a>
            </div>         
        </div>
    </div>
</form>
<div class="row">
    <div class="col-sm-12">
         <!--ESTE CSS RESPONSVEL POR AJUDAR NA INSERÇÃO DA BARRA DE ROLAGEM DA TABELA-->
        <style type="text/css">
            .table-overflow {
                max-height:400px;
                overflow-x:auto;
            }
        </style>
        <div class="table-overflow"><br>
            <table class="table table-striped table-hover table-bordered">
                <header>
                    <tr style="text-align: center;background-color:#dff0d8;color: #000000" >
                        <th style="text-align: center;font-size: 12px">EMPRESA / PESSSOA FÍSICA</th> 
                        <th style="text-align: center;font-size: 12px">LICENÇA</th> 
                        <th style="text-align: center;font-size: 12px">EMPREENDIMENTO</th>
                        <th style="text-align: center;font-size: 12px">Nº LIC</th>   
                        <th style="text-align: center;font-size: 12px">Nº PRO</th> 
                        <th style="text-align: center;font-size: 12px">ANO</th>      
                        <th style="text-align: center;font-size: 12px">EMISSÃO</th> 
                        <th style="text-align: center;font-size: 12px">VALIDADE</th>        
                        <th style="text-align: center;font-size: 12px" >SITUAÇÃO</th> 
                    </tr>
                </header>
                <?php
                $data_atual = date("d / m / Y");
                $parametro_empresa = filter_input(INPUT_GET, "parametro_empresa");
                $parametro_licenca = filter_input(INPUT_GET, "parametro_licenca");
                $parametro_numero = filter_input(INPUT_GET, "parametro_numero");

                $sql = "SELECT tb_licenca.codigo_licenca,tb_licenca.numero_licenca,ano_licenca,tb_licenca.data_emissao,tb_licenca.data_validade,
            tb_empresa.razaosocial_pessoafisica,tb_empreendimento.nome_empreendimento,tb_processo.numero_processo,tb_processo.assunto,(if(curdate()<= data_validade,'<strong>VALIDA</strong>','<strong style=color:#F4C430>INVALIDA<strong>')) AS situacao 
            FROM 
            tb_licenca,tb_empresa,tb_empreendimento,tb_processo  
            WHERE data_validade < curdate() AND (razaosocial_pessoafisica LIKE '$parametro_empresa%' AND assunto LIKE '$parametro_licenca%' AND numero_licenca LIKE '$parametro_numero%')AND 
            tb_licenca.fk4_codigo_empresa = tb_empresa.codigo_empresa AND tb_licenca.fk1_codigo_empreendimento = tb_empreendimento.codigo_empreendimento  AND tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo  ORDER BY razaosocial_pessoafisica";

                $recebe = mysqli_query($con, $sql);

                if (mysqli_num_rows($recebe) > 0) {

                    while ($linhas = mysqli_fetch_array($recebe)) {
                        $licencas = $linhas['codigo_licenca']; //variavel pararecupar o id do empreendimento
                        echo'<tr style="font-size:13px">';
                        echo'<td style="font-size:12px">' . $linhas['razaosocial_pessoafisica'] . '</td>';
                        echo'<td style="font-size:12px">' . $linhas['assunto'] . '</td>';
                        echo'<td style="font-size:12px">' . $linhas['nome_empreendimento'] . '</td>';
                        echo'<td style="font-size:12px;width:6%">' . $linhas['numero_licenca'] . '</td>';
                        echo'<td style="font-size:12px;width:5%">' . $linhas['numero_processo'] . '</td>';
                        echo'<td style="font-size:12px;width:3%">' . $linhas['ano_licenca'] . '</td>';
                        echo'<td style="font-size:12px;width:2%">' . date('d/m/Y', strtotime($linhas['data_emissao'])) . '</td>';
                        echo'<td style="font-size:12px;width:2%">' . date('d/m/Y', strtotime($linhas['data_validade'])) . '</td>';
                        echo'<td style="font-size:12px;text-align:center;width:2%">' . $linhas['situacao'] . '</td>';
                        echo'</tr>';
                    }
                } else {
                    echo "<div class='alert alert-danger fade in' style='text-align:center'><strong>NENHUM RESULTADO ENCONTRADO <img src=' img/sad-face-in-rounded-square (1).png' style='margin-bottom:5px'></strong><br/><br/>";
                    echo "<a href='consultar_licencas_invalidas.php'style='color:blue'><strong>EXIBIR LICENCAS INVÁLIDAS</strong></a></div>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php
require './pages/footer.php';



