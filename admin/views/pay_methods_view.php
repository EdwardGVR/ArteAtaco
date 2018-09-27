<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <title>Metodos de pago</title>
</head>
<body>
    <?php require "side_bar_view.php" ?>
    <main>
        <div class="bar">
            <div class="homeStoreBtns">
                <a href="index.php" title="Ir a inicio"><i class="fa fa-home"></i></a>
                <a href="../categorias.php" target="_blank" title="Ir a la tienda"><i class="fas fa-store"></i></a>
            </div>
            <h1>M&eacute;todos de pago</h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>
            <?php if ($methods != false): ?>
                <div class="title">
                    <h2>Todos los m&eacute;todos de pago</h2>
                    <hr>
                </div>
                <div class="contPay">
                    <?php foreach ($methods as $method): ?>
                        <?php $status = ($method['status'] == 1) ? "activo" : "inactivo" ?>
                        <a href="detPayMethod.php?payMethod=<?= $method['id'] ?>" class="payMethod">
                            <div class="status"><span class="<?= $status ?>"><?= $status ?></span></div>
                            <div class="name"><?= $method['nombre'] ?></div>
                        </a>
                    <?php endforeach ?>
            <?php else: ?>
                <div class="contPay">
                    <div class="noPayMethods">
                        <span id="noPayMethodsInfo" class="info">No hay metodos de pago registrados.</span>
                        <div class="regNew">
                            <div id="regNewBtn" class="button"><i class="fa fa-plus-circle"></i></div>
                            <span id="regNewInfo">Registrar un nuevo m&eacute;todo</span>
                            <form action="" id="regNewForm" class="hidden" method="POST">
                                <div class="inputs">
                                    <div class="labels">
                                        <label for="methodName">Nombre del m&eacute;todo:</label>
                                        <label for="methodIcon">&Iacute;cono del m&eacute;todo:</label>
                                        <label for=""></label>
                                    </div>
                                    <div class="fields">
                                        <input type="text" id="methodName" name="methodName" placeholder="Nombre del metodo" required>
                                        <input type="text" id="methodIcon" name="methodIcon" placeholder="<?= htmlspecialchars("<i class=\"fa fa-icon\"></i>") ?>" required>
                                        <div class="iconPreview" id="icon">
                                            <div class="icon" id="iconPreview"><i class="fas fa-question-circle"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="options">
                                    <div class="cancel">Cancelar</div>
                                    <input type="submit" name="saveMethod" id="saveMethod" value="Registrar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif ?>
                </div>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>