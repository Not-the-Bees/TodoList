<?php

require __DIR__.'/Model/model.php';

$todo = addNewTask($_POST['title'], $_POST['description'], $_SESSION['userid']);

if ($todo) {
	header('Location:browse.php');
	exit;
}

require __DIR__.'/View/addview.php';