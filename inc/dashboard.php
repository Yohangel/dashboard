<?php
class dashboard extends connection 
{
	public function comprobarMaquina($id_user){
		$id_user = $id_user;
		try
			{
				$maquina_actual = gethostbyaddr($_SERVER['REMOTE_ADDR']);	
				$db = $this->start(); 
				$stmt = $db->query("SELECT * FROM users WHERE id='".$id_user."'");
				$row = $stmt->fetch();
				$nombre_maquina = $row['nombre_maquina'];
				if($maquina_actual==$nombre_maquina)
				{
					$response = 1; // presencial
				}
				else
				{
					$response = 2; // remoto
				}
			}
			catch(PDOException $e) 
			{
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}	
		return $response;	
	}

	public function addChronometer($id_user)
	{
	$id_user = $id_user;
	$status = 0;
	$type = $this->comprobarMaquina($id_user);
			try
			{
				$db = $this->start(); 
				$stmt = $db->prepare("INSERT INTO chronometers (
					start_date,
					id_user,
					status,
					type) VALUES (
					:start_date,
					:id_user,
					:status,
					:type
					)"); 
				$stmt->bindParam(':start_date', date('Y-m-d H:i:s'), PDO::PARAM_STR); 
				$stmt->bindParam(':id_user', $id_user, PDO::PARAM_STR); 
				$stmt->bindParam(':status', $status, PDO::PARAM_STR); 
				$stmt->bindParam(':type', $type, PDO::PARAM_STR); 
				if ($stmt->execute()){
					echo "started";
				}
			}
			catch(PDOException $e) 
			{
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
	}
		
	public function totalTime($id_user) 
	{
		$id_user = $id_user;
			try
			{
				$db = $this->start(); 
				$stmt = $db->query("SELECT * FROM chronometers WHERE id_user='".$id_user."' and (status = 0 or status = 2)");
				$row = $stmt->fetch();
				$id = $row['id'];
				if($row['status']==0)
				{
					$start_date = strtotime($row['start_date']);
					$this_date = strtotime(date('Y-m-d H:i:s'));
					$total_hours = $this_date - $start_date;
				}
				else
				{
					$total_hours = 0;
				}
				if($row['total_hours'] > 0){
					$total_hours = $total_hours + $row['total_hours'];
				}
			}
			catch(PDOException $e) 
			{
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		return $total_hours;
	}

	public function hasActChronometer($id_user) 
	{
		$id_user = $id_user;
			try
			{
				$db = $this->start(); 
				$stmt = $db->query("SELECT * FROM chronometers WHERE id_user='".$id_user."' and status = 0");
				if($stmt->rowCount() > 0){
					$response = true;
				} else {
					$response = false;
				}
			}
			catch(PDOException $e) 
			{
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		return $response;
	}

	public function hasPausedChronometer($id_user) 
	{
		$id_user = $id_user;
			try
			{
				$db = $this->start(); 
				$stmt = $db->query("SELECT * FROM chronometers WHERE id_user='".$id_user."' and status = 2");
				if($stmt->rowCount() > 0){
					$response = true;
				} else {
					$response = false;
				}
			}
			catch(PDOException $e) 
			{
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		return $response;
	}

	public function pauseChronometer($id_user)
	{
		$id_user = $id_user;
		$total_hours = $this->totalTime($id_user);
			try
			{
				$db = $this->start(); 
				$stmt = $db->prepare("UPDATE chronometers SET total_hours='".$total_hours."', status=2 WHERE id_user='".$id_user."' and status=0");  
				if ($stmt->execute()){
					echo "paused";
				}
			}
			catch(PDOException $e) 
			{
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
	}

	public function startnowChronometer($id_user)
	{
		$id_user = $id_user;
			try
			{
				$db = $this->start(); 
				$stmt = $db->prepare("UPDATE chronometers SET  start_date='".date('Y-m-d H:i:s')."', status=0 WHERE id_user='".$id_user."' and status=2");  
				if ($stmt->execute()){
					echo "startednow";
				}
			}
			catch(PDOException $e) 
			{
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
	}

	public function stopChronometer($id_user)
	{
		$id_user = $id_user;
		$total_hours = $this->totalTime($id_user);
			try
			{
				$db = $this->start(); 
				$stmt = $db->prepare("UPDATE chronometers SET status = 3, end_date = '".date('Y-m-d H:i:s')."' WHERE id_user='".$id_user."' and (status=2 OR status=0)");  
				if ($stmt->execute()){
					echo "deleted";
				}
			}
			catch(PDOException $e) 
			{
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
	}

	public function saveReport($id_user,$text)
	{
		$id_user = $id_user;
		$text = $text;
		$total_hours = $this->totalTime($id_user);
		if(strlen($text)>49 || strlen($text)<401)
		{
			try
			{
				$db = $this->start(); 
				$stmt = $db->prepare("UPDATE chronometers SET report='".$text."', status=1, end_date='".date('Y-m-d H:i:s')."', total_hours='".$total_hours."'WHERE id_user='".$id_user."' and (status=0 or status=2)");  
				if ($stmt->execute()){
					echo "reportsaved";
				} else {
					echo "reporterror";
				}
			}
			catch(PDOException $e) 
			{
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
		} 
		else
		{
			echo "reporterror";
		}
	}

	public function addProject($name,$description,$start_date,$end_date,$participant)
	{
	$id_user = $id_user;
	$status = 0;
	$type = $this->comprobarMaquina($id_user);
			try
			{
				$db = $this->start(); 
				$stmt = $db->prepare("INSERT INTO chronometers (
					start_date,
					id_user,
					status,
					type) VALUES (
					:start_date,
					:id_user,
					:status,
					:type
					)"); 
				$stmt->bindParam(':start_date', date('Y-m-d H:i:s'), PDO::PARAM_STR); 
				$stmt->bindParam(':id_user', $id_user, PDO::PARAM_STR); 
				$stmt->bindParam(':status', $status, PDO::PARAM_STR); 
				$stmt->bindParam(':type', $type, PDO::PARAM_STR); 
				if ($stmt->execute()){
					echo "started";
				}
			}
			catch(PDOException $e) 
			{
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
	}

	public function asignar_proyecto($id_proyecto,$id_usuario)
	{
		$id_proyecto = $id_proyecto;
		$id_usuario = $id_usuario;
		try
			{
				$db = $this->start(); 
				$stmt = $db->prepare("INSERT INTO user_projects (
					user_id,
					project_id) VALUES (
					:user_id,
					:project_id
					)"); 
				$stmt->bindParam(':user_id', $id_usuario, PDO::PARAM_STR); 
				$stmt->bindParam(':project_id', $id_proyecto, PDO::PARAM_STR); 
				if ($stmt->execute()){
					echo "projectsaved";
				}
			}
			catch(PDOException $e) 
			{
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
	}

	public function guardar_proyecto($nombre,$descripcion,$fecha,$fecha_entrega,$asignado,$deparment_id)
	{
		$nombre = $nombre;
		$descripcion = $descripcion;
		$fecha = $fecha;
		$fecha_entrega = $fecha_entrega;
		$status = 0;
		$asignado = $asignado;
		$deparment_id = $deparment_id;
		try
			{
				$db = $this->start(); 
				$stmt = $db->prepare("INSERT INTO projects (
					name,
					description,
					start_date,
					end_date,
					status,
					departament_id
					) VALUES (
					:nombre,
					:descripcion,
					:fecha,
					:fecha_entrega,
					:status,
					:deparment_id
					)"); 
				$stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR); 
				$stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR); 
				$stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR); 
				$stmt->bindParam(':fecha_entrega', $fecha_entrega, PDO::PARAM_STR); 
				$stmt->bindParam(':status', $status, PDO::PARAM_STR); 
				$stmt->bindParam(':deparment_id', $deparment_id, PDO::PARAM_STR); 
				if ($stmt->execute()){
					$id_proyecto = $db->lastInsertId();
					foreach ($asignado as $row){
						$id_usuario = $row;
						$this->asignar_proyecto($id_proyecto,$id_usuario);
					}
				}
			}
			catch(PDOException $e) 
			{
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
	}

	public function guardar_tarea($nombre,$fecha,$fecha_entrega,$asignado,$project)
	{
		$nombre = $nombre;
		$fecha = $fecha;
		$fecha_entrega = $fecha_entrega;
		$status = 0;
		$asignado = $asignado;
		$project = $project;
		try
			{
				$db = $this->start(); 
				$stmt = $db->prepare("INSERT INTO tasks (
					name,
					start_date,
					end_date,
					status,
					user_id,
					project_id
					) VALUES (
					:nombre,
					:fecha,
					:fecha_entrega,
					:status,
					:asignado,
					:project
					)"); 
				$stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR); 
				$stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR); 
				$stmt->bindParam(':fecha_entrega', $fecha_entrega, PDO::PARAM_STR); 
				$stmt->bindParam(':status', $status, PDO::PARAM_STR); 
				$stmt->bindParam(':asignado', $asignado, PDO::PARAM_STR); 
				$stmt->bindParam(':project', $project, PDO::PARAM_STR); 
				if ($stmt->execute()){
					echo "tasksaved";
				}
			}
			catch(PDOException $e) 
			{
				echo '{"error":{"text":'. $e->getMessage() .'}}';
			}
	}
}		
?>