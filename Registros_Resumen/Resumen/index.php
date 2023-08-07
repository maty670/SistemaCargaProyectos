<!DOCTYPE html>
<html>
<head>
	<title>Registro y Carga de proyectos</title>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');
		@import url('https://fonts.googleapis.com/css2?family=Castoro+Titling&display=swap');
		@import url('https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
	</style>

	<link rel="stylesheet" type="text/css" href="/SistemaCargaProyectos/Registros_Resumen/Resumen/resumen.css">

</head>
<body>

	<?php
		$organismo = "Asactei";
		$raiz = $_SERVER['DOCUMENT_ROOT'] . '/SistemaCargaProyectos/';
		include($raiz . 'conexion.php');
			$conexion = $conn->query("SELECT `Año` FROM `registros` WHERE `organismo` = '$organismo' GROUP BY `Año` ");
		  	$años = $conexion->fetchAll(PDO::FETCH_OBJ); 
	?>

	<div class="div_contenedor_formulario">
		<div id="<?php echo 'organismo'?>" style="display: none"><?php echo $organismo?></div>
		<div class="form">
			<form method="post" action="" id="form_anio_busq">
			
				<select name="input_anio" id="input_anio">
				  <?php foreach($años as $a):?>
				  		<option class="options" value=<?php echo $a->Año?>><?php echo $a->Año?></option value=<?php ?>>
				  <?php endforeach;?>
				</select>

				
				
			</form>

			<img src="/SistemaCargaProyectos/svg/refresh.svg" class="img_refresh">
		</div>


		<a class="btn_listado_registros" id="btn_listado_registros" href="" target="_BLANK"></a>


	</div>

	

	<div class="div_contenedor_tablas">
		<?php 
			if(isset($_POST["input_anio"])){
				require("construir_resumen.php");
			}
		?>
	</div>

	<script type="text/javascript" src="/SistemaCargaProyectos/Registros_Resumen/Resumen/asd.js"></script>
	<script type="text/javascript">

		if(localStorage.getItem("input_anio")==null){
			localStorage.setItem("input_anio", new Date().getFullYear());
		}

		let anio = localStorage.getItem("input_anio");
		const anio_select = document.getElementById("input_anio");
		let anio_seleccionado = anio_select.options[anio_select.selectedIndex].value;
		let organismo = document.getElementById("organismo").innerHTML;
		const btn_listado_registros = document.getElementById("btn_listado_registros")
		

		anio_select.value = anio;
		btn_listado_registros.href = `/SistemaCargaProyectos/Registros_Resumen/Listado_Registros/index.php?O=${organismo}&A=${anio}`;
		btn_listado_registros.innerHTML = `Listado de registros ${anio}`;

		

    	anio_select.addEventListener("change",()=>{
  
    		var anio_seleccionado = anio_select.options[anio_select.selectedIndex].value;
    		localStorage.setItem("input_anio", anio_seleccionado);

    		btn_listado_registros.innerHTML = `Listado de registros ${anio_seleccionado}`;

    		
    		btn_listado_registros.style.transition = "all 0.25s ease";
    		btn_listado_registros.style.boxShadow = "0px 0px 0px 200px rgba(14, 51, 88,0.4) inset";
    		setTimeout(() => {	
				document.getElementById("btn_listado_registros").style.boxShadow = "none";
			},"250");

    		organismo = document.getElementById("organismo").innerHTML;
			btn_listado_registros.href = `/SistemaCargaProyectos/Registros_Resumen/Listado_Registros/index.php?E=${organismo}&A=${anio_seleccionado}`;

    	})
	</script>
	<script type="text/javascript">
		const img_refresh = document.querySelector(".img_refresh");
		img_refresh.addEventListener("click",()=>{
			document.getElementById("form_anio_busq").submit();
		})
	</script>
</body>
</html>