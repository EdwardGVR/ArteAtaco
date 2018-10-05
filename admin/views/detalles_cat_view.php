<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <title>Detalles categoria</title>
</head>
<body>
    <?php require "side_bar_view.php" ?>
    <main>
        <div class="bar">
            <div class="homeStoreBtns">
                <a href="index.php" title="Ir a inicio"><i class="fa fa-home"></i></a>
                <a href="../categorias.php" target="_blank" title="Ir a la tienda"><i class="fas fa-store"></i></a>
            </div>
            <h1><?= $cat['nombre_cat'] ?></h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>
        <?php if ($cat != false): ?>
            <div class="contCatDet">
                <?php $status = ($cat['status'] == 1) ? "activa" : "inactiva"; ?>
                <div id="status" class="status <?= $status ?>">
                    <span id="statusMsg">La categor&iacute;a est&aacute; <?= $status ?></span>
                    <form id="setActiveForm" action="detallesCategoria.php?cat=<?= $cat['id'] ?>" method="POST">
                        <input type="hidden" name="setActive" value="<?= $cat['status'] ?>">
                        <input type="hidden" name="currentStatus" value="<?= $cat['status'] ?>">
                    </form>
                    <form id="toggleHide" action="detallesCategoria.php?cat=<?= $cat['id'] ?>" method="POST">
                        <input type="hidden" name="toggleAndHide" value="<?= $cat['status'] ?>">
                        <input type="hidden" name="currentStatus" value="<?= $cat['status'] ?>">
                    </form>
                    <form id="toggleOthers" action="detallesCategoria.php?cat=<?= $cat['id'] ?>" method="POST">
                        <input type="hidden" name="toggleAndToOthers" value="<?= $cat['status'] ?>">
                        <input type="hidden" name="currentStatus" value="<?= $cat['status'] ?>">
                    </form>
                    <div id="switch" class="switch">
                        <div class="box">
                            <div draggable="true" class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal" class="modalMsg">
                <div class="confirmToggle">
                    <p>La categor&iacute;a pasar&aacute; a estar inactiva, lo que significa que no se mostrar&aacute; al cliente pero
                    seguir&aacute; estando disponible en el panel de administraci&oacute;n.</p>
                    <p>Seleccione que desea hacer con los productos pertenecientes a esta categor&iacute;a:</p>
                    <div class="options">
                        <div id="hideProds" class="opt hide"><span>No mostrar</span></div>
                        <div id="toOthers" class="opt showMisc"><span>Mostrar en "otros"</span></div>
                        <div id="closeModal" class="opt cancel"><span>Cancelar</span></div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="contCatDet">
                <span>No se encontr&oacute;</span>
            </div>
        <?php endif ?>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>