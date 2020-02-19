<?php

session_destroy();
session_start();
unset($_SESSION['controle_de_abas']);
header("Location:cad_licenca.php");
