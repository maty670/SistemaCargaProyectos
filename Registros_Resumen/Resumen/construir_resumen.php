	<?php

		$input_año = $_POST["input_anio"];
		$sql_tablaRegistros="registros";
		$sql_tablaOrganismos="organismos";


			$consulta_organismos_registros = "SELECT E.`Organismo`,E.`Año`,E.`Fecha_inicio`,R.`Fecha_fin` ,R.`total_por_convocatoria` 
								  			 FROM $sql_tablaOrganismos AS E,(SELECT Count(*) AS total_por_convocatoria,`Año`,MAX(`Fecha_registro`) AS Fecha_fin
								  			 								FROM $sql_tablaRegistros
								  			 								WHERE `Año` = '$input_año') AS R
								  			 WHERE R.`Año` = E.`Año`";
			$consulta_proyectos_registros = "SELECT *
			                                 FROM $sql_tablaRegistros
			                                 WHERE `Organismo` = '$organismo'
			                                 AND `Año` = '$input_año'
			                                 ORDER BY `Fecha_registro`";
			$consulta_convocatorias_registros = "SELECT `Convocatoria`,`Año`,Count(*) AS total_por_convocatoria,Min(`Fecha_registro`) AS Inicio_Convocatoria,Max(`Fecha_registro`) AS Fin_Convocatoria
	                              				 FROM $sql_tablaRegistros
	                              				 WHERE `Organismo` = '$organismo'
	                              				 AND `Año` = '$input_año'
	                              				 GROUP BY `Convocatoria`
	                              				 ORDER BY `Fecha_registro`";

			$consulta_organismos_presentados = "SELECT E.`Organismo`,E.`Año`,E.`Fecha_inicio`,R.`Fecha_fin`,R.`total_por_convocatoria` 
								  			 FROM $sql_tablaOrganismos AS E,(SELECT Count(*) AS total_por_convocatoria,Año,MAX(`Fecha_formulario_completado`) AS Fecha_fin
								  			 								FROM $sql_tablaRegistros 
								  			 								WHERE `Año` = '$input_año' AND `Completado`='SI') AS R
								  			 WHERE R.`Año` = E.`Año`";
			$consulta_proyectos_presentados = "SELECT *
			                                 FROM $sql_tablaRegistros
			                                 WHERE `Organismo` = '$organismo'
			                                 AND `Año` = '$input_año'
			                                 AND `Completado`='SI'
			                                 ORDER BY `Fecha_registro`";
			$consulta_convocatorias_presentados = "SELECT H.`Convocatoria`,
														  H.`Año`,IF(R.`Cantidad` IS NULL , 0, R.`Cantidad`) AS total_por_convocatoria,
														  IF(R.`Inicio_Convocatoria` IS NULL , '-' , R.`Inicio_Convocatoria`) AS Inicio_Convocatoria,
														  IF(R.`Fin_Convocatoria` IS NULL , '-' , R.`Fin_Convocatoria`) AS Fin_Convocatoria 
														FROM

													    (SELECT `Convocatoria`,`Año`,COUNT(*) AS Cantidad,
													    MIN(`Fecha_formulario_completado`) AS Inicio_Convocatoria,
													    MAX(`Fecha_formulario_completado`) AS Fin_Convocatoria
													    FROM $sql_tablaRegistros
													    WHERE  `Completado`= 'SI' AND `Año` = '$input_año'
													    GROUP BY `Convocatoria`,`Año`
													    ORDER BY `Fecha_registro`) AS R
												    	
												    	RIGHT JOIN 

													    (SELECT `Convocatoria`,`Año`,COUNT(*) AS Cantidad
													    FROM $sql_tablaRegistros
													    WHERE  `Año` = '$input_año'
													    GROUP BY `Convocatoria`,`Año`
													    ORDER BY `Fecha_formulario_completado`) AS H
													    ON R.`Convocatoria` = H.`Convocatoria`";

		


		
		for($j=0;$j<2;$j++){
			if($j==0){
				$consulta_organismos = $consulta_organismos_registros;
				$consulta_proyectos = $consulta_proyectos_registros;
				$consulta_convocatoria = $consulta_convocatorias_registros;
			}elseif($j==1){
				$consulta_organismos = $consulta_organismos_presentados;
				$consulta_proyectos = $consulta_proyectos_presentados;
				$consulta_convocatoria = $consulta_convocatorias_presentados;
			}

			$raiz = $_SERVER['DOCUMENT_ROOT'] . '/SistemaCargaProyectos/';
			include($raiz . 'conexion.php');
			
			$conexion = $conn->query($consulta_organismos);
		  	$filas_entidad = $conexion->fetchAll(PDO::FETCH_OBJ); //filas_entidad = Organismo ,Año y Cantidad total de registros -> fecha de inicio para el resumen semanal

		  	$conexion = $conn->query($consulta_proyectos);
		  	$filas_registros = $conexion->fetchAll(PDO::FETCH_OBJ);

		  	$conexion = $conn->query($consulta_convocatoria);
		 	$filas_convocatorias = $conexion->fetchAll(PDO::FETCH_OBJ);


		 	$desde = date($filas_entidad[0]->Fecha_inicio);
	  		
	  		if($input_año==date("Y")){
	  			$hasta = date("Y-m-d");
	  		}else{
	  			$hasta = date($filas_entidad[0]->Fecha_fin);
	  		}


	  		include_once("resumen_semanal.php");
	  		$año_resumen = date("Y",strtotime($desde));
	  		if($j==0){
				$array_semanas = construir_resumen_registrados($desde,$hasta,$filas_registros,$filas_convocatorias);
				$resumen_tipo="Registrados " . $año_resumen;
			}elseif($j==1){
				$array_semanas = construir_resumen_presentados($desde,$hasta,$filas_registros,$filas_convocatorias);
				$resumen_tipo="Presentados " . $año_resumen;
			}

			require("armar_cuadro.php");




			

		}


	 	
  		



	?>

