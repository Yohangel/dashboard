<section id="departamento" style="margin-top:90px">
				<div class="ed-container">
					
					<div class="ed-item quitar-padding-responsive quitar-padding-left quitar-padding-right">
						<?php 
							$db = $user->start();
							$departamentos = $db->query("SELECT * FROM departamento");
							foreach ($departamentos as $dep)
							{
						?>
						<div class="ed-item">
							<div class="departamento">
								<h2 class="departamento__title"><?php echo $dep['nombre']; ?></h2>
							</div>
						</div>
							<div class="department" style="margin-bottom:20px;">
							<?php 
								$departamento = $dep['id'];
								$empleados = $db->query("SELECT * FROM users WHERE departamento = '".$departamento."'");
								foreach ($empleados as $emp)
								{
							?>
									<div class="department__empleado">
										<h4 class="department__empleado--title"><?php echo $emp['name']. ' ' .$emp['lastname']; ?></h4>
										<div class="department__empleado--content">
										<?php 
										$uId = $emp['id'];
										$count = 0;
										$informes = $db->query("SELECT * FROM chronometers WHERE id_user = '".$uId."' and status=1 ORDER BY id desc");
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
											<p class="department__empleado--content__description">Actualmente no tiene ningun informe.
										<?php
										} // cierro empleado
										?>
										</div>
									</div>
								<?php
								} // cierro lista empleados
								?>
							</div>
						<?php
							} // cierro departamentos
						?>
					</div>
				</div>
			</section>