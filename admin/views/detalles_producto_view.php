<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">   
    <link href="css/lightbox.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <title>Detalles producto</title>
</head>
<body>
    <?php require "side_bar_view.php" ?>
    <main>
        <div class="bar">
            <div class="homeStoreBtns">
                <a href="index.php" title="Ir a inicio"><i class="fa fa-home"></i></a>
                <a href="../categorias.php" target="_blank" title="Ir a la tienda"><i class="fas fa-store"></i></a>
            </div>
            <h1><?= $producto['nombre'] ?></h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section class="productsAdmin">
            <div class="contenedor_productos">
                <?php if ($producto['disponible'] == 1): ?>
                    <div class="producto_list">

                        <form action="" class="info" method="POST">
                            <span class="title">Datos del producto</span>
                            <hr>
                            <div class="field">
                                <span class="label">Nombre</span>
                                <input 
                                    type="text"
                                    name="nombreProd"
                                    class="value name valueProd<?= $producto['id'] ?>"
                                    value="<?= $producto['nombre']?>"
                                    disabled
                                >
                            </div>
                            <div class="field">
                                <a href="detallesCategoria.php?cat=<?= $producto['id_categoria'] ?>" class="label">
                                    Categor&iacute;a
                                </a>
                                <select 
                                    type="text" 
                                    name="catProd" 
                                    class="value valueProd<?= $producto['id'] ?>" 
                                    value="<?= $producto['nombre_cat'] ?>" 
                                    disabled>
                                    <option value="null" disabled>-- Seleccione una categor&iacute;a --</option>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <?php $catDispMsg = ($categoria['status'] == 0) ? " (Inactiva actualmente)" : ""; ?>
                                        <?php if ($producto['id_categoria'] == $categoria['id']): ?>
                                            <option value="<?= $categoria['id'] ?>" selected><?= $categoria['nombre_cat'] . $catDispMsg ?></option>
                                        <?php else: ?>
                                            <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre_cat'] . $catDispMsg ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                    <option value="others">Otros</option>
                                </select>
                            </div>
                            <div class="field">
                                <span class="label">Precio ($)</span>
                                <input 
                                    id="precioProd"
                                    type="text" 
                                    name="precioProd" 
                                    class="value valueProd<?= $producto['id'] ?>" 
                                    value="<?= number_format($producto['precio'], 2) ?>"
                                    step="0.10"
                                    min="0" 
                                    disabled
                                >
                            </div>
                            <div class="field">
                                <span class="label">Descripci&oacute;n</span>
                                <textarea 
                                    name="descProd" 
                                    class="value valueProd<?= $producto['id'] ?>" 
                                    placeholder="<?= $producto['descripcion'] ?>" 
                                    disabled><?= $producto['descripcion'] ?>
                                </textarea>
                            </div>
                            <span class="dateReg">Fecha y hora de registro: <?= $producto['fecha_registro'] ?></span>
                            <input type="hidden" name="idProd" value="<?= $producto['id'] ?>">
                            <input type="submit" name="saveChangesProd" id="saveChangesProd<?= $producto['id'] ?>">
                        </form>

                        <div class="imgs">
                            <div class="main">
                                <?php foreach ($imgsProds as $imgProd): ?>
                                    <?php if ($imgProd['id_prod'] == $producto['id']): ?>
                                        <?php $imgsForThisProd = TRUE ?>
                                        <?php if ($imgProd['principal'] == 1): ?>
                                            <img src="../<?= $imgProd['ruta'] ?>" alt="">
                                        <?php else: ?>
                                            <span>No se ha definido im&aacute;gen principal <i class="fa fa-star-half"></i></span>
                                        <?php endif ?>
                                    <?php else: ?>
                                        <?php $imgsForThisProd = FALSE ?>
                                    <?php endif?>
                                <?php endforeach ?>

                                <?php if ( isset($imgsForThisProd) && !$imgsForThisProd): ?>
                                    <div class="noImgsText">
                                        <span>No hay im&aacute;genes para este producto </span>
                                        <div class="icons">
                                            <i class="fa fa-images fa-2x"></i> <i class="fa fa-exclamation-circle fa-2x"></i>
                                        </div>
                                        <span>Para agregar haga click en</span>
                                        <div class="icons">
                                            <i class="fa fa-plus-circle"></i>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>

                            <div class="others">
                                <?php foreach ($imgsProds as $imgProd): ?>
                                    <?php if ($imgProd['id_prod'] == $producto['id']): ?>
                                        <?php $cantImgsPorProducto++ ?>
                                        <div class="other-img">
                                            <div class="img">
                                                <img src="../<?= $imgProd['ruta'] ?>" alt="">
                                                <a href="../<?= $imgProd['ruta'] ?>" class="bg" data-lightbox="producto<?= $producto['id'] ?>">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                            <form action="" class="icons" method="POST">
                                                <input type="hidden" name="prodId" value="<?= $producto['id'] ?>">
                                                <input type="hidden" name="imgId" value="<?= $imgProd['id'] ?>">
                                                <input type="hidden" name="imgPath" value="<?= $imgProd['ruta'] ?>">
                                                <input type="submit" name="setMainImg" id="setMainImg<?= $imgProd['id'] ?>">
                                                <input type="submit" name="deleteImg" id="deleteImg<?= $imgProd['id'] ?>">
                                                <?php if ($imgProd['principal'] == 0): ?>
                                                    <label for="setMainImg<?= $imgProd['id'] ?>" class="set-main"><i class="fa fa-star"></i></label>
                                                <?php else: ?>
                                                    <i class="fa fa-star currentMain"></i>
                                                <?php endif ?>
                                                <label for="deleteImg<?= $imgProd['id'] ?>" class="delete"><i class="fas fa-trash-alt"></i></label>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <?php $cantImgsPorProducto = 0 ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                                
                                <?php if ($cantImgsPorProducto < 5): ?>
                                    <form class="add_img" action="" enctype="multipart/form-data" method="POST">
                                        <input type="hidden" name="idCat" value="<?= $producto['id_categoria'] ?>">
                                        <input type="hidden" name="idProd" value="<?= $producto['id'] ?>">
                                        <input type="file" onchange="this.form.submit()" id="uploadImgProd<?= $producto['id'] ?>" name="newImg" accept="image/*"/>
                                        <label for="uploadImgProd<?= $producto['id'] ?>"><i class="fas fa-plus-circle fa-lg"></i></label>
                                    </form>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="options">
                            <?php if ($producto['catStatus'] == 1): ?>
                                <form action="" class="opt disponible" method="POST">
                                    <input type="hidden" name="idProd" value="<?= $producto['id'] ?>">
                                    <input type="hidden" name="currentDisp" value="<?= $producto['disponible'] ?>">
                                    <input type="submit" name="setDisp" id="setDisp<?= $producto['id'] ?>">
                                    <span>Disponibilidad</span>
                                    <div class="icon">
                                        <?php if ($producto['disponible'] == 1): ?>
                                            <label for="setDisp<?= $producto['id'] ?>"><i class="fas fa-toggle-on"></i></label>
                                        <?php elseif ($producto['disponible'] == 0): ?>
                                            <label for="setDisp<?= $producto['id'] ?>"><i class="fas fa-toggle-off"></i></label>
                                        <?php endif ?>
                                    </div>
                                </form>
                            <?php elseif ($producto['catStatus']  == 0): ?>
                                <div class="opt">
                                    <span>Disponibilidad</span>
                                    <div class="icon">
                                        <?php if ($producto['disponible'] == 1): ?>
                                            <i class="fas fa-toggle-on"></i>
                                        <?php elseif ($producto['disponible'] == 0): ?>
                                            <i class="fas fa-toggle-off"></i>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endif ?>

                            <div class="opt">
                                <span>Editar</span>
                                <div class="icon editProd <?= $producto['id'] ?>">
                                    <i class="fa fa-edit <?= $producto['id'] ?>"></i>
                                </div>
                            </div>

                            <form action="" class="opt borrar" method="POST">
                                <input type="hidden" name="idProd" value="<?= $producto['id'] ?>">
                                <input type="submit" name="deleteProd" id="deleteProd<?= $producto['id'] ?>">
                                <span>Eliminar</span>
                                <div class="icon">
                                    <label for="deleteProd<?= $producto['id'] ?>" class="delProd">
                                        <i class="fa fa-times-circle"></i>
                                    </label>
                                </div>
                            </form>

                            <form action="#" class="hidden editProd<?= $producto['id'] ?>" method="POST">
                                <span>Enviar</span>
                                <label for="saveChangesProd<?= $producto['id'] ?>">
                                    <div class="icon">
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                </label>
                            </form>
                            <div class="hidden cancelEdit editProd<?= $producto['id'] ?>">
                                <span>Cancelar</span>
                                <div class="icon">
                                    <i class="fa fa-times-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php elseif ($producto['disponible'] == 0):?>
                    <div class="producto_list">
                        <form action="" class="info noDisp" method="POST">
                            <span class="title">Datos del producto</span>
                            <hr>
                            <div class="field">
                                <span class="label">Nombre</span>
                                <input 
                                    type="text"
                                    name="nombreProd"
                                    class="value name valueProd<?= $producto['id'] ?>"
                                    value="<?= $producto['nombre']?>"
                                    disabled
                                />
                            </div>
                            <div class="field">
                                    <a href="detallesCategoria.php?cat=<?= $producto['id_categoria'] ?>" class="label">Categor&iacute;a</a>
                                <select 
                                    type="text" 
                                    name="catProd" 
                                    class="value valueProd<?= $producto['id'] ?>" 
                                    value="<?= $producto['nombre_cat'] ?>" 
                                    disabled>
                                    <option value="null" disabled>-- Seleccione una categor&iacute;a --</option>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <?php $catDispMsg = ($categoria['status'] == 0) ? " (Inactiva actualmente)" : ""; ?>
                                        <?php if ($producto['id_categoria'] == $categoria['id']): ?>
                                            <option value="<?= $categoria['id'] ?>" selected><?= $categoria['nombre_cat'] . $catDispMsg ?></option>
                                        <?php else: ?>
                                            <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre_cat'] . $catDispMsg ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                        <option value="others">Otros</option>
                                </select>
                            </div>
                            <div class="field">
                                <span class="label">Precio</span>
                                <input 
                                    type="text" 
                                    name="precioProd" 
                                    class="value valueProd<?= $producto['id'] ?>" 
                                    value="<?= '$' . $producto['precio'] ?>" 
                                    disabled
                                />
                            </div>
                            <div class="field">
                                <span class="label">Descripci&oacute;n</span>
                                <textarea 
                                    name="descProd" 
                                    class="value valueProd<?= $producto['id'] ?>" 
                                    placeholder="<?= $producto['descripcion'] ?>" 
                                    disabled><?= $producto['descripcion'] ?>
                                </textarea>
                            </div>
                            <span class="dateReg">Fecha y hora de registro: <?= $producto['fecha_registro'] ?></span>
                            <input type="hidden" name="idProd" value="<?= $producto['id'] ?>">
                            <input type="submit" name="saveChangesProd" id="saveChangesProd<?= $producto['id'] ?>">
                        </form>

                        <div class="imgs noDisp">
                            <div class="main">

                                <?php foreach ($imgsProds as $imgProd): ?>
                                    
                                    <?php if ($imgProd['id_prod'] == $producto['id']): ?>
                                
                                        <?php $imgsForThisProd = TRUE ?>
                                        
                                        <?php if ($imgProd['principal'] == 1): ?>
                                            <img src="../<?= $imgProd['ruta'] ?>" alt="">
                                        <?php else: ?>
                                            <span>No se ha definido im&aacute;gen principal <i class="fa fa-star-half"></i></span>
                                        <?php endif ?>
                                    
                                    <?php else: ?>
                                        <?php $imgsForThisProd = FALSE ?>
                                    <?php endif?>

                                <?php endforeach ?>

                                <?php if (!$imgsForThisProd): ?>
                                    <div class="noImgsText">
                                        <span>No hay im&aacute;genes para este producto </span>
                                        <div class="icons">
                                            <i class="fa fa-images fa-2x"></i> <i class="fa fa-exclamation-circle fa-2x"></i>
                                        </div>
                                        <span>Para agregar haga click en</span>
                                        <div class="icons">
                                            <i class="fa fa-plus-circle"></i>
                                        </div>
                                    </div>
                                <?php endif ?>

                            </div>
                            <div class="others">
                                <?php foreach ($imgsProds as $imgProd): ?>
                                    <?php if ($imgProd['id_prod'] == $producto['id']): ?>
                                        <?php $cantImgsPorProducto++ ?>
                                        <div class="other-img">
                                            <div class="img">
                                                <img src="../<?= $imgProd['ruta'] ?>" alt="">
                                                <a href="../<?= $imgProd['ruta'] ?>" class="bg" data-lightbox="producto<?= $producto['id'] ?>">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                            <form action="" class="icons" method="POST">
                                                <input type="hidden" name="prodId" value="<?= $producto['id'] ?>">
                                                <input type="hidden" name="imgId" value="<?= $imgProd['id'] ?>">
                                                <input type="hidden" name="imgPath" value="<?= $imgProd['ruta'] ?>">
                                                <input type="submit" name="setMainImg" id="setMainImg<?= $imgProd['id'] ?>">
                                                <input type="submit" name="deleteImg" id="deleteImg<?= $imgProd['id'] ?>">
                                                <?php if ($imgProd['principal'] == 0): ?>
                                                    <label for="setMainImg<?= $imgProd['id'] ?>" class="set-main"><i class="fa fa-star"></i></label>
                                                <?php else: ?>
                                                    <i class="fa fa-star currentMain"></i>
                                                <?php endif ?>
                                                <label for="deleteImg<?= $imgProd['id'] ?>" class="delete"><i class="fas fa-trash-alt"></i></label>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <?php $cantImgsPorProducto = 0 ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                                
                                <?php if ($cantImgsPorProducto < 5): ?>
                                    <form class="add_img" action="" enctype="multipart/form-data" method="POST">
                                        <input type="hidden" name="idCat" value="<?= $producto['id_categoria'] ?>">
                                        <input type="hidden" name="idProd" value="<?= $producto['id'] ?>">
                                        <input type="file" onchange="this.form.submit()" id="uploadImgProd<?= $producto['id'] ?>" name="newImg" accept="image/*"/>
                                        <label for="uploadImgProd<?= $producto['id'] ?>"><i class="fas fa-plus-circle fa-lg"></i></label>
                                    </form>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="options noDisp">
                            <?php if ($producto['catStatus'] == 1): ?>
                                <form action="" class="opt disponible" method="POST">
                                    <input type="hidden" name="idProd" value="<?= $producto['id'] ?>">
                                    <input type="hidden" name="currentDisp" value="<?= $producto['disponible'] ?>">
                                    <input type="submit" name="setDisp" id="setDisp<?= $producto['id'] ?>">
                                    <span>Disponibilidad</span>
                                    <div class="icon">
                                        <?php if ($producto['disponible'] == 1): ?>
                                            <label for="setDisp<?= $producto['id'] ?>"><i class="fas fa-toggle-on"></i></label>
                                        <?php elseif ($producto['disponible'] == 0): ?>
                                            <label for="setDisp<?= $producto['id'] ?>"><i class="fas fa-toggle-off"></i></label>
                                        <?php endif ?>
                                    </div>
                                </form>
                            <?php elseif ($producto['catStatus'] == 0): ?>
                                <div class="opt">
                                    <span>Disponibilidad</span>
                                    <div id="confirmToggle" class="icon">
                                        <?php if ($producto['disponible'] == 1): ?>
                                            <i class="fas fa-toggle-on"></i>
                                        <?php elseif ($producto['disponible'] == 0): ?>
                                            <i class="fas fa-toggle-off"></i>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endif ?>

                            <div class="opt">
                                <span>Editar</span>
                                <div class="icon editProd <?= $producto['id'] ?>">
                                    <i class="fa fa-edit <?= $producto['id'] ?>"></i>
                                </div>
                            </div>

                            <form action="" class="opt borrar" method="POST">
                                <input type="hidden" name="idProd" value="<?= $producto['id'] ?>">
                                <input type="submit" name="deleteProd" id="deleteProd<?= $producto['id'] ?>">
                                <span>Eliminar</span>
                                <div class="icon">
                                    <label for="deleteProd<?= $producto['id'] ?>" class="delProd">
                                        <i class="fa fa-times-circle"></i>
                                    </label>
                                </div>
                            </form>

                            <form action="#" class="hidden editProd<?= $producto['id'] ?>" method="POST">
                                <span>Enviar</span>
                                <label for="saveChangesProd<?= $producto['id'] ?>">
                                    <div class="icon">
                                        <i class="fa fa-check-circle"></i>
                                    </div>
                                </label>
                            </form>
                            <div class="hidden cancelEdit editProd<?= $producto['id'] ?>">
                                <span>Cancelar</span>
                                <div class="icon">
                                    <i class="fa fa-times-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </section>

        <form action="" id="toggleForm" class="hidden" method="POST">
            <input type="hidden" name="toggleProd">
            <input type="hidden" name="actionForm" id="actionForm" value="unknown">
            <input type="hidden" name="newCat" id="newCat" value="null">
        </form>

        <div id="modal" class="modalMsg">
            <div id="toggleMsg" class="confirmToggle hidden">
                <p>La categor&iacute;a de este producto se encuentra inactiva en este momento, puede elegir entre las 
                siguientes opciones para que este producto est&eacute; disponible para el cliente.</p>
                <div class="options">
                    <div id="activeCat" class="opt hide"><span>Activar categor&iacute;a</span></div>
                    <div id="chooseCat" class="opt showMisc"><span>Elegir otra categor&iacute;a</span></div>
                    <div id="othersCat" class="opt showMisc"><span>Mostrar en "otros"</span></div>
                    <div id="closeModal" class="opt cancel"><span>Cancelar</span></div>
                </div>
            </div>
            
            <div id="chooseCatMsg" class="confirmToggle hidden">
                <p>Elija la nueva categor&iacute;a para el producto.</p>
                <div class="options">
                    <div id="saveNewCat" class="chooseCatForm">
                        <select name="newCat" id="newCatSelect" required>
                            <option value="false" disabled selected>-- Elija una categor&iacute;a --</option>
                            <?php foreach ($categorias as $cat): ?>
                                <?php if ($cat['status'] == 1): ?>
                                    <option value="<?= $cat['id'] ?>"><?= $cat['nombre_cat'] ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                        <div id="saveNewCatBtn" class="opt saveNewCat"><span>Aceptar</span></div>
                        <div id="cancelChoose" class="opt cancel"><span>Cancelar</span></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="js/lightbox-plus-jquery.js"></script>
    <script src="js/script.js"></script>
</body>
</html>