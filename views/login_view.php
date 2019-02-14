<!DOCTYPE html>
<html>
<head>
	<title>Arte Ataco :: Inicia Sesión</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php require "messenger_contact.php" ?>

	<div class="contenedorLogin">
		<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="formulario" name="login">
			<input type="text" placeholder="Usuario o correo: " name="nombre">
			<input type="password" placeholder="Contraseña: " name="pass">
			<!-- <span class="remember">Mantener sesi&oacute;n iniciada? <input type="checkbox" name="remember" value="1"></span> -->
			<?php if (!empty($errores)): ?>
				<div class="error">
					<ul>
						<?= $errores ?>
					</ul>
				</div>
			<?php endif; ?>
			<input type="submit" name="submit" class="login_btn" value="Iniciar Sesion">
		</form>
		<p class="msg_form">No tienes cuenta? <a class="login" href="register.php">Registrate</a> O puedes revisar el cat&aacute;logo de productos como <a class="login" href="categorias.php">Invitado</a></p>
	</div>

	<div class="nequiLogin">
		<img src="https://lh3.googleusercontent.com/mAg5sR6gPwjS1l9SAyD7pvcKnX76-4g6zu5DyaVO0p1VIWw9BGkH9cKrMOH1N_fR3enhzVqBmhVeeVVbCS3pC3YqQnkmeJnNUww1R8dBKNSsAGngNDW8a67bJWQzwBuYVGquNuSQDrqNEslR6MBTikLO7ZYYd6mOU3_2S0PywBPPBwCt1TMg5_YBUMP_u-piavNN16aLyjNXxKN4o6TEK88wUK5C59qm8fggNBpYjJxHKwsoeQvVO-dP_ccs2B6BoNOLlCIqaMip-cTLgVYECO-M5Y-TKEDJHpIv7D1OicCZ4r_46tQoZFKZtk5UsVofqOds2cPuHkej4-SISrnFiCbXSyNzJU-QW-SycsrgEgygWUPATwa1nplU3QHBC6DHeuEOGiAx31C-gz_yCuLaFlpiyq3_7qsIFmFLC-ffAU2hKbMfs3QX0F0k9YB86OUtMa8Foo4kHQrPCQDN4jQWyyNnZACSxMt9hDTZiuMy9iq64v25SDjT5RTUDqu7w7MB8kOpArZiUG1cUzsVLZoFzNCSTIDiuE054UUev9r55aegYC6x7exdMa192q2OcU2sLZW_3ugmsLpumnCzHOoXh_QP4c9ira2aLgeImPb65YoEKrdQImib5GAtIBAcki6-lEofVaKTBDwXbMIu8642SRdDNi6Rew=w299-h880-no" 
			alt="x"
			class="nequi head">
		<img src="https://lh3.googleusercontent.com/AVnrMjnNSp71SgXmKT2DTVPnYds3304oTnInpquP2-Oxaq_MEADplcBiTc2JiBfe1IXyOb0psJ5EYTuDeWB7ZHrzrh9wcvvivN88YcYz0ZmpEdUjYzYiK0rkt24WqHx4JmaMMEFpJTPG-dAj-xe5d5pkw0JWsqFvHUdWZJ2OjNxL-dClaWUG1JNChKZWnZfs_nqPXHj0efDHDm879N8KX8XaJHbCT8MJNe9-v_cX982e1nNP1DZ3V4szRTUjsXCf9FrrrXHEdcBe2-Y9eqV8LygVKYoF4kKz-gTKonLiQek0TPpFaaGqATFs2zDZASkSwEz_r5YwQ7_qmzUPXozi_Y6WcxSY65QO3KEgNfsQKZUM3eGgeJJ77L4lIXFpDChmqIlpi1486ZTndo7-AMrmylzbqpw59n98N6fg-ShhvRKUqRHDJDs2k0HH2CNM7lXiFw58-VPDpdeEHRF3_cDrz5d3FwmBn756HzfzDnJ1c478YEMdSUAatbcerJBYF-JYRNWpOAETBWPP5cA-f5brwIOyyM3bjGGWKUrGFeYvdgrPXaCVhAKlYwZL82egcRPDNSq9F1xmEQtoFb4thrs7OcbFtMrkRNbo5xdIRjymvFV0MYQBqBkxjuKcFH4r79mfProMXoRAAsV-3owvrPflmG4DOCkEvw=w2904-h768-no" 
			alt="x" 
			class="nequi arm1">
	</div>

	<script src="script/js/functions.js"></script>
</body>
</html>