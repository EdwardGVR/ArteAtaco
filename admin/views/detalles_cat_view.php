<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="css/lightbox.css" rel="stylesheet">
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
            <?php $status = ($cat['status'] == 1) ? "activa" : "inactiva"; ?>
            <div class="contCatDet">
                <div id="status" class="status <?= $status ?>">
                    <form id="setActiveForm" class="hidden" action="detallesCategoria.php?cat=<?= $cat['id'] ?>" method="POST">
                        <input type="hidden" name="setActive" value="<?= $cat['status'] ?>">
                        <input type="hidden" name="currentStatus" value="<?= $cat['status'] ?>">
                    </form>
                    <form id="toggleHide" class="hidden" action="detallesCategoria.php?cat=<?= $cat['id'] ?>" method="POST">
                        <input type="hidden" name="toggleAndHide" value="<?= $cat['status'] ?>">
                        <input type="hidden" name="currentStatus" value="<?= $cat['status'] ?>">
                    </form>
                    <form id="toggleOthers" class="hidden" action="detallesCategoria.php?cat=<?= $cat['id'] ?>" method="POST">
                        <input type="hidden" name="toggleAndToOthers" value="<?= $cat['status'] ?>">
                        <input type="hidden" name="currentStatus" value="<?= $cat['status'] ?>">
                    </form>
                    <form id="deleteCatForm" class="hidden" action="detallesCategoria.php?cat=<?= $cat['id'] ?>" method="POST">
                        <input type="hidden" name="deleteCat" value="deleteCat">
                        <input type="hidden" id="prodsAction" name="prodsAction" value="unknown">
                    </form>

                    <span id="statusMsg">La categor&iacute;a est&aacute; <?= $status ?></span>
                    
                    <?php if ($cat['id'] != 1): ?>
                        <div id="switch" class="switch">
                            <div class="box">
                                <div draggable="true" class="circle"></div>
                            </div>
                        </div>
                        <div id="deleteCatBtn" class="delete">
                            <i class="fa fa-trash"></i>
                        </div>
                    <?php endif ?>

                </div>
                <div class="info">
                    <form id="editName" action="detallesCategoria.php?cat=<?= $cat['id'] ?>" class="name" method="POST">
                        <input type="hidden" name="editName">
                        <div class="field">
                            <?php $name = html_entity_decode($cat['nombre_cat']) ?>
                            <label for="catName">Nombre:</label>
                            <input id="catName" type="text" name="catName" value="<?= $name ?>" placeholder="<?= $name ?>" disabled>
                            <div class="options">
                                <?php if ($cat['id'] != 1): ?>
                                    <span id="editName" class="editBtn opt">Editar &nbsp; <i class="fa fa-edit"></i> </span>
                                <?php endif ?>
                                <span id="saveName" class="saveBtn opt hidden">Guardar</span>
                                <span id="sameName" class="sameInfo hidden">El nombre ingresado es el mismo</span>
                                <span id="cancelName" class="cancelBtn opt hidden">Cancelar</span>
                            </div>
                        </div>
                    </form>
                    <form id="editDesc" action="detallesCategoria.php?cat=<?= $cat['id'] ?>" class="desc" method="POST">
                        <input type="hidden" name="editDesc">
                        <div class="field">
                            <?php $desc = html_entity_decode($cat['descripcion']) ?>
                            <label for="catDesc">Descripci&oacute;n:</label>
                            <textarea name="catDesc" id="catDesc" disabled><?= $desc ?></textarea>
                            <div class="options">
                                <span id="editInfo" class="editBtn opt">Editar &nbsp; <i class="fa fa-edit"></i> </span>
                                <span id="saveInfo" class="saveBtn opt hidden">Guardar</span>
                                <span id="sameInfo" class="sameInfo hidden">La descripci&oacute;n es la misma</span>
                                <span id="cancelInfo" class="cancelBtn opt hidden">Cancelar</span>
                            </div>
                        </div>
                    </form>
                    <form id="editImg" enctype="multipart/form-data" action="detallesCategoria.php?cat=<?= $cat['id'] ?>" class="img" method="POST">
                        <div class="field">
                            <label for="meh">Imagen:</label>
                            <div class="catImg">
                                <img src="../<?= $cat['imagen'] ?>" alt="x">
                                <a href="../<?= $cat['imagen'] ?>" class="bg" data-lightbox="Imagen de la categoria">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>
                            <div class="options">
                                <input type="hidden" name="catName" value="<?= $cat['nombre_cat'] ?>">
                                <input type="hidden" name="setImg">
                                <label for="catImg" class="uploadBtn opt">Subir &nbsp; <i class="fa fa-camera"></i> </label>
                                <input type="file" name="catImg" id="catImg" class="hidden" accept="image/*">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="catProds">
                    <?php if ($prods != false): ?>
                        <span class="title">Productos de la categor&iacute;a</span>
                        <?php  foreach($prods as $prod): ?>
                            <?php $statusClass = ($prod['disponible'] == 1) ? "disponible" : "noDisponible"; ?>
                            <!-- Validacion de imagenes -->
                            <?php $imgsCounter = 0; $mainImg = false; 
                                foreach ($imgsProds as $img) {
                                    if ($img['id_prod'] == $prod['id']) { $imgsCounter++;
                                        if ($imgsCounter > 0 && $img['principal'] == 1) {
                                            $mainImg = true; $imgPath = $img['ruta']; }
                                        if ($imgsCounter > 0 && !$mainImg) {
                                            $imgPath = $img['ruta']; } 
                                }   } ?>
                            <a href="detallesProducto.php?idProd=<?= $prod['id'] ?>" class="prod <?= $statusClass ?>">
                                <div class="img">
                                <?php if ($imgsCounter > 0): ?>
                                    <img src="../<?= $imgPath ?>" alt="x">
                                <?php else: ?>
                                    <i class="fas fa-file-image"></i>
                                <?php endif ?>
                                </div>
                                <div class="name">
                                    <span><?= $prod['nombre'] ?></span>
                                </div>
                            </a>
                        <?php endforeach ?>
                    <?php else: ?>
                        <span class="title">No hay productos en esta categor&iacute;a</span>
                    <?php endif ?>
                </div>
            </div>

            <div id="modal" class="modalMsg">
                <div id="toggleMsg" class="confirmToggle hidden">
                    <p>La categor&iacute;a pasar&aacute; a estar inactiva, lo que significa que no se mostrar&aacute; al cliente pero
                    seguir&aacute; estando disponible en el panel de administraci&oacute;n.</p>
                    <p>Seleccione que desea hacer con los productos pertenecientes a esta categor&iacute;a:</p>
                    <div class="options">
                        <div id="hideProds" class="opt hide"><span>No mostrar</span></div>
                        <div id="toOthers" class="opt showMisc"><span>Mostrar en "otros"</span></div>
                        <div id="closeModal" class="opt cancel"><span>Cancelar</span></div>
                    </div>
                </div>

                <div id="deleteMsg" class="confirmToggle hidden">
                    <p>La categor&iacute;a ser&aacute; eliminada, no se mostrar&aacute; al cliente ni
                    estar&aacute; disponible en el panel de administraci&oacute;n.</p>
                    <p>Seleccione que hacer con los productos de esta categor&iacute;a:</p>
                    <div class="options">
                        <div id="del-noDisp" class="opt hide"><span>No disponibles</span></div>
                        <div id="del-toOthers" class="opt showMisc"><span>Mostrar en "otros"</span></div>
                        <div id="delProds" class="opt cancel"><span>Eliminar</span></div>
                        <div id="closeDelete" class="opt cancel"><span>Cancelar</span></div>
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

    <script src="js/lightbox-plus-jquery.js"></script>
    <script src="js/script.js"></script>
</body>
</html>