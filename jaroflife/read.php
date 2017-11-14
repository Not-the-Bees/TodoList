<?php
session_start();

require __DIR__.'/Model/model.php';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$todo = readSelectedTask($id);
}

require __DIR__.'/View/readview.php';
