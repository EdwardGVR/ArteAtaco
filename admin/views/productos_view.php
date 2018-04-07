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
            <h1>Productos</h1>
        </div>
        <section>
            <div class="title">
                <h2>Todos los productos</h2>
                <hr>
            </div>
            <div class="contenedor_productos">
                <div class="producto_list">
                    <div class="imgs">
                        <div class="main">

                        </div>
                        <div class="others">
                            <img src="" alt="">
                            <img src="" alt="">
                            <img src="" alt="">
                        </div>
                        <div class="add_img">
                            <i class="fas fa-plus-circle fa-lg"></i>
                        </div>
                    </div>
                    <div class="info">
                        <div class="nom_cat">
                            <span class="nombre">Nombre producto</span>
                            <span class="categoria">Categoria</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>