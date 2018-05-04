<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">   
    <link href="css/lightbox.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <title>Productos</title>
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
                <a href="#">Productos</a>
                <a href="#">Clientes</a>
                <a href="#">Puntos de entrega</a>
            </div>
        </div>
    </nav>
    <main>
        <div class="bar">
                <a href="index.php"><i class="fa fa-home"></i></a>
                <h1>Productos</h1>
                <a href="#" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>
            <div class="title">
                <h2>Viendo: Todos los productos</h2>
                <hr>
            </div>
            <div class="contenedor_productos">
                <?php foreach ($productos as $producto): ?>
                    <div class="producto_list">
                        <div class="imgs">
                            <div class="main">
                                <div class="icons">
                                    <a href="http://placeimg.com/400/500/tech" class="bg" data-lightbox="producto<?= $producto['id'] ?>">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <!-- <div class="bg"><i class="fa fa-eye"></i></div> -->
                                    <div class="main-img">
                                        <div class="tooltip">
                                            <i class="fa fa-star"></i>
                                            <span class="tooltiptext">Principal</span>
                                        </div>
                                    </div>
                                    <div class="del">
                                        <div class="tooltip">
                                            <i class="fas fa-trash-alt"></i>
                                            <span class="tooltiptext">Eliminar</span>
                                        </div>
                                    </div>
                                </div>
                                <img src="http://placeimg.com/180/180/tech" alt="">
                            </div>
                            <div class="others">
                                <div class="other-img">
                                    <div class="img">
                                        <img src="http://placeimg.com/50/50/any" alt="">
                                        <a href="http://placeimg.com/400/500/any" class="bg" data-lightbox="producto<?= $producto['id'] ?>">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                    <div class="icons">
                                        <span class="set-main"><i class="fa fa-star"></i></span>
                                        <span class="delete"><i class="fas fa-trash-alt"></i></span>
                                    </div>
                                </div>
                                <div class="other-img">
                                    <div class="img">
                                        <img src="http://placeimg.com/50/50/animals" alt="">
                                        <a href="http://placeimg.com/400/500/animals" class="bg" data-lightbox="producto<?= $producto['id'] ?>">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                    <div class="icons">
                                        <span class="set-main"><i class="fa fa-star"></i></span>
                                        <span class="delete"><i class="fas fa-trash-alt"></i></span>
                                    </div>
                                </div>
                                <div class="other-img">
                                    <div class="img">
                                        <img src="http://placeimg.com/50/50/nature" alt="">
                                        <a href="http://placeimg.com/400/500/nature" class="bg" data-lightbox="producto<?= $producto['id'] ?>">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                    <div class="icons">
                                        <span class="set-main"><i class="fa fa-star"></i></span>
                                        <span class="delete"><i class="fas fa-trash-alt"></i></span>
                                    </div>
                                </div>
                                <div class="other-img">
                                    <div class="img">
                                        <img src="http://placeimg.com/50/50/arch" alt="">
                                        <a href="http://placeimg.com/400/500/arch" class="bg" data-lightbox="producto<?= $producto['id'] ?>">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                    <div class="icons">
                                        <span class="set-main"><i class="fa fa-star"></i></span>
                                        <span class="delete"><i class="fas fa-trash-alt"></i></span>
                                    </div>
                                </div>
                                
                                <form class="add_img" action="" enctype="multipart/form-data" method="POST">
                                    <input type="hidden" name="idCat" value="<?= $producto['id_categoria'] ?>">
                                    <input type="hidden" name="idProd" value="<?= $producto['id'] ?>">
                                    <input type="file" onchange="this.form.submit()" id="uploadImgProd<?= $producto['id'] ?>" name="newImg" accept="image/*"/>
                                    <label for="uploadImgProd<?= $producto['id'] ?>"><i class="fas fa-plus-circle fa-lg"></i></label>
                                </form>
                            </div>
                        </div>
                        <div class="info">
                            <div class="field">
                                <span class="label">Nombre producto</span>
                                <span class="value name"><?= $producto['nombre'] ?></span>
                            </div>
                            <div class="field">
                                <span class="label">Categoria</span>
                                <span class="value"><?= $producto['nombre_cat'] ?></span>
                            </div>
                            <div class="field">
                                <span class="label">Precio</span>
                                <span class="value"><?= '$' . $producto['precio'] ?></span>
                            </div>
                            <div class="field">
                                <span class="label">Descripcion del producto</span>
                                <span class="value"><?= $producto['descripcion'] ?></span>
                            </div>
                        </div>
                        <div class="options">
                            <div class="opt disponible">
                                <span>Disponible</span>
                                <div class="icon">
                                    <i class="fas fa-toggle-on"></i>
                                </div>
                            </div>
                            <div class="opt borrar">
                                <span>Eliminar</span>
                                <div class="icon">
                                    <i class="fa fa-times-circle"></i>
                                </div>
                            </div>
                            <div class="opt editar">
                                <span>Editar</span>
                                <div class="icon">
                                    <i class="fa fa-cog"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <a href="#" class="add_product">
                <div class="icon"><i class="fa fa-plus-circle"></i></div>
            </a>
        </section>
    </main>

    <script src="js/lightbox-plus-jquery.js"></script>
    <script src="js/script.js"></script>
</body>
</html>