/* Cronometro */
var timer = new Timer(); // Inicio el objeto Timer (Cronometro)
var limite=true;
var primero=true;

$('.cronometro .cronometro__conteo').click(function()
{
	if(has_paused) // Si esta pausado el contador
	{ 

	  		$('.cronometro .cronometro__conteo').html("Pausar conteo");
	  		api('startnowChronometer',$('#id_user').val()); // Llamo a la api para renaudar el conteo
	  		timer.start({startValues: {seconds: total_hours}});
	  		has_paused = false;
	  		has_now = true;
	  		timete=true;
	} 
	else if(has_now)
	{
		//timer.pause();

	  		$('.cronometro .cronometro__conteo').html("Continuar conteo");
	  		api('pauseChronometer',$('#id_user').val());  // Llamo a la api para pausar el conteo
	  		has_paused = true;
	  		has_now = false;
	  		limite=true;
	}
	else
	{
		api('addChronometer',$('#id_user').val());
		limite=true;
	}
});

if((has_now || has_paused) && limite==true )
	{
		if(has_paused) // Si esta pausado el contador
		{ 
			//timer.pause();
	   		$('.cronometro .cronometro__conteo').html("Continuar conteo");
	   		$('.cronometro .cronometro__conteo').click(function()
			{
				api('startnowChronometer',$('#id_user').val());
			});
				limite=false;
		} 
		else 
		{
			timer.start({startValues: {seconds: total_hours}});

	   		$('.cronometro .cronometro__conteo').html("Pausar conteo");
	   		$('.cronometro .cronometro__conteo').click(function()
			{
				api('pauseChronometer',$('#id_user').val()); 
			});
				limite=false;
		}
	}

$('.cronometro .cronometro__cancelar').click(function () 
{
	if(confirm("¿Seguro deseas cancelar el conteo?"))
    {
        alert('Conteo cancelado con exito');
    }
    else
    {
        e.preventDefault();
    }
	timer.stop();
   	$('.cronometro .cronometro__conteo').html("Comenzar conteo");
   	$('.conteo h2').html("00:00:00");
   	api('stopChronometer',$('#id_user').val()); 
});

timer.addEventListener('secondsUpdated', function (e) {
    $('.conteo h2').html(timer.getTimeValues().toString());
});

timer.addEventListener('started', function (e) {
    $('.conteo h2').html(timer.getTimeValues().toString());
});