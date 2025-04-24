<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="cssProducto/ver_Producto.css">
</head>
<body background="https://img.freepik.com/foto-gratis/textura-tela-blanca_1154-645.jpg?semt=ais_hybrid&w=740">
    

    <header>
        <nav style="background-color: #1d5583;" class="navbar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4">
                        <a class="navbar-brand fs-3 text-white"><b>TextilExport</b></a>
                    </div>
                </div>
                <form class="d-flex">
                    <a class="btn btn-outline-light m-2" href="<?= PATH.'/Admin' ?>" type="submit"><b>Volver al menú</b></a>
                    <a class="btn btn-outline-light m-2" href="<?= PATH.'/Login/' ?>" type="submit"><b>Cerrar Sesión</b></a>
                </form>
            </div>
        </nav>
    </header>
    <br>
    <div class="container" >
    <div class="text-center mt-4">
    <h2 style="color: #17456b;" class="mt-2 fw-bold">los Productos Agregados Son Los Siguientes</h2>
</div>
    <br>
    <div style="text-align: center;"><img style="width: 178px;height: auto;" src="<?= PATH.'/Views/Admin/imagenes/logo1.jpeg' ?>" class="rounded-circle" alt="admin"></div>
    <br>

 <div class="row d-flex justify-content-center">
        <div class="col-sm-10 col-sm-offset-2">
            <table class="table table-bordered table-striped">
                <thead>
                
                    <th><b style="color:#17456b">Nombre</b></th>
                    <th><b style="color:#17456b">Código</b></th>
                    <th><b style="color:#17456b">Descripción</b></th>
                    <th><b style="color:#17456b">Imágen</b></th>
                    <th><b style="color:#17456b">Categoría</b></th>
                    <th><b style="color:#17456b">Precio</b></th>
                    <th><b style="color:#17456b">Cantidad</b></th>
                    <th><b style="color:#17456b">Acciones</b></th>
                </thead>
                <tbody>
                   
        </div>
                    
                    <?php 
                        foreach($productos as $producto){

                        
                    ?>

                    <tr>
                        <td style="color: #17456b;"><?= $producto['nombre_producto'] ?></td>
                        <td style="color: #17456b;"><?= $producto['codigo_producto'] ?></td>
                        <td style="color: #17456b;"><?= $producto['descripcion'] ?></td>
                        <td><img src="<?= $producto['imagen'] ?>" alt="Enlace de imagen no válido" style="width: 150px; height: auto;"></td>
                        <td style="color: #17456b;"><?= $producto['categoria'] ?></td>
                        <td style="color: #17456b;">$<?= $producto['precio'] ?></td>
                        <td style="color: #17456b;"><?= $producto['existencias'] ?></td>
                        <td>
                        <button type="button" style="background-color: #17456b; color: white;" class="btn" data-bs-toggle="modal" data-bs-target="#modalEditar_<?= $producto['id_producto'] ?>">
                            <b>Editar</b>
                        </button>
                            <br>
                            <br>
                            <a href="<?= PATH.'/Admin/eliminar/'.$producto['id_producto'] ?>" style="background-color: #ce878d; color: black;" class="btn"><b>Eliminar</b></a>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalEditar_<?= $producto['id_producto'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <i style="font-size: 25px;" class='bx bxs-edit icon-rosa'></i>
                                    <h5 style="color: #17456b" class="modal-title" id="editModalLabel"><b>Editar Producto</b></h5>
                                
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= PATH.'/Admin/editar/'.$producto['id_producto'] ?>" method="POST">
                                        <input type="hidden" id="codigo" name="codigo">
                                        
                                        <div class="mb-3">
                                            <i style="font-size: 21px;" class='bx bx-edit-alt icon-rosa'></i>
                                            <label for="nombre" class="form-label"><b style="color:#17456b;">Nombre</b></label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $producto['nombre_producto'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <i style="font-size: 21px;" class='bx bx-food-menu icon-rosa'></i>
                                            <label for="desc" class="form-label"><b style="color: #17456b;">Descripción</b></label>
                                            <textarea class="form-control" id="desc" name="desc" rows="3"><?= $producto['descripcion'] ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <i style="font-size: 21px;" class='bx bxs-image icon-rosa'></i>
                                            <label for="img" class="form-label"><b style="color: #17456b;">URL de Imagen</b></label>
                                            <input type="text" class="form-control" id="img" name="img" value="<?= $producto['imagen'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <i style="font-size: 21px;" class='bx bx-receipt icon-rosa'></i>
                                            <label for="categoria" class="form-label"><b style="color: #17456b;">Categoría</b></label>
                                            <select name="categoria" id="categoria" class="form-select" >
                                            <?php foreach($categorias as $cat): ?>
                                                <option value="<?= $cat['id_categoria'] ?>" <?= $cat['id_categoria'] == $producto['id_categoria'] ? 'selected' : '' ?>>
                                                    <?= $cat['nombre_categoria'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <i style="font-size: 21px;" class='bx bx-dollar icon-rosa'></i>
                                            <label for="precio" class="form-label"><b style="color: #17456b;">Precio</b></label>
                                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?= $producto['precio'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <i style="font-size: 21px;" class='bx bx-signal-5 icon-rosa'></i>
                                            <label for="cantidad" class="form-label"><b style="color: #17456b;">Cantidad</b></label>
                                            <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?= $producto['existencias'] ?>">
                                        </div>

                                        <button type="submit" name="modificar" style="background-color: #ce878d;" class="btn btn-success"><b style="color: white;">Guardar Cambios</b></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php } ?>
                </tbody>
            </table>
        </div>
         <br>
         <br> 
         
    
                <div class="col-sm-6" style="text-align: center;" ><a style="background-color: #17456b;color: white;"  class="btn" href="<?= PATH.'/Admin/agregarProductos' ?>"><b>Agregar Producto</b></a>
                <br>
                <br>
                
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>