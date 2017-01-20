$(document).ready(function()
{
	$('.submenu').click(function()
	{
		$(this).next().slideToggle();
		if($('.up-down').hasClass('flaticon-chevron-arrow-down'))
		{
			$('.up-down').removeClass('flaticon-chevron-arrow-down');
			$('.up-down').addClass('flaticon-chevron-arrow-up');
		}
		else if($('.up-down').hasClass('flaticon-chevron-arrow-up'))
		{
			$('.up-down').removeClass('flaticon-chevron-arrow-up');
			$('.up-down').addClass('flaticon-chevron-arrow-down');
		}
	});
	$('.bt-menu').click(function()
	{
			main();	
		if($('.close').hasClass('flaticon-list-1'))
		{
			$('.up-down').removeClass('flaticon-list-1');
			$('.up-down').addClass('flaticon-cancel');
		}
		else if($('.close').hasClass('flaticon-cancel'))
		{
			$('.up-down').removeClass('flaticon-cancel');
			$('.up-down').addClass('flaticon-list-1');
		}
	});
	$('.department__empleado').on('click','h4',function()
	{
		var t = $(this);
		var tp = t.next();
		var p = t.parent().siblings().find('.department__empleado--content');
		tp.slideToggle();
		p.slideUp()
	});
	$('a.cronometro__save').click(function()
	{
		$('#modal').show();
		$('#modal').addClass("animated fadeInDown");
		timer.pause();
   		cronStarted = 0;
   		$('#ttHours').html($('.conteo h2').html());
   		$('.cronometro .cronometro__conteo').html("Continuar conteo");
	});
	$('.flaticon-cancel').click(function()
	{
		$('#modal').hide();
	});
}
);

var contador = 1;
function main()
{
	if(contador == 1)
	{
		$('.menu-lateral').animate(
		{
			left:'0'
		});
		contador = 0;
	}
	else
	{
		contador = 1;
		$('.menu-lateral').animate(
		{
		left:'-100%'
		});
	}
};

/* Cronometro */
var timer = new Timer(); // Inicio el objeto Timer (Cronometro)

$('.cronometro .cronometro__conteo').click(function()
{
	if(has_now || has_paused) // Si tiene un cronometro comenzado y no terminado
	{
		if(has_paused) // Si esta pausado el contador
		{ 
	   		$('.cronometro .cronometro__conteo').html("Pausar conteo");
	   		api('startnowChronometer',$('#id_user').val()); // Llamo a la api para renaudar el conteo
		} 
		else 
		{
			timer.pause();
	   		$('.cronometro .cronometro__conteo').html("Continuar conteo");
	   		api('pauseChronometer',$('#id_user').val());  // Llamo a la api para pausar el conteo
		}
	}
	else
	{
		$('.cronometro .cronometro__conteo').attr( "onclick", "api('addChronometer',$('#id_user').val())");
		location.reload();
	}
});

if(has_now || has_paused)
	{ alert('hola');
		timer.start({startValues: {seconds: total_hours}});
		if(has_paused) // Si esta pausado el contador
		{ 
			timer.pause();
	   		$('.cronometro .cronometro__conteo').html("Continuar conteo");
	   		$('.cronometro .cronometro__conteo').click(function()
			{
				api('startnowChronometer',$('#id_user').val());
			});
		} 
		else 
		{
	   		$('.cronometro .cronometro__conteo').html("Pausar conteo");
	   		$('.cronometro .cronometro__conteo').click(function()
			{
				api('pauseChronometer',$('#id_user').val()); 
			});
		}
	}

$('.cronometro .cronometro__cancelar').click(function () 
{
	timer.stop();
   	cronStarted = 0;
   	$('.cronometro .cronometro__conteo').html("Comenzar conteo");
   	$('.conteo h2').html("00:00:00");
});

timer.addEventListener('secondsUpdated', function (e) {
    $('.conteo h2').html(timer.getTimeValues().toString());
});

timer.addEventListener('started', function (e) {
    $('.conteo h2').html(timer.getTimeValues().toString());
});
