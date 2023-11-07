<?php
session_start();

// Comprobar si el usuario ya ha iniciado sesión, si es así, redirigirlo a la página de inicio
if (isset($_SESSION["usuario"])) {
    header("Location: home.php");
    exit; // Asegurarse de que el script se detenga después de la redirección
}

$error_message = ""; // Inicializar la variable de mensaje de error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    // Conectar a la base de datos
    $conn = new mysqli("localhost", "root", "", "sistema_pagos");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contraseña = '$contraseña'";

    $result = $conn->query($query);
    // Después de verificar las credenciales y antes de redirigir
if ($result->num_rows == 1) {
    // Obtén el rol del usuario desde la base de datos o de donde lo tengas
    $row = $result->fetch_assoc();
    $_SESSION["nombre"] = $usuario;
    $_SESSION["rol"] = $row["rol"]; 
    header("Location: home.php");
    exit;
}

    if ($result->num_rows == 1) {
        $_SESSION["usuario"] = $usuario;
        header("Location: home.php");
        exit;
    } else {
        $error_message = "Usuario o contraseña incorrecta";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="css/styles1.css">
</head>
<body>

<div class="container">
  <img src="imagenes/logo.png" alt="Logo de la empresa" class="logo">
  <h2>Iniciar sesión</h2>
  <?php if (isset($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>
  <form method="post" action="clientes.php">
    <label for="usuario">Usuario:</label>
    <input type="text" name="usuario" required>
    <label for="contraseña">Contraseña:</label>
    <input type="password" name="contraseña" required> 
    <input type="submit" value="Iniciar sesión">
  </form>
</div>
<img src="imagenes/wave.png" class="wave">

</body>
</html>