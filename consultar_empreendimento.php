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
$empreendimentos = "select * from tb_empreendimento";
$linha = mysqli_query($con, $empreendimentos);

//conta o total de itens 
$total = mysqli_num_rows($linha);

//seta a quantidade de itens por página, neste caso, 2 itens 
$registros = 10;

//calcula o número de páginas arredondando o resultado para cima 
$numPaginas = ceil($total / $registros);

//variavel para calcular o início da visualização com base na página atual 
$inicio = ($registros * $pagina) - $registros;
?>

<form name="fmrpesquisa">
    <div class="row">
        <div class="col-sm-2" style="">
            <input type="text" name="parametro_empreendimento" class="form-control" placeholder="Empreendimento" >
        </div>
        <div class="col-sm-2" style="">
            <input type="text" name="parametro_empresa" class="form-control" placeholder="Empresa / Pessoa Fisica" >
        </div>
        <div class="col-sm-2" style="">
            <input type="text" name="parametro_bairro" class="form-control" placeholder="Bairro" >
        </div>
        <div class="col-sm-1" style="text-align: left"  >
            <input type="submit" value="Buscar" class="btn btn-success pull-left" style="font-size: 15px; font-weight: bold;margin-left: -10px"> 
        </div>
        <div class="col-sm-5">     
            <div class="dropdown" style="float: right">
                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" ><strong>Ir Para</strong>
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="cad_empresa.php"><strong><img src="img/man-with-company.png"> CADASTRO RAZÃO SOCIAL  E / OU Pª FÍSICA</strong></a></li>
                    <li><a href="cad_representante.php"><strong><img src="img/user_2.png"> CADASTRO REPRESENTANTE</strong></a></li>
                    <li><a href="cad_processo.php"><strong><img src="img/contract.png"> CADASTRO PROCESSO</strong></a></li>
                    <li><a href="cad_licenca.php"><strong><img src="img/document_2.png"> CADASTRO LICENÇA</strong></a></li>
                    <li><a href="cad_notificacao.php"><strong><img src="img/notifications-button_1.png">CADASTRO NOTIFICAÇÃO</strong></a></li>
                    <li><a href="cad_autorizacao.php"><strong><img src="img/police-shield-with-a-star-symbol (2).png"> CADASTRO AUTORIZAÇÃO</strong></a></li>
                    <li><a href="consultar_empresas.php"style="color: #2e6da4"><strong><img src="img/office-block.png"> CONSULTAR RAZÃO SOCIAL  E / OU Pª FÍSICA</strong></a></li>
                    <li><a href="consultar_representante.php" style="color: #2e6da4"><strong><img src="img/icon.png"> CONSULTAR REPRESENTANTES</strong></a></li>
                    <li><a href="consultar_processo.php" style="color: #2e6da4"><strong><img src="img/notebook_1.png"> CONSULTAR PROCESSOS</strong></a></li>
                    <li><a href="consultar_licencas.php" style="color: #2e6da4"><strong><img src="img/document_3.png"> CONSULTAR LICENÇAS</strong></a></li>
                    <li><a href="consultar_notificacoes.php" style="color: #2e6da4"><strong><img src="img/notification_1.png"> CONSULTAR NOTIFICAÇÕES</strong></a></li>
                    <li><a href="consultar_autorizacoes.php" style="color: #2e6da4"><strong><img src="img/police-shield-with-a-star-symbol (1).png"> CONSULTAR AUTORIZAÇÃO</strong></a></li>
                    <li><a href="home.php" style="color: #ce8483"><strong><img src="img/error.png"> CANCELAR</strong></a></li>
                </ul>
                <div  class="btn btn-primary">
                    <a href="cad_empreendimento.php" style="font-size: 15px; font-weight: bold;color:white; text-decoration: none">Novo Cadastro</a>
                </div>

                <div  class="btn btn-danger">
                    <a href="home.php" style="font-size:15px; font-weight:bold; color:white; text-decoration:none">Cancelar</a>
                </div>
            </div>
        </div>
        <!--        <div class="col-sm-6" style="text-align: right"> 
                    <div  class="btn btn-primary">
                        <a href="cad_empreendimento.php" style="font-size: 17px; font-weight: bold;color:white; text-decoration: none">Novo Cadastro</a>
                    </div>
                    <div  class="btn btn-primary">
                        <a href="listar_cadastros.php" style="font-size:17px; font-weight:bold; color:white; text-decoration:none">Cancelar</a>
                    </div>-->
        <?php
//            $sql_empredimentos = "SELECT *FROM  tb_empreendimento";
//            $recebe_empreendimentod = mysqli_query($con, $sql_empredimentos);
//            $total_empreenndimento = mysqli_num_rows($recebe_empreendimentod);
//            echo'<button class="btn btn-danger" style="margin-right:2px;font-size: 17px; font-weight: bold;color:white;"><strong>Total de Empreendimentos</strong> <span  class="badge">' . $total_empreenndimento. '</span></button>';
//            
        ?>

        <!--</div>-->
    </div>
</form>
<table class="table table-striped table-hover table-bordered">
    <header>
        <tr style="text-align: center;background-color:#dff0d8;color: #000000" >    
            <th style="text-align: center;font-size: 12px">COD</th> 
            <th style="text-align: center;font-size: 12px">EMREENDIMENTO E / OU DESCRIÇÃO DA ATIVIDADE</th>
            <th style="text-align: center;font-size: 12px">RAZÃO SOCIAL / PESSOA FÍSICA</th>   
            <th style="text-align: center;font-size: 12px">LOGRADOURO</th>
            <th style="text-align: center;font-size: 12px">BAIRRO</th> 
            <th style="width: 1%"><img src="img/user.png" style="margin-left: 7px"></th>  
            <th style="width: 1%"><img src="img/printer_1.png" style="margin-left: 7px"></th>    
        </tr>
    </header>
    <?php
//variavel que representa o campo listar
    $parametro_empresa = filter_input(INPUT_GET, "parametro_empresa");
    $parametro_empreendimento = filter_input(INPUT_GET, "parametro_empreendimento");
//    $parametro_bairro = filter_input(INPUT_GET, "parametro_bairro");

    $sql = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_empreendimento.nome_logradouro,tb_empreendimento.nome_bairro,tb_empresa.razaosocial_pessoafisica
            FROM
            tb_empreendimento,tb_empresa            
            WHERE(razaosocial_pessoafisica LIKE '$parametro_empresa%'  AND nome_empreendimento LIKE '$parametro_empreendimento%') AND
            tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa ORDER BY codigo_empreendimento limit  $inicio, $registros";

    $recebe = mysqli_query($con, $sql);

    if (mysqli_num_rows($recebe) > 0) {

        while ($linhas = mysqli_fetch_array($recebe)) {
            $empreendimento = $linhas['codigo_empreendimento']; //variavel pararecupar o id do empreendimento
            echo'<td style="font-size:12px">' . $linhas['codigo_empreendimento'] . '</td>';
            echo'<td style="font-size:12px">' . $linhas['nome_empreendimento'] . '</td>';
            echo'<td style="font-size:12px">' . $linhas['razaosocial_pessoafisica'] . '</td>';
            echo'<td style="font-size:12px">' . $linhas['nome_logradouro'] . '</td>';
            echo'<td style="font-size:12px">' . $linhas['nome_bairro'] . '</td>';
             echo'<td  style="height:30px;text-align:center" title="Editar">'."<a href=alterar_empreendimento.php?codigo_empreendimento=$empreendimento><img src='img/user_3.png'></a>".'</td>';
             echo'<td style="height:30px;text-align:center" title="Imprimir"><a href=relatorio_empreendimento.php?codigo_empreendimento='.$empreendimento.' target="_blank"><img src="img/printer.png"></a></td>';
            echo'</tr>';
        }
        //exibe a paginação 
        for ($i = 1; $i < $numPaginas + 1; $i++) {
            echo"<ul class='pagination'>
            <li><a href='consultar_empreendimento.php?pagina=$i'>" . $i . "</a></li>
            </ul>";
        }
    } else {
         echo "<div class='alert alert-danger fade in' style='text-align:center'><strong>NENHUM RESULTADO ENCONTRADO <img src=' img/sad-face-in-rounded-square (1).png' style='margin-bottom:5px'></strong><br/><br/>";
        echo "<a href='consultar_empreendimento.php'style='color:blue'><strong>EXIBIR EMPREENDIMENTOS</strong></a></div>";
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








