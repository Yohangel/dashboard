<section id="inicio">
		<div class="ed-container">
			<div class="ed-item quitar-padding-responsive">
				<div class="nota">
					<?php 
								$db = $user->start();
								$notice = $db->query("SELECT * FROM notice ORDER BY id DESC LIMIT 1");
								foreach ($notice as $row) {
							?>
					<h3 class="nota__description"><?php echo $row['content']; ?></h3>
					<?php 
				}
				?>
				</div>
			</div>
		</div>
		<div class="ed-container container-inicio">
			<div class="ed-item web-70 quitar-padding-responsive">
				<div class="ed-container">
					<div class="ed-item web-50 quitar-padding-left quitar-padding-responsive">
						<div class="horas">
							<div class="ed-container">
								<div class="ed-item quitar-padding-left quitar-padding-right">
									<h4 class="horas__title">Tiempo total trabajado</h4>
								</div>
								<div class="ed-item web-50 quitar-padding-responsive">
									<div class="horas__presenciales">
										<p class="horas__prensenciales--title">Prensenciales:</p>
										<?php 
											$miId = $user->my()->id;
											$db = $user->start();
											$presencial = $db->query("SELECT sum(total_hours) as suma FROM chronometers WHERE id_user = '".$miId."' and type = 1");
											$sumPresencial = $presencial->fetch(PDO::FETCH_ASSOC);
											$totalPresencial = $sumPresencial['suma'];
										?>
										<p class="horas__presenciales--description">
										<?php 
										if (!empty($totalPresencial))
										{
											echo gmdate("H:i:s", $totalPresencial);
										}
										else 
										{
											echo '00:00:00';}
										?>
										</p>
									</div>
								</div>
								<div class="ed-item web-50">
									<div class="horas__remotas">
										<p class="horas__remotas--title">Remotas:</p>
										<?php 
											$miId = $user->my()->id;
											$db = $user->start();
											$remotas = $db->query("SELECT sum(total_hours) as suma FROM chronometers WHERE id_user = '".$miId."' and type = 2");
											$sumRemota = $remotas->fetch(PDO::FETCH_ASSOC);
											$totalRemota = $sumRemota['suma'];
										?>
										<p class="horas__remotas--description">
										<?php 
										if (!empty($totalRemota))
										{
											echo gmdate("H:i:s", $totalRemota);
										}
										else 
										{
											echo '00:00:00';
										}
										?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="ed-item web-50 quitar-padding-responsive">
						<div class="proyectos">
							<div class="ed-container">
								<div class="ed-item quitar-padding-left quitar-padding-right">
									<h4 class="proyectos__title">Proyectos</h4>
								</div>
								<div class="ed-item web-50 quitar-padding-responsive">
									<div class="proyectos__presenciales">
										<p class="proyectos__prensenciales--title">Culminados:</p>
							
										<?php 
											$miId = $user->my()->id;
											$db = $user->start();
											$terminados = $db->query("
											SELECT count(*) AS count
											FROM projects pj
											JOIN user_projects up ON pj.id = up.project_id
											WHERE up.user_id = '".$miId."' AND pj.status = 1
											");
											$sumTerminados = $terminados->fetch(PDO::FETCH_ASSOC);
											$totalTerminados = $sumTerminados['count'];
										?>
										<p class="proyectos__presenciales--description">
										<?php 
										if (!empty($totalTerminados)){
										echo $totalTerminados; }
										else {
										echo '0';}
										?>
										</p>
									</div>
								</div>
								<div class="ed-item web-50">
									<div class="proyectos__remotas">
										<p class="proyectos__remotas--title">Pendientes:</p>
										<?php 
											$miId = $user->my()->id;
											$db = $user->start();
											$pendientes = $db->query("
											SELECT count(*) AS count
											FROM projects pj
											JOIN user_projects up ON pj.id = up.project_id
											WHERE up.user_id = '".$miId."' AND pj.status = 0
											");
											$sumPendientes = $pendientes->fetch(PDO::FETCH_ASSOC);
											$totalPendientes = $sumPendientes['count'];
										?>
										<p class="proyectos__remotas--description">
										<?php 
										if (!empty($totalPendientes)){
										echo $totalPendientes; }
										else {
										echo '0';}
										?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="ed-item quitar-padding-left quitar-padding-responsive">
						<div class="tareas">
							<h3 class="tareas__title">Tareas Pendientes</h3>
						</div>
						<div id="tarea">
						<?php 
								$miId = $user->my()->id;
								$db = $user->start();
								$tasks = $db->query("SELECT * FROM tasks WHERE user_id = '".$miId."'");
								foreach ($tasks as $row) {
							?>
							<div class="tarea">
								<div class="ed-container">
									<div class="ed-item web-50">
										<a class="tarea__title" href="mi-tarea/<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
									</div>
									<div class="ed-item web-50 web-main-end">
										<h3 class="tarea__fecha"><?php echo $row['end_date']; ?></h3>
									</div>
								</div>
							</div>
							<?php
								}
							?>
						</div>
					</div>
				</div>	
			</div>
			
			<!--equipo-->
			<div class="ed-item web-30 quitar-padding-left quitar-padding-responsive">
				<div class="equipos">
					<div class="ed-container">
						<div class="ed-item quitar-padding-left quitar-padding-right">
							<h4 class="equipos__title">Mi equipo</h4>
						</div>
						<div class="ed-item quitar-padding-left quitar-padding-right">
							<div class="equipo">
							<?php 
								$miDepartamento = $user->my()->departamento;
								$db = $user->start();
								$team = $db->query("SELECT * FROM users WHERE departamento = '".$miDepartamento."'");
								foreach ($team as $row) {
							?>
								<div class="miembro">
									<img class="miembro__img" src="<?php echo $row['avatar']; ?>" alt="">
									<p class="miembro__nombre"><?php echo $row['name'] . ' ' . $row['lastname'];  ?> <span><?php echo $row['cargo']; ?></span></p>
								</div>
							<?php
								}
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>