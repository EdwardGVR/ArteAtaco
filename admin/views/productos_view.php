<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">   
    <link href="css/styles.css" rel="stylesheet">
    <title>Productos</title>
</head>
<body>
    <?php require "side_bar_view.php" ?>
    <main>
        <div class="bar">
            <div class="homeStoreBtns">
                <a href="index.php" title="Ir a inicio"><i class="fa fa-home"></i></a>
                <a href="../categorias.php" target="_blank" title="Ir a la tienda"><i class="fas fa-store"></i></a>
            </div>
            <h1>Productos</h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section class="productsAdmin">
            <?php if ($products != false): ?>
                <div class="title">
                    <h2>Viendo: Todos los productos</h2>
                    <hr>
                </div>
                <div class="contenedor_productos all">
                    <?php foreach ($products as $prod): ?>
                        <?php if ($prod['disponible'] == 1): ?>
                        <a href="detallesProducto.php?idProd=<?= $prod['id'] ?>" class="producto">
                            <div class="disp y">
                                <span>Disponible</span>
                            </div>
                        <?php elseif ($prod['disponible'] == 0): ?>
                            <a href="detallesProducto.php?idProd=<?= $prod['id'] ?>" class="producto noDisp">
                            <div class="disp n">
                                <span>No disponible</span>
                            </div>
                        <?php endif ?>
                            <?php $catName = ($prod['to_others'] == 1) ? " Ahora en otros" : $prod['catName']; ?>
                            <div class="producto_nombre">
                                <span class="nombre"><?= $prod['nombre'] ?></span>
                                <span class="categoria"><?= $catName ?></span>
                                <div class="img_categoria"></div>
                            </div>
                            <hr>
                            <!-- Validacion de imagenes -->
                            <?php $imgsCounter = 0; $mainImg = false; 
                                foreach ($imgs as $img) {
                                    if ($img['id_prod'] == $prod['id']) { $imgsCounter++;
                                        if ($imgsCounter > 0 && $img['principal'] == 1) {
                                            $mainImg = true; $imgPath = $img['ruta']; }
                                        if ($imgsCounter > 0 && !$mainImg) { $imgPath = $img['ruta']; }
                                }   } ?>
                            <div class="producto_imagen">
                                <?php if ($imgsCounter > 0): ?>
                                    <img src="../<?= $imgPath ?>" alt="x" class="imagen">
                                <?php else: ?>
                                    <div class="imagen">
                                        <i class="fas fa-file-image"></i>
                                    </div>
                                <?php endif ?>
                            </div>
                            <hr>
                            <div class="producto_descripcion">
                                <span><?= $prod['descripcion'] ?></span>
                            </div>
                            <div class="producto_precio">
                                <span>$<?= number_format($prod['precio'], 2) ?></span>
                            </div>
                        </a>
                    <?php endforeach ?>
                </div>

            <?php endif ?>

            <?php if ($categorias != false): ?>
                <div class="newProduct">
                    <div class="add_product" id="addProductBtn">
                        <div class="icon"><i class="fa fa-plus-circle"></i></div>
                    </div>

                    <form action="" class="newProductForm hidden" id="newProductForm" method="POST">
                        <div class="data">
                            <span class="title">Agregar nuevo producto.</span>

                            <div class="field">
                                <label for="newProdName">Nombre:</label>
                                <input type="text" name="newProdName" id="newProdName" placeholder="Nombre del nuevo producto">
                            </div>

                            <div class="field">
                                <label for="newProdCat">Categor&iacute;a:</label>
                                <select name="newProdCat" id="newProdCat">
                                    <option value="NULL" disabled selected>- - Seleccione una categor&iacute;a - -</option>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <?php $catStatusMsg = ($categoria['status'] == 0) ? " (actualmente inactiva)" : ""; ?>
                                        <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre_cat'] . $catStatusMsg ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="field">
                                <label for="newProdPrice">Precio:</label>
                                <input type="number" name="newProdPrice" id="newProdPrice" min="0" step="0.01" placeholder="00.00">
                            </div>

                            <div class="field">
                                <label for="newProdDesc">Descripci&oacute;n:</label>
                                <textarea type="number" name="newProdDesc" id="newProdDesc" placeholder="Descripci&oacute;n del nuevo producto"></textarea>
                            </div>
                        </div>

                        <div class="options">
                            <div class="opt save">
                                <input type="submit" name="saveNewProduct" id="saveNewProduct">
                                <label for="saveNewProduct" title="Guardar"><i class="fa fa-save"></i></label>
                            </div>
                            <div class="opt reset">
                                <input type="reset" id="resetNewProduct">
                                <label for="resetNewProduct" title="Limpiar formulario"><i class="fa fa-eraser"></i></label>
                            </div>
                            <div class="opt cancel">
                                <div class="icon cancelNewProd" id="cancelNewProd" title="Cancelar"><i class="fa fa-times-circle"></i></div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php else: ?>
                <span class="regCats">Empieza <a href="categorias.php">creando categor&iacute;as <i class="fa fa-plus-circle"></i> </a></span>
            <?php endif ?>
        </section>
    </main>
    <script src="js/script.js"></script>
</body>
</html>