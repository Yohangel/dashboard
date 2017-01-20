function api(method,id,text='') 
{
	$.ajax(
		{
	    type: "GET",
	    url: "./inc/api.php",
		data: 
		{
			method : method,
			id : id,
			text : text
		},
		    success: function(response){
		    	if (response == 'started')
		    	{
		    		//alert('agregado');
		    		location.reload();
		    	}

		    	else if (response == 'paused')
		    	{
		    		//alert('pausado');
		    		location.reload();
		    	}

		    	else if (response == 'startednow')
		    	{
		    		//alert('startednow');
		    		location.reload();
		    	}

		    	else if (response == 'reportsaved')
		    	{
		    		alert('El reporte se guardo con exito');
		    		location.reload();
		    	}

		    	else if (response == 'reporterror')
		    	{
		    		alert('Lo sentimos, en este momento no se pudo guardar el reporte');
		    		location.reload();
		    	}

		    	else if (response == 'deleted')
		    	{
		    		//alert('pausado');
		    		location.reload();
		    	}
		    
		    }
	    }
	);
}