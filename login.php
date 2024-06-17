<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <?php
                        // Archivo de conexión (conexion.php)
                        include 'conexion.php';

                        // Verificar si se ha enviado el formulario
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            // Recuperar los datos del formulario
                            $us = $_POST['usuario'];
                            $pas = $_POST['contrasena'];

                            // Consulta actualizada para usar solo la tabla `usuarios`
                            $consulta = $conexion->prepare(
                                "SELECT unombre, upass, utipo
                                FROM usuarios
                                WHERE unombre = :unombre"
                            );

                            $consulta->bindParam(':unombre', $us);
                            $consulta->execute();

                            // Verificar si las credenciales son correctas
                            if ($consulta->rowCount() > 0) {
                                $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

                                // Verificar la contraseña usando password_verify
                                if (password_verify($pas, $usuario['upass'])) {
                                    session_start();
                                    $_SESSION['usuario'] = $usuario;
                                    header('Location: clientes/index.php');
                                } else {
                                    // Contraseña incorrecta
                                   ?>
                                    <div class="alert alert-danger" role="alert">
                                        ¡Contraseña incorrecta!
                                    </div>
                                <?php
                                }
                            } else {
                                // Usuario no encontrado
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    ¡Usuario no encontrado!
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <form method="post">

                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" value="" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            <div class="form-group">
                                <label for="contrasena">Contraseña</label>
                                <input type="password" value="" class="form-control" id="contrasena" name="contrasena" required>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                                <a href="index.php" class="btn btn-warning">Volver a Inicio</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>