<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Pedido #<?= $pedido['codigo'] ?></title>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styleModal.css"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<script>var pagId = "detPedidos";</script>

 <?php require 'header.php' ?>

<div class="contenedor_pedidos">
	<span class="back2all"><a href="pedidos.php"><i class="fas fa-chevron-circle-left"></i> Ir a pedidos</a></span>
	<div class="pedido">
		<div class="pedido_header">
			<div class="code">
				<span><?= $pedido['fecha'] ?></span>
				<span class="codigo">C&oacute;digo: #<?= $pedido['codigo'] ?></span>
				<span>Estado: 
					<span class="<?= $statusClass ?>"><?= $pedido['order_status'] ?></span>
				</span>				
			</div>
			<span class="prodsHeader">Datos:</span>
			<hr class="lineProds">
			<div class="detalle">
				<div class="section dir">
					<!-- Validacion coste de envio -->
					<?php $costoEnvio = ($pedido['costoEnvioCompra'] == 0) ? "Gratuito" : "$" . $pedido['costoEnvioCompra']; ?>
					<span class="mainDet">
						Direcci&oacute;n de entrega: <?= $pedido['dir_name'] ?>
					</span>	
					<?php if ($pedido['disponible'] == 0): ?>
						&nbsp;<span class="eliminada">(Esta direcci&oacute;n fue eliminada)</span>
					<?php elseif ($pedido['dir_status'] == 0): ?>
						<span class="eliminada">(Direcci&oacute;n no disponible temporalmente)</span>
					<?php endif ?>
					<span>Departamento: <?= $pedido['dir_dpt'] ?></span>
					<span>Pa&iacute;s: <?= $pedido['dir_pais'] ?></span>
					<span>Linea 1: <?= $pedido['dir_ln1'] ?></span>
					<span>Linea 2: <?= $pedido['dir_ln2'] ?></span>
					<span>Referencias: <?= $pedido['dir_refs'] ?></span>
				</div>
				<div class="section payMth">
					<span class="mainDet">M&eacute;todo de pago: <?= $pedido['pay_name'] ?></span>
					<span class="pedCost">Sub-total de productos: $<?= $subtotal ?></span>
					<span class="pedCost">Costo de env&iacute;o: <?= $costoEnvio ?></span>
					<span class="pedCost total">Total: $<?= $total ?></span>
				</div>
			</div>
			<span class="prodsHeader">Producto(s):</span>
			<hr class="lineProds">
		</div>
		<div class="pedido_body">
			<?php foreach ($prodsPed as $prod): ?>
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
	</div>

	<div class="pedido">
		<div class="pedido_header">
			<span class="prodsHeader">Comprobante de pago:</span>
			<hr class="lineProds">
		</div>
		<?php if ($comprobante == NULL): ?>
			<form class="sendCompForm hidden" action="" enctype="multipart/form-data" method="POST">
				<input type="file" onchange="this.form.submit()" name="payCompImg" id="sendPayComp" accept="image/*"/>
			</form>
			<label class="sendPayComp" for="sendPayComp"><span>Enviar comprobante de pago <i class="fas fa-file-upload"></i></span></label>
		<?php else: ?>
			<img src="<?= $comprobante ?>" alt="x">
		<?php endif ?>
	</div>
</div>

 <?php require 'footer.php' ?>

<script src="script/js/functions.js"></script>
</body>
</html>