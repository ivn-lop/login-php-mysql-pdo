<?php
// Iniciar o reanudar la sesión
session_start();

// Destruir la sesión
session_destroy();

// Redireccionar a index.php
header('Location: index.php');
exit();
?>