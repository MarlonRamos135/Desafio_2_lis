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
    <br>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <form action="/Desafio_2_lis/Login/createUser" method="POST" class="w-100 p-4 rounded" style="max-width: 400px; background-color: transparent; backdrop-filter: blur(8px); box-shadow: 0 0 10px rgba(0,0,0,0.2);">
          
        <h1 style="color:#17456b" class="text-center">Registro</h1>
        <div style="text-align: center;">
            <img style="width: 180px;height: auto;" src="/Desafio_2_lis/Views/Login/img/logo1.jpeg" class="rounded-circle" alt="Registro">
        </div>

        <br>
        <i style="font-size: 20px;" class='bx bxs-user-account icon-rosa bx-border-circle'></i>
        <label for="nombre" class="form-label text-white"><b style="color: #17456b;">Nombre Completo</b></label>
        <input type="text" name="nombre_completo" id="nombre_completo" placeholder="Llena este campo" class="form-control" required>

        <br>
        <i style="font-size: 20px;" class='bx bxs-user icon-rosa bx-border-circle'></i>
        <label for="usuario" class="form-label text-white"><b style="color: #17456b;">Nombre de Usuario</b></label>
        <input type="text" name="nombre_usuario" id="nombre_usuario" placeholder="Llena este campo" class="form-control" required>

        <br>
        <i style="font-size: 20px;" class='bx bxl-gmail icon-rosa bx-border-circle'></i>
        <label for="correo" class="form-label text-white"><b style="color: #17456b;">Correo Electrónico</b></label>
        <input type="email" name="correo" id="correo" placeholder="Llena este campo" class="form-control" required>

        <br>
        <i style="font-size: 20px;" class='bx bx-phone-call icon-rosa bx-border-circle'></i>
        <label for="telefono" class="form-label text-white"><b style="color: #17456b;">Teléfono</b></label>
        <input type="tel" name="telefono" id="telefono" placeholder="Llena este campo" class="form-control" required>

        <br>
        <i style="font-size: 20px;" class='bx bxs-home-alt-2 icon-rosa bx-border-circle'></i>
        <label for="direccion" class="form-label text-white"><b style="color: #17456b;">Dirección</b></label>
        <input type="text" name="direccion" id="direccion" placeholder="Llena este campo" class="form-control" required>

        <br>
        <i style="font-size: 20px;" class='bx bxs-lock-alt icon-rosa bx-border-circle'></i>
        <label for="contrasena" class="form-label text-white"><b style="color: #17456b;">Contraseña</b></label>
        <input type="password" name="contrasena" id="contrasena" placeholder="Llena este campo" class="form-control" required>

        <br>
        <div class="text-center">
            <button style="background-color: #17456b" type="submit" class="btn btn"><b style="color: #fff;">Registrar</b></button>
        </div>
    </form>
</div>

<br>
</body>
</html>
