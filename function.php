
<?php

require './config/conexao.php';

function retorna($numero_notificacao,$con) {
    $resultado = "SELECT *FROM tb_notificacao WHERE numero_notificacao = '$numero_notificacao' LIMIT 1";
    $recebe_resultado = mysqli_query($con, $resultado);
    
    if ($recebe_resultado->num_rows) {
        $row_encontrada = mysqli_fetch_assoc($recebe_resultado);
       
        $valores ['descricao_prazo'] = $row_encontrada['descricao_prazo'];
        $valores ['profissao_atividade'] = $row_encontrada['profissao_atividade'];
         $valores ['status_informacoes_adicionais'] = $row_encontrada['status_informacoes_adicionais'];
         $valores ['numero_notificacao_anterior'] = $row_encontrada['numero_notificacao_anterior'];
         $valores ['numero_processo_notificacao'] = $row_encontrada['numero_processo_notificacao'];
         $valores ['status_licenca'] = $row_encontrada['status_licenca'];
         $valores ['numero_licenca_notificacao'] = $row_encontrada['numero_licenca_notificacao'];
         $valores ['orgao_emissor_licenca'] = $row_encontrada['orgao_emissor_licenca'];
        
        
        
    } else {
        $valores ['profissao_atividade'] = 'empresa não encontrada';
    }
    
    return json_encode($valores);
}

    if (isset($_GET['numero_notificacao'])) {
        echo retorna($_GET['numero_notificacao'],$con);
    }

