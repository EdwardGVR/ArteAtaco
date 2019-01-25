<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
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
                        <?php $status = ($method['status'] == 1) ? "activo" : "inactivo"; ?>
                        <?php $devStatus = ($method['dev_status'] == 1) ? " <i class=\"fas fa-hammer\"></i> &lt;En desarrollo&#47;&gt;" : ""; ?>
                        <a href="detPayMethod.php?payMethod=<?= $method['id'] ?>" class="payMethod">
                            <div class="status"><span class="<?= $status ?>"><?= $status . $devStatus ?></span></div>
                            <div class="name"><?= $method['nombre'] ?></div>
                        </a>
                    <?php endforeach ?>

                    <?php if ($userData['level'] > 2): ?>
                        <div class="noPayMethods regOther">
                            <span id="noPayMethodsInfo" class="info hidden">No hay metodos de pago registrados.</span>
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
                    <?php endif ?>

            <?php else: ?>
                <div class="contPay">
                    <div class="noPayMethods">
                        <span id="noPayMethodsInfo" class="info">No hay metodos de pago registrados.</span>
                        
                        <?php if ($userData['level'] > 2): ?>
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
                        <?php endif ?>

                    </div>
                </div>
            <?php endif ?>
                </div>
        </section>
    </main>

    <script src="js/script.js"></script>
</body>
</html>