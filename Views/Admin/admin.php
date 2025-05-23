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
<body background="<?= PATH.'/Views/Admin/imagenes/imagen con textura-01.png' ?>">
  
<header>
    <nav style="background-color: #1d5583;" class="navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center text-white" href="#">
                <b class="fs-3">TextilExport</b>
            </a>
            <form class="d-flex">
                <a class="btn btn-outline-light m-2" href="<?= PATH.'/Admin' ?>" type="submit"><b>Volver al menú</b></a>
                <a class="btn btn-outline-light m-2" href="<?= PATH.'/Login/logout' ?>" type="submit"><b>Cerrar Sesión</b></a>
            </form>
        </div>
    </nav>
</header>

<div class="container">
<br>
<div class="text-center mt-4">
    <h2 style="color: #17456b;" class="mt-2 fw-bold">Menú administrativo</h2>
</div>

    <div class="row justify-content-center">
        <a href="<?= PATH.'/Admin/adminProductos' ?>" class="col-sm-4 p-5 bg-primary m-4 rounded h1 text-center text-white" style="text-decoration: none;">
            Administrar productos
        </a>
        <a href="<?= PATH.'/Admin/adminUsuarios' ?>" class="col-sm-4 p-5 bg-success m-4 rounded h1 text-center text-white" style="text-decoration: none;">
            Administrar usuarios
        </a>
        <a href="<?= PATH.'/Admin/adminCategorias' ?>" class="col-sm-4 p-5 bg-warning m-4 rounded h1 text-center text-dark" style="text-decoration: none;">
            Administrar categorías
        </a>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
