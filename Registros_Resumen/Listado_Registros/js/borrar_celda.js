function borrar_celda(){
	const input = document.querySelectorAll('input[type=text]');


	for(let i=0; i<input.length;i++){
		input[i].addEventListener("focus",()=>{
			//let cell_codigo = input[i].parentElement.classList.contains("cell_codigo")
			if(input[i].readOnly==false){
				input[i].addEventListener("keydown",function pressKey(e){

					const arr = ['Delete','Key','Numpad','Digit','Comma','Period','Quote','Backslash','Slash','Space'];
					const substr = e.code;

						arr.forEach((element)=>{

							//e.ctrlKey=='false' evita que se borre el campo si esta apretado Ctr+C o Ctr+V
							if(e.code.includes(element) && e.ctrlKey==false && !e.code.includes("Enter")){
								input[i].value="";
								this.removeEventListener('keydown',pressKey);
							}
						})
			
				});

				//Al presionar Enter sobre una celda, desplazar el focus a la siguiente
				input[i].addEventListener("keydown",function pressKey(e){

					if(e.code.includes("Enter")){
						e.target.parentElement.nextElementSibling.firstElementChild.focus();

					}

				})

				input[i].addEventListener("paste",function pressKey(){
					input[i].value="";
				});
			}
			

		})
		


	}

}


