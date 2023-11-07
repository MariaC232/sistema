<?php
// Conexión a la base de datos (misma configuración que en tu archivo original)
$conn = new mysqli("localhost", "root", "", "sistema_pagos");

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se envió un formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["busqueda"])) {
    // Obtener el término de búsqueda del formulario
    $termino_busqueda = $_POST["busqueda"];

    // Consulta SQL para buscar clientes que coincidan con el término de búsqueda
    $sql = "SELECT clientes.id, clientes.nombre, clientes.telefono, clientes.direccion, clientes.inicio, paquetes.paquete
            FROM clientes
            LEFT JOIN paquetes ON clientes.paquete = paquetes.id
            WHERE clientes.nombre LIKE '%$termino_busqueda%'
            OR clientes.telefono LIKE '%$termino_busqueda%'
            OR clientes.direccion LIKE '%$termino_busqueda%'";
    
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... Tu código de encabezado HTML ... -->
</head>
<body>
    <!-- ... Tu contenido HTML antes de la tabla de resultados ... -->

    <?php
    // Comprobar si la consulta SQL se ejecutó correctamente
    if ($result) {
        if ($result->num_rows > 0) {
            // Hay resultados para mostrar
            echo '<div class="container-fluid px-4">';
            echo '<h1 class="mt-4">Resultados de la Búsqueda</h1>';
            echo '<div class="card mb-4">';
            echo '<div class="card-body">';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Nombre</th>';
            echo '<th>Teléfono</th>';
            echo '<th>Domicilio</th>';
            echo '<th>Fecha de ingreso</th>';
            echo '<th>Plan contratado</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            // Iterar a través de los resultados y mostrar los datos en la tabla
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td>' . $row["nombre"] . '</td>';
                echo '<td>' . $row["telefono"] . '</td>';
                echo '<td>' . $row["direccion"] . '</td>';
                echo '<td>' . $row["inicio"] . '</td>';
                echo '<td>' . $row["paquete"] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        } else {
            // No se encontraron resultados
            echo '<div class="container-fluid px-4">';
            echo '<h1 class="mt-4">Resultados de la Búsqueda</h1>';
            echo '<p>No se encontraron resultados para la búsqueda: ' . htmlspecialchars($termino_busqueda) . '</p>';
            echo '</div>';
        }
    } else {
        // Hubo un error en la consulta SQL
        echo '<div class="container-fluid px-4">';
        echo '<h1 class="mt-4">Error de Búsqueda</h1>';
        echo '<p>Ocurrió un error al buscar clientes.</p>';
        echo '</div>';
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
    ?>

    <!-- ... Tu contenido HTML después de la tabla de resultados ... -->

    <!-- ... Tus scripts y archivos JavaScript ... -->
</body>
</html>

