


<?php
header('Content-Type: text/html; charset=UTF-8');

/*foreach ($_POST as $key => $value) {
    $id = htmlspecialchars($key);
    $valor = htmlspecialchars($value);

    if(substr($id,0,3)=="mer"){
    	array_push($array_mercaderias,$valor) ;
    }elseif(substr($id,0,3)=="pre"){
    	$find = array("$",".");
	    array_push($array_precios,intval(str_replace($find,"",$valor)));
    }

}*/

	// El max_input_vars por defecto esta limitado a una cantidad
	// Cambiarlo en el php.ini
	// Si aparece 2500 , equivale a 250 variables como maximo
	
	$Org = $_GET['Org'];
	$An = $_GET['An'];
	$consulta="";

	
	$array_codigos=[];
	$array_nombres=[];
	$array_emails=[];
	$array_telefonos=[];
	$array_contra=[];
	$array_fecha_registro=[];
	$array_fechaInv_enviada=[];
	$array_completado=[];
	$array_fecha_completado=[];
	$array_comentario=[];

	$array_convocatorias=[];
	$array_anios=[];
	$array_organismos=[];
 
	foreach ($_POST as $key => $value) {
		$id = htmlspecialchars($key);
		$valor = htmlspecialchars($value);

		if(substr($id,0,6)=="Codigo"){
			array_push($array_codigos,$valor);
		}

		if(substr($id,0,6)=="Nombre"){
			array_push($array_nombres,$value);
		}

		if(substr($id,0,5)=="Email"){
			array_push($array_emails,$value);
		}

		if(substr($id,0,8)=="Telefono"){
			array_push($array_telefonos,$value);
		}

		if(substr($id,0,6)=="Contra"){
			array_push($array_contra,$value);
		}

		if(substr($id,0,14)=="Fecha_registro"){
			array_push($array_fecha_registro,$value);
		}

		if(substr($id,0,24)=="Fecha_invitacion_enviada"){
			array_push($array_fechaInv_enviada,$value);
		}

		if(substr($id,0,10)=="Completado"){
			array_push($array_completado,$value);
		}

		if(substr($id,0,27)=="Fecha_formulario_completado"){
			array_push($array_fecha_completado,$value);
		}

		if(substr($id,0,10)=="Comentario"){
			array_push($array_comentario,$value);
		}




		if(substr($id,0,12)=="Convocatoria"){
			array_push($array_convocatorias,$value);
		}

		if(substr($id,0,4)=="Anio"){
			array_push($array_anios,$value);
		}

		if(substr($id,0,9)=="Organismo"){
			array_push($array_organismos,$value);
		}

	
	}


	for ($i=0; $i<count($array_codigos); $i++){


			if ($array_codigos[$i]==""){ $codigo = "NULL";} else { $codigo = '"' . $array_codigos[$i] . '"';}

			if ($array_nombres[$i]==""){ $nombre = "NULL";} else { $nombre = '"' . $array_nombres[$i] . '"';}

			if ($array_emails[$i]==""){ $email = "NULL";} else { $email = '"' . $array_emails[$i] . '"';}

			if ($array_telefonos[$i]==""){ $telefono = "NULL";} else { $telefono = '"' . $array_telefonos[$i] . '"';}

			if ($array_contra[$i]==""){ $contras = "NULL";} else { $contras = '"' . $array_contra[$i] . '"';}

			if ($array_fecha_registro[$i]==""){ $fecha_registro = "NULL"; } else { $fecha_registro = '"' . $array_fecha_registro[$i] . '"'; }

			if ($array_fechaInv_enviada[$i]==""){ $fechaInv_enviada = "NULL";} else { $fechaInv_enviada = '"' . $array_fechaInv_enviada[$i] . '"';}

			if ($array_completado[$i]==""){ $completado = "NULL";} else { $completado = '"' . $array_completado[$i] . '"';}

			if ($array_fecha_completado[$i]==""){ $fecha_completado = "NULL";} else { $fecha_completado =  '"' . $array_fecha_completado[$i] . '"';}
		
			if ($array_comentario[$i]==""){ $comentario = "NULL";} else { $comentario = '"' . $array_comentario[$i] . '"';}

			$convocatoria = '"' . $array_convocatorias[$i] . '"';
			$anio = $array_anios[$i];
			$organismo = '"' . $array_organismos[$i] . '"';



			$consulta = "{$consulta} 
						({$codigo},{$nombre},{$email},{$telefono},{$contras},
						 {$fecha_registro},{$fechaInv_enviada},{$completado},{$fecha_completado},{$comentario},
						 {$convocatoria},{$anio},{$organismo})";


		if ($i+1 < count($array_codigos)){
			$consulta = $consulta . ",";
		}else{
			$consulta = $consulta . ";";
		}	

	}


	try{

		$raiz = $_SERVER['DOCUMENT_ROOT'] . '/SistemaCargaProyectos/';
		include($raiz . 'conexion.php');

		$borrarDatosPruebas = $conn->query("DELETE FROM `registros_pruebas` WHERE 1");

		if($conn->query("INSERT INTO `registros_pruebas` VALUES $consulta")){

			// No hay errores de sintaxis en la consulta SQL

			$borrarDatos = $conn->query("DELETE FROM `registros` WHERE `Organismo` LIKE '$Org' AND `Año` LIKE $An");

			$insertarDatos = $conn->query("INSERT INTO `registros` VALUES $consulta");

			setcookie("actualizacion", "true");
			header("Location: ../index.php?O=$Org&A=$An");

			//"Los datos se actualizaron";

		}else{
			setcookie("actualizacion", "false");
		}	
	}catch(Exception $e){
			echo '<th><font color="red"><center>Ocurrio un error. No se actualizaron los datos</center></font></th>';
			echo '<th><font color="black"><left>' . $e->getMessage() . '</left></font></th>';
			setcookie("actualizacion", "false");
	}



?>