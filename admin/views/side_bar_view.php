<div id="nav-fake" class="nav_hidden"></div>
<nav>
    <div class="side_bar">
        <div class="burguerBtn">
            <div class="hamburguerBtn open" title="Contraer / Expandir men&uacute;">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="side_icons">
            <a href="pedidos.php" class="side_icon" title="Pedidos"><i class="fas fa-cubes"></i></a>
            <a href="productos.php" class="side_icon" title="Productos"><i class="fas fa-shopping-bag"></i></a>
            <a href="clientes.php" class="side_icon" title="Clientes"><i class="fas fa-users"></i></a>
            <a href="puntosEntrega.php" class="side_icon" title="Puntos de entrega"><i class="fas fa-truck"></i></a>
        </div>
    </div>
    <div id="nav-options" class="options">
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

<script>
  var hamburger = document.querySelector(".hamburguerBtn");
  // On click
  hamburger.addEventListener("click", function() {
    // Toggle class "is-active"
    hamburger.classList.toggle("open");
    // Do something else, like open/close menu
    let navOptions = document.querySelector("#nav-options"),
        navFake = document.querySelector("#nav-fake"),
        nav = document.querySelector("nav");

    navOptions.classList.toggle("hidden");
    navFake.classList.toggle("hidden");
    nav.classList.toggle("hidden");
  });
</script>