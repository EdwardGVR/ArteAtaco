<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Datos del pedido</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styleModal.css"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body class="checkout">

<script>var pagId = "checkout";</script>

<?php require("messenger_contact.php") ?>	
<?php require 'header.php' ?>

	<div class="contenedor_checkout">
		<div id="carritoCheckout" class="carrito_checkout">
			<h2>&nbsp;&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i> Articulos en el carrito:</h2>
			<?php foreach ($carrito as $item): ?>
				<div class="item_checkout">
					<div class="item-info">
						<h3><?= $item['nombre'] ?></h3>
					</div>
					<div class="item-info">
						<h4>Cantidad: <?= $item['cantidad'] ?></h4>
					</div>
					<div class="item-info">
						<h4>Precio unitario: $<?= $item['precio'] ?></h4>
					</div>
				</div>
				<?php $subtotal += $item['precio'] * $item['cantidad'] ?>
			<?php endforeach ?>
			<div class="subtotal_checkout">
				<span>Subtotal: $ <?= $subtotal ?></span>
			</div>
			<div class="editar">
				<a href="carrito.php">Editar</a>
			</div>

			<hr>

			<div class="costoEnvio">
				<h2><i class="fa fa-money"></i> <i class="fa fa-truck"></i> Costo de env&iacute;o:</h2>
				<?php if (isset($dir_sel)): ?>
					<div class="costo">
						<?php if($dir_sel['costo'] == 0): ?>
							La entrega en <?= $dir_sel['nombre'] . ' (' . $dir_sel['nombreDpto'] . ')' ?> es <b>gratuita</b>
						<?php elseif($dir_sel['costo'] != 0): ?>
							<?= $dir_sel['nombre'] . ' (' . $dir_sel['nombreDpto'] . ')' . ': $' . $dir_sel['costo'] ?>
						<?php endif ?>
					</div>
				<?php else: ?>
					<div class="costo">
						Seleccione una direcci&oacute;n para calcular
					</div>
				<?php endif ?>
			</div>

			<hr>

			<div class="total_checkout">
				<span>Total: $ <?= $subtotal + $costoEnvio ?></span>
			</div>
		</div>

		<div class="info_checkout">
			<div class="contenedor_address">
				<div class="step1">1</div>
				<h3 class="indication"><i class="fa fa-truck"></i> Seleccione una direccion para la entrega</h3>
				<!-- Puntos de entrega -->
				<div class="select_address">
					<h4 class="addressType"><i class="fa fa-map-marker"></i> Puntos de entrega:</h4>
					<?php if ($puntosEntrega != false): ?>
						<?php foreach($puntosEntrega AS $puntoEntrega): ?>
							<div id="dirUser<?= $puntoEntrega['id'] ?>" class="shipping_address">
								<div class="info">
									<h4><?= $puntoEntrega['nombre'] . ' (' . $puntoEntrega['nombreDpto'] . ')' ?></h4>
									<h5><?= $puntoEntrega['linea1'] ?></h5>
									<h5><?= $puntoEntrega['linea2'] ?></h5>
								</div>
								<div class="options">
									<a  idAddress="<?= $puntoEntrega['id'] ?>"  
										class="button selectDir <?= $puntoEntrega['id'] ?>"
										addressType="deliveryPoint">
										Seleccionar
									</a>
									<a id="cancelDirUser<?= $puntoEntrega['id'] ?>" class="hidden">No usar</a>
								</div>
								<div class="hidden checkOnDir">
									<i class="fa fa-check-circle"></i>
								</div>
							</div>
						<?php endforeach ?>
					<?php else: ?>
						<span class="noDirs">
							<i class="fa fa-info-circle fa-2x"></i>
							Actualmente no hay puntos de entrega, pronto estar&aacute;n disponibles
						</span>
					<?php endif ?>
				</div>
				<!-- Direcciones del cliente -->
				<div class="select_address">
					<h4 class="addressType"><i class="fa fa-compass"></i> Direcciones personalizadas:</h4>
					<h4 class="info"><i class="fa fa-info-circle"></i>Podr&iacute;an aplicarse cargos</h4>
					<?php if ($direcciones != false): ?>
						<?php foreach ($direcciones as $direccion): ?>
							<div id="dirUser<?= $direccion['id'] ?>" class="shipping_address">
								<div class="info">
									<h4><?= $direccion['nombre'] ?></h4><br />
									<h5><?= $direccion['nombreDpto'] ?></h5>
									<h5><?= $direccion['linea1'] ?></h5>
								</div>
								<div class="options">
									<a href="cuenta.php" class="button">Editar</a>
									<a idAddress="<?= $direccion['id'] ?>"  
									   class="button selectDir <?= $direccion['id'] ?>"
									   addressType="user">
									   Seleccionar
									</a>
									<a id="cancelDirUser<?= $direccion['id'] ?>" class="hidden">No usar</a>
								</div>
								<div class="hidden checkOnDir">
									<i class="fa fa-check-circle"></i>
								</div>
							</div>
						<?php endforeach ?>
					<?php else: ?>
						<span class="noDirs">
							<i class="fa fa-info-circle fa-2x"></i>
							No tiene ninguna direcci&oacute;n registrada, puede agregar direcciones y aparecer&aacute;n aqu&iacute;:
						</span>
					<?php endif ?>
				</div>
			</div>
			<!-- <hr> -->

			<?php if ($permitir_direccion): ?>
				<div class="new_address">
					<div class="show-form">
						<span class="add_address" id="showNewAddressForm">
							Agregar una nueva direccion 
							&nbsp;<i class="fa fa-truck"></i>
							&nbsp;<i class="fa fa-plus"></i>
							&nbsp;&nbsp;&nbsp;(<?= $restantes ?> restantes)
						</span>
					</div>
					<form id="newAddressForm" class="form_new_address closed" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
						Nombre de la direcci&oacute;n: *
						<input type="text" name="address_name" class="new_address_field" placeholder="ej: Casa Santa Ana, Oficina, etc.." required>
						Pa&iacute;s: *
						<input type="text" name="pais" class="new_address_field" value="El Salvador" readonly disabled>
						Departamento: *
						<select name="departamento" id="dpto" class="new_address_field" required>
							<option value="null" disabled selected>-- Selecciones un departamento --</option>
							<?php foreach ($departamentos as $departamento): ?>
								<?php if($departamento['id'] == 1 || $departamento['id'] == 2 || $departamento['id'] == 3 || $departamento['id'] == 7): ?>
									<option value="<?= $departamento['id'] ?>"><?php echo $departamento['nombre'] ?></option>
								<?php else: ?>
									<option value="<?= $departamento['id'] ?>" disabled><?php echo $departamento['nombre'] . "(No disponible)" ?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
						Direccion:
						<input type="text" name="address_line_1" class="new_address_field" placeholder="Direccion linea 1 *" required>
						<input type="text" name="address_line_2" class="new_address_field" placeholder="Direccion linea 2">
						Referencias:
						<textarea name="referencias" id="ref" class="new_address_field" placeholder="Referencias de ubicacion ej: Frente a iglesia, a la par de local X, etc..."></textarea>
						<?php if (!empty($errores)): ?>
							<div class="errores"><?= $errores ?></div>
						<?php else: ?>
							<?php if (isset($added)): ?>
								<div class="added"><?= $added ?></div>
							<?php endif ?>
						<?php endif ?>
						<div class="options">
							<input type="submit" name="add_address" value="Agregar direcci&oacute;n">
							<div class="cancel" id="cancelNewAddressChkt">
								<i class="fa fa-times-circle"></i>
							</div>
						</div>
					</form>
				</div>	
			<?php endif ?>
			
			<hr>
				
			<div class="payment_method">
				<div class="step1">2</div>
				<h3 class="indication">Seleccione un m&eacute;todo de pago</h3>
				<?php if ($metodos != false): ?>
					<div class="form_pay_method">
						<?php foreach ($metodos as $metodo): ?>
							<div id="payOption<?= $metodo['id'] ?>" class="pay_option">
								<i class="<?= $metodo['icon'] ?>" aria-hidden="true"></i>
								<input id="metodoPago<?= $metodo['id'] ?>" 
									idPago="<?= $metodo['id'] ?>"
									class="radioPago"
									type="radio" name="payment_method" 
									value="<?= $metodo['id'] ?>"
								>
								<label for="metodoPago<?= $metodo['id'] ?>"><?= $metodo['nombre'] ?></label>
							</div>		
						<?php endforeach ?>
					</div>
				<?php else: ?>
					<span class="noMethods">
						<i class="fa fa-info-circle fa-2x"></i>
						Los m&eacute;todos de pago estar&aacute;n disponibles en unos momentos.
					</span>
				<?php endif ?>
			</div>
			<hr>

			<div class="confirm_info">
				<?php if ($metodos != false): ?>
				<div class="step1">3</div>
					<h3 class="indication">Revisar informaci&oacute;n</h3>
					<div class="form_confirm_info">
						<div class="selecciones">
							<?php if (isset($dir_sel) && $dir_sel != false): ?>
								<div class="direccion_seleccionada">
									<h3>Se entregar&aacute; en:</h3>
									<div class="shipping_address review">
										<div class="info">
											<h4><?= $dir_sel['nombre'] ?></h4><br />
											<h5><?= $dir_sel['linea1'] ?></h5>
										</div>
										<div class="options">
											<a id="anularDirUser<?= $dir_sel['id'] ?>" class="button review">Quitar</a>
										</div>
									</div>						
								</div>
							<?php else: ?>
								<div class="direccion_seleccionada">
									<h3 class="noSel">
										No se han seleccionado una direcci&oacute;n.
										<i class="fa fa-truck"></i>
										<i class="fa fa-question"></i>
									</h3>
								</div>
							<?php endif ?>

							<?php if (isset($pay_sel) && $pay_sel != false): ?>
								<div class="pago_seleccionado">
									<h3>Se pagar&aacute; con:</h3>
									<div class="shipping_address review">
										<div class="info">
											<h4><i class="<?= $pay_sel['icon'] ?>" aria-hidden="true"></i><?= " ". $pay_sel['nombre'] ?></h4><br />
										</div>
										<div class="options">
											<a id="anularPagoUser<?= $pay_sel['id'] ?>" class="button review">Quitar</a>
										</div>
									</div>						
								</div>
							<?php else: ?>
								<div class="direccion_seleccionada">
									<h3 class="noSel">
										No se ha seleccionado un m&eacute;todo de pago.
										<i class="fa fa-money"></i>
										<i class="fa fa-question"></i>
									</h3>
								</div>
							<?php endif ?>
						</div>
					</div>

					<div class="form_confirm_info">
						<?php if ($allowPass): ?>
							<?php $payName = str_replace(" ", "-", $pay_sel['nombre']) ?>
							<?php $payName = strtolower($payName) ?>
							<a id="checkoutBtn" href="pago.php?method=<?= $payName ?>" class="send_info">La informaci&oacute;n es correcta</a>
						<?php else: ?>
							<div class="noInfo">Completar informaci&oacute;n para continuar <i class="fa fa-exclamation-triangle"></i></div>
						<?php endif ?>
					</div>
				<?php else: ?>
					<span class="noMethods">
						<i class="fa fa-exclamation-triangle fa-2x"></i>
						Sentimos los inconvenientes, pronto estar&aacute;n disponibles las opciones para completar su pedido
					</span>
				<?php endif ?>
			</div>
		</div>
	</div>

	<?php require 'footer.php' ?>

	<script src="script/js/functions.js"></script>
</body>
</html>