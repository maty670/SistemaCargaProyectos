function bloquear_desbloquear_elementos(id,bloqdesb){
	row = document.querySelector(`.row${id}`);
	
	for(let e of row.children){

		switch (bloqdesb) {
		  case "bloquear":

			  	if(e.classList.contains("cell") && e.children[0].type=="text"){
					e.children[0].setAttribute("readOnly","true");
				}

				if(e.classList.contains("cell") && e.children[0].type=="date"){
					e.children[0].classList.add("block");
					e.children[0].style.pointerEvents="none";
				}


				if(e.classList.contains("cell") && e.children[0].type=="select-one"){
					e.children[0].classList.add("block");
					e.children[0].style.pointerEvents="none";
				}

				e.style.cursor="no-drop";

		    	break;


		  case "desbloquear":

		  		if(e.classList.contains("cell") && e.children[0].type=="text"){
					e.children[0].removeAttribute("readOnly");
				}

				if(e.classList.contains("cell") && e.children[0].type=="date"){
					e.children[0].style.pointerEvents="auto";
					e.children[0].classList.remove("block");
				}

				if(e.classList.contains("cell") && e.children[0].type=="select-one"){
					e.children[0].style.pointerEvents="auto";
					e.children[0].classList.remove("block");
				}
				e.style.cursor="auto";

		    	break;
		}

	}
}


function switch_bloq_desbl(){
	inputs_switch = document.querySelectorAll(`[id*=switch]`);
	for(let i = 0; i < inputs_switch.length; i++){
		inputs_switch[i].addEventListener("change",()=>{
			if(inputs_switch[i].checked){
				let id = inputs_switch[i].id.replace("switch","")
				bloquear_desbloquear_elementos(id,"bloquear");
			}else{
				let id = inputs_switch[i].id.replace("switch","")
				bloquear_desbloquear_elementos(id,"desbloquear");
			}
		})
	}
	
}

function switch_bloq_desbl_all(){
	switch_all = document.getElementById("Switch_all");
	inputs_switch = document.querySelectorAll(`[id*=switch]`);
	switch_all.addEventListener("click",()=>{
		for(let i = 0; i <inputs_switch.length; i++){

			let id = inputs_switch[i].id.replace("switch","")
			if(switch_all.checked==true && inputs_switch[i].checked==false){
				inputs_switch[i].click();
			}else if(switch_all.checked==false && inputs_switch[i].checked==true){
				inputs_switch[i].click();
			}

		}
	})
	
	
}


switch_bloq_desbl();
switch_bloq_desbl_all();