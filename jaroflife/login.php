<?php
//Données brutes
$login_valide = "kevin";
$pwd_valide = "azerty12";


if (isset($_POST['login'], $_POST['pwd'])) {
	$login = $_POST['login'];
	$password = $_POST['pwd'];

	if ($login_valide == $login && $pwd_valide == $password) {
		session_start ();
		$_SESSION['login'] = $login;
		$_SESSION['pwd'] = $password;
		header ('location: browse.php');
	} else {
		echo '<body onLoad="alert(\'Membre non reconnu...\')">';
		//echo '<meta http-equiv="refresh" content="0;URL=index.html">';
		header ('location: index.html');
	}
} else {
	echo 'Veuillez entrer un nom d\'utilisateur et un mot de passe.';
}