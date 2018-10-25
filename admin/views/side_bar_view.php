<?php 
    // Obtener cantidades

    $query = $conexion->prepare("SELECT COUNT(*) FROM pedidos");
    $query->execute();
    $result = $query->fetch();
    $qtyOrders = " (" . $result['COUNT(*)'] . ")";

    $query = $conexion->prepare("SELECT COUNT(*) FROM productos WHERE deleted = 0");
    $query->execute();
    $result = $query->fetch();
    $qtyProds = " (" . $result['COUNT(*)'] . ")";

    $query = $conexion->prepare("SELECT COUNT(*) FROM categorias WHERE deleted = 0");
    $query->execute();
    $result = $query->fetch();
    $qtyCats = " (" . $result['COUNT(*)'] . ")";

    $userId = $userData['id'];
    $query = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE id != :userId");
    $query->execute(array(':userId' => $userId));
    $result = $query->fetch();
    $qtyCost = " (" . $result['COUNT(*)'] . ")";

    $query = $conexion->prepare("SELECT COUNT(*) FROM metodos_pago WHERE deleted = 0");
    $query->execute();
    $result = $query->fetch();
    $qtyPayMethods = " (" . $result['COUNT(*)'] . ")";

    $query = $conexion->prepare("SELECT COUNT(*) FROM direcciones WHERE id_tipo = 2 AND disponible = 1");
    $query->execute();
    $result = $query->fetch();
    $qtyDelivPoint = " (" . $result['COUNT(*)'] . ")";
?>

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
            <a href="pedidos.php" class="side_icon" title="Pedidos"><i class="fas fa-shopping-bag"></i></a>
            <a href="productos.php" class="side_icon" title="Productos"><i class="fas fa-cubes"></i></a>
            <a href="categorias.php" class="side_icon" title="Categor&iacute;as"><i class="fas fa-folder"></i></a>
            <a href="clientes.php" class="side_icon" title="Clientes"><i class="fas fa-users"></i></a>
            <a href="payMethods.php" class="side_icon" title="M&eacute;todos de pago"><i class="fas fa-money-bill-alt"></i></a>
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
            <a href="pedidos.php">Pedidos <?= $qtyOrders ?></a>
            <a href="productos.php">Productos <?= $qtyProds ?></a>
            <a href="categorias.php">Categor&iacute;as <?= $qtyCats ?></a>
            <a href="clientes.php">Clientes <?= $qtyCost ?></a>
            <a href="payMethods.php">M&eacute;todos de pago <?= $qtyPayMethods ?></a>
            <a href="puntosEntrega.php">Puntos de entrega <?= $qtyDelivPoint ?></a>
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