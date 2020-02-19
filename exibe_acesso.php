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

$data = date('d/m/Y \a\s  H:i:s');
echo $data;
?>
<link rel="stylesheet" href="css/estilo_exibe_acesso.css">
<form name="fmrpesquisa">
    <div class="row">
        <div class="col-sm-4" style="">
            <input type="text" name="parametro_usuario" class="form-control" placeholder="Digite o email">
        </div>  

        <div class="col-sm-8" style="text-align: left"  >
            <input type="submit" value="Clique Para Buscar" class="btn btn-primary pull-left" style="font-size: 15px; font-weight: bold;margin-left: -20px;color: #fff">
            <div  class="btn btn-danger" style="margin-left: 10px">              
                <a href="inicioadm.php" style="font-weight:bold; color:#FFF; text-decoration:none;">Cancelar<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a>
            </div>   
        </div>
        

    </div> 
</form>

<div class="row">
    
    <div class="col-sm-12">
        <h2>CONTROLE DE ACESSOS</h2>
        <!--ESTE CSS RESPONSVEL POR AJUDAR NA INSERÇÃO DA BARRA DE ROLAGEM DA TABELA-->
        <style type="text/css">
            .table-overflow {
                max-height:400px;
                overflow-x:auto;
            }
        </style>
        <div class="table-overflow">
            <table class="table table-striped table-hover table-bordered" >
                <header>
                    <tr style="text-align: center;background-color:#67b168;color: #000000" >               
                        <th style="text-align: center;font-size: 12px">EMAIL</th>   
                        <th style="text-align: center;font-size: 12px">DATA DE ACESSO</th>
                        <th style="text-align: center;font-size: 12px">NOME</th>
                        <th style="text-align: center;font-size: 12px">AÇÃO REALIZADA</th>
                    </tr>
                </header>            
                <?php
                //seleciona todos os itens da tabela usuario
                $usuarios = "select * FROM tb_controle_usuario";
                $linha = mysqli_query($con, $usuarios);

                $parametro_usuario = filter_input(INPUT_GET, "parametro_usuario");

                $sql = "SELECT codigo_controle_usuario,email,data_acesso,nome,acao 
                    FROM tb_controle_usuario WHERE email LIKE '$parametro_usuario%' ORDER BY data_acesso desc";
                $recebe = mysqli_query($con, $sql);
                if (mysqli_num_rows($recebe) > 0) {
                    while ($linhas = mysqli_fetch_array($recebe)) {
                        echo'<td style="font-size:12px;text-align:right">' . $linhas['email'] . '</td>';   
                        echo'<td style="font-size:12px">' . date('d/m/Y \a\s  H:i:s', strtotime($linhas['data_acesso'])) . '</td>';
                        echo'<td style="font-size:12px;text-align:right">' . $linhas['nome'] . '</td>';   
                        echo'<td style="font-size:12px;text-align:right">' . $linhas['acao'] . '</td>';   
                        echo'</tr>';
                    }
                }
                
                ?>
            </table>
        </div>  
        <br><br><br>
    </div>
     
</div>
</div>
<?php
require './pages/footer.php';
