<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Registros <?php echo $_GET['O'] . " " . $_GET['A']; ?></title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<link rel="stylesheet" type="text/css" href="switch.css">
	<link rel="stylesheet" type="text/css" href="switch2.css">
	<link rel="stylesheet" type="text/css" href="css/filtros_convocatorias.css">

	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap');
		@import url('https://fonts.googleapis.com/css2?family=Castoro+Titling&display=swap');
		@import url('https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
	</style>
</head>

<body>



	<?php require("sql/consultas_sql.php") ?>
	<?php require("php/filtros_convocatorias.php") ?>


	<form method="post" class="form" action="php/guardar.php?Org=<?php echo $_GET['O'] ?>&An=<?php echo $_GET['A'] ?>" id="form">


		<div class="opciones">
			<input type="submit" name="" id="btn_guardar" value="Guardar">
			<input type="button" name="" value="Volver">
		</div>


		<div class="contenedor_tabla">



			<table class="table">
				<tr class="header" tabindex="1">
					<td class="cell_switch">
						<div>
							<label class="switch_all">
								<input type="checkbox" checked id="Switch_all">
								<span>
									<em></em>
								</span>
							</label>
						</div>
					</td>
					<td class="cell_checkbox"></td>
					<td class="cell cell_codigo">Código</td>
					<td class="cell cell_nombre"><textarea readonly>Nombre</textarea></td>
					<td class="cell cell_email"><textarea readonly>Email</textarea></td>
					<td class="cell">Teléfono</td>
					<td class="cell">Contraseña</td>
					<td class="cell">Fecha registro</td>
					<td class="cell">Fecha invitacion</td>
					<td class="cell">Completado</td>
					<td class="cell">Fecha completado</td>
					<td class="cell cell_comentario"><textarea readonly>Comentario</textarea></td>
				</tr>

				<?php
				$j = 0;
				foreach ($registros as $r) :
					$conv = preg_replace('/[#$%^&*()_+=\-\[\]\';,.\/{}|":<>?~\\\\ ]/', '', $r->Convocatoria);
					$anio = preg_replace('/[#$%^&*()_+=\-\[\]\';,.\/{}|":<>?~\\\\ ]/', '', $r->Año);
				?>
					<tr class="row row<?php echo $j ?>" style="display: none" id="<?php echo $conv . '_' . $anio . "_" . $organismo ?>" tabindex="2">
						<td class="cell_switch">
							<div>
								<label class="switch">
									<input type="checkbox" checked id="<?php echo 'switch' . $j ?>">
									<span>
										<em></em>
									</span>
								</label>
							</div>
						</td>
						<td class="cell_checkbox">
							<input type="checkbox" id="<?php echo 'checkbox' . $j ?>" class="input_checkbox">
						</td>
						<td class="cell cell_codigo">
							<input required readonly type="text" class="input_text" name="<?php echo 'Codigo' . $j ?>" value="<?php echo $r->Codigo ?>">
						</td>
						<td class="cell cell_nombre">
							<input required readonly spellcheck="false" type="text" class="input_text" name="<?php echo 'Nombre' . $j ?>" value="<?php echo $r->Nombre ?>">
						</td>
						<td class="cell cell_email">
							<input required readonly spellcheck="false" type="text" class="input_text" name="<?php echo 'Email' . $j ?>" value="<?php echo $r->Email ?>">
						</td>
						<td class="cell cell_telefono">
							<input readonly spellcheck="false" type="text" class="input_text" name="<?php echo 'Telefono' . $j ?>" value="<?php echo $r->Telefono ?>">
						</td>
						<td class="cell cell_contra">
							<input required readonly spellcheck="false" type="text" class="input_text" name="<?php echo 'Contra' . $j ?>" value="<?php echo $r->Contraseña ?>">
						</td>
						<td class="cell">
							<input required spellcheck="false" type="date" class="input_text block" name="<?php echo 'Fecha_registro' . $j ?>" value="<?php echo $r->Fecha_registro ?>">
						</td>
						<td class="cell">
							<input required spellcheck="false" type="date" class="input_text block" name="<?php echo 'Fecha_invitacion_enviada' . $j ?>" value="<?php echo $r->Fecha_invitacion_enviada ?>">
						</td>
						<td class="cell">
							<select name="<?php echo 'Completado' . $j ?>" class="block">
								<option class="option_SI" <?php if ($r->Completado == "SI") {
																echo "selected";
															} ?>>SI</option>
								<option class="option_NO" <?php if ($r->Completado == "NO") {
																echo "selected";
															} ?>>NO</option>
							</select>
						</td>
						<td class="cell">
							<input type="date" class="input_text block" name="<?php echo 'Fecha_formulario_completado' . $j ?>" value="<?php echo $r->Fecha_formulario_completado ?>">
						</td>
						<td class="cell cel_comentario">
							<input type="text" readonly spellcheck class="input_text" name="<?php echo 'Comentario' . $j ?>" value="<?php echo $r->Comentario ?>">
						</td>

						<td class="cell hidden">
							<input type="text" class="input_text" name="<?php echo 'Convocatoria' . $j ?>" value="<?php echo $r->Convocatoria ?>">
						</td>

						<td class="cell hidden">
							<input type="text" class="input_text" name="<?php echo 'Anio' . $j ?>" value="<?php echo $r->Año ?>">
						</td>

						<td class="cell hidden">
							<input type="text" class="input_text" name="<?php echo 'Organismo' . $j ?>" value="<?php echo $r->Organismo ?>">
						</td>

					</tr>


				<?php
					$j++;
				endforeach;
				?>


			</table>
	</form>
	</div>







	<script type="text/javascript" src="js/copy_animation.js"></script>
	<script type="text/javascript" src="js/select_background.js"></script>
	<script type="text/javascript" src="js/insertar_nuevo_registro.js"></script>
	<script type="text/javascript" src="js/borrar_celda.js"></script>
	<script type="text/javascript" src="js/checkbox_background.js"></script>
	<script type="text/javascript" src="js/switch_bloquear_desbloquear.js"></script>


	<script type="text/javascript">
		copy_animation();
		select_background();
		borrar_celda();
		checkbox_background();
	</script>
	<script type="text/javascript">
		// Al presionar enter sobre cualquier celda, evitar que se haga un POST sobre el formulario
		// para que solo se guarde si se presiona sobre GUARDAR
		function checkEnter(e) {
			e = e || event;
			var txtArea = /textarea/i.test((e.target || e.srcElement).tagName);
			return txtArea || (e.keyCode || e.which || e.charCode || 0) !== 13;
		}

		document.getElementById('form').onkeypress = checkEnter;
	</script>

</body>

</html>