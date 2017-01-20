<section id="cronometro">
				<div class="ed-container">
					<div class="ed-item quitar-padding-responsive quitar-padding-left quitar-padding-right">
						<div class="cronometro">
							<div class="conteo">
								<h2>
									<?php
									if($dashboard->hasActChronometer($user->my()->id)){
										$seconds = $dashboard->totalTime($user->my()->id);
										echo gmdate("H:i:s", $seconds);
									} elseif($dashboard->hasPausedChronometer($user->my()->id)) {
										$seconds = $dashboard->totalTime($user->my()->id);
										echo gmdate("H:i:s", $seconds);
									} else {
										echo "00:00:00";
									}
									?>
								</h2>
							</div>
							<div class="cronometro__botonera">
								<input id="id_user" type="hidden" value="<?php echo $user->my()->id; ?>">
								<?php if(!($dashboard->hasActChronometer($user->my()->id)) && !($dashboard->hasPausedChronometer($user->my()->id))){ ?>
									<a class="cronometro__conteo" href="#" style="width:100%;">Comenzar Conteo</a>
								<?php } else { ?>
									<a class="cronometro__conteo" href="#">Comenzar Conteo</a>
									<a class="cronometro__save" href="#">Guardar</a>
									<a class="cronometro__cancelar" href="#">Cancelar conteo</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
</section>
<div id="modal" style="display:none;">
	<div class="modal">
		<div class="content-modal">
			<div class="modal__cabecera">Total horas trabajadas <span id="ttHours">
			<?php
									if($dashboard->hasActChronometer($user->my()->id)){
										$seconds = $dashboard->totalTime($user->my()->id);
										echo gmdate("H:i:s", $seconds);
									} elseif($dashboard->hasPausedChronometer($user->my()->id)) {
										$seconds = $dashboard->totalTime($user->my()->id);
										echo gmdate("H:i:s", $seconds);
									} else {
										echo "00:00:00";
									}
									?>
			</span> <a class="flaticon-cancel"></a></div>
			<textarea id="report" class="modal__contenido" placeholder="resumen de lo trabajado (obligatorio)"></textarea>
			<div class="modal__button" onclick="guardarReporte();">Guardar</div>
		</div>
	</div>
</div>

<div id="modal__exito" style="display:none;">
	<div class="modal">
		<div class="content-modal">
			<div class="modal__cabecera">Respuesta<a class="flaticon-cancel"></a></div>
			<textarea class="modal__contenido"  maxlength="20" minlength="5" style="height:80px;text-align:center;font-size:1.4rem;" readonly>Horas guardadas con exito, recuerda que aun deben ser aprobadas!</textarea>
		</div>
	</div>
</div>
<script>
var total_hours = <?php echo $dashboard->totalTime($user->my()->id); ?>;
var has_now = <?php if($dashboard->hasActChronometer($user->my()->id)){echo 'true';}else{echo 'false';}  ?>;
var has_paused = <?php if($dashboard->hasPausedChronometer($user->my()->id)){echo 'true';}else{echo 'false';}  ?>;
function guardarReporte(){
	if($('#report').val().length < 50){
       alert('El mensaje no puede contener menos de 50 caracteres');
    }else if($('#report').val().length > 400){
    	alert('El mensaje no puede contener mas de 400 caracteres.');
    }else{
    	api('saveReport',<?php echo $user->my()->id; ?>,$('#report').val());	
    }
}
</script>
<script src="js/chronometer.js"></script>