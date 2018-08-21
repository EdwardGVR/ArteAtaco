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
                <a href="clientes.php">Clientes</a>
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
                                    disabled>
                                </input>
                            </div>
                            <div class="field">
                                <span class="label">Categor&iacute;a</span>
                                <select 
                                    type="text" 
                                    name="catProd" 
                                    class="value valueProd<?= $producto['id'] ?>" 
                                    value="<?= $producto['nombre_cat'] ?>" 
                                    disabled>
                                    <option value="null" disabled>-- Seleccione una categor&iacute;a --</option>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <?php if ($producto['id_categoria'] == $categoria['id']): ?>
                                            <option value="<?= $categoria['id'] ?>" selected><?= $categoria['nombre_cat'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre_cat'] ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
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
                                    disabled>
                                </input>
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

                        <div class="options">
                            <form action="" class="opt disponible" method="POST">
                                <input type="hidden" name="idProd" value="<?= $producto['id'] ?>">
                                <input type="hidden" name="currentDisp" value="<?= $producto['disponible'] ?>">
                                <input type="submit" name="setDisp" id="setDisp<?= $producto['id'] ?>">
                                <span>Disponible</span>
                                <div class="icon">
                                    <?php if ($producto['disponible'] == 1): ?>
                                        <label for="setDisp<?= $producto['id'] ?>"><i class="fas fa-toggle-on"></i></label>
                                    <?php elseif ($producto['disponible'] == 0): ?>
                                        <label for="setDisp<?= $producto['id'] ?>"><i class="fas fa-toggle-off"></i></label>
                                    <?php endif ?>
                                </div>
                            </form>

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
                                    disabled>
                                </input>
                            </div>
                            <div class="field">
                                <span class="label">Categor&iacute;a</span>
                                <select 
                                    type="text" 
                                    name="catProd" 
                                    class="value valueProd<?= $producto['id'] ?>" 
                                    value="<?= $producto['nombre_cat'] ?>" 
                                    disabled>
                                    <option value="null" disabled>-- Seleccione una categor&iacute;a --</option>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <?php if ($producto['id_categoria'] == $categoria['id']): ?>
                                            <option value="<?= $categoria['id'] ?>" selected><?= $categoria['nombre_cat'] ?></option>
                                        <?php else: ?>
                                            <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre_cat'] ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="field">
                                <span class="label">Precio</span>
                                <input 
                                    type="text" 
                                    name="precioProd" 
                                    class="value valueProd<?= $producto['id'] ?>" 
                                    value="<?= '$' . $producto['precio'] ?>" 
                                    disabled>
                                </input>
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
                            <form action="" class="opt disponible" method="POST">
                                <input type="hidden" name="idProd" value="<?= $producto['id'] ?>">
                                <input type="hidden" name="currentDisp" value="<?= $producto['disponible'] ?>">
                                <input type="submit" name="setDisp" id="setDisp<?= $producto['id'] ?>">
                                <span>Disponible</span>
                                <div class="icon">
                                    <?php if ($producto['disponible'] == 1): ?>
                                        <label for="setDisp<?= $producto['id'] ?>"><i class="fas fa-toggle-on"></i></label>
                                    <?php elseif ($producto['disponible'] == 0): ?>
                                        <label for="setDisp<?= $producto['id'] ?>"><i class="fas fa-toggle-off"></i></label>
                                    <?php endif ?>
                                </div>
                            </form>

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
    </main>

    <script src="js/lightbox-plus-jquery.js"></script>
    <script src="js/script.js"></script>
</body>
</html>