<?php
 session_start();
 session_destroy();
 header("location:login.php");
 unset($_SESSION['controle_de_abas']);
 header("cad_licenca.php");
 
 
 
