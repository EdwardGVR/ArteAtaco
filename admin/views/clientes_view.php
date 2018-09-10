<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">   
    <link rel="stylesheet" href="css/styles.css">
    <title>Clientes</title>
</head>
<body>
    <?php require "side_bar_view.php" ?>
    <main>
        <div class="bar">
            <div class="homeStoreBtns">
                <a href="index.php" title="Ir a inicio"><i class="fa fa-home"></i></a>
                <a href="../categorias.php" title="Ir a la tienda"><i class="fas fa-store"></i></a>
            </div>
            <h1>Clientes</h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>
            <div class="title">
                <h2>Todos los clientes</h2>
                <hr>    
            </div>
            <?php if ($clientes != false): ?>
                <div class="contenedorClientes all">    
                    <?php foreach ($clientes as $cliente): ?>
                        <a href="detallesCliente.php?cosId=<?= $cliente['id'] ?>" class="clienteList">
                            <!-- <div class="disp">
                                <span class="code">#####</span>
                            </div> -->
                            <div class="clienteInfo">
                                <span class="info1"><?= $cliente['nombres'] ?></span>
                                <span class="info2"><?= $cliente['apellidos'] ?></span>
                                <span class="info3"><?= $cliente['user'] ?></span>
                            </div>
                            <hr>
                            <div class="clienteImg">
                                <?php if ($cliente['imagen'] != null): ?>
                                    <img src="../<?= $cliente['imagen'] ?>" alt="">
                                <?php else: ?>
                                    <i class="fa fa-user"></i>
                                <?php endif ?>
                            </div>
                            <hr>
                            <div class="clienteContact">
                                <span class="info1"><?= $cliente['telefono'] ?></span>
                                <span class="info1"><?= $cliente['email'] ?></span>
                            </div>
                            <div class="regDate">
                                <span class="info2">Registro:&nbsp;<?= substr($cliente['regDate'], 0, -9) ?></span>
                            </div>
                        </a>
                    <?php endforeach ?>
                </div>
            <?php else: ?>
                <div class="contenedorNoPuntos"> 
                    No hay clientes que mostrar
                </div>
            <?php endif?>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>