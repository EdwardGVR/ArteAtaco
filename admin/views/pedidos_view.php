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
                <a href="productos.php">Productos</a>
                <a href="#">Clientes</a>
                <a href="#">Puntos de entrega</a>
            </div>
        </div>
    </nav>
    <main>
        <div class="bar">
            <a href="index.php"><i class="fa fa-home"></i></a>
            <h1>Pedidos</h1>
            <a href="#" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
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
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombres">Nombre nombre</span>
                                        <span class="apellidos">Apellido apellido</span>
                                        <hr>
                                        <span class="tel">0000-0000</span>
                                        <span class="email">cliente@mail.com</span>
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
                                    <hr>
                                    <span class="det">
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Alias illum accusantium, sunt cumque voluptates inventore.
                                    </span>
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
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>
                               <div class="ped_prod">
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>
                               <div class="ped_prod">
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>                                                           
                           </div>                                       
                       </div>
                       <div class="total">
                           <div class="envio">
                               <div class="icon"><i class="fas fa-tags fa-lg"></i></div>
                               <div class="mount">
                                   <span>Sub-total:</span>
                                   <span>$00.00</span>
                               </div>                               
                           </div>
                           <div class="subtotal">
                               <div class="icon"><i class="fas fa-truck fa-lg"></i></div>
                               <div class="mount">
                                   <span>Envio:</span>
                                   <span>$00.00</span>
                               </div>
                           </div>
                           <div class="total_sum">
                               <div class="icon"><i class="fas fa-money-bill-alt fa-lg"></i></div>
                               <div class="mount">
                                   <span>Total:</span>
                                   <span>$00.00</span>
                               </div>
                           </div>
                       </div>
                       <div class="estado">
                           <div class="actual">
                               <div class="indicador"></div>
                               <span>Estado actual del pedido</span>
                           </div>
                           <div class="update updOrderStat" id="updOrderStat">
                               Actualizar
                           </div>
                           <form id="orderStatusForm" class="select_status orderStatusForm" action="#" method="post">
                               <select class="sel_stat_hidden sel_status" name="status" id="sel_status">
                                   <option value="1">Estado 1</option>
                                   <option value="2">Estado 2</option>
                                   <option value="3">Estado 3</option>
                               </select>
                               <input id='submit_status' class='submit_status' type="submit" value="Aceptar">
                           </form>
                       </div>
                   </div>
                </article>
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
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombres">Nombre nombre</span>
                                        <span class="apellidos">Apellido apellido</span>
                                        <hr>
                                        <span class="tel">0000-0000</span>
                                        <span class="email">cliente@mail.com</span>
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
                                    <hr>
                                    <span class="det">
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Alias illum accusantium, sunt cumque voluptates inventore.
                                    </span>
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
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>
                               <div class="ped_prod">
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>
                               <div class="ped_prod">
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>                                                           
                           </div>                                       
                       </div>
                       <div class="total">
                           <div class="envio">
                               <div class="icon"><i class="fas fa-tags fa-lg"></i></div>
                               <div class="mount">
                                   <span>Sub-total:</span>
                                   <span>$00.00</span>
                               </div>                               
                           </div>
                           <div class="subtotal">
                               <div class="icon"><i class="fas fa-truck fa-lg"></i></div>
                               <div class="mount">
                                   <span>Envio:</span>
                                   <span>$00.00</span>
                               </div>
                           </div>
                           <div class="total_sum">
                               <div class="icon"><i class="fas fa-money-bill-alt fa-lg"></i></div>
                               <div class="mount">
                                   <span>Total:</span>
                                   <span>$00.00</span>
                               </div>
                           </div>
                       </div>
                       <div class="estado">
                           <div class="actual">
                               <div class="indicador"></div>
                               <span>Estado actual del pedido</span>
                           </div>
                           <div class="update updOrderStat" id="updOrderStat2">
                               Actualizar
                           </div>
                           <form id="orderStatusForm" class="select_status orderStatusForm" action="#" method="post">
                               <select class="sel_stat_hidden sel_status" name="status" id="sel_status">
                                   <option value="1">Estado 1</option>
                                   <option value="2">Estado 2</option>
                                   <option value="3">Estado 3</option>
                               </select>
                               <input id='submit_status' class='submit_status' type="submit" value="Aceptar">
                           </form>
                       </div>
                   </div>
                </article>
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
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombres">Nombre nombre</span>
                                        <span class="apellidos">Apellido apellido</span>
                                        <hr>
                                        <span class="tel">0000-0000</span>
                                        <span class="email">cliente@mail.com</span>
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
                                    <hr>
                                    <span class="det">
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Alias illum accusantium, sunt cumque voluptates inventore.
                                    </span>
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
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>
                               <div class="ped_prod">
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>
                               <div class="ped_prod">
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>                                                           
                           </div>                                       
                       </div>
                       <div class="total">
                           <div class="envio">
                               <div class="icon"><i class="fas fa-tags fa-lg"></i></div>
                               <div class="mount">
                                   <span>Sub-total:</span>
                                   <span>$00.00</span>
                               </div>                               
                           </div>
                           <div class="subtotal">
                               <div class="icon"><i class="fas fa-truck fa-lg"></i></div>
                               <div class="mount">
                                   <span>Envio:</span>
                                   <span>$00.00</span>
                               </div>
                           </div>
                           <div class="total_sum">
                               <div class="icon"><i class="fas fa-money-bill-alt fa-lg"></i></div>
                               <div class="mount">
                                   <span>Total:</span>
                                   <span>$00.00</span>
                               </div>
                           </div>
                       </div>
                       <div class="estado">
                           <div class="actual">
                               <div class="indicador"></div>
                               <span>Estado actual del pedido</span>
                           </div>
                           <div class="update updOrderStat" id="updOrderStat">
                               Actualizar
                           </div>
                           <form id="orderStatusForm" class="select_status orderStatusForm" action="#" method="post">
                               <select class="sel_stat_hidden sel_status" name="status" id="sel_status">
                                   <option value="1">Estado 1</option>
                                   <option value="2">Estado 2</option>
                                   <option value="3">Estado 3</option>
                               </select>
                               <input id='submit_status' class='submit_status' type="submit" value="Aceptar">
                           </form>
                       </div>
                   </div>
                </article>
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
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombres">Nombre nombre</span>
                                        <span class="apellidos">Apellido apellido</span>
                                        <hr>
                                        <span class="tel">0000-0000</span>
                                        <span class="email">cliente@mail.com</span>
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
                                    <hr>
                                    <span class="det">
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Alias illum accusantium, sunt cumque voluptates inventore.
                                    </span>
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
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>
                               <div class="ped_prod">
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>
                               <div class="ped_prod">
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>                                                           
                               <div class="ped_prod">
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>
                               <div class="ped_prod">
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>
                               <div class="ped_prod">
                                    <div class="imagen">
                                    <i class="fas fa-file-image fa-2x"></i>
                                    </div>
                                    <div class="datos">
                                        <span class="nombre">Nombre del producto</span>
                                        <span class="cat">Categoria</span>
                                        <span class="cant">1x</span>
                                        <span class="precio">$00.00</span>
                                    </div>
                               </div>                                                           
                           </div>                                       
                       </div>
                       <div class="total">
                           <div class="envio">
                               <div class="icon"><i class="fas fa-tags fa-lg"></i></div>
                               <div class="mount">
                                   <span>Sub-total:</span>
                                   <span>$00.00</span>
                               </div>                               
                           </div>
                           <div class="subtotal">
                               <div class="icon"><i class="fas fa-truck fa-lg"></i></div>
                               <div class="mount">
                                   <span>Envio:</span>
                                   <span>$00.00</span>
                               </div>
                           </div>
                           <div class="total_sum">
                               <div class="icon"><i class="fas fa-money-bill-alt fa-lg"></i></div>
                               <div class="mount">
                                   <span>Total:</span>
                                   <span>$00.00</span>
                               </div>
                           </div>
                       </div>
                       <div class="estado">
                           <div class="actual">
                               <div class="indicador"></div>
                               <span>Estado actual del pedido</span>
                           </div>
                           <div class="update updOrderStat" id="updOrderStat">
                               Actualizar
                           </div>
                           <form id="orderStatusForm" class="select_status orderStatusForm" action="#" method="post">
                               <select class="sel_stat_hidden sel_status" name="status" id="sel_status">
                                   <option value="1">Estado 1</option>
                                   <option value="2">Estado 2</option>
                                   <option value="3">Estado 3</option>
                               </select>
                               <input id='submit_status' class='submit_status' type="submit" value="Aceptar">
                           </form>
                       </div>
                   </div>
                </article>                            
            </div>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>