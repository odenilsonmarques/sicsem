<?php 

require './config/conexao.php';

if(isset($_POST['search'])){
    $search = $_POST['search'];

    $query = "SELECT * FROM tb_processo WHERE numero_processo like '$search%'";
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_array($result) ){
        
        $response[] = array("value"=>$row['numero_processo'],"label"=>$row['numero_processo']);
    }
    echo json_encode($response);
}
exit;


