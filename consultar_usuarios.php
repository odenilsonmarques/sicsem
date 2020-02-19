<?php
session_start();
require './config/conexao.php';
require './pages/header_table.php';

if (isset($_SESSION['email_admin']) && empty($_SESSION['email_admin']) == FALSE) {
    if (isset($_SESSION['senha_admin']) && empty($_SESSION['senha_admin']) == FALSE) {
        
    }
} else {
    header("Location:loginadmin.php");
}

//verifica a página atual caso seja informada na URL, senão atribui como 1ª página 
$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

//seleciona todos os itens da tabela 
$sql_ctrlusu = "select * from tb_controle_usuario";
$linha = mysqli_query($con, $sql_ctrlusu);

//conta o total de itens 
$total = mysqli_num_rows($linha);
//echo $total . "<br>";
//seta a quantidade de itens por página, neste caso, 2 itens 
$registros = 5;

//calcula o número de páginas arredondando o resultado para cima 
$numPaginas = ceil($total / $registros);

//variavel para calcular o início da visualização com base na página atual 
$inicio = ($registros * $pagina) - $registros;
?>

<form name="fmrpesquisa">
    <p style="background-color: #dff0d8"><strong>Pesquisar Usuários</strong></p>
    <div class="row">
        <div class="col-sm-4" style="">
            <input type="text" name="parametro_usuario" class="form-control" placeholder="Informe o nome o usuário" >
        </div>

        <div class="col-sm-2" style="text-align: left"  >
            <input type="submit" value="Buscar" class="btn btn-success pull-left" style="font-size: 15px; font-weight: bold;margin-left: -10px"> 
        </div>
        <div class="col-sm-6" style="text-align: right"> 
            <div  class="btn btn-primary">
                <a href="cad_usuarios.php" style="font-size: 17px; font-weight: bold;color:white; text-decoration: none">Novo Usuario</a>
            </div>
            <div  class="btn btn-primary">
                <a href="admin.php" style="font-size:17px; font-weight:bold; color:white; text-decoration:none">Cancelar</a>
            </div>   
        </div>
    </div>
</form>
<table class="table table-striped table-hover table-bordered">
    <header>
        <tr style="text-align: center;background-color:#dff0d8;color: #000000" >    
            <th style="text-align: center;font-size: 12px">COD</th>  
            <th style="text-align: center;font-size: 12px">EMAIL</th>
            <th style="text-align: center;font-size: 12px">DATA E HORA DE ACESSO</th>
            <th style="width: 1%"><img src="img/user.png" style="margin-left: 7px"></th>   
        </tr>
    </header>
    <?php
//variavel que representa o campo listar
    $parametro_usuario = filter_input(INPUT_GET, "parametro_usuario");


    $sql = "SELECT * FROM tb_controle_usuario WHERE email LIKE '%$parametro_usuario%' ORDER BY codigo_ctrlusu  limit $inicio,$registros";
    $recebe = mysqli_query($con, $sql);

    if (mysqli_num_rows($recebe) > 0) {

        while ($linhas = mysqli_fetch_array($recebe)) {
            $controle_usuario = $linhas['codigo_ctrlusu']; //variavel pararecupar o id do empreendimento
            echo'<td style="font-size:12px">' . $linhas['codigo_ctrlusu'] . '</td>';
            echo'<td style="font-size:12px">' . $linhas['email'] . '</td>';
            echo'<td style="font-size:12px">' . Date('d/m/Y \a\s H:i:s', strtotime($linhas['data_acesso'])) . '</td>';
            echo'<td style="font-size:12px"> </td>';
            echo'</tr>';
        }
        for ($i = 1; $i < $numPaginas + 1; $i++) {
            echo"<ul class='pagination'>
            <li><a href='consultar_usuarios.php?pagina=$i'>" . $i . "</a></li>
            </ul>";
        }
    } else {
        echo "<div class='alert alert-danger fade in' style='text-align:center'><strong>NENHUM RESULTADO ENCONTRADO!</strong></div>";
    }
    ?>
    <style type="text/css">

        li{
            margin-bottom: 10px;
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








