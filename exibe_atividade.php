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
<link rel="stylesheet" href="css/estilo_exibeEmpreendimento.css">
<form name="fmrpesquisa">
    <div class="row">
        <div class="col-sm-4" style="">
            <input type="text" name="parametro_atividade" class="form-control" placeholder="Digite o nome da atividade">
        </div>  

        <div class="col-sm-4" style="text-align: left"  >
            <input type="submit" value="Clique Para Buscar" class="btn btn-primary pull-left" style="font-size: 15px; font-weight: bold;margin-left: -20px;color: #fff">
            <div  class="btn btn-danger" style="margin-left: 10px">              
                <a href="editar.php" style="font-weight:bold; color:#FFF; text-decoration:none;">Cancelar<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a>
            </div> 
        </div> 
    </div>
</form>

<div class="row">
    <h2>ATIVIDADES</h2>
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
                <tr style="text-align: center;background-color:#67b168;color: #000000"  >               
                    <th style="text-align: center;font-size: 12px;">RAZÃO SOCIAL / Pª FÍSICA</th> 
                    <th style="text-align: center;font-size: 12px;">ATIVIDADE</th> 
                    <th style="text-align: center;font-size: 12px;">GRAU DE POLUIÇÃO</th> 
                    <th style="width: 1%"><img src="img/user.png" title="Editar" style="margin-left: 7px"></th>  
                </tr>
            </header>            
            <?php
            //seleciona todos os itens da tabela 
            $empreendimentos = "select * from tb_empreendimento";
            $linha = mysqli_query($con, $empreendimentos);

            //conta o total de itens 
            $total = mysqli_num_rows($linha);

            $parametro_atividade = filter_input(INPUT_GET, "parametro_atividade");

            $sql = "
                SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_atividade,tb_empreendimento.grau_atividade,tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica
                FROM 
                tb_empreendimento,tb_empresa
                WHERE(nome_atividade like '$parametro_atividade%')and
                tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa and nome_atividade !='' order by razaosocial_pessoafisica asc";
            $recebe = mysqli_query($con, $sql);
            if (mysqli_num_rows($recebe) > 0) {
                while ($linhas = mysqli_fetch_array($recebe)) {
                    $cod_empreendimento = $linhas['codigo_empreendimento']; //variavel pacuperar o id do empreendimento                      
                    echo'<td style="font-size:12px;text-align:center">' . $linhas['razaosocial_pessoafisica'] . '</td>';
                    echo'<td style="font-size:12px;text-align:center">' . $linhas['nome_atividade'] . '</td>';
                    echo'<td style="font-size:12px;text-align:center">' . $linhas['grau_atividade'] . '</td>';
                    echo'<td style="height:30px;text-align:center" title="Editar"><a href=alterar_empreendimento.php?codigo_empreendimento=' . $cod_empreendimento . '><span class="glyphicon glyphicon-pencil"></a></td>';
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

