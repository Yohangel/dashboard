<section id="proyectos-pendientes">
<h2 class="proyectos-pendientes--title">Asignar al proyecto "<b>Prueba</b>":</h2>
<div class="ed-container">
						<form method="post" action="#" id="formulario">
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
							<button type="sumbit"  class="formulario__button">Guardar</button>
						</form>
					</div>
</section>