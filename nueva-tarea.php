<section id="proyectos-pendientes">
					<h2 class="proyectos-pendientes--title">Nueva tarea</h2>
					<div class="ed-container">
						<form method="post" action="#" id="formulario" class="form-task">
							<input id="nombre" name="nombre" type="text" placeholder="Nombre" required>
							<input id="fecha" name="fecha" type="text" placeholder="Fecha de inicio" required>
							<input id="fecha_entrega" name="fecha_entrega" type="text" placeholder="Fecha de entrega" required>
							<div style="margin:10px; font-family: Kano;">Asignar a:</div>
							<?php 
								$miDepartamento = $user->my()->departamento;
								$db = $user->start();
								$team = $db->query("SELECT * FROM users WHERE departamento = '".$miDepartamento."'");
								foreach ($team as $row) {
							?>
							<input type="radio" id="asignado" name="asignado" value="<?php echo $row['id'];  ?>" required><span class="checkbox__texto" style="margin:10px;"><?php echo $row['name'] . ' ' . $row['lastname'];  ?></span><br>
							<?php
								}
							?>
							<div style="margin:10px; font-family: Kano;">En el proyecto:</div>
							<?php 
								$miDepartamento = $user->my()->departamento;
								$db = $user->start();
								$team = $db->query("SELECT * FROM projects WHERE departament_id = '".$miDepartamento."'");
								foreach ($team as $row) {
							?>
							<input type="radio" id="project" name="project" value="<?php echo $row['id'];  ?>" required><span class="checkbox__texto" style="margin:10px;"><?php echo $row['name']; ?></span><br>
							<?php
								}
							?>
							<button id="guardar_proyecto" type="sumbit" class="formulario__button">Guardar</button>
						</form>
					</div>
</section>