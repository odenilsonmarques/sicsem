<?php 

require './config/conexao.php';

if(isset($_POST['search'])){
    $search = $_POST['search'];

//    $query = "SELECT * FROM tb_cnae WHERE atividade like '$search%'";
// $query = "SELECT  nome_atividade FROM tb_empreendimento WHERE nome_atividade like '%$search%' UNION ALL SELECT nome_atividade FROM tb_atividade WHERE nome_atividade like '%$search%'";
 $query = "SELECT  nome_atividade FROM tb_empreendimento WHERE nome_atividade like '$search%' LIMIT 5  UNION ALL SELECT nome_atividade FROM tb_atividade WHERE nome_atividade like '$search%' LIMIT 5 ";
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_array($result) ){
//        $response[] = array("value"=>$row['atividade'],"label"=>$row['atividade']);
        $response[] = array("value"=>$row['nome_atividade'],"label"=>$row['nome_atividade']);
        
    }

    echo json_encode($response);
}

exit;


