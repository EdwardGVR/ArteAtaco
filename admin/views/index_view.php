<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">   
    <link rel="stylesheet" href="css/styles.css">
    <title>ArteAteataco :: Admin</title>
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
            <h1>Inicio</h1>
        </div>
        <section>
            <div class="title">
                <h2>Pedidos recientes</h2>
                <hr>
            </div>
            <div class="contenedor_pedidos">
                <article class="pedido">
                    <div class="pedido_cliente">
                        <span class="nombre">Nombre</span>
                        <span class="apellido">Apellido</span>
                        <div class="img_cliente"></div>
                    </div>
                    <hr>
                    <div class="pedido_productos">
                        <div class="producto">
                            <span class="cantidad">1x</span>
                            <span class="nombre_producto">Nombre del producto</span>
                            <span class="precio">$00.00</span>
                        </div>
                    </div>
                    <hr>
                    <div class="pedido_direccion">
                        <span class="departamento">Departamento</span>
                        <span class="nombre_direccion">Nombre direccion</span>
                        <div class="info_direccion tooltip"><i class="fas fa-info-circle"></i>
                            <span class="tooltiptext">Detalles de la direccion de envio para este pedido</span>
                        </div>
                    </div>
                    <div class="pedido_total">
                        <span>$00.00</span>
                    </div>
                </article>
                <article class="pedido">
                    <div class="pedido_cliente">
                        <span class="nombre">Nombre</span>
                        <span class="apellido">Apellido</span>
                        <div class="img_cliente"></div>
                    </div>
                    <hr>
                    <div class="pedido_productos">
                        <div class="producto">
                            <span class="cantidad">1x</span>
                            <span class="nombre_producto">Nombre del producto</span>
                            <span class="precio">$00.00</span>
                        </div>
                        <div class="producto">
                            <span class="cantidad">1x</span>
                            <span class="nombre_producto">Nombre del producto</span>
                            <span class="precio">$00.00</span>
                        </div>
                        <div class="producto">
                            <span class="cantidad">1x</span>
                            <span class="nombre_producto">Nombre del producto</span>
                            <span class="precio">$00.00</span>
                        </div>
                    </div>
                    <hr>
                    <div class="pedido_direccion">
                        <span class="departamento">Departamento</span>
                        <span class="nombre_direccion">Nombre direccion</span>
                        <div class="info_direccion tooltip"><i class="fas fa-info-circle"></i>
                            <span class="tooltiptext">Detalles de la direccion de envio para este pedido</span>
                        </div>
                    </div>
                    <div class="pedido_total">
                        <span>$00.00</span>
                    </div>
                </article>
                <article class="pedido">
                    <div class="pedido_cliente">
                        <span class="nombre">Nombre</span>
                        <span class="apellido">Apellido</span>
                        <div class="img_cliente"></div>
                    </div>
                    <hr>
                        <div class="pedido_productos">
                            <div class="producto">
                                <span class="cantidad">1x</span>
                                <span class="nombre_producto">Nombre del producto</span>
                                <span class="precio">$00.00</span>
                            </div>
                            <div class="producto">
                                <span class="cantidad">1x</span>
                                <span class="nombre_producto">Nombre del producto</span>
                                <span class="precio">$00.00</span>
                            </div>
                            <div class="producto">
                                <span class="cantidad">1x</span>
                                <span class="nombre_producto">Nombre del producto</span>
                                <span class="precio">$00.00</span>
                            </div>
                            <div class="producto">
                                <span class="cantidad">1x</span>
                                <span class="nombre_producto">Nombre del producto</span>
                                <span class="precio">$00.00</span>
                            </div>
                        </div>
                    <hr>
                    <div class="pedido_direccion">
                        <span class="departamento">Departamento</span>
                        <span class="nombre_direccion">Nombre direccion</span>
                        <div class="info_direccion tooltip"><i class="fas fa-info-circle"></i>
                            <span class="tooltiptext">Detalles de la direccion de envio para este pedido</span>
                        </div>
                    </div>
                    <div class="pedido_total">
                        <span>$00.00</span>
                    </div>
                </article>
            </div>
            <div class="button">
                <a href="#">Ver todos</a>
            </div>
        </section>

        <section>
            <div class="title">
                <h2>Nuevos productos</h2>
                <hr>
            </div>
            <div class="contenedor_productos">
                <article class="producto">
                    <div class="producto_nombre">
                        <span class="nombre">Prod name</span>
                        <span class="categoria">Category</span>
                        <div class="img_categoria"></div>
                    </div>
                    <hr>
                    <div class="producto_imagen">
                        <i class="fas fa-file-image"></i>
                    </div>
                    <hr>
                    <div class="producto_descripcion">
                        <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur, corporis? Lorem ipsum dolor sit amet.</span>
                    </div>
                    <div class="producto_precio">
                        <span>$00.00</span>
                    </div>
                </article>
                <article class="producto">
                    <div class="producto_nombre">
                        <span class="nombre">Prod name</span>
                        <span class="categoria">Category</span>
                        <div class="img_categoria"></div>
                    </div>
                    <hr>
                    <div class="producto_imagen">
                        <i class="fas fa-file-image"></i>
                    </div>
                    <hr>
                    <div class="producto_descripcion">
                        <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur, corporis? Lorem ipsum dolor sit amet.</span>
                    </div>
                    <div class="producto_precio">
                        <span>$00.00</span>
                    </div>
                </article>
                <article class="producto">
                    <div class="producto_nombre">
                        <span class="nombre">Prod name</span>
                        <span class="categoria">Category</span>
                        <div class="img_categoria"></div>
                    </div>
                    <hr>
                    <div class="producto_imagen">
                        <i class="fas fa-file-image"></i>
                    </div>
                    <hr>
                    <div class="producto_descripcion">
                        <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur, corporis? Lorem ipsum dolor sit amet.</span>
                    </div>
                    <div class="producto_precio">
                        <span>$00.00</span>
                    </div>
                </article>
            </div>
            <div class="button">
                <a href="#">Ver todos</a>
            </div>
        </section>
    </main>
</body>
</html>