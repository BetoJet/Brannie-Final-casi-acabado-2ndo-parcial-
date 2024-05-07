<?php
include "com.php"; 

$sql = "SELECT id, Nombre, Descrpition, Price FROM producto";
$result = $com->query($sql);


$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT id, Nombre, Descrpition, Price FROM producto";

if ($search) {
   
    $sql .= " WHERE Nombre LIKE '%" . $com->real_escape_string($search) . "%'";
}

$result = $com->query($sql);








?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    
    <style>body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
h1 {
            color: #333;
        }
.producto {
            border: 1px solid #ccc;
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

 .producto h2 {
            margin-top: 0;
        }

.producto p {
            color: #666;
            line-height: 1.5;
        }

.producto .acciones {
            margin-top: 10px;
        }
.boton {
            background-color: #333;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin-right: 10px;
        }
.boton:hover {
            background-color: #555;
        }

.boton-regresar {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            margin-top: 20px;
        }
.boton-regresar:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Lista de Productos</h1>
    <form method="GET">
        <input type="text" name="search" placeholder="Buscar producto...">
        <button type="submit" class="boton">Buscar</button>
    </form>

<a href="ProductoAdmin.html"><button class="boton-regresar">Regresar</button></a>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
echo "<div class='producto'>";
echo "<h2>" . htmlspecialchars($row["Nombre"]) . "</h2>";
echo "<p>Descripción: " . htmlspecialchars($row["Descrpition"]) . "</p>";
echo "<p>Precio: $" . number_format($row["Price"], 2) . "</p>";
echo "<div class='acciones'>";
echo "<a class='boton' href='edit_product.php?id=" . htmlspecialchars($row["id"]) . "'>Editar</a>";
echo "<a class='boton' href='delete_product.php?id=" . htmlspecialchars($row["id"]) . "'>Eliminar</a>";
echo "</div>";

echo "</div>";
        }
    } else {
echo "<p>No hay productos registrados.</p>";
    }
    $com->close();
    ?>
</body>
</html>
