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

//verifica a página atual caso seja informada na URL, senão atribui como 1ª página 
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

//seleciona todos os itens da tabela 
$sql_notificacoes = "SELECT *FROM tb_notificacao WHERE data_hora_comparecimento < curdate()";
$linha = mysqli_query($con, $sql_notificacoes);

//conta o total de itens 
$total = mysqli_num_rows($linha);

//echo $total . "<br>";
//seta a quantidade de itens por página, neste caso, 2 itens 
$registros = 10;

//calcula o número de páginas arredondando o resultado para cima 
$numPaginas = ceil($total / $registros);

////variavel para calcular o início da visualização com base na página atual 
$inicio = ($registros * $pagina) - $registros;
?>


<form name="fmrpesquisa">

    <div class="row">

        <div class="col-sm-2" style="">
            <input type="text" name="parametro_empresa" class="form-control" placeholder="Nome Fantasia" >
        </div>
        <div class="col-sm-2" style="">
            <input type="text" name="parametro_numero" class="form-control" placeholder="Número da Notificação" >
        </div>        
        <div class="col-sm-2" style="text-align: left"  >
            <input type="submit" value="Buscar" class="btn btn-success pull-left" style="font-size: 15px; font-weight: bold;margin-left: -20px"> 
        </div>

        <div class="col-sm-6" style="text-align: right"> 
            
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Ir Para
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="cad_empresa.php"><strong><img src="img/man-with-company.png"> CADASTRO EMPRESA / Pª FÍSICA</strong></a></li>
                <li><a href="cad_representante.php"><strong><img src="img/user_2.png"> CADASTRO REPRESENTANTE</strong></a></li>
                <li><a href="cad_processo.php"><strong><img src="img/contract.png"> CADASTRO PROCESSO</strong></a></li>
                <li><a href="cad_empreendimento.php"><strong><img src="img/construction-worker_1.png"> CADASTRO EMPREENDIMENTO</strong></a></li>
                <li><a href="cad_notificacao.php"><strong><img src="img/notifications-button_1.png">CADASTRO NOTIFICAÇÃO</strong></a></li>
                <li><a href="cad_autorizacao.php"><strong><img src="img/police-shield-with-a-star-symbol (2).png"> CADASTRO AUTORIZAÇÃO</strong></a></li>
                <li><a href="consultar_empresas.php"style="color: #2e6da4"><strong><img src="img/office-block.png"> CONSULTAR EMPRESAS</strong></a></li>
                <li><a href="consultar_representante.php" style="color: #2e6da4"><strong><img src="img/icon.png"> CONSULTAR REPRESENTANTES</strong></a></li>
                <li><a href="consultar_processo.php" style="color: #2e6da4"><strong><img src="img/notebook_1.png"> CONSULTAR PROCESSOS</strong></a></li>
                <li><a href="consultar_empreendimento.php" style="color: #2e6da4"><strong><img src="img/miner.png"> CONSULTAR EMPREENDIMENTOS</strong></a></li>
                 <li><a href="consultar_licencas.php" style="color: #2e6da4"><strong><img src="img/document_3.png"> CONSULTAR LICENÇAS</strong></a></li>
                <li><a href="consultar_notificacoes.php" style="color: #2e6da4"><strong><img src="img/notification_1.png"> CONSULTAR NOTIFICAÇÕES</strong></a></li>
                <li><a href="consultar_autorizacoes.php" style="color: #2e6da4"><strong><img src="img/police-shield-with-a-star-symbol (1).png"> CONSULTAR AUTORIZAÇÃO</strong></a></li>
                <li><a href="home.php" style="color: #ce8483"><strong><img src="img/error.png"> CANCELAR</strong></a></li>
            </ul>
             <div  class="btn btn-success">
                 <a href="consultar_notificacoes.php" style="font-size:px; font-weight:bold; color:white; text-decoration:none">Notificações</a>
            </div>

            <div  class="btn btn-primary">
                <a href="cad_notificacao.php" style="font-size:px; font-weight:bold; color:white; text-decoration:none">Novo Cadastro</a>
            </div>
           
           <div  class="btn btn-danger">
                <a href="home.php" style="font-size:px; font-weight:bold; color:white; text-decoration:none">Cancelar</a>
            </div> 

            <?php
            $sql_invalidas = "SELECT *FROM  tb_notificacao WHERE data_hora_comparecimento < curdate()";
            $linhas_invalidas = mysqli_query($con, $sql_invalidas);
            $total_invalidas = mysqli_num_rows($linhas_invalidas);
            echo'<a href="#" class="btn btn-warning" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"><strong>Total</strong> <span class="badge">' . $total_invalidas . '</span></a>';
            ?>                   
        </div>
    </div>
</form>

<table class="table table-striped table-hover table-bordered">
    <header>
        <tr style="text-align: center;background-color:#dff0d8;color: #000000" >
            <th style="text-align: center;font-size: 12px"><strong>COD</strong></th>
            <th style="text-align: center;font-size: 12px">NOME FANTASIA</th>  
            <th style="text-align: center;font-size: 12px">PROFISSÃO / ATIVIDADE</th> 
            <th style="text-align: center;font-size: 12px"><strong>NÚMERO NOTIFICACÃO</strong></th>
            <th style="text-align: center;font-size: 12px">DATA  NOTIFICAÇÃO</th>
            <th style="text-align: center;font-size: 12px">DATA COMPARECIMENTO</th>
            <th style="text-align: center;font-size: 12px">NÚMERO PROCESSO</th> 
            <th style="text-align: center;font-size: 12px">STATUS</th>  
            <th style="text-align: center;font-size: 12px">SITUAÇÃO</th>             
            <th style="text-align: center;font-size: 12px">IMPR</th>             
        </tr>
    </header>
    <?php
    $parametro_empresa = filter_input(INPUT_GET, "parametro_empresa");
    $parametro_numero = filter_input(INPUT_GET, "parametro_numero");


    $sql = "SELECT tb_notificacao.codigo_notificacao,tb_notificacao.numero_notificacao,tb_notificacao.data_hora_notificacao,tb_notificacao.data_hora_comparecimento,tb_notificacao.profissao_atividade,tb_notificacao.descricao_prazo,tb_notificacao.status,tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_processo.numero_processo,tb_fiscal.nome_matricula_fiscal,
            tb_chefe_fiscalizacao.nome_matricula_chefe, (if(curdate()<= data_hora_comparecimento,'<strong>DENTRO DO PRAZO</strong>','<strong style=color:#FFF>PRAZO VENCIDO<strong>')) AS situacao    
            FROM 
            tb_notificacao,tb_empresa,tb_processo,tb_fiscal,tb_chefe_fiscalizacao
            WHERE data_hora_comparecimento < curdate() AND (nome_fantasia LIKE '$parametro_empresa%' AND numero_notificacao LIKE '$parametro_numero%') AND 
            tb_notificacao.fk5_codigo_empresa = tb_empresa.codigo_empresa AND tb_notificacao.fk2_codigo_processo = tb_processo.codigo_processo AND tb_notificacao.fk1_codigo_fiscal = tb_fiscal.codigo_fiscal AND tb_notificacao.fk1_codigo_chefefiscalizacao = tb_chefe_fiscalizacao.codigo_chefe_fiscalizacao ";

    $recebe = mysqli_query($con, $sql);

    if (mysqli_num_rows($recebe) > 0) {

        while ($linhas = mysqli_fetch_array($recebe)) {
            $notificacoes = $linhas['codigo_notificacao']; //variavel para recupar o id da notificação
            echo'<tr style="font-size:13px">';
            echo'<td style="font-size:12px">' . $linhas['codigo_notificacao'] . '</td>';
            echo'<td style="font-size:12px">' . $linhas['nome_fantasia'] . '</td>';
            echo'<td style="font-size:12px">' . $linhas['profissao_atividade'] . '</td>';
            echo'<td style="font-size:12px">' . $linhas['numero_notificacao'] . '</td>';
            echo'<td style="font-size:12px">' . date('d/m/Y H:i', strtotime($linhas['data_hora_notificacao'])) . '</td>';
            echo'<td style="font-size:12px">' . date('d/m/Y H:i', strtotime($linhas['data_hora_comparecimento'])) . '</td>';
            echo'<td style="font-size:12px">' . $linhas['numero_processo'] . '</td>';
            echo'<td style="font-size:12px">' . $linhas['status'] . '</td>';
            echo'<td style="font-size:12px;background:#EEAD2D">' . $linhas['situacao'] . '</td>';
            echo'<td><a href=relatorio_licencas.php?codigo_licenca=' . $notificacoes . ' target="_blank"><img src="img/printer.png"></a></td>';
            echo'</tr>';
        }
         //exibe a paginação 
        for ($i = 1; $i < $numPaginas + 1; $i++) {
            echo"<ul class='pagination'>
            <li><a href='consultar_notificacoes_vencidas.php?pagina=$i'>" . $i . "</a></li>
            </ul>";
        }
    }else {
        echo "<div class='alert alert-danger fade in' style='text-align:center'><strong>NENHUM RESULTADO ENCONTRADO <img src=' img/sad-face-in-rounded-square (1).png' style='margin-bottom:5px'></strong><br/><br/>";
        echo "<a href='consultar_notificacoes_vencidas.php'style='color:blue'><strong>EXIBIR NOTIFICAÇÕES COM PRAZOS VENCIDOS</strong></a></div>";
    }
    ?>
    <style type="text/css">
        ul {
            margin-top: -10px;
        }
        a:link{
            color: #FFF;
            text-decoration: none;
        }
        a:visited{
            color: #FFF;
            color:#d43f3a
        }
    </style>
</table>



