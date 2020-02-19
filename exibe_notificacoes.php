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
            <input type="text" name="parametro_numero_notificacao" class="form-control" placeholder="Digite o Número da Notificação">
        </div>  
        <div class="col-sm-8" style="text-align: left"  >
            <input type="submit" value="Clique Para Buscar" class="btn btn-primary pull-left" style="font-size: 15px; font-weight: bold;margin-left: -20px;color: #fff">
            <div  class="btn btn-danger" style="margin-left: 10px">              
                <a href="editar.php" style="font-weight:bold; color:#FFF; text-decoration:none;">Cancelar<span class="glyphicon glyphicon-remove" style="margin-left: 10px;"></span></a>
            </div> 
        </div>
    </div>
</form>

<h2>NOTICACÕES</h2>
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
            <tr style="text-align: center;background-color:#dff0d8;color: #000000" >
                <th style="text-align: center;font-size: 12px"><strong>Nº NOTIFICACÃO</strong></th>
                <th style="text-align: center;font-size: 12px">DATA  NOTIFICAÇÃO</th>
                <th style="text-align: center;font-size: 12px">DATA COMPARECIMENTO</th>
                <th style="text-align: center;font-size: 12px">NÚMERO PROCESSO</th> 
                <th style="text-align: center;font-size: 12px">STATUS</th>  
                <th style="text-align: center;font-size: 12px">SITUAÇÃO</th>             
                <th style="width: 1%"><img  src="img/user.png" title="Editar" style="margin-left: 7px"></th>  
                <th style="width: 1%"><img src="img/delete.png" title="Excluir" style="margin-left: 7px;height: 25px"></th> 
            </tr>
        </header>
        <?php
        $parametro_numero_notificacao = filter_input(INPUT_GET, "parametro_numero_noticaacao");
        $sql = "SELECT tb_notificacao.codigo_notificacao,tb_notificacao.numero_notificacao,tb_notificacao.ano_notificacao,tb_notificacao.data_notificacao,tb_notificacao.data_comparecimento,tb_notificacao.profissao_atividade,tb_notificacao.descricao_prazo,tb_notificacao.status,tb_empresa.razaosocial_pessoafisica,tb_empresa.nome_fantasia,tb_processo.numero_processo,tb_fiscal.nome_matricula_fiscal,
            (if(current_date()<= data_comparecimento,'<strong>DENTRO DO PRAZO</strong>','<strong style=color:#F4C430>PRAZO VENCIDO<strong>')) AS situacao    
            FROM 
            tb_notificacao,tb_empresa,tb_processo,tb_fiscal
            WHERE(numero_notificacao LIKE '$parametro_numero_notificacao%')AND 
            tb_notificacao.fk5_codigo_empresa = tb_empresa.codigo_empresa AND tb_notificacao.fk2_codigo_processo = tb_processo.codigo_processo AND tb_notificacao.fk1_codigo_fiscal = tb_fiscal.codigo_fiscal ORDER BY codigo_notificacao";

        $recebe = mysqli_query($con, $sql);

        if (mysqli_num_rows($recebe) > 0) {

            while ($linhas = mysqli_fetch_array($recebe)) {
                $notificacoes = $linhas['codigo_notificacao']; //variavel para recupar o id da notificação
                echo'<tr style="font-size:13px">';
                echo'<td style="font-size:12px">' . $linhas['numero_notificacao'] . '</td>';
                echo'<td style="font-size:12px">' . date('d/m/Y', strtotime($linhas['data_notificacao'])) . '</td>';
                echo'<td style="font-size:12px">' . date('d/m/Y', strtotime($linhas['data_comparecimento'])) . '</td>';
                echo'<td style="font-size:12px">' . $linhas['numero_processo'] . '</td>';
                echo'<td style="font-size:12px">' . $linhas['status'] . '</td>';
                echo'<td style="font-size:12px">' . $linhas['situacao'] . '</td>';
                echo'<td  style="height:30px;text-align:center" title="Editar"><a href=alterar_notificacao.php?codigo_notificacao=' . $notificacoes . '><span class="glyphicon glyphicon-pencil"></a></td>';
                if ($_SESSION['nivel_acesso'] == "4") {
                    echo"<td><a href='remover_notificacoes.php?codigo_notificacao=" . $notificacoes . "' data-confirm='Tem certeza de que deseja excluir o item selecionado?'><span class='glyphicon glyphicon-remove' style='font-weight:bold; color:#CC0000; text-decoration:none;margin-left: 10px'></a></td>";
                } else {
                    ?>
                    <td><a href="#myModalExclusao" data-toggle="modal" style="font-weight:bold; color:#CC0000; text-decoration:none;margin-left: 5px"><span class="glyphicon glyphicon-remove" style="margin-left: 5px"></a></td>
                        <?php
                    }
                    echo'</tr>';
                }
            } else {
                echo "<div class='alert alert-danger fade in' style='text-align:center'><strong>NENHUM RESULTADO ENCONTRADO <img src=' img/sad-face-in-rounded-square (1).png' style='margin-bottom:5px'></strong><br/><br/>";
                echo "<a href='consultar_notificacoes.php'style='color:blue'><strong>EXIBIR NOTIFICAÇÕES</strong></a></div>";
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


