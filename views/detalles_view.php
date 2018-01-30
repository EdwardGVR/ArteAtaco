<!DOCTYPE html>
<html>
<head>
	<!-- lightbox -->
	<link href="script/css/lightbox.css" rel="stylesheet">

	<title>Arte Ataco :: <?php echo $detalles['nombre'] ?></title>
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
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
				<div class="detalles-prod-img">
					<div class="mini-img">
						<a href="<?php echo $detalles['imagen'] ?>" data-lightbox="product" data-title="Producto">
							<img onmousemove="javascript:document.getElementById('imgDefault').src='<?php echo $detalles['imagen'] ?>';"
							 src="<?php echo $detalles['imagen'] ?>" alt="">
						</a>
						<a href="http://lorempixel.com/720/960/cats" data-lightbox="product" data-title="Producto">
							<img onmousemove="javascript:document.getElementById('imgDefault').src='http://lorempixel.com/720/960/cats';"
							 src="http://lorempixel.com/200/200/cats" alt="">
						</a>
						<a href="http://lorempixel.com/720/960/food" data-lightbox="product" data-title="Producto">
							<img onmousemove="javascript:document.getElementById('imgDefault').src='http://lorempixel.com/720/960/food';" src="http://lorempixel.com/200/200/food" alt="">
						</a>
						<a href="http://lorempixel.com/720/960/city" data-lightbox="product" data-title="Producto">
							<img onmousemove="javascript:document.getElementById('imgDefault').src='http://lorempixel.com/720/960/city';" src="http://lorempixel.com/200/200/city" alt="">
						</a>
					</div>
					    <a id="principal" onmousemove="cambiarEnlace()" href="<?php echo $detalles['imagen'] ?>" data-lightbox="product" data-title="Producto">
					    	<img class="img_default" id="imgDefault" src="<?php echo $detalles['imagen'] ?>" alt="">
					    </a>
					<div class="img-info">
						<p>Click sobre una imagen para ampliarla  </p>
					</div>
				</div>
				<div class="detalles-prod-info">
					<h2 class="item">Producto: <?php echo $detalles['nombre'] ?></h2>
					<hr>
					<h2 class="precio">Precio:</br> <?php echo '$'.$detalles['precio'] ?></h2>

					<form class="form_carrito" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
						<input type="hidden" value="<?php echo $id_prod ?>" name="idprod">
						<input type="hidden" value="<?php echo $user ?>" name="username">
						<h2 class="detalles_cantidad">Cantidad</h2> <input type="number" name="quantity" min="1" max="10" value="1">
						<?php if ($user != "Invitado"): ?>
							<input type="submit" class="carrito-prod" value="Carrito">
						<?php else: ?>
							<div id="two" class="button carrito-prod">Carrito</div>
						<?php endif ?>				
					</form>

					<h2 class="descripcion">Descripci&oacute;n:</br> <?php echo $detalles['descripcion'] ?></h2>
					<!-- <h2 class="stock">Disponibles:</br> <?php //echo $detalles['stock'] . ' unidades' ?></h2> -->
				</div>
			</div>
		<?php else: ?>
			<h3>No se ha encontrado el producto.</h3>
		<?php endif ?>
	</div>
	
	<div class="contenedor_detalles">
		<img src="http://lorempixel.com/300/300/food" alt="">
	</div>
	
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