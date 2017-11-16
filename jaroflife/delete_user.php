<?php

session_start();

require __DIR__.'/Model/model.php';

if (isset($_SESSION['userid'])) {
	$userid = $_SESSION['userid'];

  if (deleteMember($userid)) {
  	header('Location: logout.php');
  	exit;
	}
}