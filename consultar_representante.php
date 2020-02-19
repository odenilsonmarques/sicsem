
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
$representantes = "select * from tb_representante";
$linha = mysqli_query($con, $representantes);

//conta o total de itens 
$total = mysqli_num_rows($linha);

//seta a quantidade de itens por página, neste caso, 2 itens 
$registros = 10;

//calcula o número de páginas arredondando o resultado para cima 
$numPaginas = ceil($total / $registros);

//variavel para calcular o início da visualização com base na página atual 
$inicio = ($registros * $pagina) - $registros;
?>
<script type="text/javascript">
    $(function ($) {
        $("#parametro_cpf").mask("999.999.999-99");
    });
</script>



<form name="fmrpesquisa">
    <!--<p style="margin-bottom:5px;"><strong>Pesquisar Empresa Por</strong></p>-->
    <div class="row">
        <div class="col-sm-2" style="">
            <input type="text" name="parametro_nome_representante" class="form-control" placeholder="Representante" >
        </div>
        <div class="col-sm-2" style="">
            <input type="text" name="parametro_cpf" id="parametro_cpf" class="form-control" placeholder="Cpf" >
        </div>
        <div class="col-sm-1" style="text-align:"  >
            <input type="submit" value="Buscar" class="btn btn-success pull-left" style="font-size: 15px; font-weight: bold"> 
        </div>

        <div class="col-sm-7">     
            <div class="dropdown" style="float: right">
                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"><strong>Ir Para</strong>
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="cad_empresa.php"><strong><img src="img/man-with-company.png"> CADASTRO RAZÃO SOCIAL E / OU Pª FÍSICA</strong></a></li>
                    <li><a href="cad_representante.php"><strong><img src="img/user_2.png"> CADASTRO REPRESENTANTE</strong></a></li>
                    <li><a href="cad_processo.php"><strong><img src="img/contract.png"> CADASTRO PROCESSO</strong></a></li>
                    <li><a href="cad_empreendimento.php"><strong><img src="img/construction-worker_1.png"> CADASTRO EMPREENDIMENTO</strong></a></li>
                    <li><a href="cad_licenca.php"><strong><img src="img/document_2.png"> CADASTRO LICENÇA</strong></a></li>
                    <li><a href="cad_notificacao.php"><strong><img src="img/notifications-button_1.png">CADASTRO NOTIFICAÇÃO</strong></a></li>
                    <li><a href="cad_autorizacao.php"><strong><img src="img/police-shield-with-a-star-symbol (2).png"> CADASTRO AUTORIZAÇÃO</strong></a></li>
                    <li><a href="consultar_empresas.php"style="color: #2e6da4"><strong><img src="img/office-block.png"> CONSULTAR RAZÃO SOCIAL E / OU Pª FÍSICA</strong></a></li>
                    <li><a href="consultar_processo.php" style="color: #2e6da4"><strong><img src="img/notebook_1.png"> CONSULTAR PROCESSOS</strong></a></li>
                    <li><a href="consultar_empreendimento.php" style="color: #2e6da4"><strong><img src="img/miner.png"> CONSULTAR EMPREENDIMENTOS</strong></a></li>
                    <li><a href="consultar_licencas.php" style="color: #2e6da4"><strong><img src="img/document_3.png"> CONSULTAR LICENÇAS</strong></a></li>
                    <li><a href="consultar_notificacoes.php" style="color: #2e6da4"><strong><img src="img/notification_1.png"> CONSULTAR NOTIFICAÇÕES</strong></a></li>
                    <li><a href="consultar_autorizacoes.php" style="color: #2e6da4"><strong><img src="img/police-shield-with-a-star-symbol (1).png"> CONSULTAR AUTORIZAÇÃO</strong></a></li>
                    <li><a href="home.php" style="color: #ce8483"><strong><img src="img/error.png"> CANCELAR</strong></a></li>
                </ul>
                <div  class="btn btn-primary">
                    <a href="cad_representante.php" style="font-size: 15px; font-weight: bold;color:white; text-decoration: none">Novo Cadastro</a>
                </div>

                <div  class="btn btn-danger">
                    <a href="home.php" style="font-size:15px; font-weight:bold; color:white; text-decoration:none">Cancelar</a>
                </div>
            </div>
        </div>

    </div>
</form>

<table class="table table-striped table-hover table-bordered">
    <header>
        <tr style="text-align: center;background-color:#dff0d8;color: #000000" >    
            <th style="text-align: center;font-size: 12px">COD</th> 
            <th style="text-align: center;font-size: 12px">REPRESENTANTE</th>   
            <th style="text-align: center;font-size: 12px">EMPRESA / PESSOA FÍSICA</th>   
            <th style="text-align: center;font-size: 12px">CPF</th>
            <th style="text-align: center;font-size: 12px">LOGRADOURO</th> 
            <th style="text-align: center;font-size: 12px">TELEFONE</th> 
            <th style="width: 1%"><img src="img/user.png" style="margin-left: 7px"></th>   
            <th style="width: 1%"><img src="img/printer_1.png" style="margin-left: 7px"></th> 
        </tr>
    </header>
    <?php
//variavel que representa o campo listar
    $parametro_nome_representante = filter_input(INPUT_GET, "parametro_nome_representante");
    $parametro_cpf = filter_input(INPUT_GET, "parametro_cpf");


    $sql = "SELECT tb_representante.codigo_representante,tb_representante.nome_representante,tb_representante.cpf,tb_representante.logradouro,tb_representante.telefone,tb_empresa.razaosocial_pessoafisica 
            FROM 
            tb_representante, tb_empresa
            WHERE (nome_representante LIKE '$parametro_nome_representante%' AND cpf LIKE '$parametro_cpf%') AND
            tb_representante.fk2_codigo_empresa = tb_empresa.codigo_empresa limit $inicio, $registros";



    $recebe = mysqli_query($con, $sql);

    if (mysqli_num_rows($recebe) > 0) {

        while ($linhas = mysqli_fetch_array($recebe)) {
            $representante = $linhas['codigo_representante']; //variavel pararecupar o id do empreendimento
            echo'<td style="font-size:12px">' . $linhas['codigo_representante'] . '</td>';
            echo'<td style="font-size:12px">' . $linhas['nome_representante'] . '</td>';
            echo'<td style="font-size:12px">' . $linhas['razaosocial_pessoafisica'] . '</td>';
            echo'<td style="font-size:12px">' . $linhas['cpf'] . '</td>';
            echo'<td style="font-size:12px">' . $linhas['logradouro'] . '</td>';
            echo'<td style="font-size:12px">' . $linhas['telefone'] . '</td>';
//            echo'<td class="" style="height:35px;margin-top:0px">' . "<a href = alterar_empresa.php?codigo_representante = $representante></a>" . '</td>';
            echo'<td  style="height:30px;text-align:center" title="Editar">'."<a href=alterar_representante.php?codigo_representante=$representante><img src='img/user_3.png'></a>".'</td>';
             echo'<td style="height:30px;text-align:center" title="Imprimir"><a href=relatorio_representante.php?codigo_representante='.$representante.' target="_blank"><img src="img/printer.png"></a></td>';
            echo'</tr>';
        }
        //exibe a paginação 
        for ($i = 1; $i < $numPaginas + 1; $i++) {
            echo"<ul class='pagination'>
            <li><a href='consultar_representante.php?pagina=$i'>" . $i . "</a></li>
            </ul>";
        }
    } else {
        echo "<div class='alert alert-danger fade in' style='text-align:center'><strong>NENHUM RESULTADO ENCONTRADO <img src=' img/sad-face-in-rounded-square (1).png' style='margin-bottom:5px'></strong><br/><br/>";
        echo "<a href='consultar_representante.php'style='color:blue'><strong>EXIBIR REPRESENTANTES</strong></a></div>";
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









