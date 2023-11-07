<?php
// Conexión a la base de datos (ya tienes esta parte)
$conn = new mysqli("localhost", "root", "", "sistema_pagos");

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn = new mysqli("localhost", "root", "", "sistema_pagos");



// Variables para almacenar los datos seleccionados y mensajes de éxito/error
$nombre = "";
$telefono = "";
$tel_adicional = "";
$direccion = "";
$coordenadas = "";
$fechainicio= "";
$ip = "";
$mensaje = "";

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores seleccionados del formulario
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $tel_adicional = $_POST["tel_adicional"];
    $direccion = $_POST["direccion"];
    $coordenadas = $_POST["coordenadas"];
    $fechainicio = $_POST["inicio"];
    $ip = $_POST["ip"];

    // Realizar la inserción en la tabla "clientes"
    $sql = "INSERT INTO clientes (nombre, telefono,tel_adicional, direccion, coordenadas, inicio, paquete, ip) VALUES ('$nombre', '$telefono','$tel_adicional', '$direccion','$coordenadas','$fechainicio', '$paquete', '$ip')";
    if ($conn->query($sql) === TRUE) {
        $mensaje = "Cliente registrado con éxito.";
    } else {
        $mensaje = "Error al registrar el cliente: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
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
        <link rel="stylesheet" href="ruta/a/font-awesome/css/all.min.css">

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Incluye jQuery (requerido por jQuery UI Datepicker) desde un CDN -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Incluye jQuery UI (incluye el Datepicker) desde un CDN -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


       

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">CVNet</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                <i class="fas fa-user fa-fw"></i>
                    
                    
                </div>
            </form>
        
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-2 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Configuracion</a></li>
                        <li><a class="dropdown-item" href="#!">Actividad</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="home.php">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="container-fluid px-3">
    <h1 class="mt-2">Clientes</h1>    
    
</div>
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
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Procesar pago                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        pagos y servicios
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                     
                                </nav>
                            </div>
                                <a class="nav-link" href="clientes.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Clientes
                            </a>
                            <a class="nav-link" href="tables.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Historial de pagos
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        </nav>
                                </div>
                                <div id="layoutSidenav_content">
                                    <main>
                                    <h1 class="mt-4">Registro de cliente</h1>
                        <div class="card mb-4"> 
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="mb-3">
                                    <div class="mb-3">
                            <!-- Mostrar el mensaje de éxito/error solo si la variable $mensaje no está vacía -->
                    <?php if (!empty($mensaje)): ?>
                        <div class="alert <?php echo ($mensaje ? 'alert-success' : 'alert-danger'); ?>">
                            <?php echo $mensaje; ?>
                        </div>
                    <?php endif; ?>

                        </div>
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                <label for="telefono" class="form-label">Número de Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" pattern="[0-9]+" title="Ingresa solo números" minlength="10" maxlength="10" required>
                </div>
                <div class="mb-3">
                    <label for="tel_adicional" class="form-label">Número de Teléfono adicional</label>
                    <input type="tel" class="form-control" id="tel_adicional" name="tel_adicional" pattern="[0-9]+" title="Ingresa solo números" minlength="10" maxlength="10" required>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>

                <div class="mb-3">
                    <label for="inicio" class="form-label">Fecha de inicio</label>
                    <input type="text" class="form-control" id="inicio" name="inicio" data-toggle="datepicker" required>
                </div>

                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección IP</label>
                    <input type="text" class="form-control" id="ip" name="ip" required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Coordenadas</label>
                    <input type="text" class="coordenadas" id="coordenadas" name="coordenadas" required>
                </div>                            
                                            
                </select>
                <button type="submit" class="btn btn-primary">Registrar Cliente</button>

                </form>
                            <script> 
                        // Inicializa el selector de fechas
                        $('[data-toggle="datepicker"]').datepicker();
                        </script>
                           </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                    </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            
                         </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="assets/demo/chart-pie-demo.js"></script>
        <script>
    $(function() {
        $("#inicio").datepicker();
    });
</script>

    </body>
</html>
