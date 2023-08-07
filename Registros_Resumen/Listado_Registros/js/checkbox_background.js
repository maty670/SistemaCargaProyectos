function checkbox_background(){


//Setear colores al cambiar la opcion del select
	const checkboxs = document.getElementsByClassName('input_checkbox');
	const tr_row = document.getElementsByClassName('row');
	
	for(let i = 0; i < checkboxs.length; i++){
		checkboxs[i].addEventListener("change",(e)=>{

			let tr_row = checkboxs[i];
			while(!tr_row.classList.contains("row")){
				tr_row = tr_row.parentNode;
			}

			if(e.target.checked==true){
				for(let j=0; j< tr_row.cells.length; j++){
					input_cell = tr_row.cells[j].firstElementChild;
					if(input_cell.classList.contains("input_text")){
						input_cell.id="input_checked";
					}
				}
				
			}else{
				for(let j=0; j< tr_row.cells.length; j++){
					input_cell = tr_row.cells[j].firstElementChild;
					if(input_cell.classList.contains("input_text")){
						input_cell.id="";
					}
				}
			}
		})
	}
}