<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_pagos";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (isset($_GET['eliminar'])) {
    // Obtener el ID del registro a eliminar desde la URL
    $idAEliminar = intval($_GET['eliminar']);

    // Realizar la eliminación del registro
    $sqlEliminar = "DELETE FROM clientes WHERE id = $idAEliminar";
    if ($conn->query($sqlEliminar) === TRUE) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    // Obtener el ID del último registro insertado automáticamente después de la eliminación
    $idUltimoRegistro = mysqli_insert_id($conn);

    // Actualizar el valor del ID de todos los registros restantes
    $sqlActualizarID = "SET @num := 0; UPDATE clientes SET id = @num := (@num+1);";
    if ($conn->query($sqlActualizarID) === TRUE) {
        echo "IDs actualizados correctamente.";
    } else {
        echo "Error al actualizar los IDs: " . $conn->error;
    }
}

// Consulta SQL para obtener los datos de los clientes y el nombre del paquete contratado
$sql = "SELECT clientes.id, clientes.nombre, clientes.telefono,clientes.tel_adicional, clientes.direccion, clientes.coordenadas, clientes.inicio, paquetes.paquete, clientes.ip
        FROM clientes
        LEFT JOIN paquetes ON clientes.paquete = paquetes.id";
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
        <title>CVNet Clientes</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="ruta/a/font-awesome/css/all.min.css">


    </head>
    
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- ... tu barra de navegación ... -->
    </nav>
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
    <h1 class="mt-2">Clientes</h1>    
    <div class="text-end mb-0">
        <a href="alta_cliente.php" class="btn btn-primary">Agregar Cliente</a>
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
                    <body class="sb-nav-fixed">
    <!-- ... tu navegación y contenido principal ... -->
    <div class="container-fluid px-4">
    <h1 class="mt-4">Clientes</h1>
  
        
    <div class="row mb-3">
        <div class="col-lg-5">
            <form action="buscar_cliente.php" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar cliente por nombre, teléfono, dirección, etc." name="busqueda" />
                    <button class="btn btn-primary" type="submit">Buscar</button>

    </div>
    <div id="layoutSidenav">

                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive mx-auto"> <!-- Agregado mx-auto para centrar -->
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Teléfono adicional</th>
                    <th>Domicilio</th>
                    <th>Coordenadas</th>
                    <th>Fecha de ingreso</th>
                    <th>Plan contratado</th>
                    <th>Dirección IP</th>
                    <th>Acciones</th> <!-- Agregamos una columna para acciones -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Iterar a través de los resultados de la consulta y mostrar los datos en la tabla
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["telefono"] . "</td>";
                    echo "<td>" . $row["tel_adicional"] . "</td>";
                    echo "<td>" . $row["direccion"] . "</td>";
                    echo "<td>" . $row["coordenadas"] . "</td>";
                    echo "<td>" . $row["inicio"] . "</td>";
                    echo "<td>" . $row["paquete"] . "</td>";
                    echo "<td>" . $row["ip"] . "</td>";
                    echo '<td style="text-align: center;"><a href="?eliminar=' . $row["id"] . '" style="margin-right: 10px;"><i class="fas fa-trash-alt"></i> Eliminar</a>
    <a href="editar_cliente.php?id=' . $row["id"] . '" style="margin-left: 10px;"><i class="fas fa-edit"></i> Editar</a>
</td>';
                   
                }
                ?>
            </tbody>
        </table>
                </div>
            </div>
        </main>
        <footer class="py-1 bg-light mt-auto">
            <div class="container-fluid px-1">
                <div class="d-flex align-items-center justify-content-between small">
                    <!-- ... tu pie de página ... -->
                </div>
            </div>
        </footer>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="assets/demo/chart-pie-demo.js"></script>
    </body>
</html>
