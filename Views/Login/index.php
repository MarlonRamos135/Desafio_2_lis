<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TextilExport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css login/Login.css">
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
            </div>
        </nav>
    </header>

    <div class="container d-flex justify-content-center align-items-start" style="padding-top: 30px;">
        <form action="<?= PATH.'/Login/verifyUser' ?>" method="POST" class="w-100 p-4 rounded" style="max-width: 400px; background-color: transparent; backdrop-filter: blur(8px); box-shadow: 0 0 10px #00000033;">
              
            <h1 style="color:#17456b" class="text-center">Bienvenid@s</h1>
            <div style="text-align: center;">
                <img style="width: 180px;height: auto;" src="imagenes/logo1.jpeg" class="rounded-circle" alt="Registro">
            </div>

            <br>
            <i style="font-size: 20px;"class='bx bxs-user-account icon-rosa bx-border-circle'></i>
            <label for="nombre" class="form-label text-white"><b style="color: #17456b">Correo electrónico</b></label>
            <input type="text" name="correo" id="correo" placeholder="Llena este campo" class="form-control" required>

            <br>
            <i style="font-size: 20px;" class='bx bxs-lock-alt icon-rosa bx-border-circle'></i>
            <label for="usuario" class="form-label text-white"><b style="color: #17456b">Contraseña</b></label>
            <input type="text" name="contrasena" id="contrasena" placeholder="Llena este campo" class="form-control" required>

            <br>
            <div class="text-center">
                <button style="background-color: #17456b" type="submit" class="btn btn"><b style="color: #fff;">Iniciar Sección</b></button>
            </div>
        </form>
    </div>

    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
