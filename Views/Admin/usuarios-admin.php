<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
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
    <br>
    <div class="text-center mt-4">
        <h2 style="color: #17456b;" class="mt-2 fw-bold"><b>Modificar Perfil de Usuario</b></h2>
        <br>

        <div style="text-align: center;"><img style="width: 198px;height: auto;"
                src="https://cdn-icons-png.flaticon.com/256/17246/17246491.png" class="rounded-circle" alt="admin">
        </div>
    </div>
    <br>

    <div class="row d-flex justify-content-center">
        <div class="col-sm-10 col-sm-offset-2">
            <table class="table table-bordered table-striped">
                <thead>

                    <th><b style="color:#17456b">Nombre completo</b></th>
                    <th><b style="color:#17456b">Nombre usuario</b></th>
                    <th><b style="color:#17456b">Teléfono</b></th>
                    <th><b style="color:#17456b">Correo</b></th>
                    <th><b style="color:#17456b">Dirección</b></th>
                    <th><b style="color:#17456b">Rol</b></th>
                    <th><b style="color:#17456b">Acciones</b></th>
                </thead>
                <tbody>
                    <?php foreach($usuarios as $usuario): ?>
                    <tr>
                        <td style="color: #17456b;">
                            <?= $usuario['nombre_completo'] ?>
                        </td>
                        <td style="color: #17456b;">
                            <?= $usuario['nombre_usuario'] ?>
                        </td>
                        <td style="color: #17456b;">
                            <?= $usuario['telefono'] ?>
                        </td>
                        <td style="color: #17456b;">
                            <?= $usuario['correo'] ?>
                        </td>
                        <td style="color: #17456b;">
                            <?= $usuario['direccion'] ?>
                        </td>
                        <td style="color: #17456b;">
                            <?= $usuario['nombre_rol'] ?>
                        </td>
                        <td>
                            <a href="<?= PATH.'/Admin/editar/'.$usuario['id_Usuario'] ?>"
                            class="btn btn-primary">Editar</a>
                            <br><br>
                            <a href="<?= PATH.'/Admin/eliminarUsuario/'.$usuario['id_Usuario'] ?>"
                                class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table> <!-- Aquí se cierra la tabla correctamente -->


            </table>
        </div>
</body>

</html>