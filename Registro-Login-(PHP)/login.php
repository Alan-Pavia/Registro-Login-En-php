<?php
    // Iniciar la sesión o reanudarla si ya existe
    session_start();

    // Redireccionar al usuario a la página principal si ya ha iniciado sesión
    if (isset($_SESSION['user_id'])) {
        header('Location: /Registro-login-(PHP)');
    }

    // Incluir el archivo de conexión a la base de datos
    require 'database.php';

    // Verificar si se enviaron datos del formulario (email y password)
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        // Preparar una consulta SQL para seleccionar información del usuario por correo electrónico
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        // Variable para almacenar mensajes informativos o de error
        $message = '';

        // Verificar si se obtuvieron resultados de la consulta y si la contraseña coincide
        if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
            
            // Iniciar sesión para el usuario
            $_SESSION['user_id'] = $results['id'];
            header("Location: /Registro-login-(PHP)");// Redireccionar al usuario a la página principal
        } else {
            $message = 'Sorry, those credentials do not match';// Mensaje de error si las credenciales no coinciden
        }
    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php require 'partials/header.php' ?>

    <?php if (!empty($message)): ?>
        <p>
            <?= $message ?>
        </p>
    <?php endif; ?>

    <h1>Login</h1>
    
    <form action="login.php" method="POST">
        <input name="email" type="text" placeholder="Enter your email">
        <input name="password" type="password" placeholder="Enter your Password">
        <input type="submit" value="Submit">
    </form>
    <span>or <a href="signup.php">SignUp</a></span>
</body>

</html>