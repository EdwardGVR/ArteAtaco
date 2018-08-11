<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">   
    <link rel="stylesheet" href="css/styles.css">
    <title>Pedidos</title>
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
            <h1>Pedidos</h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>
            <div class="title">
                <h2>Todos los pedidos</h2>
                <hr>
            </div>
            <div class="contenedor_pedidos">
                <?php foreach ($pedidos AS $pedido): ?>
                    <?php $subtotal = 0; ?>
                    <article class="pedido_todos">
                    <div class="pedido_header">
                        <div class="codigo">#<?= $pedido['codigo'] ?></div>
                    </div>
                    <div class="pedido_body">
                        <div class="pedido_cliente_direccion">
                            <div class="pedido_cliente">
                                    <div class="titulo">
                                        <span>Cliente</span>
                                        <hr>
                                    </div>
                                    <div class="info">
                                        <div class="imagen">
                                            <?php if ($pedido['cos_img'] == NULL): ?>
                                                <i class="fas fa-user fa-2x"></i>
                                            <?php else: ?>
                                                <img src="../<?= $pedido['cos_img'] ?>" alt="">
                                            <?php endif ?>
                                        </div>
                                        <div class="datos">
                                            <span class="nombres"><?= $pedido['cos_names'] ?></span>
                                            <span class="apellidos"><?= $pedido['cos_apellidos'] ?></span>
                                            <hr>
                                            <?php if ($pedido['cos_tel'] == NULL): ?>
                                                <span class="tel">No se ha registrado tel&eacute;fono</span>
                                            <?php else: ?>
                                                <span class="tel"><?= $pedido['cos_tel'] ?></span>
                                            <?php endif ?>
                                            <span class="email"><?= $pedido['cos_email'] ?></span>
                                        </div>
                                    </div>
                            </div>
                            <div class="pedido_direccion">
                                    <div class="titulo">
                                        <span>Direccion (<?= $pedido['dir_tipo'] ?>)</span>
                                        <hr>
                                    </div>
                                    <div class="info">
                                        <span><?= $pedido['dir_dpto'] ?></span>
                                        <span><?= $pedido['dir_name'] ?></span>
                                        <hr>
                                        <span class="det">
                                            <?= $pedido['dir_linea1'] ?>, <?= $pedido['dir_linea2'] ?>, <?= $pedido['dir_refs'] ?>
                                        </span>
                                    </div>
                            </div>
                        </div>
                        <div class="ped_prods">
                            <div class="title">
                                <span>Productos</span>
                                <hr>
                            </div>
                            <div class="prods">
                                <?php foreach ($prods_pedidos AS $prod): ?>
                                    <?php if ($pedido['codigo'] == $prod['codigo']): ?>
               							<!-- Validacion de imagenes -->
                                        <?php 
                                            $imgsCounter = 0; $mainImg = false; 
                                            foreach ($imgs as $img) {
                                                if ($img['id_prod'] == $prod['prod_id']) {
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
                                        <div class="ped_prod">
                                            <?php if ($imgsCounter > 0): ?>
                                                <img src="../<?= $imgPath ?>" alt="x" class="imagen">
                                            <?php else: ?>
                                                <div class="imagen">
                                                    <i class="fas fa-file-image fa-2x"></i>
                                                </div>
                                            <?php endif ?>
                                            <div class="datos">
                                                <span class="nombre"><?= $prod['prod_name'] ?></span>
                                                <span class="cat"><?= $prod['prod_cat'] ?></span>
                                                <span class="cant"><?= $prod['cantidad'] ?>x</span>
                                                <span class="precio">$<?= number_format($prod['precioCompra'], 2) ?></span>
                                            </div>
                                        </div>
                                        <?php $subtotal += $prod['precioCompra'] ?>  
                                    <?php endif ?>
                                <?php endforeach ?>                                                      
                            </div>                                       
                        </div>
                        <div class="total">
                            <div class="envio">
                                <div class="icon"><i class="fas fa-tags fa-lg"></i></div>
                                <div class="mount">
                                    <span>Sub-total:</span>
                                    <span>$<?= number_format($subtotal, 2) ?></span>
                                </div>                               
                            </div>
                            <div class="subtotal">
                                <div class="icon"><i class="fas fa-truck fa-lg"></i></div>
                                <div class="mount">
                                    <span>Costo de env&iacute;o:</span>
                                    <span>$<?= number_format($pedido['costoEnvioCompra'], 2) ?></span>
                                </div>
                            </div>
                            <div class="total_sum">
                                <div class="icon"><i class="fas fa-money-bill-alt fa-lg"></i></div>
                                <div class="mount">
                                    <span>Total:</span>
                                    <span>$<?= number_format($subtotal + $pedido['costoEnvioCompra'], 2) ?></span>
                                </div>
                            </div>
                        </div>

                        <?php $statusClass = strtolower(str_replace(' ', '', $pedido['status'])) ?>

                        <div class="estado">
                            <div class="actual">
                                <div class="indicador <?= $statusClass ?>">
                                    <i class="fa fa-info"></i>
                                </div>
                                <span class="<?= $statusClass ?>">
                                    Estado actual del pedido: <?= $pedido['status'] ?>
                                </span>
                            </div>
                            <div class="update updOrderStat" id="updOrderStat">
                                Actualizar
                            </div>
                            <form id="orderStatusForm" class="select_status orderStatusForm" action="" method="post">
                                <select class="sel_stat_hidden sel_status" name="newStatus" id="sel_status">
                                    <?php foreach ($orderStatus AS $status): ?>
                                        <?php if ($pedido['status'] == $status['status']): ?>
                                            <option value="<?= $status['id'] ?>" selected>
                                                <?= $status['status'] ?>
                                            </option>
                                        <?php else: ?>
                                            <option value="<?= $status['id'] ?>">
                                                <?= $status['status'] ?>
                                            </option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </select>
                                <input type="hidden" name="orderCode" value="<?= $pedido['codigo'] ?>">
                                <input id='submit_status' name="changeStatus" class='submit_status' type="submit" value="Aceptar">
                            </form>
                        </div>
                    </div>
                    </article>                           
                <?php endforeach ?>
            </div>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>