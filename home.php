<?php if($user->status()){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pamax: Panel de personal</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/font/flaticon.css">
	<link rel="stylesheet" href="css/admin.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/jquery-ui.min.css">
</head>
<body>
	<!--Seccion Header-->
		<header id="header">
			<div class="ed-container container-header">
				<div class="ed-item web-25 web-main-start azul">
					<div class="logo">
						<img class="logo__img" src="img/logopamax2.png" alt="logo">
					</div>
				</div>
				<div class="ed-item web-75 web-main-end web-cross-center">
					<ul class="menu">
						<li class="menu__item" id="hamburguer"><a class="menu__link bt-menu"><span class="flaticon-list-1 close"></span></a></li>
						<li class="menu__item"><a class="menu__link" href="#"><img class="imagen-perfil" src="<?php echo $user->my()->avatar ?>" alt=""> <?php echo $user->my()->name . ' ' . $user->my()->lastname; ?></a></li>
					</ul>
				</div>
			</div>
		</header>
	<!--Fin Seccion Header-->

<section id="content">
<div class="ed-container container-content">
	<div class="ed-item web-25 quitar-padding-left">
		<nav class="menu-lateral" id="lateral">
			<ul>
				<li class="menu-lateral__item"><a class="menu-lateral__link" href="index.php"><span class="flaticon-home-page"></span> Inicio</a></li>
				<li class="menu-lateral__item"><a class="menu-lateral__link submenu" href="index.php?page=cronometro"><span class="flaticon-alarm-clock"></span> Cronómetro</a>
				</li>
				<li class="menu-lateral__item"><span class="flaticon-chevron-arrow-down up-down"></span><a class="menu-lateral__link submenu" href="#"><span class="flaticon-newspaper"></span> Informes</a>
					<ul class="childreen">
						<li class="childreen__item"><a class="childreen__link" href="index.php?page=mis-informes">Mis informes</a></li>
						<li class="childreen__item"><a class="childreen__link" href="index.php?page=informes-departamento">Informes del departamento</a></li>
						<li class="childreen__item"><a class="childreen__link" href="index.php?page=informes-todos">Informes de todos</a></li>
					</ul>
				</li>
				<li class="menu-lateral__item"><span class="flaticon-chevron-arrow-down up-down"></span><a class="menu-lateral__link submenu" href="#"><span class="flaticon-management"></span> Proyectos</a>
					<ul class="childreen">
						<li class="childreen__item"><a class="childreen__link" href="index.php?page=mis-proyectos">Mis proyectos</a></li>
						<li class="childreen__item"><a class="childreen__link" href="index.php?page=nuevo-proyecto">Nuevo proyecto</a></li>
						<li class="childreen__item"><a class="childreen__link" href="index.php?page=proyectos-todos">Proyectos de todos</a></li>
					</ul>
				</li>
				<li class="menu-lateral__item"><span class="flaticon-chevron-arrow-down up-down"></span><a class="menu-lateral__link submenu" href="#"><span class="flaticon-list"></span> Tareas</a>
					<ul class="childreen">
						<li class="childreen__item"><a class="childreen__link" href="index.php?page=mis-tareas">Mis tareas</a></li>
						<li class="childreen__item"><a class="childreen__link" href="index.php?page=nueva-tarea">Nueva tarea</a></li>
						<li class="childreen__item"><a class="childreen__link" href="index.php?page=tareas-todos">Tareas de todos</a></li>
					</ul>
				</li>
				<li class="menu-lateral__item"><a class="menu-lateral__link" href="index.php?page=personal"><span class="flaticon-multiple-users-silhouette"></span> Personal</a></li>
				<li class="menu-lateral__item"><a class="menu-lateral__link" href="index.php?page=estadisticas"><span class="flaticon-line-chart"></span> Estadísticas</a></li>
				<li class="menu-lateral__item"><a class="menu-lateral__link" href="index.php?page=administacion"><span class="flaticon-admin-with-cogwheels"></span> Administración</a></li>
			</ul>
		</nav>
	</div>


	<div class="ed-item web-75">
			<div id="vista">
				<?php 
					if(isset($_GET['page']))
					{
						$page =  $_GET['page'];
						if($page == "inicio")
						{
							include"inicio.php";
						}
						elseif($page == "cronometro")
						{
							include"cronometro.php";
						}
						elseif($page == "mis-informes")
						{
							include"mis-informes.php";
						}
						elseif($page == "informes-departamento")
						{
							include"informes-departamento.php";
						}
						elseif($page == "informes-todos")
						{
							include"informes-todos.php";
						}
						elseif($page == "mis-proyectos")
						{
							include"mis-proyectos.php";
						}
						elseif($page == "nuevo-proyecto")
						{
							include"nuevo-proyecto.php";
						}
						elseif($page == "proyectos-todos")
						{
							include"proyectos-todos.php";
						}
						elseif($page == "nueva-tarea")
						{
							include"nueva-tarea.php";
						}
						elseif($page == "mis-tareas")
						{
							include"mis-tareas.php";
						}
						elseif($page == "tareas-todos")
						{
							include"tareas-todos.php";
						}
						else
						{
							include"error.php";
						}
					}
					else
					{
						include"inicio.php";
					}
				?>
			</div>
		</div>
	</div>
</div>
</section>
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/easytimer.min.js"></script>
<script src="js/api.js"></script>
<script src="js/main.js"></script>
<?php 
if(isset($_GET['page']))
	{
	if($page == "cronometro")
	{
		echo '<script src="js/chronometer.js"></script>';
	} 
	if($page == "nuevo-proyecto" || $page == "nueva-tarea")
	{
		echo '<script src="js/datepicker.js"></script>';
	} 
} 
?>
</body>
</html>
<?php } ?>