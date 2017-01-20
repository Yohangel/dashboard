<section id="departamento" style="margin-top:90px">
				<div class="ed-container">
					<div class="ed-item">
						<div class="departamento">
							<h2 class="departamento__title">Lista de informes</h2>
						</div>
					</div>
					<div class="ed-item quitar-padding-responsive quitar-padding-left quitar-padding-right">
						<div class="department">
							<div class="department__empleado">
								<div class="department__empleado--content" style="display: block;">
								<?php 
								$miId = $user->my()->id;
								$db = $user->start();
								$count = 0;
								$informes = $db->query("SELECT * FROM chronometers WHERE id_user = '".$miId."' and status=1 ORDER BY id desc");
								if($informes->rowCount() > 0)
								{
									foreach ($informes as $row) 
									{
									?>
										<?php if ($count>0): ?>
											<hr style="margin:10px;">
										<?php endif ?>
										<p class="department__empleado--content__fecha">Desde <b><?php echo $row['start_date']; ?></b>, hasta <b><?php echo $row['end_date']; ?></b>, total de tiempo trabajado: <b><?php echo gmdate("H:i:s", $row['total_hours']); ?></b></p>
										<p class="department__empleado--content__description"><?php echo $row['report']; ?></p>
								<?php
									$count=+1;
									} 
								}
								else
								{
								?>
									<p class="department__empleado--content__description">Actualmente no tienes ningun informe.</div>
								<?php
								} 
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>