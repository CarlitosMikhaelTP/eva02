<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <h1>Actualizar Producto</h1>
    <?php
    include('../conexion/conexion.php');

    // Obtener el ID del producto a actualizar
    $idProducto = $_GET['idProducto'];

    // Abrir la conexión a la base de datos
    $conexion = conectar();

    // Consultar los datos del producto
    $query = $conexion->prepare("SELECT * FROM producto WHERE idProducto = ?");
    $query->bind_param('i', $idProducto);

    if ($query->execute()) {
        $resultado = $query->get_result();
        $producto = $resultado->fetch_assoc();

        // Mostrar el formulario con los datos del producto
        ?>
        <form name="formulario" method="post" action="actualizar_producto.php">
            <input type="hidden" name="idProducto" value="<?php echo $producto['idProducto']; ?>">
            <table>
                <tbody>
                    <tr>
                        <td>Nombre</td>
                        <td>
                            <input type="text" name="nombre" maxlength="40" value="<?php echo $producto['nombre']; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Descripcion</td>
                        <td>
                            <input type="text" name="descripcion" maxlength="40" value="<?php echo $producto['descripcion']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Stock</td>
                        <td>
                            <input type="text" name="stock" maxlength="40" value="<?php echo $producto['stock']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Precio de venta</td>
                        <td>
                            <input type="text" name="precioVenta" maxlength="40" value="<?php echo $producto['precioVenta']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit">Actualizar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php
    } else {
        echo 'Error al obtener los datos del producto.';
    }

    // Cerrar la conexión a la base de datos
    desconectar($conexion);
    ?>
    <a href="productos.php">Regresar</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>  
</body>
</html>