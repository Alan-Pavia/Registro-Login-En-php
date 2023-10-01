<?php
require 'database.php';

// Variable para almacenar mensajes informativos o de error
$message = '';

// Verificar si se enviaron datos del formulario (email y password)
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    // Consulta SQL para insertar un nuevo usuario en la base de datos
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);

    // Vincular los valores de email y contraseña desde el formulario
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash de la contraseña
    $stmt->bindParam(':password', $password);

    // Ejecutar la consulta SQL para insertar el nuevo usuario
    if ($stmt->execute()) {
        $message = 'Successfully created new user'; // Mensaje de éxito
    } else {
        $message = 'Sorry there must have been an issue creating your account';
        // Mensaje de error
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>

    <form action="signup.php" method="post">
        <input type="text" name="email" placeholder="Enter your Email">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="password" name="confirm_password" placeholder="Confirm your password">
        <input type="submit" value="send">
    </form>

    <span>or <a href="login.php">Login</a></span>

</body>
</html>