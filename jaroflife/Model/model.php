 <?php
 //Initialisation du PDO et récupération de la config
function initializePdo() {
	try {
	  require __DIR__.'/config.php';

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
function readAllExistingTasks() {
	$todos = [];
	$pdo_statement = prepareStatement('SELECT * FROM todos WHERE deleted_at IS NULL');

	if ($pdo_statement && $pdo_statement->execute()) {
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

//Ajout d'une nouvelle ligne dans la liste des tâches
function addNewTask($title, $description, $user_id) {
	$pdo_statement = prepareStatement(
		'INSERT INTO todos (title, description, user_id) VALUES (:title, :description, :user_id)');

	if (
	  $pdo_statement &&
	  $pdo_statement->bindParam(':title', $title) &&
	  $pdo_statement->bindParam(':description', $description) &&
	  $pdo_statement->bindParam(':user_id', $user_id) &&
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

//Modification d'une ligne de la liste des tâches      
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


