<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Pedidos</title>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
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
							Env&iacute;o a: <?= $pedido['dir_name'] ?>
							<?php if ($pedido['disponible'] == 0): ?>
								&nbsp;<span class="eliminada">(Esta direccion fue eliminada)</span>
							<?php endif ?>
						</span>	
						<span>Fecha del pedido: <?= $pedido['fecha'] ?></span>					
					</div>
					<span class="prodsHeader">Producto(s):</span>
					<hr class="lineProds">
				</div>
				<div class="pedidos_body">
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
									<?php if ($prod['prodDeleted'] == 0): ?>
										<div class="prod_img">
											<?php if ($imgsCounter > 0): ?>
												<img src="<?= $imgPath ?>" alt="...">
											<?php elseif ($imgsCounter == 0): ?>
												<div class="noImg">
													<i class="fa fa-image"></i>
												</div>
											<?php endif ?>
											<h4 class="prodName"><?= $prod['nombreProd'] ?></h4>
										</div>
									<?php elseif ($prod['prodDeleted'] == 1): ?>
										<div class="prod_img">
											<div class="prodDel"><i class="fa fa-times"></i></div>
											<h4 class="prodName"><?= $prod['nombreProd'] ?></h4>
										</div>
									<?php endif ?>
								<?php else: ?>
									<a href="detalles.php?id_prod=<?= $prod['idProd'] ?>" class="prod_img">
										<?php if ($imgsCounter > 0): ?>
											<img src="<?= $imgPath ?>" alt="...">
										<?php elseif ($imgsCounter == 0): ?>
											<div class="noImg">
												<i class="fa fa-image"></i>
											</div>
										<?php endif ?>
										<h4 class="prodName"><?= $prod['nombreProd'] ?></h4>
									</a>
								<?php endif ?>
								<?php if ($prod['disponible'] == 0 && $prod['prodDeleted'] == 0): ?>
									<div class="prodStatus">
										<span>
											Este producto no est&aacute; disponible actualmente. 
											<i class="fa fa-exclamation-triangle"></i>
										</span>
									</div>
								<?php elseif ($prod['disponible'] == 0 && $prod['prodDeleted'] == 1): ?>
									<div class="prodStatus">
										<span>
											Este producto fue eliminado del cat&aacute;logo. 
											<i class="fa fa-trash"></i>
										</span>
									</div>
								<?php endif ?>
								<div class="prod_cant">
									<h3>x<?= $prod['cantidad'] ?></h3>
									<h4>Cantidad</h4>
								</div>
								<div class="prod_pre">
									<h3>$<?= number_format($prod['precioCompra'], 2) ?></h3>
									<h4>Precio de compra</h4>
								</div>
							</div>
						<?php endif ?>
					<?php endforeach ?>		
				</div>
				<span class="detBtnCont">
					<a class="detailsBtn" href="det_pedido.php?orderCode=<?= $pedido['codigo'] ?>">Detalles</a>
				</span>
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