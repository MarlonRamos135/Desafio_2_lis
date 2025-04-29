<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body background="<?= PATH.'/Views/Admin/imagenes/imagen con textura-01.png' ?>">
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
                    <a class="btn btn-outline-light m-2" href="<?= PATH.'/Admin' ?>" type="submit"><b>Volver al menú</b></a>
                    <a class="btn btn-outline-light m-2" href="<?= PATH.'/Login/logout' ?>" type="submit"><b>Cerrar Sesión</b></a>
                </form>
            </div>
        </nav>
    </header>
    <br>
    <br>
    <div style="text-align: center;"><img style="width: 198px;height: auto;" src="<?= PATH.'/Views/Admin/imagenes/logo1.jpeg' ?>" class="rounded-circle" alt="admin"></div>
   

    <form action="<?= PATH.'/Admin/editarUsuario/'.$usuarios['id_Usuario'] ?>" method="POST">
    <div class="container my-5">
        <div class="row">
            <div class="col-sm-6">
                <label for="nombre_completo" class="form-label">Nombre completo</label>
                <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" value="<?= $usuarios['nombre_completo'] ?>">
            </div>
            <div class="col-sm-6">
                <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" value="<?= $usuarios['nombre_usuario'] ?>">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="<?= $usuarios['telefono'] ?>">
            </div>
            <div class="col-sm-6">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" name="correo" id="correo" class="form-control" value="<?= $usuarios['correo'] ?>">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-6">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control" value="<?= $usuarios['direccion'] ?>">
            </div>
            <div class="col-sm-6">
                <label for="id_tipo_usuario" class="form-label">Rol</label>
                <select name="id_tipo_usuario" id="id_tipo_usuario" class="form-select">
                    <option value="1" <?= $usuarios['id_tipo_usuario'] == 1 ? 'selected' : '' ?>>Administrador</option>
                    <option value="2" <?= $usuarios['id_tipo_usuario'] == 2 ? 'selected' : '' ?>>Cliente</option>
                    <!-- Agrega más roles si tienes -->
                </select>
            </div>
        </div>
        <br>
        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="<?= PATH.'/Admin/adminUsuarios' ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>