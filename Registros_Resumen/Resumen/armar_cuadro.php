<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
	
<body>
	<?php
		/*
		$array_semanas[] = [
							[fecha_inicio,n1,n2,...,N,fecha_fin]
							[fecha_inicio,n1,n2,...,N,fecha_fin]
							[fecha_inicio,n1,n2,...,N,fecha_fin]
							[fecha_inicio,n1,n2,...,N,fecha_fin]
						   ]
		

		$filas_convocatorias[] = (
								  [Convocatoria->conv1,Año->año,total_por_conv->total]
								  [Convocatoria->conv2,Año->año,total_por_conv->total]
								  [Convocatoria->conv3,Año->año,total_por_conv->total]
								 )

		 $filas_entidad[] = (
		 						[Entidad,Año,Fecha_inicio,total_por_convocatoria)]
		 						[Entidad,Año,Fecha_inicio,total_por_convocatoria)] 
		 						[Entidad,Año,Fecha_inicio,total_por_convocatoria)] 
		 					)  
		*/
	?>

	<div class="div_tabla_resumen">
		<table>

			<tr>
				<th class="titulo_cuadro" colspan="100%">Proyectos <?php echo $resumen_tipo?></th>
			</tr>

			<tr class="fila_titulos">
				<th class="titulo_convocatoria">Inicio</th>
				<th class="titulo_convocatoria">Fin</th>
				<?php 
					foreach ($filas_convocatorias as $c):?>
						<th class="titulo_convocatoria"><?php echo $c->Convocatoria?></th>
				<?php
					endforeach;
				?>

				<th class="titulo_convocatoria">Semanal</th>
				
			</tr>

			<?php 
				foreach ($array_semanas as $f):?>

			    <tr tabindex="1">
			     	<?php for($i=0; $i<count($f); $i++){ ?>
			     		<td <?php 
			     				if($i<=1){
			     					echo "class='fecha_text'";
			     				}elseif($i>1 && $i<count($f)-1){
			     					echo "class='number'";
			     				}elseif($i>1 && $i<count($f)) {
			     					echo "class='number total_semana'";
			     				}
			     			?>>
			     			<?php echo $f[$i]?>
			     		</td>
			     	<?php } ?>

			    </tr>

		     <?php
				endforeach;
		     ?>


		     <tr>
				<th></th>
				<th></th>
				<?php 
					foreach ($filas_convocatorias as $c):?>
						<th class="total_convocatoria number"><?php echo $c->total_por_convocatoria?></th>
				<?php
					endforeach;	
				?>
					<th class="total_todas_convocatorias number"><?php echo $filas_entidad[0]->total_por_convocatoria?></th>
				
			</tr>
			
		</table>
	</div>

</body>

<script type="text/javascript">
	elements = document.getElementsByClassName("number")
	Object.keys(elements).forEach(key => {

			
			if(elements[key].textContent.includes("-")){
				elements[key].textContent="";
				elements[key].style.background="rgb(218,150,148)";
			}


	});

	
</script>
</html>