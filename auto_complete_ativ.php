<?php 

require './config/conexao.php';

if(isset($_POST['search'])){
    $search = $_POST['search'];

    $query = "SELECT * FROM tb_cnae WHERE atividade like '$search%'";
    $result = mysqli_query($con,$query);
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['atividade'],"label"=>$row['atividade']);
    }
    echo json_encode($response);
}
exit;


