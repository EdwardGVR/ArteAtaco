<?php

if (!isset($_SESSION['user'])) {
    session_start();
}

require '../functions.php';
require '../conexion.php';

$userData = adminValidation($conexion);
$userName = $userData['nombres'] . ' ' . $userData['apellidos'];
$userImg = $userData['imagen'];
$payMethodId = (isset($_GET['payMethod'])) ? $_GET['payMethod'] : false;

if ($conexion != false) {
    if ($payMethodId != false) {
        // Obtener detalles del metodo de pago
        $query = $conexion->prepare("SELECT * FROM metodos_pago WHERE id = :idPay AND deleted = 0");
        $query->execute(array('idPay' => $payMethodId));
        $methodDet = $query->fetch();

        $query = $conexion->prepare("SELECT * FROM datos_metodos_pago WHERE id_metodo_pago = :id");
        $query->execute(array(':id' => $payMethodId));
        $datosMethod = $query->fetchall();

        $query = $conexion->prepare("SELECT COUNT(*) FROM datos_metodos_pago WHERE id_metodo_pago = :id");
        $query->execute(array(':id' => $payMethodId));
        $countDatos = $query->fetch();
        $countDatos = $countDatos[0];
    } else {
        $methodDet = false;
    }

    if (isset($_POST['setNewIcon'])) {
        $newIcon = $_POST['iconCode'];        
        $startClassPos = strpos($newIcon, "class=");
        $endClassPos = strpos($newIcon, "></i>");

        $newIcon = substr($newIcon, $startClassPos+7);
        $newIcon = substr($newIcon, 0, $endClassPos-11);

        $query = $conexion->prepare("UPDATE metodos_pago SET icon = :newIcon WHERE id = :idPay");
        $query->execute(array(
            ':newIcon' => $newIcon,
            ':idPay' => $payMethodId
        ));

        header("Location: detPayMethod.php?payMethod=$payMethodId");
    }

    if (isset($_POST['saveNewName'])) {
        $newName = $_POST['newName'];
        $newName = trim($newName);
        $newName = htmlspecialchars($newName);

        $query = $conexion->prepare("UPDATE metodos_pago SET nombre = :newMethodName WHERE id = :idPay");
        $query->execute(array(
            ':newMethodName' => $newName,
            ':idPay' => $payMethodId
        ));

        header("Location: detPayMethod.php?payMethod=$payMethodId");
    }

    if (isset($_POST['saveNewInfo'])) {
        $newInfo = $_POST['newInfo'];

        $query = $conexion->prepare("UPDATE metodos_pago SET info = :newInfo WHERE id = :idPay");
        $query->execute(array(
            ':newInfo'=>$newInfo,
            ':idPay'=>$payMethodId
        ));

        header("Location: detPayMethod.php?payMethod=$payMethodId");
    }

    if (isset($_POST['toggleStatus'])) {
        $currentStatus = $_POST['currentStatus'];
        
        if ($currentStatus == 1) {
            $query = $conexion->prepare("UPDATE metodos_pago SET status = 0 WHERE id = :idPay");
            $query->execute(array(':idPay' => $payMethodId));
        } else if ($currentStatus == 0) {
            if ($methodDet['dev_status'] != 1) {
                $query = $conexion->prepare("UPDATE metodos_pago SET status = 1 WHERE id = :idPay");
                $query->execute(array(':idPay' => $payMethodId));
            }
        }

        header("Location: detPayMethod.php?payMethod=$payMethodId");
    }

    if (isset($_POST['deleteMethod'])) {
        $query = $conexion->prepare("UPDATE metodos_pago SET deleted = 1, status = 0, dev_status = 1 WHERE id = :idPay");
        $query->execute(array(':idPay' => $payMethodId));

        $query = $conexion->prepare("SELECT nombre FROM metodos_pago WHERE id = :id");
        $query->execute(array(':id' => $payMethodId));
        $result = $query->fetch();
        $methodName = $result['nombre'];

        $methodNameSlug = str_replace(" ", "-", $methodName);
        $methodNameSlug = strtolower($methodNameSlug);

        deletePayMethodFiles($methodNameSlug);

        header("Location: payMethods.php");
    }

    if (isset($_POST['setNewDevStatus'])) {
        $newDevStatus = $_POST['setNewDevStatus'];
        switch ($newDevStatus) {
            case 1:
                $query = $conexion->prepare("
                    UPDATE metodos_pago
                    SET dev_status = 1, status = 0
                    WHERE id = :id
                ");
                $query->execute(array(':id' => $payMethodId));
                break;
            case 2:
                $query = $conexion->prepare("
                    UPDATE metodos_pago
                    SET dev_status = 2, status = 0
                    WHERE id = :id
                ");
                $query->execute(array(':id' => $payMethodId));
                break;
            case 3:
                $query = $conexion->prepare("
                    UPDATE metodos_pago
                    SET dev_status = 2, status = 1
                    WHERE id = :id
                ");
                $query->execute(array(':id' => $payMethodId));
                break;
            default:
                # code...
                break;
        }
        header("location: detPayMethod.php?payMethod=$payMethodId");
    }

    if (isset($_POST['datoSet'])) {
        $idDato = $_POST['datoSet'];
        $dato = $_POST['datoMod'];
        $valor = $_POST['valorMod'];

        $query = $conexion->prepare("UPDATE datos_metodos_pago SET dato = :dato, valor = :valor WHERE id = :id");
        $query->execute(array(
            ':id' => $idDato,
            ':dato' => $dato,
            ':valor' => $valor
        ));

        header("location: detPayMethod.php?payMethod=$payMethodId");
    }

    if (isset($_POST['deleteDato'])) {
        $idDato = $_POST['deleteDato'];

        $query = $conexion->prepare("DELETE FROM datos_metodos_pago WHERE id = :id");
        $query->execute(array(':id' => $idDato));

        header("location: detPayMethod.php?payMethod=$payMethodId");
    }

    if (isset($_POST['saveNewDato'])) {
        $dato = $_POST['newDatoName'];
        $value = $_POST['newDatoValue'];

        $query = $conexion->prepare("INSERT INTO datos_metodos_pago (id_metodo_pago, dato, valor) VALUES (:idMetodo, :dato, :valor)");
        $query->execute(array(
            ':idMetodo' => $payMethodId,
            ':dato' => $dato,
            ':valor' => $value
        ));

        header("location: detPayMethod.php?payMethod=$payMethodId");
    }
}

require "views/detalles_metodo_pago_view.php";