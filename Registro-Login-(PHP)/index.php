<?php
// Iniciar la sesión o reanudarla si ya existe
session_start();

// Incluir el archivo de conexión a la base de datos
require 'database.php';

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['user_id'])) {
     // Preparar una consulta SQL para seleccionar información del usuario
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    // Verificar si se obtuvieron resultados de la consulta
    if (count($results) > 0) {
        $user = $results;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to your App</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php require 'partials/header.php' ?>

    <?php if (!empty($user)): ?>
        <br> Welcome.
        <?= $user['email']; ?>
        <br>You are Successfully Logged In
        <a href="logout.php">
            Logout
        </a>
    <?php else: ?>
        <h1>Please Login or SignUp</h1>

        <a href="login.php">Login</a> or
        <a href="signup.php">SignUp</a>
    <?php endif; ?>
</body>

</html>