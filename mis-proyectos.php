	<section id="proyectos-pendientes">
					<h2 class="proyectos-pendientes--title">Proyectos pedientes</h2>
					<?php 
						$miId = $user->my()->id;
						$db = $user->start();
						$projects = $db->query("
						SELECT *
						FROM projects pj
						JOIN user_projects up ON pj.id = up.project_id
						WHERE up.user_id = '".$miId."' AND pj.status = 0
						ORDER BY end_date ASC
						");
						if($projects->rowCount() > 0){
						foreach ($projects as $row) {
					?>
					<div class="ed-container" style="background: rgba(0,0,0,0.1); margin-bottom: 20px; padding-bottom: 20px;">
						<div class="ed-item web-25">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__titulo">
									<p><?php echo $row['name']; ?></p>
								</div>
							</div>
						</div>
						<div class="ed-item web-75">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__entrega">
									<p><?php echo $row['description']; ?></p>
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
						<div class="ed-item web-25">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__culminadas">
									<p>tareas culminadas:</p>
									<p>24</p>
								</div>
							</div>
						</div>
						<div class="ed-item web-25">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__pendientes">
									<p>tareas pendientes:</p>
									<p>5</p>
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
						$projects = $db->query("
						SELECT *
						FROM projects pj
						JOIN user_projects up ON pj.id = up.project_id
						WHERE up.user_id = '".$miId."' AND pj.status = 1
						ORDER BY end_date ASC
						");
						if($projects->rowCount() > 0){
						foreach ($projects as $row) {
					?>
					<div class="ed-container" style="background: rgba(0,0,0,0.1); margin-bottom: 20px; padding-bottom: 20px;">
						<div class="ed-item web-25">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__titulo">
									<p><?php echo $row['name']; ?></p>
								</div>
							</div>
						</div>
						<div class="ed-item web-75">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__entrega">
									<p><?php echo $row['description']; ?></p>
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
						<div class="ed-item web-25">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__entrega">
									<p>fecha de entrega:</p>
									<p><?php echo $row['end_date']; ?></p>
								</div>
							</div>
						</div>
						<div class="ed-item web-25">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__culminadas">
									<p>tareas culminadas:</p>
									<p>24</p>
								</div>
							</div>
						</div>
						<div class="ed-item web-25">
							<div class="proyectos-pendientes">
								<div class="proyectos-pendientes__pendientes">
									<p>tareas pendientes:</p>
									<p>5</p>
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