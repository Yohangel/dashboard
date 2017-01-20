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


/* guardar proyecto */
$(".form-project").submit(function(event) {
	event.preventDefault();	
	var nombre = $('#nombre').val();
	var descripcion = $('#descripcion').val();
	var fecha = $('#fecha').val();
	var fecha_entrega = $('#fecha_entrega').val();
	var departament_id = $('#departament_id').val();
	var asignado = [];
	$("input[name='asignado[]']:checked").each(function(){asignado.push($(this).val());});
 	$.ajax({
	    	type: "GET",
	    	url: "./inc/api.php",
			data: 
			{
				method : 'guardar_proyecto',
				nombre : nombre,
				descripcion : descripcion,
				fecha : fecha,
				fecha_entrega : fecha_entrega,
				asignado : asignado,
				departament_id : departament_id
			},
			success: function(response){
				alert(response);
			}
		});         
});


$(".form-task").submit(function(event) {
	event.preventDefault();	
	var nombre = $('#nombre').val();
	var fecha = $('#fecha').val();
	var fecha_entrega = $('#fecha_entrega').val();
	var asigned = $("input[name='asignado']:checked").val();
	var project = $("input[name='project']:checked").val();
 	$.ajax({
	    	type: "GET",
	    	url: "./inc/api.php",
			data: 
			{
				method : 'guardar_tarea',
				nombre : nombre,
				fecha : fecha,
				fecha_entrega : fecha_entrega,
				asignado : asigned,
				project: project
			},
			success: function(response){
				alert(response);
			}
		});         
});