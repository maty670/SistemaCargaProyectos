
	//Buscar el ultimo codigo de esa convocatoria y retornar el codigo siguiente
	function get_siguiente_codigo(convocatoria_anio_organismo){
		convocatoria_anio_organismo = convocatoria_anio_organismo.split("_");
		let C = convocatoria_anio_organismo[0];
		let A = convocatoria_anio_organismo[1];
		let O = convocatoria_anio_organismo[2];
		let rows = document.querySelectorAll(`[id*=${C}_${A}_${O}]`);
		let last_row = [].slice.call(rows).pop().children;
		
		for(let i=0; i<last_row.length;i++){
			if(last_row[i].classList.contains("cell_codigo")){

				codigo = last_row[i].firstElementChild.value;

				codigo = codigo.split("-");


				if((parseInt(codigo[2])+1)<=99){
					numero = "0" + (parseInt(codigo[2])+1);
				}else{
					numero = "" + (parseInt(codigo[2])+1);
				}

				return ( codigo[0] + "-" + codigo[1] + "-" + numero );
			}
		}
	}

	function get_cantidad(){
		return (document.getElementsByClassName("row").length + 1);
	}




	function crear_elementos(convocatoria_anio_organismo){

		let ultimo_codigo = get_siguiente_codigo(convocatoria_anio_organismo);
		let row_count = get_cantidad(); //Cantidad de filas
		convocatoria_anio_organismo = convocatoria_anio_organismo.split("_");
		let convocatoria = convocatoria_anio_organismo[0];
		let anio = convocatoria_anio_organismo[1];
		let organismo = convocatoria_anio_organismo[2];



		let trRow = document.createElement("tr");
		trRow.setAttribute("class","row");
		trRow.setAttribute("id",`${convocatoria}_${anio}_${organismo}`);

		tdSwitch = document.createElement("td");
		tdSwitch.setAttribute("class","cell_switch");
		labelSwitch = document.createElement("label");
		labelSwitch.setAttribute("class","switch");
		inputSwitch = document.createElement("input");
		inputSwitch.setAttribute("type","checkbox");
		spanSwitch = document.createElement("span");
		emSwitch = document.createElement("em")
		spanSwitch.appendChild(emSwitch);
		labelSwitch.appendChild(inputSwitch);
		labelSwitch.appendChild(spanSwitch);
		tdSwitch.appendChild(labelSwitch);
		trRow.appendChild(tdSwitch);

		tdCheckbox = document.createElement("td");
		tdCheckbox.setAttribute("class","cell_checkbox");
		inputCheckbox = document.createElement("input");
		inputCheckbox.setAttribute("type","checkbox");
		inputCheckbox.setAttribute("class","input_checkbox");
		inputCheckbox.setAttribute("name",`checkbox${row_count}`);
		tdCheckbox.appendChild(inputCheckbox);
		trRow.appendChild(tdCheckbox);


		tdCod = document.createElement("td");
		tdCod.setAttribute("class","cell cell_codigo");
		inputCod = document.createElement("input");
		inputCod.setAttribute("required","true");
		inputCod.setAttribute("type","text");
		inputCod.setAttribute("class","input_text");
		inputCod.setAttribute("name",`Codigo${row_count}`);
		inputCod.setAttribute("value",ultimo_codigo);
		tdCod.appendChild(inputCod);
		trRow.appendChild(tdCod);

		tdNom = document.createElement("td");
		tdNom.setAttribute("class","cell cell_nombre");
		inputNom = document.createElement("input");
		inputNom.setAttribute("required","true");
		inputNom.setAttribute("spellcheck","false");
		inputNom.setAttribute("type","text");
		inputNom.setAttribute("class","input_text");
		inputNom.setAttribute("name",`Nombre${row_count}`);
		tdNom.appendChild(inputNom);
		trRow.appendChild(tdNom);

		tdEmail = document.createElement("td");
		tdEmail.setAttribute("class","cell");
		inputEmail = document.createElement("input");
		inputEmail.setAttribute("required","true");
		inputEmail.setAttribute("spellcheck","false");
		inputEmail.setAttribute("type","text");
		inputEmail.setAttribute("class","input_text");
		inputEmail.setAttribute("name",`Email${row_count}`);
		tdEmail.appendChild(inputEmail);
		trRow.appendChild(tdEmail);

		tdTel = document.createElement("td");
		tdTel.setAttribute("class","cell");
		inputTel = document.createElement("input");
		inputTel.setAttribute("spellcheck","false");
		inputTel.setAttribute("type","text");
		inputTel.setAttribute("class","input_text");
		inputTel.setAttribute("name",`Telefono${row_count}`);
		tdTel.appendChild(inputTel);
		trRow.appendChild(tdTel);

		tdContra = document.createElement("td");
		tdContra.setAttribute("class","cell");
		inputContra = document.createElement("input");
		inputContra.setAttribute("required","true");
		inputContra.setAttribute("spellcheck","false");
		inputContra.setAttribute("type","text");
		inputContra.setAttribute("class","input_text");
		inputContra.setAttribute("name",`Contraseña${row_count}`);
		tdContra.appendChild(inputContra);
		trRow.appendChild(tdContra);

		tdF_registro = document.createElement("td");
		tdF_registro.setAttribute("class","cell");
		inputF_registro = document.createElement("input");
		inputF_registro.setAttribute("required","true");
		inputF_registro.setAttribute("spellcheck","false");
		inputF_registro.setAttribute("type","date");
		inputF_registro.setAttribute("class","input_text");
		inputF_registro.setAttribute("name",`Fecha_registro${row_count}`);
		tdF_registro.appendChild(inputF_registro);
		trRow.appendChild(tdF_registro);

		tdF_invEnv = document.createElement("td");
		tdF_invEnv.setAttribute("class","cell");
		inputF_invEnv = document.createElement("input");
		inputF_invEnv.setAttribute("required","true");
		inputF_invEnv.setAttribute("spellcheck","false");
		inputF_invEnv.setAttribute("type","date");
		inputF_invEnv.setAttribute("class","input_text");
		inputF_invEnv.setAttribute("name",`Fecha_invitacion_enviada${row_count}`);
		tdF_invEnv.appendChild(inputF_invEnv);
		trRow.appendChild(tdF_invEnv);

		tdCompletado = document.createElement("td");
		tdCompletado.setAttribute("class","cell");
		inputCompletado = document.createElement("select");
		inputCompletado.setAttribute("name",`Completado${row_count}`);
		var optionSI = document.createElement("option");
		var optionNO = document.createElement("option");
		optionSI.setAttribute("class","option_SI");
		optionNO.setAttribute("class","option_NO");
		optionSI.textContent="SI";
		optionNO.textContent="NO";
		inputCompletado.appendChild(optionNO);
		inputCompletado.appendChild(optionSI);
		tdCompletado.appendChild(inputCompletado);
		trRow.appendChild(tdCompletado);

		tdF_completado = document.createElement("td");
		tdF_completado.setAttribute("class","cell");
		inputF_completado = document.createElement("input");
		inputF_completado.setAttribute("spellcheck","false");
		inputF_completado.setAttribute("type","date");
		inputF_completado.setAttribute("class","input_text");
		inputF_completado.setAttribute("name",`Fecha_formulario_completado${row_count}`);
		tdF_completado.appendChild(inputF_completado);
		trRow.appendChild(tdF_completado);

		tdComentario = document.createElement("td");
		tdComentario.setAttribute("class","cell");
		inputComentario = document.createElement("input");
		inputComentario.setAttribute("spellcheck","false");
		inputComentario.setAttribute("type","text");
		inputComentario.setAttribute("class","input_text");
		inputComentario.setAttribute("name",`Comentario${row_count}`);
		tdComentario.appendChild(inputComentario);
		trRow.appendChild(tdComentario);

		tdConvocatoria = document.createElement("td");
		tdConvocatoria.setAttribute("class","cell hidden");
		inputConvocatoria = document.createElement("input");
		inputConvocatoria.setAttribute("spellcheck","false");
		inputConvocatoria.setAttribute("type","text");
		inputConvocatoria.setAttribute("value",`${convocatoria}`);
		inputConvocatoria.setAttribute("class","input_text");
		inputConvocatoria.setAttribute("name",`Convocatoria${row_count}`);
		tdConvocatoria.appendChild(inputConvocatoria);
		trRow.appendChild(tdConvocatoria);

		tdAnio = document.createElement("td");
		tdAnio.setAttribute("class","cell hidden");
		inputAnio = document.createElement("input");
		inputAnio.setAttribute("spellcheck","false");
		inputAnio.setAttribute("type","text");
		inputAnio.setAttribute("class","input_text");
		inputAnio.setAttribute("value",`${anio}`);
		inputAnio.setAttribute("name",`Anio${row_count}`);
		tdAnio.appendChild(inputAnio);
		trRow.appendChild(tdAnio);

		tdOrganismo = document.createElement("td");
		tdOrganismo.setAttribute("class","cell hidden");
		inputOrganismo = document.createElement("input");
		inputOrganismo.setAttribute("spellcheck","false");
		inputOrganismo.setAttribute("type","text");
		inputOrganismo.setAttribute("class","input_text");
		inputOrganismo.setAttribute("value",`${organismo}`);
		inputOrganismo.setAttribute("name",`Organismo${row_count}`);
		tdOrganismo.appendChild(inputOrganismo);
		trRow.appendChild(tdOrganismo);


		document.querySelector(".table").appendChild(trRow);
		copy_animation_insert(trRow);


	}


	const btns_agregar = document.getElementsByClassName("btn_agregar");
	for(let i = 0; i < btns_agregar.length; i++){
		btns_agregar[i].addEventListener("click",()=>{
			crear_elementos(btns_agregar[i].id);
		})
	}

