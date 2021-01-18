<!-- Requerir conexion a la base de datos -->
<?php
	require 'database.php';

	// variable global
	$message = '';
// metodo de validación para registrar campos nuevos

if (!empty($_POST['email'])&& !empty($_POST['password'])) {
		$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':email',$_POST['email']);
		$password=password_hash($_POST['password'], PASSWORD_BCRYPT);
		$stmt->bindParam(':password',$password);

		// método validación para la creación de usuarios
		if ($stmt->execute()) {
			$message='Creaste un Usuario Satisfactoriamente';
		}	else {	
			$message='Lo sentimos! Pero hubo un problema creando tu Usuario';
		}
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registrarse</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background: url(img/signin.jpg) no-repeat; background-size: cover;">
	<!-- requerir header, navegación de pantallas -->
	<?php require 'partials/header.php' ?>
	<!-- Formulario para registrar los datos o para ingresar(login) -->

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>
		
	<h1>Registrarse</h1>
	<span>o <a href="login.php">Ingresar</a></span>

	<form action="signup.php" method="post">
		<input type="text" name="email" placeholder="Ingresa tu Correo">
		<input type="password" name="password" placeholder="Crea una Contraseña">
		<input type="password" name="confirm_password" placeholder="Confirma tu Contraseña">
		<input type="submit" value="Enviar">
		
	</form>
</body>
</html>



