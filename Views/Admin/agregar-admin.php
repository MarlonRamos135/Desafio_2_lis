<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body background="https://img.freepik.com/foto-gratis/textura-tela-blanca_1154-645.jpg?semt=ais_hybrid&w=740">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <header>
        <nav style="background-color: #1d5583;" class="navbar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4">
                        <a class="navbar-brand fs-3 text-white"><b>TextilExport</b></a>
                    </div>
                </div>
                <form class="d-flex">
                    <a class="btn btn-outline-light" href="<?= PATH.'/Login/'?>" type="submit"><b>Cerrar Sesión</b></a>
                </form>
            </div>
        </nav>
    </header>
    <br>
    <br>
    <div style="text-align: center;"><img style="width: 198px;height: auto;" src="<?= PATH.'/Views/Admin/imagenes/logo1.jpeg' ?>" class="rounded-circle" alt="admin"></div>
   

    <form action="<?= PATH.'/Admin/crear'?>" method="POST">
        <div class="container my-5">
            <?php
                if(isset($errores)){
                    echo "<div class='alert alert-danger'>";
                    echo "<ul>";
                    foreach($errores as $error){
                        echo "<li>$error</li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                }
            ?>
            <div class="row">
                <div class="col-sm-4">
                    <i style="font-size: 23px;" class='bx bx-cart bx-border-circle icon-rosa'></i>
                    <label for="nombre" class="form-label"><b style="color: navy;background-color: white;">Nombre del Producto</b></label>
                    <input type="text" name="nombre" id="nombre" placeholder="Llena este campo" class="form-control" value="<?= isset($producto[':nombre']) ? $producto[':nombre'] : '' ?>">
                </div>
                <div class="col-sm-4">
                    <i style="font-size: 23px;" class='bx bx-file bx-border-circle icon-rosa'></i>
                    <label for="desc" class="form-label"><b style="color: navy;background-color: white;">Descripción</b></label>
                    <input type="text" name="desc" placeholder="Llena este campo" class="form-control" id="desc" value="<?= isset($producto[':descripcion']) ? $producto[':descripcion'] : '' ?>">
                </div>
                <div class="col-sm-4">
                    <i style="font-size: 23px;" class='bx bx-dollar bx-border-circle icon-rosa'></i>
                    <label for="precio" class="form-label"><b style="color: navy;background-color:white;">Precio del producto</b></label>
                    <input type="number" name="precio" id="precio" min="0" step="0.01" placeholder="Llena este campo" class="form-control" value="<?= isset($producto[':precio']) ? $producto[':precio'] : '' ?>">
                </div>  
            </div>
            <br><br>
            <div class="row">
                <div class="col-sm-4">
                    <i style="font-size: 23px;"class='bx bx-spreadsheet bx-border-circle icon-rosa'></i>
                    <label for="categoria" class="form-label"><b style="color:navy;background-color: white;">Categoría</b></label>
                    <select name="categoria" id="categoria" class="form-select">
                        <option value="">--Seleccione un campo--</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?= $cat['id_categoria'] ?>"><?= $cat['nombre_categoria'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <i style="font-size: 23px;" class='bx bxs-image bx-border-circle icon-rosa'></i>
                    <label for="img" class="form-label"><b style="color: navy; background-color: white;">Imagen (URL)</b></label>
                    <input type="text" name="img" placeholder="Llena este campo" class="form-control" id="img">
                </div>
                <div class="col-sm-4">
                    <i style="font-size: 23px;" class='bx bx-bar-chart bx-border-circle icon-rosa'></i>
                    <label for="cantidad" class="form-label"><b style="color:navy; background-color: white;">Cantidad</b></label>
                    <input type="number" min="0" step="1" name="cantidad" id="cantidad" placeholder="Llena este campo" class="form-control">
                </div>  
            </div>
            
            <div style="text-align: center;"> <button style="background-color: #1d5583;" class="btn my-3" type="submit"><b style="color: white;">Subir datos</b></button>
            <a style="background-color: #1d5583;" class="btn" href="<?= PATH.'/Admin/adminProductos'?>"><b style="color: white;">Ver Producto</b></a>
        </div>
           </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>