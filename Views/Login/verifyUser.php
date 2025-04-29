<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        .icon-rosa {
            color: #ce878d;
        }
    </style>
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
            </div>
        </nav>
    </header>
    <br>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <?php 
        if (isset($viewBag['errores']) && count($viewBag['errores']) > 0) {
            echo "<div class='alert alert-danger'>";
            echo "<ul>";
            foreach($viewBag['errores'] as $error){
                echo "<li>$error</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
    ?>

    <form action="/Desafio_2_lis/Login/verifyUser" method="POST" class="w-100 p-4 rounded" style="max-width: 400px; background-color: transparent; backdrop-filter: blur(8px); box-shadow: 0 0 10px rgba(0,0,0,0.2);">  
          <div style="text-align: center;">
                <img style="width: 180px;height: auto;" src="/Desafio_2_lis/Views/Login/imagenes/logo1.jpeg" class="rounded-circle" alt="Registro">
                <br>
                <h1>Usuario creado correctamente</h1>
                <a href="<?= PATH.'/Login/' ?>" class="btn btn-primary">Iniciar Sesión</a>
          </div>
          <br>
          <label for="nombre_completo" class="form-label
    </form>
</div>

<br>
</body>
</html>
