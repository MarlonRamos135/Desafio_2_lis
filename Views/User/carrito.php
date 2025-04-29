<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras Realizadas</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

<body background="<?= PATH.'/Views/Admin/imagenes/imagen con textura-01.png' ?>">

      
<header>
    <nav style="background-color: #1d5583;" class="navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center text-white" href="#">
                <b class="fs-3">TextilExport</b>
            </a>
            <div>
                <form class="d-flex">
                    <a class="btn btn-outline-light m-2" href="<?= PATH.'/User/' ?>" type="submit"><b>Volver al menú</b></a>
                    <a class="btn btn-outline-light m-2" href="<?= PATH.'/Login/logout' ?>" type="submit"><b>Cerrar Sesión</b></a>
                </form>
            </div>
           </div>
    </nav>
</header>
<br>

<div class="container">
    <div class="text-center mt-4">
        <h2 style="color: #17456b;" class="mt-2 fw-bold">Compras Realizadas</h2>
        <br>
        <div style="text-align: center;"><img style="width: 198px;height: auto;" src="<?= PATH.'/Views/Admin/imagenes/logo1.jpeg' ?>" class="rounded-circle" alt="admin"></div>
    </div>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 40vh;">
        <table class="table table table-borderless">
            <thead>
                <tr>
                    <th scope="col" style="color: #17456b;"><b>#</b></th>
                    <th scope="col" style="color: #17456b;"><b>Producto</b></th>
                    <th scope="col" style="color: #17456b;"><b>Fecha de compra</b></th>
                    <th scope="col" style="color: #17456b;"><b>Total pagado</b></th>
                    <th scope="col" style="color: #17456b;"><b>Acciones</b></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($compras)): ?>
                    <?php $i = 1; foreach ($compras as $compra): ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= htmlspecialchars($compra['nombre_producto']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($compra['fecha'])) ?></td>
                        <td>$<?= number_format($compra['subtotal'], 2) ?></td>
                        <td>
                        <a href="<?= PATH ?>/User/ticket/<?= $compra['id_venta'] ?>" target="_blank" class="btn btn-primary">Descargar PDF</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                    <td colspan="4" class="text-center">No se encontraron compras realizadas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
    
</body>
</html>