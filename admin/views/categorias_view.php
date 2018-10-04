<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <title>Categorias</title>
</head>
<body>
    <?php require "side_bar_view.php" ?>
    <main>
        <div class="bar">
            <div class="homeStoreBtns">
                <a href="index.php" title="Ir a inicio"><i class="fa fa-home"></i></a>
                <a href="../categorias.php" target="_blank" title="Ir a la tienda"><i class="fas fa-store"></i></a>
            </div>
            <h1>Categor&iacute;as de productos</h1>
            <a href="../logout.php" class="logout" title="Cerrar sesion"><i class="fa fa-times-circle"></i></a>
        </div>
        <section>
            <?php if ($cats != false): ?>
                <div class="title">
                    <h2>Todas las categor&iacute;as</h2>
                    <hr>
                </div>
                <div class="contPay">
                    <?php foreach ($cats as $cat): ?>
                        <?php $status = ($cat['status'] == 1) ? "activo" : "inactivo" ?>
                        <a href="detallesCategoria.php?cat=<?= $cat['id'] ?>" class="payMethod">
                            <div class="status"><span class="<?= $status ?>"><?= str_replace("o", "a", $status) ?></span></div>
                            <div class="name"><?= $cat['nombre_cat'] ?></div>
                        </a>
                    <?php endforeach ?>

                    <div class="noPayMethods regOther">
                        <span id="noPayMethodsInfo" class="info hidden">No hay metodos de pago registrados.</span>
                        <div class="regNew cat">
                            <div id="regNewBtn" class="button"><i class="fa fa-plus-circle"></i></div>
                            <span id="regNewInfo">Registrar una nueva categor&iacute;a</span>
                            <form action="" enctype="multipart/form-data" id="regNewForm" class="hidden" method="POST">
                                <div class="inputs">
                                    <div class="field">
                                        <label for="catName">Nombre:</label>
                                        <input type="text" id="catName" name="catName" placeholder="Nombre de la categor&iacute;a" required>
                                    </div>
                                    <div class="field">
                                        <label for="catInfo">Descripci&oacute;n</label>
                                        <textarea id="catInfo" name="catInfo" placeholder="Descripcion de la categoria" required></textarea>
                                    </div>
                                    <div class="field">
                                        <label for="catImg">Imagen:</label>
                                        <label for="catImg"><i class="fa fa-upload"></i></label>
                                        <input type="file" id="catImg" class="hidden" name="catImg" accept="image/*" required>
                                    </div>
                                </div>
                                <div class="options">
                                    <div class="cancel" id="cancelSaving">Cancelar</div>
                                    <input type="submit" name="saveCat" id="saveCat" value="Registrar">
                                </div>
                            </form>
                        </div>
                    </div>

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
                                        <label for="methodName">Nombre:</label>
                                        <label for="methodIcon">&Iacute;cono:</label>
                                        <label for="methodInfo">Descripci&oacute;n</label>
                                    </div>
                                    <div class="fields">
                                        <input type="text" id="methodName" name="methodName" placeholder="Nombre del metodo" required>
                                        <input type="text" id="methodIcon" name="methodIcon" placeholder="<?= htmlspecialchars("<i class=\"fa fa-icon\"></i>") ?>" required>
                                        <span class="infoIcons">
                                            Iconos disponibles en 
                                            <a href="https://fontawesome.com/icons" target="_blank">fontawesome</a>
                                        </span>
                                        <div class="iconPreview" id="icon">
                                            <div class="icon" id="iconPreview"><i class="fas fa-question-circle"></i></div>
                                        </div>
                                        <textarea id="methodInfo" name="methodInfo" placeholder="Informacion sobre el metodo" required></textarea>
                                    </div>
                                </div>
                                <div class="options">
                                    <div class="cancel" id="cancelSaving">Cancelar</div>
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