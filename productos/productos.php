<?php

include('../conexion/conexion.php');

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Consultamos a la base de datos
$query = $conexion->prepare("SELECT idProducto, nombre, descripcion, stock, precioVenta FROM producto");
if (!$query) {
    die('Error en la consulta: ' . $conexion->error);
}


$query->execute();
$resultado = $query->get_result();

// Cerramos la conexión a la base de datos
desconectar($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body class="bg-secondary" >
<section class="content">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row"> 
            <div class="col-md-10"></div>
            <div class="col-md-12">
                <div class="card bg-primary text-center text-white">
                        <h3>Productos</h3>
                        <a href="agregar.html"><h3 class="text-white">Registrar Nuevo producto</h3></a>
                </div>
                    <form class="bg-white ">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <hr >
                                    <div class="form-group text-center px-4 ">
                                        <table>
                                            <thead>
                                             <tr > 
                                             <th class="px-4">Id</th>
                                             <th class="px-4">Nombre</th>
                                             <th class="px-4">Descripcion</th>
                                             <th class="px-4">Stock</th>
                                             <th class="px-4">Precio</th>
                                             <th class="px-4">&nbsp;</th>
                                             </tr>
                                            </thead>
                                    </div> 
                                </div>
                            </div>
                        </div>       
                    </form> 
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>
<form method="GET" action="">
    <div class="form-group">
        <input type="text" name="buscar_nombre" class="form-control" placeholder="Buscar por nombre del producto">
    </div>
    <button type="submit" class="btn btn-warning my-3">Buscar</button>
</form>
<tbody>
        <?php
            while ($producto = $resultado->fetch_assoc()) {
                // Verificar si se ha enviado un valor de búsqueda y si el nombre coincide
                if (isset($_GET['buscar_nombre']) && !empty($_GET['buscar_nombre']) && stripos($producto['nombre'], $_GET['buscar_nombre']) !== false) {
                    // Código para mostrar el producto aquí
                    echo '<tr>';
                    echo '<td>' . $producto['idProducto'] . '</td>';
                    echo '<td>' . $producto['nombre'] . '</td>';
                    echo '<td>' . $producto['descripcion'] . '</td>';
                    echo '<td>' . $producto['stock'] . '</td>';
                    echo '<td>' . $producto['precioVenta'] . '</td>';
                    echo '<td>';
                    echo '<div class="btn-group btn-group-sm px-5 mt-2" role="group">';
                    echo '<a class="btn btn-primary" href="actualizar.php?idProducto=' . $producto['idProducto'] . '">Editar</a>';
                    echo '<a class="btn btn-danger" href="eliminar_producto.php?idProducto=' . $producto['idProducto'] . '">Eliminar</a>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            
        ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>  
</body>
</html>