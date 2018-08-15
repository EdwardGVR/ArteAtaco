<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">   
    <link rel="stylesheet" href="css/styles.css">
    <title>Puntos de entrega</title>
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
            <h1>Puntos de entrega</h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>
            <?php if ($hayPuntos): ?>
                <div class="title">
                    <h2>Todos los puntos de entrega</h2>
                    <hr>    
                </div>
                <div class="contenedor_puntos all">
                    <?php foreach($puntos AS $punto): ?>
                        <a href="#" class="puntoList">
                            <div class="disp">
                                <span class="code">Estado</span>
                            </div>
                            <div class="pedido_cliente">
                                <span class="nombre">Nonbre</span>
                                <span class="apellido">Departamento</span>
                                <?php if (true): ?>
                                    <img class="img_cliente" src="../<?= $lastOrder['cos_img'] ?>" alt="">
                                <?php else: ?>
                                    <div class="img_cliente"><i class="fa fa-user"></i></div>
                                <?php endif ?>
                            </div>
                            <hr>
                            <div class="puntoImg">
                                <div class="imagen">
                                    <i class="fas fa-file-image"></i>
                                </div>
                            </div>
                            <hr>
                            <div class="pedido_direccion">
                                <span class="departamento">Informacion</span>
                                <span class="nombre_direccion">
                                    Informacion 
                                </span>
                                <div class="info_direccion tooltip"><i class="fas fa-info-circle"></i>
                                    <span class="tooltiptext">
                                        <?= '(' . "Informacion" . ')' ?><br/>
                                        <?= "Informacion" ?><br/>
                                        <?= "Informacion" ?>
                                    </span>
                                </div>
                            </div>
                            <div class="puntoCosto">
                                <span>$<?= number_format(0, 2) ?></span>
                            </div>
                        </a>                        
                    <?php endforeach ?>
                </div>
            <?php endif ?>
                <div class="contenedorNoPuntos">
                    <article class="punto">
                        <div id="puntosTitle" class="text">
                            <?php if($hayPuntos): ?>
                                <span>Registrar un nuevo punto.</span>
                            <?php else: ?>
                                <span>No hay puntos registrados.</span>
                            <?php endif ?>
                        </div>
                        <div id="btnShowForm" class="btnAdd">
                            <i class="fa fa-plus-circle"></i>
                        </div>
                        <div id="cancelForm" class="btnAdd noShow cancel">
                            <i class="fa fa-times-circle"></i>
                        </div>
                        <label for="resetForm" class="btnAdd noShow clear">
                            <i class="fa fa-eraser"></i>
                        </label>
                        <label for="saveForm" class="btnAdd noShow save">
                            <i class="fa fa-check-circle"></i>
                        </label>
                    </article>  

                    <form id="formNewPoint" class="hidden" action="" method="POST">
                        <input type="hidden" name="userId" value="<?php //id del usuario ?>">
                        <input type="hidden" name="tipoDir" value="2">
                        <input id="resetForm" type="reset">
                        <input id="saveForm" name="savePoint" type="submit">
                        <div class="field">
                            <label for="nombrePunto">Nombre:</label>
                            <input type="text" id="nombrePunto" name="nombrePunto" placeholder="Nombre del punto de entrega" required>
                        </div>
                        <div class="field">
                            <label for="dptoPunto">Departamento:</label>
                            <select name="dptoPunto" id="dptoPunto" required>
                                <option value="NULL" disabled selected>-- Seleccione un departamento --</option>
                                <?php foreach($departamentos AS $dpto): ?>
                                    <option value="<?= $dpto['id'] ?>"><?= $dpto['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="field">
                            <label for="paisPunto">Pa&iacute;s:</label>
                            <input type="text" id="paisPunto" name="paisPunto" value="El Salvador" placeholder="El Salvador" disabled>
                        </div>
                        <div class="field">
                            <label for="linea1">Linea 1:</label>
                            <input type="text" id="linea1" name="linea1" placeholder="Municipio, ciudad, colonia" required>
                        </div>
                        <div class="field">
                            <label for="linea2">Linea 1:</label>
                            <input type="text" id="linea2" name="linea2" placeholder="Calle, pasaje/block, #casa" required>
                        </div>
                        <div class="field">
                            <label for="refPunto">Referencias:</label>
                            <textarea name="refPunto" id="refPunto" placeholder="Ej: Frente a iglesia, a la par de banco..."></textarea>
                        </div>
                        <div class="field">
                            <label for="tipoEntrega">Entrega gratuita?</label>
                            <div class="input">
                                <div class="siNo">
                                    <label class="tipoEntrega" for="">Si</label>
                                    <input type="radio" id="siGratis" name="tipoEntrega" value="free" checked>
                                    <label class="tipoEntrega" for="">No</label>
                                    <input type="radio" id="noGratis" name="tipoEntrega" value="noFree">
                                </div>
                                <input id="costoEntrega" name="costoEntrega" type="hidden" class="costo" min="0" max="1000" step="0.01" placeholder="Ingrese el costo Ej: 10.00">
                            </div>
                        </div>
                    </form>  

                </div>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>