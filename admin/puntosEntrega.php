<?php

require '../functions.php';
require '../conexion.php';

if ($conexion != false) {
    $query = $conexion->prepare("SELECT * FROM direcciones WHERE id_tipo = 2");
    $query->execute();
    $puntos = $query->fetchall();

    if ($puntos != false) {
        $hayPuntos = true;
    } else {
        $hayPuntos = false;
    }
}

require "views/puntos_entrega_view.php";