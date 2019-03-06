<!DOCTYPE html>
<html>
<head>
	<link href="script/css/lightbox.css" rel="stylesheet">
	<?php if ($detalles['disponible'] == 1): ?>
		<title>Arte Ataco :: <?= $detalles['nombre'] ?></title>
	<?php else: ?>
		<title>Arte Ataco :: No encontrado</title>
	<?php endif ?>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styleModal.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php require("messenger_contact.php") ?>

	<header>
		<?php require 'header.php' ?>
	</header>

	<div class="contenedor_detalles">

	<div id="modal-container">
	    <div class="modal-background">
	      <div class="modal">
	        <h2>Para continuar por favor inicia sesi&oacute;n o registrate</h2>
	        <div class="btns">
	        	<a href="login.php" class="boton">Aceptar</a>
	        </div>
	        <svg class="modal-svg" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none">
	 	 	<rect x="0" y="0" fill="none" width="226" height="162" rx="3" ry="3"></rect>
	        </svg>
	      </div>
	    </div>
	  </div>

		<?php if ($detalles != false): ?>
			<div class="detalles-prod">

				<?php if ($imagenes != false): ?>
					<div class="detalles-prod-img">
						<div class="mini-img">
							<?php foreach ($imagenes as $img): ?>
								<a href="<?= $img['ruta'] ?>" data-lightbox="product" data-title="Producto">
									<img onmousemove="javascript:document.getElementById('imgDefault').src='<?= $img['ruta'] ?>';"
										src="<?= $img['ruta'] ?>"
									>
								</a>
							<?php endforeach ?>
						</div>
						
						<?php foreach ($imagenes as $checkImg): ?>
							<?php if ($checkImg['principal'] == 1): ?>
								<?php $mainImg = TRUE; ?>
								<a 	id="principal" onmousemove="cambiarEnlace()" href="<?= $checkImg['ruta'] ?>" 
									data-lightbox="product" data-title="Producto">
									<img class="img_default" id="imgDefault" src="<?= $checkImg['ruta'] ?>" alt="">
								</a>
							<?php endif ?>
						<?php endforeach ?>

						<?php if (!isset($mainImg)): ?>
							<a 	id="principal" onmousemove="cambiarEnlace()" href="<?= $imagenes[0]['ruta'] ?>" 
								data-lightbox="product" data-title="Producto">
								<img class="img_default" id="imgDefault" src="<?= $imagenes[0]['ruta'] ?>" alt="">
							</a>
						<?php endif ?>

						<div class="img-info">
							<p>Click sobre una imagen para ampliarla</p>
						</div>
					</div>
				<?php else: ?>
					<div class="detalles-prod-img noImgs">
						<span>Actualmente no hay imagenes para este producto <i class="fa fa-image"></i> <i class="fa fa-exclamation-circle"></i></span>
					</div>
				<?php endif ?>
				
				<div class="detalles-prod-info">
					<div class="prod-det">
						<div class="title">
							<span>Producto:</span>
						</div>
						<div class="info">
							<span><?= $detalles['nombre'] ?></span>
						</div>
					</div>
					<hr>

					<div class="prod-det">
						<div class="title">
							<span>Descripci&oacute;n:</span>
						</div>
						<div class="info">
							<?= $detalles['descripcion'] ?>
						</div>
					</div>

					<div class="prod-det">
						<div class="title">
							<span>Precio:</span>
						</div>
						<div class="info">
							<?= '$'. number_format($detalles['precio'], 2) ?>
						</div>
					</div>

					<form class="form_carrito" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
						<input type="hidden" value="<?php echo $id_prod ?>" name="idprod">
						<input type="hidden" value="<?php echo $user ?>" name="username">
						
						<div class="prod-det carrito">
							<div class="title">
								<span>Cantidad:</span>
							</div>
							<div class="info">
								<input type="number" name="quantity" min="1" max="10" value="1">
							</div>
						</div>

						<?php if ($user != "Invitado"): ?>
							<div class="carrito-submit-container">
								<input type="submit" class="carrito-prod" value="Carrito">
							</div>
						<?php else: ?>
							<div class="carrito-submit-container">
								<div id="two" class="button carrito-prod">Carrito <i class="fa fa-shopping-cart"></i></div>
							</div>
						<?php endif ?>				
					</form>
					<!-- <h2 class="stock">Disponibles:</br> <?php //echo $detalles['stock'] . ' unidades' ?></h2> -->
				</div>
			</div>
		<?php else: ?>
			<span class="notFound">No se ha encontrado el producto <i class="fa fa-puzzle-piece"></i></span>
		<?php endif ?>
	</div>
	
	<?php if ($detalles != false): ?>
		<div class="contenedor_detalles">
			<!-- Comentarios disqus -->
			<div id="disqus_thread"></div>
				<script>
				/**
				*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
				*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
				/*
				var disqus_config = function () {
				this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
				this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
				};
				*/
				(function() { // DON'T EDIT BELOW THIS LINE
				var d = document, s = d.createElement('script');
				s.src = 'https://arteataco.disqus.com/embed.js';
				s.setAttribute('data-timestamp', +new Date());
				(d.head || d.body).appendChild(s);
				})();
				</script>
				<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
		</div>
	<?php endif ?>

	<?php include 'footer.php'; ?>

	<!-- lightbox -->
	<script src="script/js/lightbox-plus-jquery.js"></script>
	<script>
    		lightbox.option({
      		'wrapAround': true,
    		})

    		function cambiarEnlace() {
    			var imgDefault = document.getElementById("imgDefault"),
    				enlaceDefault = document.getElementById("principal");

    			enlaceDefault.href = imgDefault.src;
    		}
	</script>
	
	<script src="script/js/functions.js"></script>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script  src="script/js/modal.js"></script>
	<script id="dsq-count-scr" src="//arteataco.disqus.com/count.js" async></script>
</body>
</html>