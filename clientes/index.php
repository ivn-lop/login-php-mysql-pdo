<?php

session_start();


if (!isset($_SESSION['usuario'])) {
    print"Primero debes iniciar sesión";
    exit();
}


if ($_SESSION['usuario']['utipo'] != '1') {
    print"No tiene el perfil para ver esta pagina";
    exit();
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de Estudiante</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Proyecto SENA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../salir.php">Salir</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Contenido Principal -->
<div class="alert alert-primary" role="alert">
    <p class="lead">¡Hola, <b> <?php print_r( $_SESSION['usuario']); ?>!</b> Bienvenido</p>
</div>


<div class="container text-center">
  <div class="row">
    <p>Bienvenido</p>
  </div>



<!-- Scripts de Bootstrap y jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>