<?php

session_start();

print_r($_SESSION);

$usuario_autenticado = false; //por default é falso, se nao entra na funçao
$usuario_id = null; //a principio usuarios serao null, até serem verificados
$usuario_perfil_id = null;
//criar indices para validar. administrativo pode ver tudo. usuario vê só o que é dele
$perfis = array(1 => 'Administrativo', 2 => 'usuário');

$usuarios_app = array( //cria array com varias arrays com dados de usuarios
	array('id' = 1, 'email' => 'adm@teste.com.br', 'senha' => '1234', 'perfil_id' =>1),
	array('id' = 2, 'email' => 'teste@teste.com.br', 'senha' => '1234', 'perfil_id' =>1),
	array('id' = 3, 'email' => 'jose@teste.com.br', 'senha' => '1234', 'perfil_id' =>2),
	array('id' = 4, 'email' => 'maria@teste.com.br', 'senha' => '1234', 'perfil_id' =>2),
);


foreach ($usuarios_app as $user) { //percorre a array mae e vai atribuindo valor encontrado ao $user
	if ($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']) {
		$usuario_autenticado = true;
		$usuario_id = $user['id'];
		$usuario_perfil_id = $user['perfil_id'];
	}
}

if ($usuario_autenticado) {
	echo 'Usuário autenticado';
	$_SESSION['autenticado'] = 'SIM';
	$_SESSION['id'] = $usuario_id;
	$_SESSION['perfil_id'] = $usuario_perfil_id;
	header('Location: home.php'); //se tiver tudo ok vai pra pagina home
}
	else {
		$_SESSION['autenticado'] = 'NAO';
		header('Location: index.php?login=erro'); //se tiver erro vai retornar para a pagina index
	}

?>