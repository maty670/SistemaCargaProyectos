	function clean_inputs(){
		const inputs = document.querySelectorAll('input[type=text],input[type=date],select');
		for(let i=0; i<inputs.length;i++){
			inputs[i].classList.remove("dashed-animation");
		}
	}

function copy_animation(){

	// Asignar background a la fila al hacer focus en un input
	const input = document.querySelectorAll('input[type=text],input[type=date],select');
	for(let i=0; i<input.length;i++){


		//Al ejecutar el evento de copiado sobre un input, se copia el contenido en el portapapeles y se crea el efecto de animacion
		(input[i]).addEventListener("copy",(event)=>{
			clean_inputs();
			let texto_input = input[i].value;
			let texto_seleccionado = document.getSelection().toString();

			if(texto_seleccionado.length<1 || texto_seleccionado.length == texto_input.length){
				navigator.clipboard.writeText(texto_input).then(() => {		//Escribir el el portapapeles el contenido del input
				})
				input[i].classList.add("dashed-animation");	
			}else{

			}
			
		})


		window.addEventListener("keydown", (evt)=>{
				if(evt.keyCode=="27" && input[i].classList.contains("dashed-animation")){
					input[i].classList.remove("dashed-animation");
				}

		});
	
	}

}

function copy_animation_insert(tr_row){
	
	for(let i = 0; i<tr_row.cells.length; i++){
		let new_input = tr_row.cells[i].firstElementChild;

		(new_input).addEventListener("copy",(event)=>{

			clean_inputs();
			let texto_input = new_input.value;
			let texto_seleccionado = document.getSelection().toString();

			if(texto_seleccionado.length<1 || texto_seleccionado.length == texto_input.length){
				navigator.clipboard.writeText(texto_input).then(() => {		
				})
				new_input.classList.add("dashed-animation");	
			}else{

			}
			
		})
	}
}

	



