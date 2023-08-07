	<?php

		$organismo = $_GET['O'];
		$anio = $_GET['A'];

		$raiz = $_SERVER['DOCUMENT_ROOT'] . '/SistemaCargaProyectos/';
		include($raiz . 'conexion.php');

		// Registros necesarios para la construccion de la tabla general
		$conexion = $conn->query("SELECT * 
								  FROM `registros` 
								  WHERE `organismo` = '$organismo' AND `Año` = '$anio'");
		$registros = $conexion->fetchAll(PDO::FETCH_OBJ);


		//Registros con los titulos de las convocatorias para generar los botones
		$conexion = $conn->query("SELECT `Convocatoria`,`Año`,`Organismo` 
								  FROM `registros`
								  WHERE `organismo` = '$organismo' AND `Año` = '$anio'
								  GROUP BY `Convocatoria`,`Año`");
		$registros_convocatorias = $conexion->fetchAll(PDO::FETCH_OBJ);









	?>