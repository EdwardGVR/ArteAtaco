<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">   
    <link rel="stylesheet" href="css/styles.css">
    <title>Pedidos</title>
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
            <h1>Pedidos</h1>
        </div>
        <section>
            <div class="title">
                <h2>Todos los pedidos</h2>
                <hr>
            </div>
            <div class="contenedor_pedidos">
                <article class="pedido_todos">
                   <div class="pedido_header">
                       <div class="codigo">#1234567</div>
                   </div>
                   <div class="pedido_body">
                       <div class="pedido_cliente_direccion">
                           <div class="pedido_cliente">
                                <div class="titulo">
                                    <span>Cliente</span>
                                    <hr>
                                </div>
                                <div class="info">
                                    <div class="imagen">

                                    </div>
                                    <div class="datos">
                                        <span class="nombres">Nombre nombre</span>
                                        <span class="apellidos">Apellido apellido</span>
                                    </div>
                                </div>
                           </div>
                           <div class="pedido_direccion">
                                <div class="titulo">
                                    <span>Direccion</span>
                                    <hr>
                                </div>
                                <div class="info">
                                    <span>Departamento</span>
                                    <span>Nombre de la direccion</span>
                                </div>
                           </div>
                       </div>
                       <div class="ped_prods">
                           <div class="title">
                               <span>Productos</span>
                               <hr>
                           </div>
                           <div class="prods">
                               <div class="ped_prod">
                                   
                               </div>
                           </div>
                       </div>
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