<?php

session_start ();


require __DIR__.'/Model/model.php';

if (isset($_SESSION['userid'])) {

	$todos = readAllExistingTasks($_SESSION['userid']);

	if (isset($_SESSION['login'], $_SESSION['pwd'])) {
		echo "<p class='font_color'>";
		echo 'Vous êtes connecté. Votre nom d\'utilisateur est '. $_SESSION['login'].'.';
		echo '<br />';
		echo '<a href="./logout.php">Déconnection de la session</a>';
		echo '<a href="./delete_user.php">Suppression de la session</a>';
		echo '</p>';
	} 

	else {
		echo "<p class='font_color'>";
		echo 'Merci de remplir les champs nom d\'utilisateur et mot de passe.';
		echo '<br />';
		echo '<a href="./index.html">Retour à l\'acceuil</a>';
		echo '</p>';
	}
}

require __DIR__.'/View/browseview.php';
