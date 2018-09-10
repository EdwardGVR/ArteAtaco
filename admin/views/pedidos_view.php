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
            <h1>Pedidos</h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>
            <div class="title">
                <h2>Todos los pedidos</h2>
                <hr>
            </div>
            <div class="contenedor_pedidos all">
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
            </div>
        </section>
    </main>
</body>
</html>