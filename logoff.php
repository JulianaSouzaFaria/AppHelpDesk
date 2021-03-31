<?php
session_start(); //inicia a sessao
session_destroy(); //destroi as sessoes
header('Location:index.php'); //força recarregar pagina para realmente apagar dados e fazer logoff


?>