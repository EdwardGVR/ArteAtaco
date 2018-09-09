<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">   
    <link href="css/lightbox.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <title>Detalles cliente</title>
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
                <a href="clientes.php">Clientes</a>
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
            <h1><?= $shortName ?></h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <?php if ($datosCliente != false): ?>
        <?php 
            $nombre = $datosCliente['nombres'] . ' ' . $datosCliente['apellidos'];
            $regDate = substr($datosCliente['regDate'], 0, -9);
            $phone = ($datosCliente['telefono'] != null) ? $datosCliente['telefono'] : "No registrado";
        ?>
            <section class="costDetail">
                <div class="data 1">
                    <div class="img">
                        <?php if ($datosCliente['imagen'] != null): ?>
                            <img src="../<?= $datosCliente['imagen'] ?>" alt="">
                        <?php else: ?>
                            <i class="fa fa-user"></i>
                        <?php endif ?>
                    </div>
                    <div class="cosInfo1Cont">
                        <div class="cosInfo1">
                            <div class="title">
                                <span>Identidad:</span>
                                <hr>
                            </div>
                            <div class="detail">
                                <span>Nombre:</span>
                                <span><?= $nombre ?></span>
                                <span>Usuario:</span>
                                <span><?= $datosCliente['user'] ?></span>
                                <span>Fecha de registro:</span>
                                <span><?= $regDate ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="data 2">
                    <div class="cosInfo2Cont">
                        <div class="cosInfo2">
                            <div class="title">
                                <span>Contacto:</span>
                                <hr>
                            </div>
                            <div class="detail">
                                <span>Telefono:</span>
                                <span><?= $phone ?></span>
                                <span>Correo</span>
                                <span><?= $datosCliente['email'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="cosInfo3">
                        <div class="title">
                            <span>Direcciones:</span>
                            <hr>
                        </div>
                        <?php if ($direccionesCliente != false): ?>
                            <?php foreach ($direccionesCliente as $dir): ?>
                                <div class="direccion">
                                    <div class="dirInfo nombre">
                                        <span>Nombre:</span>
                                        <span><?= $dir['nombre'] ?> (El Salvador)</span>
                                    </div>
                                    <div class="dirInfo dpto">
                                        <span>Departamento:</span>
                                        <span><?= $dir['nombreDpto'] . ' ($' . number_format($dir['costoDpto'], 2) . ')' ?></span>
                                    </div>
                                    <div class="dirInfo lineas">
                                        <span>Direccion:</span>
                                        <span><?= $dir['linea1'] ?></span>
                                        <span><?= $dir['linea2'] ?></span>
                                        <span><?= $dir['referencias'] ?></span>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                            <div class="direccion">
                                No hay direcciones registradas.
                            </div>
                        <?php endif ?>
                    </div>
                </div>

                <div class="data 3">
                    <div class="cosInfo4">
                        <div class="title">
                            <span>Pedidos:</span>
                            <hr>
                        </div>
                        <div class="list">
                            <div class="typeCont">
                                <div class="type activos">
                                    <div class="title">
                                        <span>Activos:</span>
                                        <hr>
                                    </div>  
                                    <?php if ($pedidosCliente != false): ?>
                                        <?php $pedidosActivos = 0 ?>
                                        <?php foreach ($pedidosCliente as $orderActive): ?>
                                            <?php if ($orderActive['estado'] != 4): ?>
                                                <?php 
                                                    $cost = $orderActive['costoEnvioCompra']; 
                                                    foreach ($prodsOrders as $prod) {
                                                        if ($prod['codigo'] == $orderActive['codigo']) {
                                                            $cost += $prod['precioCompra'];
                                                        }
                                                    }
                                                ?>
                                                <?php $statusClass = strtolower(str_replace(' ', '', $orderActive['status'])) ?>
                                                <a class="order <?= $statusClass ?>" href="detallesPedido.php?order=<?= $orderActive['codigo'] ?>">
                                                    <div class="code">
                                                        #<?= $orderActive['codigo'] ?>
                                                    </div>
                                                    <div class="status">
                                                        <?= $orderActive['status'] ?>
                                                    </div>
                                                    <div class="cost">
                                                        $&nbsp;<?= number_format($cost, 2) ?>
                                                    </div>
                                                </a>
                                                <?php $pedidosActivos++ ?>
                                            <?php endif ?>
                                            <?php endforeach ?>
                                            <?php if ($pedidosActivos == 0): ?>
                                                <span>No hay pedidos activos</span>
                                            <?php endif ?>
                                    <?php else:?>
                                        <span class="noOrders">No hay pedidos.</span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="typeCont">
                                <div class="type completos">
                                    <div class="title">
                                        <span>Completos:</span>
                                        <hr>
                                    </div>
                                    <?php if ($pedidosCliente != false): ?>
                                        <?php $pedidosCompletos = 0 ?>
                                        <?php foreach ($pedidosCliente as $orderComplete): ?>
                                            <?php if ($orderComplete['estado'] == 4): ?>
                                                <?php 
                                                    $cost = $orderActive['costoEnvioCompra']; 
                                                    foreach ($prodsOrders as $prod) {
                                                        if ($prod['codigo'] == $orderActive['codigo']) {
                                                            $cost += $prod['precioCompra'];
                                                        }
                                                    }
                                                ?>
                                                <?php $statusClass = strtolower(str_replace(' ', '', $orderComplete['status'])) ?>
                                                <a class="order <?= $statusClass ?>" href="detallesPedido.php?order=<?= $orderComplete['codigo'] ?>">
                                                    <div class="code">
                                                        #<?= $orderComplete['codigo'] ?>
                                                    </div>
                                                    <div class="status">
                                                        <?= $orderComplete['status'] ?>
                                                    </div>
                                                    <div class="cost">
                                                        $&nbsp;<?= number_format($cost, 2) ?>
                                                    </div>
                                                </a>
                                                <?php $pedidosCompletos++ ?>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                        <?php if ($pedidosCompletos == 0): ?>
                                            <span>No hay pedidos completos</span>
                                        <?php endif ?>
                                    <?php else:?>
                                        <span class="noOrders">No hay pedidos.</span>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php else: ?>
            No se encontr&oacute;.
        <?php endif ?>
    </main>

    <script src="js/lightbox-plus-jquery.js"></script>
    <script src="js/script.js"></script>
</body>
</html>