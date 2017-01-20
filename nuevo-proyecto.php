<section id="proyectos-pendientes">
					<h2 class="proyectos-pendientes--title">Nuevo proyecto</h2>
					<div class="ed-container">
						<form method="post" action="#" id="formulario" class="form-project">
							<input id="departament_id" type="hidden" value="<?php echo $user->my()->departamento; ?>">
							<input id="nombre" name="nombre" type="text" placeholder="Nombre" required>
							<input id="descripcion" name="descripcion" type="text" placeholder="Descripcion" required>
							<input id="fecha" name="fecha" type="text" placeholder="Fecha de inicio" required>
							<input id="fecha_entrega" name="fecha_entrega" type="text" placeholder="Fecha de entrega" required>
							<div style="margin:10px; font-family: Kano;">Asignar a:</div>
							<?php 
								$miDepartamento = $user->my()->departamento;
								$db = $user->start();
								$team = $db->query("SELECT * FROM users WHERE departamento = '".$miDepartamento."'");
								foreach ($team as $row) {
							?>
							<input type="checkbox" id="asignado" name="asignado[]" value="<?php echo $row['id'];  ?>"><span class="checkbox__texto"><?php echo $row['name'] . ' ' . $row['lastname'];  ?></span><br>
							<?php
								}
							?>
							<button id="guardar_proyecto" type="sumbit" class="formulario__button">Guardar</button>
						</form>
					</div>
</section>