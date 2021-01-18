<!-- Comprobar que el id del usuario esté en base de datos y todos sus parámetros -->
<?php
	session_start();

	require 'database.php';

	if (isset($_SESSION['user_id'])) {
		$records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
		$records->bindParam(':id', $_SESSION['user_id']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);

		$user = null;

		if (count($results)>0) {
			$user = $results;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Aplicación Web</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">	
</head>
<body style="background: url(img/home.jpg) no-repeat; background-size: cover;">

<?php require 'partials/header.php' ?>

<?php if(!empty($user)): ?>
<br>Bienvenido Usuario:  <?= $user['email']?>
<br>Ingresaste Satisfactoriamente.
<a href="logout.php">Salir?</a>
<?php else: ?>	


	<h1>Únete a nuestro Sitio Web y sé parte del equipo!<h1>
	<h3>Por favor, Escoge una opción:</h3> 		
	<a href="login.php">Ingresar</a> o
	<a href="signup.php">Registrarse</a>

<?php endif; ?>	
</body>
</html>