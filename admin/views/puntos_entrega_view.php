<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
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
                    <img src="" alt="usrimg">
                </div>
                <div class="data">
                    <span class="nombre">Nombre usuario</span>
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
            <a href="index.php"><i class="fa fa-home"></i></a>
            <h1>Puntos de entrega</h1>
            <a href="#" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>
            <?php if ($hayPuntos): ?>
                <div class="title">
                    <h2>Todos los puntos de entrega</h2>
                    <hr>    
                </div>
                <div class="contenedor_puntos">
                    <?php foreach($puntos AS $punto): ?>
                        <article class="punto">
                            <div class="title">
                                <span class="nombre"><?= $punto['nombre'] ?></span>
                                <hr>
                                <span class="dpto"><?= $punto['dptoNombre'] . " (" . $punto['pais'] . ")" ?></span>
                            </div>
                            <div class="body">
                                <div class="info">
                                    <span class="value"><?= $punto['linea1'] ?></span>
                                    <span class="value"><?= $punto['linea2'] ?></span>
                                    <span class="value"><?= $punto['referencias'] ?></span>
                                </div>
                                <div class="details">
                                    <i class="fas fa-map-marked-alt fa-8x"></i>
                                </div>
                            </div>
                            <div class="options">
                                <div class="toggle">
                                    <?php if($punto['estado'] == 1): ?>
                                        <label for="togglePunto<?= $punto['id'] ?>" class="btn">
                                            <!-- <div class="far fa-circle"></div> -->
                                            <i class="fa fa-dot-circle"></i>
                                        </label>
                                        <div class="status">
                                            <span>Activo</span>
                                        </div>
                                    <?php elseif($punto['estado'] == 0): ?>
                                        <label for="togglePunto<?= $punto['id'] ?>" class="btn">
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
                                    <label for="deletePunto<?= $punto['id'] ?>" class="btn delete">
                                            <i class="fa fa-times-circle"></i>
                                    </label>

                                    <form class="hidden" action="" method="POST">
                                        <input type="hidden" name="puntoId" value="<?= $punto['id'] ?>">
                                        <input type="submit" name="deletePoint" id="deletePunto<?= $punto['id'] ?>">
                                        <input type="submit" name="togglePoint" id="togglePunto<?= $punto['id'] ?>">
                                    </form>

                                    <!-- <div class="btn cancel"></div>
                                    <div class="btn reset"></div>
                                    <div class="btn save"></div> -->
                                </div>
                            </div>
                        </article>                          
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
                                    <label class="tipoEntrega" for="siGratis">Si</label>
                                    <input type="radio" id="siGratis" name="tipoEntrega" value="Si">
                                    <label class="tipoEntrega" for="noGratis">No</label>
                                    <input type="radio" id="noGratis" name="tipoEntrega" value="No">
                                </div>
                                <input type="number" class="costo" min="0" max="1000" step="0.01" placeholder="10.00">
                            </div>
                        </div>
                    </form>  

                </div>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>