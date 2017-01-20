<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Administrador</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/font/flaticon.css">
	<link rel="stylesheet" href="css/admin.css">
	<link rel="stylesheet" href="css/normalize.css">
</head>
<body id="login">
	
	<section class="log">
		<div class="ed-container">
			<div class="ed-item">
				<div class="login">
					<img class="login__logo" src="img/logopamax2.png" alt="logo">
				</div>
				<div class="login__contenedor">
					<form action="" class="sing" method="post">
						<?php if(isset($_SESSION['error']) && $_SESSION['error'] != ""){ ?>
						<span class="sing__error"><?php echo $_SESSION['error']; $_SESSION['error']=""; ?></span>
						<?php } ?>
						<input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
						<input class="sing__campo using__usuario" type="text" name="username" placeholder="Usuario">
						<input class="sing__campo sing__password" type="password" name="password" placeholder="Contraseña">
						<input type="submit" class="sing__entrar" value="Ingresar" name="login">
					</form>
				</div>
				<p class="login__footer">Panel de Personal</p>
			</div>
		</div>		
	</section>

</body>
</html>