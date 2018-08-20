<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">   
    <link rel="stylesheet" href="css/styles.css">
    <title>Detalles punto de entrega</title>
</head>
<body>
    <div class="nav_hidden"></div>
    <nav>
        <div class="side_bar">
            <div class="side_user_info"></div>
            <div class="side_icons">
                <div class="side_icon"><i class="fas fa-shopping-bag"></i></div>
                <div class="side_icon"><i class="fas fa-cubes"></i></div>
                <div class="side_icon"><i class="fas fa-users"></i></div>
                <div class="side_icon"><i class="fas fa-truck"></i></div>
            </div>
        </div>
        <div class="options">
            <div class="user_info">
                <div class="image">
                <img src="<?= '../' . $userImg ?>" alt="usrimg">
                </div>
                <div class="data">
                    <span class="nombre"><?= $userName ?></span>
                    <hr>
                    <span>Administrador</span>
                </div>
            </div>

            <div class="buttons">
                <a href="pedidos.php">Pedidos</a>
                <a href="productos.php">Productos</a>
                <a href="#">Clientes</a>
                <a href="puntosEntrega.php">Puntos de entrega</a>
            </div>
        </div>
    </nav>
    <main>
        <div class="bar">
            <div class="homeStoreBtns">
                <a href="index.php" title="Ir a inicio"><i class="fa fa-home"></i></a>
                <a href="../categorias.php" title="Ir a la tienda"><i class="fas fa-store"></i></a>
            </div>
            <h1>Punto de entrega: <?= $puntoData['nombre'] ?></h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
    <section>
        <div class="contenedor_puntos">
            <?php if ($puntoData != false): ?>
                <?php $statusClass = ($puntoData['estado'] == 1) ? "activo" : "inactivo" ?>
                <article class="punto <?= $statusClass ?>">
                    <div class="title">
                        <span class="nombre"><?= $puntoData['nombre'] ?></span>
                        <hr>
                        <span class="dpto"><?= $puntoData['dptoNombre'] . " (" . $puntoData['pais'] . ")" ?></span>
                    </div>
                    <div class="body">
                        <div class="info">
                            <span class="value"><?= $puntoData['linea1'] ?></span>
                            <span class="value"><?= $puntoData['linea2'] ?></span>
                            <span class="value"><?= $puntoData['referencias'] ?></span>
                            <?php $cost = ($puntoData['costo'] != 0) ? "$" . number_format($puntoData['costo'], 2) : "Entrega gratis" ?>
                            <span class="value"><?= $cost ?></span>
                        </div>
                        <div class="details">
                            <i class="fas fa-map-marked-alt fa-8x"></i>
                        </div>
                    </div>
                    <div class="options">
                        <div class="toggle">
                            <?php if($puntoData['estado'] == 1): ?>
                                <label for="togglePunto<?= $puntoData['id'] ?>" class="btn">
                                    <!-- <div class="far fa-circle"></div> -->
                                    <i class="fa fa-dot-circle"></i>
                                </label>
                                <div class="status">
                                    <span>Activo</span>
                                </div>
                            <?php elseif($puntoData['estado'] == 0): ?>
                                <label for="togglePunto<?= $puntoData['id'] ?>" class="btn">
                                    <i class="far fa-circle"></i>
                                </label>
                                <div class="status">
                                    <span>Inactivo</span>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="editOptions">
                            <div class="btn img">
                                <i class="fa fa-image"></i>
                            </div>
                            <div class="btn edit">
                                <i class="fa fa-pen-square"></i>
                            </div>
                            <label for="deletePunto<?= $puntoData['id'] ?>" class="btn delete">
                                    <i class="fa fa-times-circle"></i>
                            </label>

                            <form class="hidden" action="" method="POST">
                                <input type="hidden" name="puntoId" value="<?= $puntoData['id'] ?>">
                                <input type="submit" name="deletePoint" id="deletePunto<?= $puntoData['id'] ?>">
                                <input type="submit" name="togglePoint" id="togglePunto<?= $puntoData['id'] ?>">
                            </form>

                            <!-- <div class="btn cancel"></div>
                            <div class="btn reset"></div>
                            <div class="btn save"></div> -->
                        </div>
                    </div>
                </article>             
            <?php else: ?>             
                <span>No se ha encontrado el punto de entrega.</span>
            <?php endif ?>
        </div>
    </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>