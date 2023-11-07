<?php
$servername = "localhost";
$username = "usarname";
$password = "password";
$dbname = "sistema_pagos";

// Crear una conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "sistema_pagos");


// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos de los planes
$sql = "SELECT * FROM paquetes";
$result = $conn->query($sql);

// Cerrar la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>CVNet Planes - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="ruta/a/font-awesome/css/all.min.css">
        

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <i class="fas fa-user fa-fw"></i>
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">CVNet</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
              
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
    <h1 class="mt-2">Planes</h1>    
    <div class="text-end mb-0">
        <a href="alta_plan.php" class="btn btn-primary">Agregar paquete</a>
    </div>
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
                                
                                    
                                </nav>
                                </div>
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
                    <div class="sb-sidenav-footer">
                        </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <body class="sb-nav-fixed">
    <!-- ... tu navegación y contenido principal ... -->
    <div class="container-fluid px-4">
        <h1 class="mt-4">Lista de paquetes</h1>
        <h3 class= "mt-4"> Paquetes de internet residencial</h3>
        
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Paquetes</th>
                                <th>Precio</th>                                
                                <th>Velocidad de subida</th>
                                <th>Velocidad de bajada</th>
                                <!-- Agrega más encabezados según los campos de la tabla -->
                                </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Iterar a través de los resultados de la consulta y mostrar los datos en la tabla
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["paquete"] . "</td>";
                                echo "<td>" . $row["precio"] . "</td>";
                                echo "<td>" . $row["velocidad_subida"] . "</td>";
                                echo "<td>" . $row["velocidad_bajada"] . "</td>";
                                // Agrega más celdas según los campos de la tabla
                                echo "</tr>";
                            }
                            ?>
                            
                            
                                             
                        </tbody>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                        
                            </div>
                        </div>
                    </div>
                </main>
              
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="assets/demo/chart-pie-demo.js"></script>
    </body>
</html>
