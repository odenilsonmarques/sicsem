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
<link rel="stylesheet" href="css/estilo_exibeContribuintes.css">
<script type="text/javascript" src="js/msg_de_erro.js"></script>
<form name="fmrpesquisa">
    <div class="row">
        <div class="col-sm-4" style="">
            <input type="text" name="parametro_empresa" class="form-control" placeholder="Digite o Nome da Razão Social / Pª Física">
        </div>  

        <div class="col-sm-8" style="text-align: left"  >
            <input type="submit" value="Clique Para Buscar" class="btn btn-primary pull-left" style="font-size: 15px; font-weight: bold;margin-left: -20px;color: #fff">
            <div  class="btn btn-danger" style="margin-left: 10px">              
                <a href="editar.php" style="font-weight:bold; color:#FFF; text-decoration:none;">Cancelar<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a>
            </div>   
        </div>

    </div> 
</form>

<div class="row">
     <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <h2>NOSSOS CONTRIBUINTES</h2>
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
                    <th style="text-align: center;font-size: 12px">RAZÃO SOCIAL / PESSOA FÍSICA</th>   
                    <th style="text-align: center;font-size: 12px">NOME FANTASIA</th>             
                    <th style="text-align: center;font-size: 12px">CNPJ / CPF</th>
                    <th style="text-align: center;font-size: 12px">TELEFONE</th> 
                    <th style="width: 1%"><img src="img/user.png" title="Editar" style="margin-left: 7px"></th>
                    <th style="width: 1%"><img src="img/delete.png" title="Excluir" style="margin-left: 7px;height: 25px"></th>  
                </tr>
            </header>            
            <?php
            //seleciona todos os itens da tabela 
            $empresas = "select * from tb_empresa";
            $linha = mysqli_query($con, $empresas);

            //conta o total de itens 
            $total = mysqli_num_rows($linha);

            $parametro_empresa = filter_input(INPUT_GET, "parametro_empresa");

            $sql = "SELECT codigo_empresa,razaosocial_pessoafisica,nome_fantasia,cnpj_cpf,bairro,telefone
        FROM tb_empresa WHERE razaosocial_pessoafisica LIKE '$parametro_empresa%' ORDER BY razaosocial_pessoafisica asc";
            $recebe = mysqli_query($con, $sql);
            if (mysqli_num_rows($recebe) > 0) {
                while ($linhas = mysqli_fetch_array($recebe)) {
                    $cod_empresa = $linhas['codigo_empresa']; //variavel pararecupar o id do empreendimento         
                    echo'<td style="font-size:12px">' . $linhas['razaosocial_pessoafisica'] . '</td>';
                    echo'<td style="font-size:12px">' . $linhas['nome_fantasia'] . '</td>';
                    echo'<td style="font-size:12px">' . $linhas['cnpj_cpf'] . '</td>';
                    echo'<td style="font-size:12px">' . $linhas['telefone'] . '</td>';
                    echo'<td style="height:30px;text-align:center" title="Editar"><a href=alterar_empresa.php?codigo_empresa=' . $cod_empresa . '><span class="glyphicon glyphicon-pencil"></a></td>';
                    if ($_SESSION['nivel_acesso'] == "4") {
                        echo"<td><a href='remover_contribuinte.php?codigo_empresa=" . $cod_empresa . "' data-confirm='Tem certeza de que deseja excluir o item selecionado?'><span class='glyphicon glyphicon-remove' style='font-weight:bold; color:#CC0000; text-decoration:none;margin-left: 5px'></a></td>";
                    } else {
                        ?>
                        <td><a href="#myModalExclusao" data-toggle="modal" style="font-weight:bold; color:#CC0000; text-decoration:none;margin-left: 5px"><span class="glyphicon glyphicon-remove" style="margin-left: 5px"></a></td>
                            <?php
                        }
                        echo'</tr>';
                    }
                }
                ?>
        </table>
    </div>  
    <br><br><br>
</div>
</div>
<!--MODAL PARA O CAMPO CADASTRO - BLOQEANDO USUARIO CASO ELE NÃO SEJA TENHA PERMISSÃO-->
<div class="modal fade" id="myModalExclusao" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">VOCÊ NÃO TEM PERMISSÃO PARA REALIZAR ESTA TAREFA</h4>
            </div>
            <div class="modal-body">
                <p style="text-align: center">
                    <strong>CONSULTE O USUÁRIO QUE TENHA ESSA PERMISSÃO</strong>
                    <a href="#" data-toggle="popover" title="GABINETE" style="text-decoration: none"><br>IDENTIFICAR USUÁRIO</span></a>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Retornar</button>
            </div>
        </div>
    </div>
</div>
<!--Este script chama o popover para indentificar quem é o usuario nivel 2-->
<script>
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });
</script>
<?php
require './pages/footer.php';
