<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">   
    <link rel="stylesheet" href="css/styles.css">
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
                <h2>Todos los productos</h2>
                <hr>
            </div>
            <div class="contenedor_productos">
                <?php foreach ($productos as $producto): ?>
                    <div class="producto_list">
                        <div class="imgs">
                            <div class="main">
                                <div class="icons">
                                    <div class="main-img">
                                        <div class="tooltip">
                                            <i class="fa fa-gem"></i>
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
                                <img src="" alt="">
                            </div>
                            <div class="others">
                                <img src="" alt="">
                                <img src="" alt="">
                                <img src="" alt="">
                                <img src="" alt="">
                                <img src="" alt="">
                                <img src="" alt="">
                                <div class="add_img">
                                    <i class="fas fa-plus-circle fa-lg"></i>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <div class="field">
                                <span class="label">Nombre producto</span>
                                <span class="value"><?= $producto['nombre'] ?></span>
                            </div>
                            <div class="field">
                                <span class="label">Categoria</span>
                                <span class="value"><?= $producto['id_categoria'] ?></span>
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

    <script src="js/script.js"></script>
</body>
</html>