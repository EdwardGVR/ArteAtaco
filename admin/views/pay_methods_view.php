<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <title>ArteAteataco :: Admin</title>
</head>
<body>
    <?php require "side_bar_view.php" ?>
    <main>
        <div class="bar">
            <div class="homeStoreBtns">
                <a href="index.php" title="Ir a inicio"><i class="fa fa-home"></i></a>
                <a href="../categorias.php" title="Ir a la tienda"><i class="fas fa-store"></i></a>
            </div>
            <h1>M&eacute;todos de pago</h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>
            <?php if ($methods != false): ?>
                <div class="title">
                    <h2>Todos los m&eacute;todos de pago</h2>
                    <hr>
                </div>
                <div class="contPay">
                    <?php foreach ($methods as $method): ?>
                        <?php $status = ($method['status'] == 1) ? "activo" : "inactivo" ?>
                        <a href="detPayMethod.php?payMethod=<?= $method['id'] ?>" class="payMethod">
                            <div class="status"><span class="<?= $status ?>"><?= $status ?></span></div>
                            <div class="name"><?= $method['nombre'] ?></div>
                        </a>
                    <?php endforeach ?>
            <?php else: ?>
                <div class="noPayMethods">
                    No hay metodos de pago registrados.
                </div>
            <?php endif ?>
                </div>
        </section>
    </main>
</body>
</html>