<?php
session_start();
require './config/conexao.php';
require './pages/header.php';

if (isset($_SESSION['email']) && empty($_SESSION['email']) == FALSE) {
    if (isset($_SESSION['senha']) && empty($_SESSION['senha']) == FALSE) {
        
    }
} else {
    header("Location:login.php");
}
?>

<link rel="stylesheet" href="css/estilo_exibeLicencas.css">
<script type="text/javascript" src="js/msg_de_erro.js"></script>
<form name="fmrpesquisa">
    <div class="row">
        <div class="col-sm-4" style="">
            <input type="text" name="parametro_numero_licenca" class="form-control" placeholder="Digite o Número da Licença">
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
</div>
<h2>LICENÇAS</h2>
<!--ESTE CSS RESPONSVEL POR AJUDAR NA INSERÇÃO DA BARRA DE ROLAGEM DA TABELA-->
<style type="text/css">
    .table-overflow {
        max-height:400px;
        overflow-x:auto;
    }
</style>
<div class="table-overflow">
    <table class="table table-striped table-hover table-bordered">
        <header>
            <tr>
                <th style="text-align: center;font-size: 12px">LICENÇA</th> 
                <th style="text-align: center;font-size: 12px">Nº LIC</th>   
                <th style="text-align: center;font-size: 12px">ANO</th>      
                <th style="text-align: center;font-size: 12px">EMISSÃO</th> 
                <th style="text-align: center;font-size: 12px">VALIDADE</th>            
                <th style="text-align: center;font-size: 12px" >SITUAÇÃO</th> 
                <th style="width: 1%"><img src="img/user.png" title="Editar" style="margin-left: 7px"></th>  
                <th style="width: 1%"><img src="img/delete.png" title="Editar" style="margin-left: 7px;height: 25px"></th>  
            </tr>
        </header>
        <?php
        $parametro_numero_licenca = filter_input(INPUT_GET, "parametro_numero_licenca");

        $sql = "SELECT tb_licenca.codigo_licenca,tb_licenca.numero_licenca,tb_licenca.ano_licenca,tb_licenca.data_emissao,tb_licenca.data_validade,
            tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica,tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_empreendimento.nome_bairro,tb_processo.numero_processo,tb_processo.assunto, (if(current_date()<= data_validade,'<strong>VALIDA</strong>','<strong style=color:#F4C430>INVALIDA<strong>')) AS situacao
            FROM 
            tb_licenca,tb_empresa,tb_empreendimento,tb_processo
            WHERE(numero_licenca LIKE '$parametro_numero_licenca%')AND 
            tb_licenca.fk4_codigo_empresa = tb_empresa.codigo_empresa AND tb_licenca.fk1_codigo_empreendimento = tb_empreendimento.codigo_empreendimento  AND tb_licenca.fk1_codigo_processo = tb_processo.codigo_processo  ORDER BY razaosocial_pessoafisica";

        $recebe = mysqli_query($con, $sql);

        if (mysqli_num_rows($recebe) > 0) {

            while ($linhas = mysqli_fetch_array($recebe)) {
                $cod_licenca = $linhas['codigo_licenca']; //variavel pararecupar o id do empreendimento
                echo'<tr style="font-size:13px">';

                echo'<td style="font-size:12px;width:20%">' . $linhas['assunto'] . '</td>';
                echo'<td style="font-size:12px;width:5%">' . $linhas['numero_licenca'] . '</td>';
                echo'<td style="font-size:12px;width:3%">' . $linhas['ano_licenca'] . '</td>';
                echo'<td style="font-size:12px;width:2%">' . date('d/m/Y', strtotime($linhas['data_emissao'])) . '</td>';
                echo'<td style="font-size:12px;width:2%">' . date('d/m/Y', strtotime($linhas['data_validade'])) . '</td>';
                echo'<td style="font-size:12px;text-align:center;width:2%">' . $linhas['situacao'] . '</td>';
                echo'<td  style="height:30px;text-align:center" title="Editar"><a href=altera_licenca.php?codigo_licenca=' . $cod_licenca . '><span class="glyphicon glyphicon-pencil"></a></td>';
//                echo'<td  style="height:30px;text-align:center" title="Remover"><a href=remover_licenca.php?codigo_licenca=' . $cod_licenca . '><span class="glyphicon glyphicon-remove"></a></td>';

                if ($_SESSION['nivel_acesso'] == "4") {
                    echo"<td><a href='remover_licenca.php?codigo_licenca=" . $cod_licenca . "'data-confirm='Tem certeza de que deseja excluir o item selecionado?'><span class='glyphicon glyphicon-remove' style='font-weight:bold; color:#CC0000; text-decoration:none;margin-left: 10px'></a></td>";
                } else {
                    ?>
                    <td><a href="#myModalExclusao" data-toggle="modal" style="font-weight:bold; color:#CC0000; text-decoration:none;margin-left: 5px"><span class="glyphicon glyphicon-remove" style="margin-left: 5px"></a></td>
                        <?php
                    }
                    echo'</tr>';
                }
            } else {
                echo "<div class='alert alert-danger fade in' style='text-align:center'><strong>NENHUM RESULTADO ENCONTRADO <img src=' img/sad-face-in-rounded-square (1).png' style='margin-bottom:5px'></strong><br/><br/>";
                echo "<a href='consultar_licencas.php'style='color:blue'><strong>EXIBIR LICENCAS</strong></a></div>";
            }
            ?>
    </table><br>
</div>
<br><br><br>
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


