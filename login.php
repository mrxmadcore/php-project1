<!-- Requerir la conexion a base de datos y obtener  los datos de la bd, comprobando que no estén vacíos -->
<?php

	session_start();

	require 'database.php';
	if (!empty($_POST['email']) && !empty($_POST['password'])) {
	 	$records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
	 	$records->bindParam(':email', $_POST['email']);
	 	$records->execute();
	 	$results = $records->fetch(PDO::FETCH_ASSOC);

	 	$message = '';

	 	if (count($results) > 0 && password_verify($_POST['password'], $results ['password'])) {
	 		$_SESSION['user_id']= $results['id'];
	 		header('Location: /php-project');
	 	} else {
	 		$message = 'Lo sentimos, Tus credenciales no coinciden';
	 	}
	 } 	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ingresar</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background: url(img/login.jpg) no-repeat; background-size: cover;">
	 <!-- requerir header, navegación de pantallas -->
	<?php require 'partials/header.php' ?>
	 <!-- Formulario para ingresar los datos o para registrarse (signup) -->
	<h1>Ingresar</h1>
	<span>o <a href="signup.php">Registrarse</a></span>

	<?php if (!empty($message)) : ?> 
		<p><?= $message ?></p>
	<?php endif;?>	
	

	<form action="login.php" method="post">
		<input type="text" name="email" placeholder="Ingresa tu Correo">
		<input type="password" name="password" placeholder="Ingresa tu Contraseña">
		<input type="submit" value="Enviar">
		
	</form>

</body>
</html>