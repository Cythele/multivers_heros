let tab = [];

function letheme(themeContenu){
	if(themeContenu=='malvoyant'){
		document.body.style.backgroundColor = "black";
	}
}

function texteAlignement(alignementContenu){
	if(alignementContenu=="centrer"){
		var cells = document.getElementsByTagName("p");
		for (var i = 0; i < cells.length; i++) {
		    cells[i].style.textAlign = "center";
			}
	}
}

function addInTab(elementtoAdd){
	var elementtoAdd = document.querySelectorAll(elementtoAdd);
	if(elementtoAdd.length != undefined && elementtoAdd.length != 0){
		tab.push(elementtoAdd);
	}
	return tab;
}

function SizeTypo(size){
	addInTab('a');
	addInTab('p');
	addInTab('legend');
	addInTab('input');
	addInTab('label');
	if(size==1){ sizeInput=1; }
	else if(size==2){ sizeInput=1.1; }
	else{ sizeInput=1.4; }
	if(document.getElementById("resStat")!=null){
		var test = document.getElementById("resStat");
		document.getElementById("resStat").style.fontSize= sizeInput + "em";
	}
	tab.forEach(function(element){
		for(index=0; index < element.length; index++){ // les paragraphes
			 element[index].style.fontSize = sizeInput + "em";
	 	}
	});
}
