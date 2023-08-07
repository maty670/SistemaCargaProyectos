
function select_background(){


//Setear colores al cambiar la opcion del select
	const selects = document.querySelectorAll('select');
	for(i=0;i<selects.length;i++){

		if(selects[i].value=="SI"){
			selects[i].classList.add("green");
			selects[i].parentElement.classList.add("green");
		}else{
			selects[i].classList.add("red");
			selects[i].parentElement.classList.add("red");
		}

		selects[i].addEventListener("change",(event)=>{
			if(event.target.value=="SI"){
				event.target.classList.replace("red","green");
				event.target.parentElement.classList.replace("red","green");
			}else{
				event.target.classList.replace("green","red");
				event.target.parentElement.classList.replace("green","red");
			}
		})

	}
}
