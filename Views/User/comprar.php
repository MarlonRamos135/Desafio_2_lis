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
                    <a class="btn btn-outline-light" href="<?= PATH.'/Login/'?>"><b>Cerrar Sesión</b></a>
                </form>
            </div>
        </nav>
    </header>
    
    <br>

    <form class="container my-5" action="<?= PATH.'/User/pago/'.$productos['']?>" method="POST">

        <h2 style="color: #17456b;text-align: center;">Pago con Tarjeta de Credito</h2>
        <br>

        <div class="row my-5 justify-content-center">

            <div class="col-sm-4">
                <img style="width: 180px;height: auto;" src="<?= PATH.'/Views/Admin/imagenes/logo1.jpeg' ?>" class="rounded-circle" alt="Registro">
            </div>

            <div class="col-sm-8">
                <div class="row justify-content-center">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="card-number"><b style="color: #17456b;font-size: 16px;">N°.Tarjeta</b></label>
                            <input type="number" id="tarjeta" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="cvv"><b style="color: #17456b;font-size: 16px;">CVV</b></label>
                            <input type="number" id="cvv" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="vencimiento">Fecha de vencimiento</label>
                            <input type="date" id="vencimiento" class="form-control" required>
                        </div>
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-primary mt-4">
                    Realizar compra
                </button>
            </div>

        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>