<?php
    // Definir las credenciales de la base de datos
    $server = 'localhost'; // Servidor de la base de datos (puede variar según la configuración)
    $username = 'root'; // Nombre de usuario de la base de datos
    $password = ''; // Contraseña de la base de datos (en este caso, está en blanco)
    $database = 'registro_login_php'; // Nombre de la base de datos a la que se conectará

    try {
        // Crear una nueva instancia de PDO para establecer la conexión con la base de datos
        $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    } catch (PDOException $e) {
        // En caso de error en la conexión, mostrar un mensaje de error y terminar el script
        die('conection failed: ' . $e->getMessage());
    }
?>