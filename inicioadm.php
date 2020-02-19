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

<link rel="stylesheet" href="css/estilo_paginainicial.css">
 <h2>Painel de Controle de Usuário</h2>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 sidenav"><br>
            <img src="img/user (1)_1.png"  class="img-responsive  center-block" style="height: 102px"><br>    
            <?php
            echo'<div class="row">';
            echo'<div class="col-sm-12">';
            echo '<p style="text-align:center;color:#fff;font-size:16px;border-radius:7px"><strong>Olá ' . $_SESSION['nome'] . '</strong></p>';
            echo'</div>';
            echo'</div>';
            ?>         
            <ul class="nav nav-pills">   
                <li class="">
                    <a href="cad_usuario.php" style="color:#fff">
                        <strong>NOVO USUÁRIO<span class="glyphicon glyphicon-plus" style="margin-left: 10px"></strong>
                    </a>                   
                </li>
                <li class="">
                    <a href="exibe_acesso.php" style="color:#fff">
                        <strong>CONTROLE ACESSO<span class="glyphicon glyphicon-user" style="margin-left: 5px"></strong>
                    </a>                   
                </li>
                <li>
                    <a href="logout.php" style="color:#fff">
                        <strong>SAIR DO SISTEMA<span class="glyphicon glyphicon-off" style="margin-left: 10px"></strong>
                    </a>
                </li>
            </ul>
        </div>
        <!--ESTE CSS RESPONSVEL POR AJUDAR NA INSERÇÃO DA BARRA DE ROLAGEM DA TABELA-->
        <style type="text/css">
            .table-overflow {
                max-height:250px;
                overflow-x:auto;
            }
        </style>
        <div class="table-overflow">
            <table class="table table-striped table-hover table-bordered" >
                <header>
                    <tr style="text-align: center;background-color:#67b168;color: #000000" >               
                        <th style="text-align: center;font-size: 12px">NOME</th>   
                        <th style="text-align: center;font-size: 12px">EMAIL</th>
                        <th style="text-align: center;font-size: 12px">CARGO</th>
                        <th style="text-align: center;font-size: 12px">MATRICULA</th>                        
                    </tr>
                </header>

                <?php
                //seleciona todos os itens da tabela 
                $empresas = "select * from tb_usuario";
                $linha = mysqli_query($con, $empresas);

                //conta o total de itens 
                $total = mysqli_num_rows($linha);


                $sql = "SELECT codigo_usuario,nome,email,cargo,matricula
        FROM tb_usuario ORDER BY codigo_usuario";
                $recebe = mysqli_query($con, $sql);
                if (mysqli_num_rows($recebe) > 0) {
                    while ($linhas = mysqli_fetch_array($recebe)) {
                        $empresa = $linhas['codigo_usuario']; //variavel pararecupar o id do empreendimento         
                        echo'<td style="font-size:12px">' . $linhas['nome'] . '</td>';
                        echo'<td style="font-size:12px">' . $linhas['email'] . '</td>';                      
                        echo'<td style="font-size:12px">' . $linhas['cargo'] . '</td>';
                        echo'<td style="font-size:12px">' . $linhas['matricula'] . '</td>';
                        echo'</tr>';
                    }
                }
                ?>
            </table>
        </div>  
        <br><br><br>
    </div>
</div>
<?php
require './pages/footer.php';
