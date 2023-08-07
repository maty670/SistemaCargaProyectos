
	<div class="contenedor">
		<?php foreach($registros_convocatorias as $reg):
			$conv = preg_replace('/[#$%^&*()_+=\-\[\]\';,.\/{}|":<>?~\\\\ ]/', '', $reg->Convocatoria);
			$anio = preg_replace('/[#$%^&*()_+=\-\[\]\';,.\/{}|":<>?~\\\\ ]/', '', $reg->Año);
			$organismo = preg_replace('/[#$%^&*()_+=\-\[\]\';,.\/{}|":<>?~\\\\ ]/', '', $reg->Organismo);

		?>
			<div class="convocatoria">
				<div class="btn_filtro_convocatoria" id="<?php echo $conv . '_' . $anio . "_" . $organismo?>">
					<div></div>
					<div><?php echo $reg->Convocatoria . " " . $reg->Año?></div>
				</div>
				<div class="btn_agregar" id="<?php echo $conv . '_' . $anio . "_" . $organismo?>"></div>
			</div>
		<?php endforeach;?>

	</div>
	
	<hr>

<script type="text/javascript">

	//Adaptar el width de todos los contenedores de las convocatorias al del tamaño maximo
	const btn_filtro_convocatoria = document.getElementsByClassName("btn_filtro_convocatoria");
	var flexWidth_max = 0;
	for( let i = 0; i<btn_filtro_convocatoria.length; i++){
		let flex_width = btn_filtro_convocatoria[i].getBoundingClientRect().width;
			if( flexWidth_max < flex_width){
				flexWidth_max = flex_width;
			}
	}

	for( let i = 0; i<btn_filtro_convocatoria.length; i++){
		btn_filtro_convocatoria[i].style.width   = `${flexWidth_max}px`;


	}
	////////////////////////////////////////////////////////////////////////////////////











	//Al hacer click en un boton, mostrar las filas que pertenezcan a esa convocatoria
	const botones_convocatorias = document.getElementsByClassName("btn_filtro_convocatoria");
	const rows = document.getElementsByClassName("row");



	//Funcion que actualiza la tabla cada vez que se presiona un boton para filtrar convocatorias y se deja solo las filas que pertenecen
	//a la convocatoria que se hizo click
	function actualizar_tabla(id){

		for(let j = 0 ; j<rows.length; j++ ){
			if(rows[j].id==id){
				rows[j].style.display="";
			}else{
				rows[j].style.display="none";
			}
		}


	}

	//Funcion que actualiza el boton seleccionado(css), agregandolo a la clase visible o removiendole la clase
	function actualizar_bts_convocatorias(btnConvocatoria){
			for(let i=0; i<botones_convocatorias.length;i++){
				if(botones_convocatorias[i]==btnConvocatoria){
					botones_convocatorias[i].classList.add("seleccionado");
				}else{
					botones_convocatorias[i].classList.remove("seleccionado");
				}
				
		}
	}


	//Funcion que visualiza o esconde los botones de agregar filas
	function actualizar_btn_agregar(id){
		const btn_agregar = document.getElementsByClassName(`btn_agregar`);

		for(let k = 0; k < btn_agregar.length; k++){
			if(btn_agregar[k].id == id){
				btn_agregar[k].style.visibility ="visible"
			}else{
				btn_agregar[k].style.visibility ="hidden"}
			}
	}





	
	

	for(let i = 0; i < botones_convocatorias.length; i++){

		botones_convocatorias[i].addEventListener("click",()=>{
			
			actualizar_tabla(botones_convocatorias[i].id);
			actualizar_bts_convocatorias(botones_convocatorias[i]);
			actualizar_btn_agregar(botones_convocatorias[i].id)

		})
	}

	////////////////////////////////////////////////////////////////////////////////////////
	



</script>