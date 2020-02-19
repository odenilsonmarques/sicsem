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
$sql_licencas = "select * from tb_licenca";
$linha = mysqli_query($con, $sql_licencas);

//conta o total de itens 
$total = mysqli_num_rows($linha);
echo $total;


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
            <input type="text" name="parametro" class="form-control" placeholder="Informe a Licença" >
        </div>
        <div class="col-sm-2" style="">
            <input type="text" name="parametro1" class="form-control" placeholder="Informe o Numero da Licença" >
        </div>
        <div class="col-sm-2" style="text-align: left"  >
            <input type="submit" value="Buscar Licença" class="btn btn-success pull-left" style="font-size: 15px; font-weight: bold;margin-left: -20px"> 
        </div>
        <div class="col-sm-6" style="text-align: right"> 
            <div  class="btn btn-primary">
                <a href="cad_licenca.php" style="font-size: 17px; font-weight: bold;color:white; text-decoration: none">Novo Cadastro</a>
            </div>
            <div  class="btn btn-primary">
                <a href="home.php" style="font-size:17px; font-weight:bold; color:white; text-decoration:none">Cancelar</a>
            </div>
        </div>
    </div>
</form>

<table class="table table-striped table-hover table-bordered">
    <header>
        <tr style="text-align: center;background-color:#dff0d8;color: #000000" >
            <th style="text-align: center;font-size: 12px"><strong>COD</strong></th>
            <th style="text-align: center;font-size: 12px"><strong>TIPO DE LICENÇA</strong></th>
            <th style="text-align: center;font-size: 12px">NÚMERO</th>      
            <th style="text-align: center;font-size: 12px">EMISSÃO</th> 
            <th style="text-align: center;font-size: 12px">VALIDADE</th>
            <th style="text-align: center;font-size: 12px">EMPRESA / PESSSOA FÍSICA</th> 
            <th style="text-align: center;font-size: 12px">EMPREENDIMENTO</th> 
            <th style="text-align: center;font-size: 12px">ATIVIDADE</th> 
            <th style="text-align: center;font-size: 12px">PROCESSO</th> 
            <th style="text-align: center;font-size: 12px;">SITUAÇÃO</th> 
        </tr>
    </header>
    <?php
    $data_atual = date("d / m / Y");
    $parametro = filter_input(INPUT_GET, "parametro");
    $parametro1 = filter_input(INPUT_GET, "parametro1");
    

    $sql = "SELECT tb_licenca.codigo_licenca,tb_licenca.licenca,tb_licenca.numero_licenca,tb_licenca.data_emissao,tb_licenca.data_validade,tb_licenca.atividade_realizada,
            tb_empresa.razaosocial_pessoafisica,tb_empreendimento.nome_empreendimento,tb_processo.numero_processo, (if(curdate()<= data_validade,'<strong>VALIDA</strong>','<strong>INVALIDA<strong>')) AS situacao
            FROM 
            tb_licenca,tb_empresa,tb_empreendimento,tb_processo
            WHERE(licenca LIKE '$parametro%' AND numero_licenca LIKE '$parametro1%') AND 
            tb_licenca.fk4_codigo_empresa = tb_empresa.codigo_empresa AND tb_licenca.fk1_codigo_empreendimento = tb_empreendimento.codigo_empreendimento  AND tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo  ORDER BY situacao DESC limit $inicio,$registros";

    $recebe = mysqli_query($con, $sql);
    
    if(mysqli_num_rows($recebe)>0){

    while ($linhas = mysqli_fetch_array($recebe)) {
        $licencas = $linhas['codigo_licenca']; //variavel pararecupar o id do empreendimento
        echo'<tr style="font-size:14px">';
        echo'<td style="font-size:12px">' . $linhas['codigo_licenca'] . '</td>';
        echo'<td style="font-size:12px">' . $linhas['licenca'] . '</td>';
        echo'<td style="font-size:12px">' . $linhas['numero_licenca'] . '</td>';
        echo'<td style="font-size:12px">' . date('d/m/Y', strtotime($linhas['data_emissao'])) . '</td>';
        echo'<td style="font-size:12px">' . date('d/m/Y', strtotime($linhas['data_validade'])) . '</td>';
        echo'<td style="font-size:12px">' . $linhas['razaosocial_pessoafisica'] . '</td>';
        echo'<td style="font-size:12px">' . $linhas['nome_empreendimento'] . '</td>';
        echo'<td style="font-size:12px">' . $linhas['atividade_realizada'] . '</td>';
        echo'<td style="font-size:12px">' . $linhas['numero_processo'] . '</td>';
        echo'<td style="font-size:12px;text-align:center" >' . $linhas['situacao'] . '</td>';
  
        echo'<td class="" style="height:35px;margin-top:0px">' . "<a href = relatorio_licenca.php?codigo_empresa = $licencas></a>" . '</td>';
        echo'</tr>'; 
    }
     //exibe a paginação 
        for ($i = 1; $i < $numPaginas + 1; $i++) {  
            echo"<ul class='pagination'>
            <li><a href='listar_com_impressao.php?pagina=$i'>" . $i . "</a></li>
            </ul>";
        }
    }else{
        echo "<div class='alert alert-danger fade in' style='text-align:center'><strong>NENHUM RESULTADO ENCONTRADO!</strong></div>";
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



