<?php
session_start();

// Verificar el rol del usuario
if ($_SESSION["rol"] !== "administrador") {
    // Si el rol no es "usuario", muestra un mensaje de error con estilo
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>CVNet Clientes</title>
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class="sb-nav-fixed">
        <div class="container">
            <div class="alert alert-danger" role="alert">
                <strong>Error:</strong> No tienes acceso a esta página.
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Configuración de la base de datos
$servername = "localhost";
$username = "root"; // Cambia "username" por el nombre de usuario real
$password = "";     // Cambia "password" por la contraseña real
$dbname = "sistema_pagos";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener la lista de usuarios con sus roles
$sql = "SELECT usuarios.usuario, usuarios.nombre, roles.rol AS rol_nombre
        FROM usuarios
        INNER JOIN roles ON usuarios.id_rol = roles.id";

// Ejecuta la consulta SQL
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>CVNet Clientes</title>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- ... tu barra de navegación ... -->
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="usuarios.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Usuarios
                        </a>
                        <a class="nav-link" href="planes.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Planes
                        </a>
                        <a class="nav-link" href="procesar_pago.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Procesar pago
                        </a>
                        <a class="nav-link" href="clientes.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Clientes
                        </a>
                        <a class="nav-link" href="historial_pagos.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Historial de pagos
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Usuarios</h1>
                    <ol class="breadcrumb mb-4">
                        <!-- ... migas de pan ... -->
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tablaUsuarios">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Nombre</th>
                                            <th>Rol</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["usuario"] . "</td>";
                                            echo "<td>" . $row["nombre"] . "</td>";
                                            echo "<td>" . $row["rol_nombre"] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
        </div>
    </div>
</body>
</html>
