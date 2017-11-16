 <?php
 //Initialisation du PDO et récupération de la config
function initializePdo() {
	try {
	  require __DIR__ . '/config.php';

	  $pdo = new PDO(
	    "mysql:dbname=$dbname;host=$host;charset=utf8", $user, $password
	  );
	} catch (PDOException $e) {
	  echo 'erreur : ' . $e->getMessage();
	  $pdo = null;
	}
	return $pdo;
}

//Préparation de la requête SQL
function prepareStatement($sql) {
	$pdo_statement = null;
	$pdo = initializePdo();

	if ($pdo) {
		try {
		  $pdo_statement = $pdo->prepare($sql);
		} catch (PDOException $e) {
		  echo 'erreur : ' . $e->getMessage();
		}
	}
	return $pdo_statement;
}

//Récupération de la liste des tâches
function readAllExistingTasks($userid) {
	$todos = [];
	$pdo_statement = prepareStatement('SELECT * FROM todos WHERE deleted_at IS NULL AND userid=:userid');

	if ($pdo_statement && 
		$pdo_statement->bindParam(':userid', $userid, PDO::PARAM_INT) &&
		$pdo_statement->execute()) {
		$todos = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
	}
	return $todos;
}

//Récupération d'une ligne de la liste des tâches
function readSelectedTask($id) {
	$todo = null;
	$pdo_statement = prepareStatement('SELECT * FROM todos WHERE id=:id');

	if (
  	$pdo_statement &&
  	$pdo_statement->bindParam(':id', $id, PDO::PARAM_INT) &&
  	$pdo_statement->execute()
	) {
  	$todo = $pdo_statement->fetch(PDO::FETCH_ASSOC);
	}
  return $todo;
}

//Ajout d'une nouvelle ligne dans la liste des tâches et un niveau de priorité 
function addNewTask($title, $description, $userid) {
	$pdo_statement = prepareStatement(
		'INSERT INTO todos (title, description, userid) VALUES (:title, :description, :userid)');

	if (
	  $pdo_statement &&
	  $pdo_statement->bindParam(':title', $title) &&
	  $pdo_statement->bindParam(':description', $description) &&
	  $pdo_statement->bindParam(':userid', $userid) &&
	  $pdo_statement->execute()
	 ) {
	 	return $pdo_statement;
   }  
}

//Suppression d'une ligne de la liste des tâches
function deleteSelectedTask($id) {
	$pdo_statement = prepareStatement('UPDATE todos SET deleted_at = CURRENT_TIMESTAMP() WHERE id=:id');
	if (
    !$pdo_statement ||
    !$pdo_statement->bindParam(':id', $id, PDO::PARAM_INT) ||
    !$pdo_statement->execute()
  ) {
    return $pdo_statement;
  }
}


//Modification d'une activité de la liste des tâches ainsi que son niveau de priorité (WIP)   
function editSelectedTask($id, $title, $description) {
	$todo = null;
	$pdo_statement = prepareStatement('UPDATE todos SET title=:title, description=:description WHERE id=:id');
	if (
	  $pdo_statement &&
	  $pdo_statement->bindParam(':id', $id, PDO::PARAM_INT) &&
	  $pdo_statement->bindParam(':title', $title) &&
	  $pdo_statement->bindParam(':description', $description) &&
	  $pdo_statement->execute()
	) {
	  $todo = $pdo_statement->fetch(PDO::FETCH_ASSOC);
	  return $todo;
	}
}
/* pour l'ajout de piorité : 
	-ajouter une variable $priority et la lier à la colonne priority_level de la BDD
	-rajouter une limite dans les niveaux de priorité (allant de 1->plus haute à 5->plus basse)
	-ajouter un code couleur via les alertes twitter bootstrap (1-> rouge,2-> orange, 3-> vert)
*/
//Rajout d'une fonction permettant d'accéder/voir les activités supprimées/terminées ?


function connectMember($login, $password) {
	
	$pdo_statement = prepareStatement('SELECT * FROM user WHERE login=:login AND password=:password');

	$pdo_statement->execute(array('login' => $login,
    'password' => $password));

	$result = $pdo_statement->fetch();

	return $result;
}