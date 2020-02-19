<?php

require './config/conexao.php';

if (isset($_POST['search'])) {
    $search = $_POST['search'];

    $query = "SELECT * FROM tb_empresa WHERE razaosocial_pessoafisica like '$search%' limit 5";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {

            $empresa = $row['codigo_empresa'];

            $response[] = array("value" => $row['razaosocial_pessoafisica'], "label" => $row['razaosocial_pessoafisica']);
        }


      echo json_encode($response);

    }
}
exit;
