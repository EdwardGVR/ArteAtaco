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
                <a href="../categorias.php" target="_blank" title="Ir a la tienda"><i class="fas fa-store"></i></a>
            </div>
            <h1>Inicio</h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>
            <div class="title">
                <h2>Pedidos recientes</h2>
                <hr>
            </div>
            <div class="contenedor_pedidos">
                <?php if ($lastOrders != false): ?>
                    <?php foreach ($lastOrders as $lastOrder): ?>
                        <?php $subtotal = 0 ?>
                        <a href="detallesPedido.php?order=<?= $lastOrder['codigo'] ?>" class="pedido">
                            <?php $statusClass = strtolower(str_replace(' ', '', $lastOrder['status'])) ?>
                            <div class="codigo <?= $statusClass ?>">
                                <span class="code">#<?= $lastOrder['codigo'] ?></span>
                                <span class="status">
                                    <i class="fa fa-info-circle"></i>
                                    &nbsp;<?= $lastOrder['status'] ?>
                                </span>
                            </div>
                            <div class="pedido_cliente">
                                <span class="nombre"><?= $lastOrder['cos_names'] ?></span>
                                <span class="apellido"><?= $lastOrder['cos_apellidos'] ?></span>
                                <?php if ($lastOrder['cos_img'] != NULL): ?>
                                    <img class="img_cliente" src="../<?= $lastOrder['cos_img'] ?>" alt="">
                                <?php else: ?>
                                    <div class="img_cliente"><i class="fa fa-user"></i></div>
                                <?php endif ?>
                            </div>
                            <hr>
                            <div class="pedido_productos">
                                <?php foreach ($orderProds as $prod): ?>
                                    <?php if ($lastOrder['codigo'] == $prod['codigo']): ?>
                                        <div class="producto">
                                            <span class="cantidad"><?= $prod['cantidad'] ?>x</span>
                                            <span class="nombre_producto"><?= $prod['prod_name'] ?></span>
                                            <span class="precio">$<?= number_format($prod['precioCompra'], 2) ?></span>
                                        </div>
                                        <?php $subtotal += $prod['precioCompra'] ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </div>
                            <hr>
                            <div class="pedido_direccion">
                                <span class="departamento"><?= $lastOrder['dir_dpto'] ?></span>
                                <span class="nombre_direccion">
                                    <?= $lastOrder['dir_name'] . ' ($' . number_format($lastOrder['costoEnvioCompra'], 2) . ')' ?>
                                </span>
                                <div class="info_direccion tooltip"><i class="fas fa-info-circle"></i>
                                    <span class="tooltiptext">
                                        <?= '(' . $lastOrder['dir_tipo'] . ')' ?><br/>
                                        <?= $lastOrder['dir_linea1']?><br/>
                                        <?= $lastOrder['dir_linea2'] ?>
                                    </span>
                                </div>
                            </div>
                            <div class="pedido_total">
                                <?php $subtotal += $lastOrder['costoEnvioCompra'] ?>
                                <span>$<?= number_format($subtotal, 2) ?></span>
                            </div>
                        </a>
                    <?php endforeach ?>
                <?php else: ?>
                    <div class="noOrders">
                        <span>No hay pedidos que mostrar</span>
                    </div>
                <?php endif ?>
            </div>
            <div class="button">
                <a href="pedidos.php">Ver todos</a>
            </div>
        </section>

        <section>
            <div class="title">
                <h2>Nuevos productos</h2>
                <hr>
            </div>
            <div class="contenedor_productos">
                <?php if ($lastProducts != false): ?>
                    <?php foreach ($lastProducts AS $lastProd): ?>
                        <a href="detallesProducto.php?idProd=<?= $lastProd['id'] ?>" class="producto">
                            <div class="producto_nombre">
                                <span class="nombre"><?= $lastProd['nombre'] ?></span>
                                <span class="categoria"><?= $lastProd['catName'] ?></span>
                                <div class="img_categoria"></div>
                            </div>
                            <hr>
                            <!-- Validacion de imagenes -->
                            <?php 
                                $imgsCounter = 0; $mainImg = false; 
                                foreach ($imgs as $img) {
                                    if ($img['id_prod'] == $lastProd['id']) {
                                        $imgsCounter++;
                                        if ($imgsCounter > 0 && $img['principal'] == 1) {
                                            $mainImg = true; $imgPath = $img['ruta'];
                                        }
                                        if ($imgsCounter > 0 && !$mainImg) {
                                            $imgPath = $img['ruta'];
                                        }
                                    }
                                }
                            ?>
                            <div class="producto_imagen">
                                <?php if ($imgsCounter > 0): ?>
                                    <img src="../<?= $imgPath ?>" alt="x" class="imagen">
                                <?php else: ?>
                                    <div class="imagen">
                                        <i class="fas fa-file-image"></i>
                                    </div>
                                <?php endif ?>
                            </div>
                            <hr>
                            <div class="producto_descripcion">
                                <span><?= $lastProd['descripcion'] ?></span>
                            </div>
                            <div class="producto_precio">
                                <span>$<?= number_format($lastProd['precio'], 2) ?></span>
                            </div>
                        </a>
                    <?php endforeach ?>
                <?php else: ?>
                    <div class="noOrders">
                        <span>No hay productos que mostrar</span>
                    </div>
                <?php endif ?>
            </div>
            <div class="button">
                <a href="productos.php">Ver todos</a>
            </div>
        </section>
    </main>
    <script src="js/script.js"></script>
</body>
</html>