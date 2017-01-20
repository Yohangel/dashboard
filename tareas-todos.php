	<section id="proyectos-pendientes">
					<h2 class="proyectos-pendientes--title">Tareas pedientes</h2>
					<?php 
						$miId = $user->my()->id;
						$db = $user->start();
						$tasks = $db->query("
						SELECT * FROM tasks
						WHERE status = 0 
						ORDER BY end_date ASC
						");
						if($tasks->rowCount() > 0){
						foreach ($tasks as $row) {
					?>
					<div class="ed-container" style="background: rgba(0,0,0,0.1); margin-bottom: 20px; padding-bottom: 20px;">
						<div class="ed-item web-50">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__titulo">
									<p><?php echo $row['name']; ?></p>
								</div>
							</div>
						</div>
						<div class="ed-item web-25">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__entrega">
									<p>fecha de inicio:</p>
									<p><?php echo $row['start_date']; ?></p>
								</div>
							</div>
						</div>
						<div class="ed-item web-25">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__entrega">
									<p>fecha de entrega:</p>
									<p><?php echo $row['end_date']; ?></p>
								</div>
							</div>
						</div>
					</div>
					<?php
					}
					}
					else
					{
					?>
					<p>actualmente no hay ningún proyecto culminado</p>
					<?php
					}
					?>
					<div id="proyectos-culminados">
						<h2 class="proyectos-pendientes--title">Proyectos culminados</h2>
						<?php 
						$miId = $user->my()->id;
						$db = $user->start();
						$tasks = $db->query("
						SELECT * FROM tasks
						WHERE status = 1
						ORDER BY end_date ASC
						");
						if($tasks->rowCount() > 0){
						foreach ($tasks as $row) {
					?>
					<div class="ed-container" style="background: rgba(0,0,0,0.1); margin-bottom: 20px; padding-bottom: 20px;">
						<div class="ed-item web-50">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__titulo">
									<p><?php echo $row['name']; ?></p>
								</div>
							</div>
						</div>
						<div class="ed-item web-25">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__entrega">
									<p>fecha de inicio:</p>
									<p><?php echo $row['start_date']; ?></p>
								</div>
							</div>
						</div>
						<div class="ed-item web-25">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__entrega">
									<p>fecha de entrega:</p>
									<p><?php echo $row['end_date']; ?></p>
								</div>
							</div>
						</div>
					</div>
					<?php
					}
					}
					else
					{
					?>
					<p>actualmente no hay ningún proyecto culminado</p>
					<?php
					}
					?>
					</div>
				</section>