<?php
session_start();
require './config/conexao.php';

 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM tb_empresa WHERE razaosocial_pessoafisica LIKE '".$_POST["query"]."%' limit 4";  
      $result = mysqli_query($con, $query);  
      $output = '<ul class="">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["razaosocial_pessoafisica"].'</li>';  
           }  
      }  
      else  
      {  
           $output .= '<li></li>';  
      }  
      $output .= '</ul>';  
     echo $output;  
 }  

