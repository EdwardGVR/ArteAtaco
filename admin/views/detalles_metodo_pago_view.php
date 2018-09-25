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
    <main>
        <div class="bar">
            <div class="homeStoreBtns">
                <a href="index.php" title="Ir a inicio"><i class="fa fa-home"></i></a>
                <a href="../categorias.php" title="Ir a la tienda"><i class="fas fa-store"></i></a>
            </div>
            <h1><?= $methodDet['nombre'] ?></h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>
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
                                <input type="submit" name="toggleStatus" class="opt enable" value="Habilitar">
                            <?php endif ?>
                            <input id="deleteMethod" type="submit" name="deleteMethod" class="opt delete" value="Eliminar">
                        </form>
                    </div>
                <?php else: ?>
                    <span>No se encontro</span>
                <?php endif ?>
            </div>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>