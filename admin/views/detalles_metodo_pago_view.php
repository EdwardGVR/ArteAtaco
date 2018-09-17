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
            <h1><?= $methodDet['nombre'] ?></h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>
            <div class="contPay">
                <?php if ($methodDet != false): ?>
                    <div class="dets">
                        <div class="name">
                            <span>Nombre del metodos</span>
                            <div class="edit hidden" id="editName"><i class="fas fa-pen-square"></i> Editar</div>
                        </div>
                        <div class="iconSec">
                            <div class="iconsCurrentNew">
                                <div class="currentIcon">
                                    <div class="icon"><i class="fas fa-money-bill-alt"></i></div>
                                </div>
                                <div class="arrow hidden">
                                    <i class="fas fa-arrow-alt-circle-right"></i>
                                </div>
                                <div class="currentIcon hidden">
                                    <div class="icon"><i class="fas fa-question-circle"></i></div>
                                </div>
                            </div>
                            <form action="" class="setIcon" method="POST">
                                <div class="infoIcon">
                                    <span>C&oacute;digo del &iacute;cono actual: <?= htmlspecialchars("<i class=\"fas fa-money-bill-alt\"></i>") ?></span>
                                    <span class="edit" id="editIcon"><i class="fas fa-pen-square"></i> Editar</span>
                                </div>
                                <div class="inputs hidden">
                                    <span>Ingrese el c&oacute;digo del nuevo &iacute;cono</span>
                                    <input type="text" name="iconCode" id="iconCode" placeholder="<?= htmlspecialchars("<i class=\"fas fa-money-bill-alt\"></i>") ?>">
                                    <div class="buttons">
                                        <input type="submit" value="Aceptar" id="setNewIcon">
                                        <div class="cancel">Cancelar</div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="options">
                            <div class="opt">Editar</div>
                            <div class="opt">Deshabilitar</div>
                            <div class="opt">Eliminar</div>
                        </div>
                    </div>
                <?php else: ?>
                    <span>No se encontro</span>
                <?php endif ?>
            </div>
        </section>
    </main>
</body>
</html>