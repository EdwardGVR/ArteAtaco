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
                <a href="puntosEntrega.php">Puntos de entrega</a>
            </div>
        </div>
    </nav>
    <main>
        <div class="bar">
            <a href="index.php"><i class="fa fa-home"></i></a>
            <h1>Puntos de entrega</h1>
            <a href="#" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>
            <?php if ($hayPuntos): ?>
                <div class="title">
                    <h2>Todos los puntos de entrega</h2>
                    <hr>    
                </div>
                <div class="contenedor_puntos">
                    <article class="punto">

                    </article>                          
                </div>
            <?php else: ?>
                <div class="contenedorNoPuntos">
                    <article class="punto">
                        <div class="text">
                            No hay puntos registrados.
                        </div>
                        <div class="btnAdd">
                            <i class="fa fa-plus-circle"></i>
                        </div>
                        <div class="btnAdd cancel">
                            <i class="fa fa-times-circle"></i>
                        </div>
                        <div class="btnAdd clear">
                            <i class="fa fa-eraser"></i>
                        </div>
                        <div class="btnAdd save">
                            <i class="fa fa-check-circle"></i>
                        </div>
                    </article>  

                    <form class="addPoint" action="" method="POST">
                        <input type="hidden" name="userId" value="<?php //id del usuario ?>">
                        <input type="hidden" name="tipoDir" value="2">
                        <div class="field">
                            <label for="nombrePunto">Nombre:</label>
                            <input type="text" id="nombrePunto" name="nombrePunto" placeholder="Nombre del punto de entrega">
                        </div>
                        <div class="field">
                            <label for="dptoPunto">Departamento:</label>
                            <select name="dptoPunto" id="dptoPunto">
                                <option value="NULL" disabled selected>-- Seleccione un departamento --</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="paisPunto">Pa&iacute;s:</label>
                            <input type="text" id="paisPunto" name="paisPunto" value="El Salvador" placeholder="El Salvador" disabled>
                        </div>
                        <div class="field">
                            <label for="linea1">Linea 1:</label>
                            <input type="text" id="linea1" name="linea1" placeholder="Municipio, ciudad, colonia">
                        </div>
                        <div class="field">
                            <label for="linea2">Linea 1:</label>
                            <input type="text" id="linea2" name="linea2" placeholder="Calle, pasaje/block, #casa">
                        </div>
                        <div class="field">
                            <label for="refPunto">Referencias:</label>
                            <textarea name="refPunto" id="refPunto" placeholder="Ej: Frente a iglesia, a la par de banco..."></textarea>
                        </div>
                    </form>  

                </div>
            <?php endif ?>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>