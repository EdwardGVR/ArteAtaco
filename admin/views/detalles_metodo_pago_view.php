<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <title>Detalles metodo</title>
</head>
<body>
    <?php require "side_bar_view.php" ?>
    <main class="mainDetPayMethod">
        <div class="bar">
            <div class="homeStoreBtns">
                <a href="index.php" title="Ir a inicio"><i class="fa fa-home"></i></a>
                <a href="../categorias.php" target="_blank" title="Ir a la tienda"><i class="fas fa-store"></i></a>
            </div>
            <h1><?= $methodDet['nombre'] ?></h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>

        <div class="devNotice">
            <?php if ($methodDet['dev_status'] == 1): ?>
                <span class="toggleError">
                    <i class="fas fa-terminal"></i>
                    &nbsp;&lt;Este m&eacute;todo de pago se encuentra en desarrollo, por lo que a&uacute;n no puede ser habilitado&#47;&gt;&nbsp;
                    <i class="fa fa-info-circle"></i>
                </span>
            <?php endif ?>
            <?php if ($userData['level'] > 2): ?>
                <div class="setDev">
                    <form id="setNewDevStatus" action="" method="POST">
                        <input type="hidden" id="newStatus" name="setNewDevStatus" value="0">
                        <label for="newDevStatus"><i class="fas fa-wrench"></i> Actualizar estado</label>
                        <select name="newDevStatus" id="newDevStatus">
                            <option value="null" disabled selected>-- Opciones --</option>
                            <option value="1">En desarrollo</option>
                            <option value="2">Listo, no habilitar</option>
                            <option value="3">Listo, habilitar</option>
                        </select>
                    </form>
                </div>
            <?php endif ?>
        </div>

            <div class="contPay">
                <?php if ($methodDet != false): ?>
                    <div class="dets">
                        <div class="name">
                            <form action="" method="POST">
                                <div class="nameEdit">
                                    <input id="newName" name="newName" type="text" class="newName" value="<?= $methodDet['nombre'] ?>" disabled>
                                    <input id="saveNewName" type="submit" class="saveNewName hidden" value="Aceptar" name="saveNewName" disabled>
                                    <div id="cancelName" class="cancel hidden">Cancelar</div>
                                    <span id="errMsg" class="errMsg hidden">Este es el nombre actual, por favor elige otro.</span>
                                </div>
                                <div class="edit" id="editName"><i class="fas fa-pen-square"></i> Editar</div>
                            </form>
                        </div>
                        <div class="info">
                            <form action="" method="POST">
                                <div class="infoEdit">
                                    <textarea id="newInfo" name="newInfo" class="newInfo" disabled><?= $methodDet['info'] ?></textarea>
                                    <input id="saveNewInfo" type="submit" class="saveNewInfo hidden" value="Aceptar" name="saveNewInfo" disabled>
                                    <div id="cancelInfo" class="cancel hidden">Cancelar</div>
                                    <span id="errMsgInfo" class="errMsg hidden">La informaci&oacute;n introducida es la misma.</span>
                                </div>
                                <div class="edit" id="editInfo"><i class="fas fa-pen-square"></i> Editar</div>
                            </form>
                        </div>
                        <div class="iconSec">
                            <div class="iconsCurrentNew">
                                <div class="currentIcon">
                                    <div class="icon" id="currentIcon"><i class="<?= $methodDet['icon'] ?>"></i></div>
                                </div>
                                <div class="arrow hidden" id="arrowIcon">
                                    <i class="fas fa-arrow-alt-circle-right"></i>
                                </div>
                                <div class="currentIcon hidden" id="newIcon">
                                    <div class="icon" id="newIconPreview"><i class="fas fa-question-circle"></i></div>
                                </div>
                            </div>
                            <form action="" class="setIcon" method="POST">
                                <div class="infoIcon">
                                    <span>C&oacute;digo del &iacute;cono actual: <?= htmlspecialchars("<i class=\"" . $methodDet['icon'] . "\"></i>") ?></span>
                                    <span class="edit" id="editIcon"><i class="fas fa-pen-square"></i> Editar</span>    
                                </div>
                                <div class="inputsIcon hidden" id="iconForm">
                                    <span>Ingrese el c&oacute;digo del nuevo &iacute;cono, puedes elegirlos desde <a href="https://fontawesome.com/icons?q=money" target="_blank">fontawesome</a></span>
                                    <input type="text" name="iconCode" id="iconCode" placeholder="<?= htmlspecialchars("<i class=\"fas fa-money-bill-alt\"></i>") ?>">
                                    <div class="buttons">
                                        <input class="hidden" type="submit" value="Aceptar" id="setNewIcon" name="setNewIcon" disabled="">
                                        <div class="cancel">Cancelar</div>
                                    </div>
                                    <span class="eqIcons hidden" id="eqIcons">Los &iacute;conos son iguales, por favor elige otro</span>
                                </div>
                            </form>
                        </div>
                        <form action="" class="options" method="POST">
                            <input type="hidden" name="currentStatus" value="<?= $methodDet['status'] ?>">
                            
                            <?php if ($methodDet['status'] == 1): ?>
                                <input type="submit" name="toggleStatus" class="opt disable" value="Deshabilitar">
                            <?php else: ?>
                                <?php if ($methodDet['dev_status'] == 1): ?>
                                    <!-- <input type="submit" name="toggleStatus" class="opt enable" value="Habilitar" disabled> -->
                                <?php else: ?>
                                    <input type="submit" name="toggleStatus" class="opt enable" value="Habilitar">
                                <?php endif ?>
                            <?php endif ?>
                            
                            <?php if ($userData['level'] > 2): ?>
                                <input id="deleteMethod" type="submit" name="deleteMethod" class="opt delete" value="Eliminar">
                            <?php endif ?>
                        </form>
                    </div>
                    <form class="datos" id="formDatos" action="" method="POST">
                        <span class="title">Datos del m&eacute;todo de pago</span>
                        <?php if($datosMethod != false): ?>
                        <?php foreach ($datosMethod as $dato): ?>
                            <div class="dato">
                                <input type="hidden" id="delDato<?= $dato['id'] ?>" name="null" value="null">
                                <input type="hidden" id="setDato<?= $dato['id'] ?>" name="null" value="null">
                                <input type="text" id="labelDato<?= $dato['id'] ?>" class="datoLabel" name="null" value="<?= $dato['dato'] ?>" disabled>
                                <input type="text" id="dato<?= $dato['id'] ?>" name="null" value="<?= $dato['valor'] ?>" disabled>
                                <div class="options">
                                    <div class="buttons">
                                        <span class="editDato" id="editDato<?= $dato['id'] ?>"><i class="fas fa-edit"></i></span>
                                        <span class="deleteDato" id="deleteDato<?= $dato['id'] ?>"><i class="fas fa-trash"></i></span>
                                        <span class="opt2 save hidden" id="saveDato<?= $dato['id'] ?>"><i class="fas fa-save"></i></span>
                                        <span class="opt2 cancel hidden" id="cancelDato<?= $dato['id'] ?>"><i class="fas fa-times-circle"></i></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                        <?php else: ?>
                            <div class="dato">No hay datos para este m&eacute;todo de pago</div>
                        <?php endif ?>
                        <div id="newDato" class="dato new">
                            <input id="newDatoSetter" type="hidden" name="null" value="null">
                            <input type="hidden" class="newDatoInput" name="newDatoName" placeholder="Etiqueta" required>
                            <input type="hidden" class="newDatoInput" name="newDatoValue" placeholder="Valor" required>
                            <div class="options">
                                <div class="buttons">
                                    <span id="saveNewDato" class="saveNew" ><i class="fas fa-save"></i></span>
                                    <span class="cancel"><i class="fas fa-times-circle"></i></span>
                                </div>
                            </div>
                        </div>
                        <div id="addDato" class="dato add">
                            <i class="fa fa-plus-circle"></i>
                        </div>
                    </form>
                <?php else: ?>
                    <span>No se encontr&oacute;</span>
                <?php endif ?>
            </div>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>