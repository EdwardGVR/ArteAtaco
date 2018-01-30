<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Datos del pedido</title>

	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styleModal.css"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php require("messenger_contact.php") ?>
 <?php require 'header.php' ?>

<div class="contenedor_pedidos">
	<?php if ($pedidos != false): ?>
		<?php foreach ($pedidos as $pedido): ?>
			<div class="pedido">
				<div class="pedido_header">
					<h3>C&oacute;digo del pedido: #<?php echo $pedido['codigo'] ?></h3>
					<h3>Estado: <?php if ($pedido['estado'] == 0): ?>
							<span class="pago_pend">
								Pago pendiente
								<i class="fa fa-clock-o" aria-hidden="true"></i>
								<i class="fa fa-money" aria-hidden="true"></i>
							</span>
						         <?php elseif($pedido['estado'] == 1): ?>
						         	Pago recibido
						         <?php elseif($pedido['estado'] == 2): ?>
						         	Listo para entrega
						         <?php elseif($pedido['estado'] == 3): ?>
						         	Entregado
						         <?php else: ?>
						         	No se encontr&oacute;
						         <?php endif ?>
					</h3>
					<div class="detalle">
						<span>
							Env&iacute;o a: <?php echo $pedido['dir_name'] ?>
							<?php if ($pedido['activa'] == 0): ?>
								&nbsp;<span class="eliminada">(Esta direccion fue eliminada)</span>
							<?php endif ?>
						</span>	
						<span>Fecha: <?php echo $pedido['fecha'] ?></span>					
					</div>
				</div>
				<div class="pedido_body">
					<?php foreach ($productos_pedidos as $prod): ?>
						<?php if ($pedido['codigo'] == $prod['codigo']): ?>
							<div class="prod_ped">
								<div class="prod_img">
									<a href="detalles.php?id_prod=<?php echo $prod['id'] ?>"><img src="<?php echo $prod['imagen'] ?>" alt="X"></a>
									<a href="detalles.php?id_prod=<?php echo $prod['id'] ?>"><h4><?php echo $prod['nombre'] ?></h4></a>
								</div>
								<div class="prod_cant">
									<h3>x<?php echo $prod['cantidad'] ?></h3>
									<h4>Cantidad</h4>
								</div>
								<div class="prod_pre">
									<h3>$<?php echo $prod['precio'] ?></h3>
									<h4>Precio unitario</h4>
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