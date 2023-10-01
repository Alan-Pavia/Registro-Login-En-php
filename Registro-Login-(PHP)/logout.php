<?php
  // Iniciar la sesión o reanudarla si ya existe
  session_start();

  // Eliminar todas las variables de sesión
  session_unset();

  // Destruir la sesión
  session_destroy();

  // Redireccionar al usuario a la página principal después de cerrar sesión
  header('Location: /Registro-login-(PHP)');
?>