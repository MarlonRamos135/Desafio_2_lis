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
<body background="<?= PATH.'/Views/Admin/imagenes/imagen con textura-01.png' ?>">
    

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
                    <a class="btn btn-outline-light m-2" href="<?= PATH.'/Login/logout' ?>" type="submit"><b>Cerrar Sesión</b></a>
                </form>
            </div>
        </nav>
    </header>
    <br>
    <div class="container" >
    <div class="text-center mt-4">
    <h2 style="color: #17456b;" class="mt-2 fw-bold">Las categorías agregadas son las siguientes.</h2>
</div>
    <br>
    <div style="text-align: center;"><img style="width: 178px;height: auto;" src="<?= PATH.'/Views/Admin/imagenes/logo1.jpeg' ?>" class="rounded-circle" alt="admin"></div>
    <br>

    <div class="row d-flex justify-content-center">
        <div class="col-sm-10 col-sm-offset-2">
            <table class="table table-bordered table-striped">
                <thead>
                
                    <th><b style="color:#17456b">Nombre</b></th>
                    <th><b style="color:#17456b">Acciones</b></th>
                </thead>
                <tbody>
                   
        </div>
                    
                    <?php 
                        foreach($categorias as $categoria){

                        
                    ?>

                    <tr>
                        <td style="color: #17456b;"><?= $categoria['nombre_categoria'] ?></td>
                        
                        <td>
                            <button type="button" style="background-color: #17456b; color: white;" class="btn" data-bs-toggle="modal" data-bs-target="#modalEditar_<?= $categoria['id_categoria'] ?>">
                                <b>Editar</b>
                            </button>
                            <br>
                            <br>
                            <a href="<?= PATH.'/Admin/eliminarCategoria/'.$categoria['id_categoria'] ?>" style="background-color: #ce878d; color: black;" class="btn"><b>Eliminar</b></a>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalEditar_<?= $categoria['id_categoria'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <i style="font-size: 25px;" class='bx bxs-edit icon-rosa'></i>
                                    <h5 style="color: #17456b" class="modal-title" id="editModalLabel"><b>Editar categoria</b></h5>
                                
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= PATH.'/Admin/editarCategoria/'.$categoria['id_categoria'] ?>" method="POST">
                                        <input type="hidden" id="codigo" name="codigo">
                                        
                                        <div class="mb-3">
                                            <i style="font-size: 21px;" class='bx bx-edit-alt icon-rosa'></i>
                                            <label for="nombre" class="form-label"><b style="color:#17456b;">Nombre de la categoría</b></label>
                                            <input type="text" class="form-control" id="nombre" name="nombre_categoria" value="<?= $categoria['nombre_categoria'] ?>">
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
    
    <div class="col-sm-6" style="text-align: center;" >
        <button type="button" style="background-color: #17456b; color: white;" class="btn" data-bs-toggle="modal" data-bs-target="#modalAgregar">
            <b>Agregar categoría</b>
        </button>
        <br>
        <br>  
    </div>

    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <i style="font-size: 25px;" class='bx bxs-edit icon-rosa'></i>
                    <h5 style="color: #17456b" class="modal-title" id="editModalLabel"><b>Agregar categoria</b></h5>
                
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= PATH.'/Admin/agregarCategoria/' ?>" method="POST">
                        <input type="hidden" id="codigo" name="codigo">
                        
                        <div class="mb-3">
                            <i style="font-size: 21px;" class='bx bx-edit-alt icon-rosa'></i>
                            <label for="nombre" class="form-label"><b style="color:#17456b;">Nombre de la categoría</b></label>
                            <input type="text" class="form-control" id="nombre" name="nombre_categoria" required>
                        </div>

                        <button type="submit" name="modificar" style="background-color: #ce878d;" class="btn btn-success"><b style="color: white;">Guardar Cambios</b></button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>