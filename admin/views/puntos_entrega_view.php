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
    <?php require "side_bar_view.php" ?>
    <main>
        <div class="bar">
            <div class="homeStoreBtns">
                <a href="index.php" title="Ir a inicio"><i class="fa fa-home"></i></a>
                <a href="../categorias.php" target="_blank" title="Ir a la tienda"><i class="fas fa-store"></i></a>
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
                        <?php $status = ($punto['estado']) ? "Activo" : "Inactivo" ?>
                        <a href="detallesPuntoEntrega.php?idPunto=<?= $punto['id'] ?>" class="puntoList <?= $status ?>">
                            <div class="disp <?= $status ?>">
                                <span class="code"><?= $status ?></span>
                            </div>
                            <div class="puntoInfo">
                                <span class="nombre"><?= $punto['nombre'] ?></span>
                                <span class="apellido"><?= $punto['dptoNombre'] ?></span>
                                <span class="pais"><?= $punto['pais'] ?></span>
                            </div>
                            <hr>
                            <div class="puntoImg">
                                <span class="linea1"><?= $punto['linea1'] ?></span>
                                <span class="linea2"><?= $punto['linea2'] ?></span>
                            </div>
                            <hr>
                            <div class="puntoRefs">
                                <span><?= $punto['referencias'] ?></span>
                            </div>
                            <div class="puntoCosto">
                                <?php $cost = ($punto['costo'] != 0) ? "$" . number_format($punto['costo'], 2) : "Entrega gratis" ?>
                                <span><?= $cost ?></span>
                            </div>
                        </a>                        
                    <?php endforeach ?>
                </div>
            <?php endif ?>
                <div class="contenedorNoPuntos">
                    <article class="punto">
                        <div id="puntosTitle" class="text">
                            <?php if($hayPuntos): ?>
                                <span>Registrar nuevo punto.</span>
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
                                <option value="NULL" disabled selected>-- Seleccione --</option>
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