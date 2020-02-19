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
echo'<a href="inicio.php" class="btn btn-danger" style="margin-left:5px;font-size: 15px; font-weight: bold;color:white;"title="CANCELAR"><strong>PAGINA INICIAL </strong><span class="glyphicon glyphicon-remove" style="margin-left:5px"></span></a>';
?>

<link rel="stylesheet" href="css/estilo_exibeAtividade.css">
 
<script type="text/javascript">
    function mostrardivinformacoes(valor) {
        if (valor === "ATIVIDADE_PESSOAFISICA_RAZAOSOCIAL") {
            document.getElementById("ATIV_PFISICA_RSOCIAL").style.display = "block";
            document.getElementById("ATIV_EMPREENDIMENTO").style.display = "none";
        } else if (valor === "ATIVIDADE_EMPREENDIMENTO") {
            document.getElementById("ATIV_EMPREENDIMENTO").style.display = "block";
            document.getElementById("ATIV_PFISICA_RSOCIAL").style.display = "none";
        }
    }
</script>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="atividade_empreendimento"><strong></strong></label><br/>
            <select name="atividade_empreendimento" id="atividade_empreendimento" class="form-control" onchange="mostrardivinformacoes(this.value)">
                <option value="">SELECIONE A CATEGORIA</option>
                <option value="ATIVIDADE_PESSOAFISICA_RAZAOSOCIAL">ATIVIDADES PARA PESSSOAS FISICAS / RAZÃO SOCIAL</option>
                <option value="ATIVIDADE_EMPREENDIMENTO">ATIVIDADES PARA EMPREENDIMENTOS</option>
            </select>
        </div>
    </div>
</div>


<div class="row" id="ATIV_PFISICA_RSOCIAL">
    
    <div class="row" style="margin-left: 1px">
        <div class="col-sm-12">
            <?php
            $sql_nivel_poluicao = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.grau_atividade FROM tb_empreendimento where grau_atividade = 'insignificante'";
            $sql_qtd = mysqli_query($con, $sql_nivel_poluicao);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="ATIVIDADE COM POTENCIAL DE POLUIÇÃO INSIGNIFICANTE"><strong>NÍVEL INSIGNIFICANTE<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_nivel_poluicao = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.grau_atividade FROM tb_empreendimento where grau_atividade = 'baixo'";
            $sql_qtd = mysqli_query($con, $sql_nivel_poluicao);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="ATIVIDADE COM POTENCIAL DE POLUIÇÃO BAIXO"><strong>NÍVEL BAIXO<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_nivel_poluicao = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.grau_atividade FROM tb_empreendimento where grau_atividade = 'medio'";
            $sql_qtd = mysqli_query($con, $sql_nivel_poluicao);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="ATIVIDADE COM POTENCIAL DE POLUIÇÃO MEDIO"><strong>NÍVEL MÉDIO<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_nivel_poluicao = "SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.grau_atividade FROM tb_empreendimento where grau_atividade = 'altoo'";
            $sql_qtd = mysqli_query($con, $sql_nivel_poluicao);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="ATIVIDADE COM NIVEL DE POLUIÇÃO ALTO"><strong>NÍVEL ALTO<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_invalidas = "SELECT * FROM  tb_empreendimento where nome_atividade !=''";
            $linhas_invalidas = mysqli_query($con, $sql_invalidas);
            $total_invalidas = mysqli_num_rows($linhas_invalidas);
            echo'<a href="#" class="btn btn-warning" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"TITLE="TOTAL DE ATIVIDADES"><strong>TOTAL<br></strong> <span class="badge">' . $total_invalidas . '</span></a>';
           
            ?>
    </div><hr>
    </div>

    <!--ESTE CSS RESPONSVEL POR AJUDAR NA INSERÇÃO DA BARRA DE ROLAGEM DA TABELA-->
    <style type="text/css">
        .table-overflow {
            max-height:400px;
            overflow-x:auto;
        }
    </style>
    <div class = "table-overflow"><br>
        <table class = "table table-striped table-hover table-bordered">
            <header>
                <tr style = "text-align: center;background-color:#67b168;color: #000000">
                    <th style = "text-align: center;font-size: 12px;">RAZÃO SOCIAL / Pª FÍSICA</th>
                    <th style = "text-align: center;font-size: 12px;">ATIVIDADE</th>                            
                    <th style = "text-align: center;font-size: 12px;">GRAU DE POLUIÇÃO</th>
                </tr>
            </header>
            <?php
            $parametro_empresa = filter_input(INPUT_GET, "parametro_empresa");


            $sql = "
                SELECT tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_atividade,tb_empreendimento.grau_atividade,tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica
                FROM 
                tb_empreendimento,tb_empresa
                WHERE
                tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa and nome_atividade !='' order by razaosocial_pessoafisica asc";
            $recebe = mysqli_query($con, $sql);

            if (mysqli_num_rows($recebe) > 0) {
                while ($linhas = mysqli_fetch_array($recebe)) {
                    $cod_atividade = $linhas['codigo_empreendimento']; //variavel pacuperar o id do empreendimento  
                    echo'<td style="font-size:12px;text-align:center">' . $linhas['razaosocial_pessoafisica'] . '</td>';
                    echo'<td style="font-size:12px;text-align:center">' . $linhas['nome_atividade'] . '</td>';
                    echo'<td style="font-size:12px;text-align:center">' . $linhas['grau_atividade'] . '</td>';
                    echo'</tr>';
                }
            } else {
                echo "<div class='alert alert-danger fade in' style='text-align:center'><strong>NENHUM RESULTADO ENCONTRADO <img src=' img/sad-face-in-rounded-square (1).png' style='margin-bottom:5px'></strong><br/><br/>";
            }
            ?>
        </table>
    </div>  
    <br><br><br>
    <?php
    require './pages/footer.php';
    ?>
</div>


<div class="row" id="ATIV_EMPREENDIMENTO">
    
    <div class="row" style="margin-left: 1px">
        <div class="col-sm-12">
            <?php
            $sql_nivel_poluicao = "SELECT tb_atividade.codigo_atividade,tb_atividade.potencial_poluidor FROM tb_atividade where potencial_poluidor = 'insignificante'";
            $sql_qtd = mysqli_query($con, $sql_nivel_poluicao);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="ATIVIDADE COM POTENCIAL DE POLUIÇÃO INSIGNIFICANTE"><strong>NÍVEL INSIGNIFICANTE<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_nivel_poluicao = "SELECT tb_atividade.codigo_atividade,tb_atividade.potencial_poluidor FROM tb_atividade where potencial_poluidor = 'baixo'";
            $sql_qtd = mysqli_query($con, $sql_nivel_poluicao);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="ATIVIDADE COM POTENCIAL DE POLUIÇÃO BAIXO"><strong>NÍVEL BAIXO<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_nivel_poluicao = "SELECT tb_atividade.codigo_atividade,tb_atividade.potencial_poluidor FROM tb_atividade where potencial_poluidor = 'medio'";
            $sql_qtd = mysqli_query($con, $sql_nivel_poluicao);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="ATIVIDADE COM POTENCIAL DE POLUIÇÃO MEDIO"><strong>NÍVEL MÉDIO<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_nivel_poluicao = "SELECT tb_atividade.codigo_atividade,tb_atividade.potencial_poluidor FROM tb_atividade where potencial_poluidor = 'alto'";
            $sql_qtd = mysqli_query($con, $sql_nivel_poluicao);
            $sql_total = mysqli_num_rows($sql_qtd);
            echo'<a href="" class="btn btn-info" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"title="ATIVIDADE COM NIVEL DE POLUIÇÃO ALTO"><strong>NÍVEL ALTO<br></strong> <span class="badge">' . $sql_total . '</span></a>';

            $sql_invalidas = "SELECT * FROM  tb_atividade";
            $linhas_invalidas = mysqli_query($con, $sql_invalidas);
            $total_invalidas = mysqli_num_rows($linhas_invalidas);
            echo'<a href="#" class="btn btn-warning" style="margin-right:2px;font-size: 15px; font-weight: bold;color:white;"TITLE="TOTAL DE ATIVIDADES"><strong>TOTAL<br></strong> <span class="badge">' . $total_invalidas . '</span></a>';
            ?>
    </div><hr>
    </div>

    <!--ESTE CSS RESPONSVEL POR AJUDAR NA INSERÇÃO DA BARRA DE ROLAGEM DA TABELA-->
    <style type="text/css">
        .table-overflow {
            max-height:400px;
            overflow-x:auto;
        }
    </style>
    <div class = "table-overflow"><br>
        <table class = "table table-striped table-hover table-bordered">
            <header>
                <tr style = "text-align: center;background-color:#67b168;color: #000000">
                    <th style = "text-align: center;font-size: 12px;">RAZÃO SOCIAL / Pª FÍSICA</th>
                    <th style = "text-align: center;font-size: 12px;">EMPREENDIMENTO</th>
                    <th style = "text-align: center;font-size: 12px;">ATIVIDADE</th>                            
                    <th style = "text-align: center;font-size: 12px;">GRAU DE POLUIÇÃO</th>

                </tr>
            </header>
            <?php
            $sql = "select tb_atividade.codigo_atividade,tb_atividade.nome_atividade,tb_atividade.potencial_poluidor,tb_empreendimento.codigo_empreendimento,tb_empreendimento.nome_empreendimento,tb_empresa.codigo_empresa,tb_empresa.razaosocial_pessoafisica
                     from
                     tb_atividade,tb_empreendimento,tb_empresa
                     where
                     tb_atividade.fk5_codigo_empreendimento = tb_empreendimento.codigo_empreendimento and tb_empreendimento.fk1_codigo_empresa = tb_empresa.codigo_empresa";

            $recebe = mysqli_query($con, $sql);

            if (mysqli_num_rows($recebe) > 0) {
                while ($linhas = mysqli_fetch_array($recebe)) {
                    $cod_atividade = $linhas['codigo_empreendimento']; //variavel pacuperar o id do empreendimento  
                    echo'<td style="font-size:12px;text-align:center">' . $linhas['razaosocial_pessoafisica'] . '</td>';
                    echo'<td style="font-size:12px;text-align:center">' . $linhas['nome_empreendimento'] . '</td>';
                    echo'<td style="font-size:12px;text-align:center">' . $linhas['nome_atividade'] . '</td>';
                    echo'<td style="font-size:12px;text-align:center">' . $linhas['potencial_poluidor'] . '</td>';
                    echo'</tr>';
                }
            } else {
                echo "<div class='alert alert-danger fade in' style='text-align:center'><strong>NENHUM RESULTADO ENCONTRADO <img src=' img/sad-face-in-rounded-square (1).png' style='margin-bottom:5px'></strong><br/><br/>";
            }
            ?>
        </table>
    </div>  
    <br><br><br>
    <?php
    require './pages/footer.php';
    ?>
</div>
