<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TextilExport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css publica/publica.css">
</head>
<body background="https://img.freepik.com/foto-gratis/textura-tela-blanca_1154-645.jpg?semt=ais_hybrid&w=740">
  
<header>
    <nav style="background-color: #1d5583;" class="navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center text-white" href="#">
                <b class="fs-3">TextilExport</b>
            </a>
            <a class="btn btn-outline-light m-2" href="<?= PATH.'/Login/' ?>" type="submit"><b>Cerrar Sesión</b></a>
        </div>
    </nav>
</header>

<div class="container">
<br>
<div class="text-center mt-4">
    <h2 style="color: #17456b;" class="mt-2 fw-bold">Textiles Únicos para tus Creaciones</h2>
</div>
 <br>
    <div class="row">
        
        <?php 
            foreach($productos as $producto){
        ?>
        <div class="col-sm-4 mb-4">
            <div class="card h-100">
                <img src="<?= $producto['imagen'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 style="color: navy" class="card-title"><b><?= $producto['nombre_producto'] ?></b></h5>
                    <p style="color:#17456b" class="card-text"><?= $producto['descripcion'] ?></p>
                    <button style="background-color:#17456b" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal_<?= $producto['codigo_producto'] ?>">
                        <b style="color: white;">Ver más</b>
                    </button>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_<?= $producto['codigo_producto'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 style="color: #17456b;" class="modal-title fs-5" id="exampleModalLabel"><?= $producto['nombre_producto'] ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row justify-content-center mb-4" align="center">
                                <img src="<?= $producto['imagen'] ?>" class="col-sm-6 text-center" alt="<?= $producto['nombre_producto'] ?>">
                            </div>
                            <div class="row">
                                <div class="col-sm-7">
                                    <h3 style="color: #17456b;"><?= $producto['codigo_producto'] ?></h3>
                                    <p><?= $producto['descripcion'] ?></p>
                                </div>
                                <div class="col-sm-5">
                                    <p style="color: #17456b;"><b>Precio:</b></p>
                                    <p><?= $producto['precio'] ?></p>
                                    <p style="color: #17456b;"><b>Cantidad disponible:</b></p>
                                    <p><?= $producto['existencias'] ?></p>
                                    <p style="color: #17456b;"><b>Categoría:</b></p>
                                    <p><?= $producto['categoria'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button style="color: #fff; background-color:#ce878d" type="button" class="btn" data-bs-dismiss="modal"><b>Cerrar</b></button>
                        <a href="<?= PATH.'/Productos/comprar/'.$producto['id_producto'] ?>" class="btn btn-primary">Comprar</a>
                    </div>
                </div>
            </div>
        </div>

        <?php 
            }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
