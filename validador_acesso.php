<?php //para imprimir teste do session no valida_login
session_start();
//se for true autentica se for false volta para index
if (!isset($_SESSION['autenticado']) || $_SESSION ['autenticado'] != 'SIM')
header('Location: index.php?login=erro2'); 
?>