<?php
include 'conexion.php';

$exitoMensaje = $errorMensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener datos del formulario
    $usuario = $_POST['unombre'];
    $password = $_POST['upass'];
    $tipo = $_POST['utipo'];


    $sqlVerificarUsuario = "SELECT unombre FROM usuarios WHERE unombre = :usuario";
    $stmtVerificarUsuario = $conexion->prepare($sqlVerificarUsuario);
    $stmtVerificarUsuario->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmtVerificarUsuario->execute();

    if ($stmtVerificarUsuario->rowCount() > 0) {
        $errorMensaje = "El nombre de usuario ya está en uso. Por favor, elija otro.";
    } else {
        // Hashear la contraseña
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);

        // Insertar datos en la tabla usuarios
        $sqlInsertarUsuario = "INSERT INTO usuarios (unombre, upass, utipo) VALUES (:usuario, :password, :tipo)";
        $stmtInsertarUsuario = $conexion->prepare($sqlInsertarUsuario);
        $stmtInsertarUsuario->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmtInsertarUsuario->bindParam(':password', $passwordHashed, PDO::PARAM_STR);
        $stmtInsertarUsuario->bindParam(':tipo', $tipo, PDO::PARAM_STR);

        if ($stmtInsertarUsuario->execute()) {
            $exitoMensaje = "Registro exitoso. Ahora puedes iniciar sesión.";
        } else {
            $errorMensaje = "Error al registrar el usuario. Por favor, inténtalo de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Registro</div>
                    <div class="card-body">
                        <?php if ($exitoMensaje): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $exitoMensaje; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($errorMensaje): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $errorMensaje; ?>
                            </div>
                        <?php endif; ?>

                        <form method="post">
                            <div class="form-group">
                                <label for="unombre">Nombre de Usuario:</label>
                                <input type="text" class="form-control" id="unombre" name="unombre" required>
                            </div>
                            <div class="form-group">
                                <label for="upass">Contraseña:</label>
                                <input type="password" class="form-control" id="upass" name="upass" required>
                            </div>
                            <div class="form-group">
                                <label for="utipo">Tipo de Usuario:</label>
                                <input type="text" class="form-control" id="utipo" name="utipo" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                            <p class="mt-3">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a>.</p>
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

<?php
// Cerrar la conexión
$conexion = null;
?>