<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Pedidos</title>

	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styleModal.css"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<script>var pagId = "pedidos";</script>

<?php require("messenger_contact.php") ?>
 <?php require 'header.php' ?>

<div class="contenedor_pedidos">
	<?php if ($pedidos != false): ?>
		<?php foreach ($pedidos as $pedido): ?>
			<div class="pedido">
				<div class="pedido_header">
					<h3>C&oacute;digo: #<?= $pedido['codigo'] ?></h3>
					<h3>Estado: 
						<?php if ($pedido['estado'] == 1): ?>
							<span class="pago_pend">
								Pago pendiente
								<i class="fa fa-clock-o" aria-hidden="true"></i>
								<i class="fa fa-money" aria-hidden="true"></i>
							</span>
						<?php elseif($pedido['estado'] == 2): ?>
							<span class="pago_rec">
								Pago recibido
							</span>
						<?php elseif($pedido['estado'] == 3): ?>
							<span class="ready_shipp">
								Listo para entrega
							</span>			 
						<?php elseif($pedido['estado'] == 4): ?>
							<span class="delivered">
								Entregado
							</span>			 
						<?php else: ?>
							<span class="nd">
								No se encontr&oacute;
							</span>	
						<?php endif ?>
					</h3>
					<div class="detalle">
						<span>
							<!-- Validacion coste de envio -->
							<?php 
								if ($pedido['costoEnvioCompra'] == 0) {
									$costoEnvio = "Gratuito";
								} else {
									$costoEnvio = "$" . $pedido['costoEnvioCompra'];
								}
							?>
							Env&iacute;o a: <?= $pedido['dir_name'] ?>
							(Costo de env&iacute;o: <?= $costoEnvio ?>)
							<?php if ($pedido['disponible'] == 0): ?>
								&nbsp;<span class="eliminada">(Esta direccion fue eliminada)</span>
							<?php endif ?>
						</span>	
						<span>Fecha: <?= $pedido['fecha'] ?></span>					
					</div>
					<span class="prodsHeader">Producto(s):</span>
					<hr class="lineProds">
				</div>
				<div class="pedido_body">
					<?php foreach ($productos_pedidos as $prod): ?>
						<?php if ($pedido['codigo'] == $prod['codigo']): ?>
							<!-- Validacion de imagenes -->
							<?php 
								$imgsCounter = 0; $mainImg = false; 
								foreach ($imgs as $img) {
									if ($img['id_prod'] == $prod['idProd']) {
										$imgsCounter++;
										if ($imgsCounter > 0 && $img['principal'] == 1) {
											$mainImg = true; $imgPath = $img['ruta'];
										}
										if ($imgsCounter > 0 && !$mainImg) {
											$imgPath = $img['ruta'];
										}
									}
								}
							?>
							<div class="prod_ped">
								<?php if ($prod['disponible'] == 0): ?>
									<div class="prod_img">
										<?php if ($imgsCounter > 0): ?>
											<img src="<?= $imgPath ?>" alt="...">
										<?php endif ?>
										<h4 class="prodName"><?= $prod['nombreProd'] ?></h4>
									</div>
								<?php else: ?>
									<a href="detalles.php?id_prod=<?= $prod['idProd'] ?>" class="prod_img">
										<?php if ($imgsCounter > 0): ?>
											<img src="<?= $imgPath ?>" alt="...">
										<?php endif ?>
										<h4 class="prodName"><?= $prod['nombreProd'] ?></h4>
									</a>
								<?php endif ?>
								<?php if ($prod['disponible'] == 0): ?>
									<div class="prodStatus">
										<span>
											Producto no disponible por el momento 
											<i class="fa fa-exclamation-triangle"></i>
										</span>
									</div>
								<?php endif ?>
								<div class="prod_cant">
									<h3>x<?= $prod['cantidad'] ?></h3>
									<h4>Cantidad</h4>
								</div>
								<div class="prod_pre">
									<h3>$<?= $prod['precioCompra'] ?></h3>
									<h4>Precio de compra</h4>
								</div>
							</div>
						<?php endif ?>
					<?php endforeach ?>		
				</div>
			</div>
		<?php endforeach ?>
	<?php else: ?>
		<h3>No hay pedidos que mostrar.</h3>
	<?php endif ?>
</div>

 <?php require 'footer.php' ?>

<script src="script/js/functions.js"></script>
</body>
</html>