<?php
include('../conexion/conexion.php');

// Obtener los valores del formulario
$idProducto = $_POST['idProducto'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$precioVenta = $_POST['precioVenta'];


// Abrir la conexión a la base de datos
$conexion = conectar();

// Consulta a la base de datos
$query = $conexion->prepare("UPDATE producto SET nombre = ?, descripcion = ?, stock = ?, precioVenta = ? WHERE idProducto = ?");
$query->bind_param('ssssi', $nombre, $descripcion, $stock, $precioVenta, $idProducto);

$msg = '';
if ($query->execute()) {
    $msg = 'Producto actualizado';
} else {
    $msg = 'No se pudo actualizar el Producto';
}

// Cerrar la conexión a la base de datos
desconectar($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizaste un Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <h1>Actualizar Producto</h1>
    <h3><?php echo $msg ?></h3>
    <a href="productos.php">Regresar</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>  
</body>
</html>
