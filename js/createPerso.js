/* Rend la liste des url des images invisibles*/
function makeInvisible(objet, number){
	objet[number].style.display="none";
}

function showLife(res,chaine){
	document.getElementById(chaine).innerHTML=res+"Points de "+chaine;
	document.getElementById(chaine).style.display="block";
}

function hideParagraphe(listeP){
	var index=0;
	for(index=0; index < listeP.length; index++) {
		listeP[index].style.display="none";
 	}
}

window.addEventListener("load", function(){
	/* cacher les descriptions pour les réafficher au clic */
	var div=document.getElementById("descMetiers");
	makeStatVisible(div, "Desccourtisan");
	document.getElementById("Nbror").style.display="none";
	showDescComp("courtisan");
	document.getElementById("statPerso").style.display="none";
	document.getElementById("statMetiers").style.display="none";
	hideDesc();
	showImage();
	var divPoints=document.getElementById("Points");
	var listeP = divPoints.getElementsByTagName("P");
	hideParagraphe(listeP);
	var min = document.getElementById("pointsvieMin").innerHTML;
	var max = document.getElementById("pointsVieMax").innerHTML;
	calculPointsVie(min,max,"Vie");
	var minMana = document.getElementById("pointsvieMin").innerHTML;
	var maxMana = document.getElementById("pointsVieMax").innerHTML;
	calculPointsVie(minMana,maxMana, "Mana");
});

function hideDesc(){
	/* Cacher toutes les descriptions générées dans des <p> ! */
	document.getElementById("mageDesc").style.display="none";
	document.getElementById("assassinDesc").style.display="none";
	/* Cacher la liste des urls invisibles */
	var listeImages = document.getElementsByClassName("imageClasseP");
	hideParagraphe(listeImages);
}

function getRandomArbitrary(min, max) {
  return Math.random() * (max - min) + min;
}

function calculPointsVie(min,max,chaine){
	min= parseInt(min);
	max= parseInt(max);
	res=Math.floor(Math.random() * (max - min +1)) + min;
	showLife(res,chaine);
	/* a nettoyer par ici !!! */
	if(chaine=='Vie'){
		var resvie= document.getElementById("Vie").innerHTML;
		var type="vie";
	}
	else{
		var resvie= document.getElementById("Mana").innerHTML;
		var type="mana";
	}
	createInput(resvie,type);
}

// pas de si sinon pcque les points de vie st generes une seule fois
function createInput(resvie,type){
		document.cookie = ' + '+type+'='+resvie+';';
}

function generateNames(arg){
	console.log(arg);
	if (arg=='firstName'){
		var arrayNames =  [ {id:1, name:"Eden"},{id:2, name:"Rhéa"},{id:3, name:"Thyres"},]
	}
	else {
		var arrayNames = [ {id:1, name:"Heurtevent"},{id:2, name:"Malombres"},{id:3, name:"Distena"},]
	}
	var res = Math.floor(getRandomArbitrary(1,arrayNames.length));
	var item = arrayNames.find(item => item.id === res);
	var name=item.name;
	console.log(name);
	document.getElementById(arg).value=name;
}

function getDesc(classe){
	document.getElementById("guerrierDesc").style.display="none";
	hideDesc();
	showImage();
	document.getElementById(classe+"Desc").style.display="block";
	document.getElementById("statPerso").style.display="block";
	var divPerso = document.getElementById("statPerso");
	var descElement = divPerso.getElementsByTagName("p");
	/* tout désafficher */
	hideParagraphe(descElement);
}

function makeVisible(number){
	var divportrait = document.getElementById("avatar");
	var imageUrl = document.getElementsByClassName("imageClasseP")[number].innerHTML;
	divportrait.style.background = 'url('+imageUrl+')';
	createParaStat("divImgUrl",imageUrl, "url");
	document.getElementById("divImgUrl").style.display="none";
}

function showSelectedImage(c1,c2,c3){
	var classe = document.getElementsByName("classe");
		if (classe[0].checked){ // guerrier
			makeVisible(c1);
		}
		else if(classe[1].checked){ // assassin
			makeVisible(c2);
		}
		else{
			makeVisible(c3); // mage
		}
		lancerDes();
}

function showImage(){
	var genre = document.getElementsByName("genre");
	// Si homme
	if(genre[0].checked){ // tester la classe
		showSelectedImage(6,7,11);
	}
	// Femme
	else if(genre[1].checked){
		showSelectedImage(9,10,11);
	} // autre
	else{
		showSelectedImage(3,4,5);
	}
}
/* Ici on compare l'égalité entre le paragraphe et l'objet (pour descComp et DescMetier) */
function makeVisibleCompAndMetier(nomDiv,paragraphe){
	document.getElementById("descCompetences").style.display="none";
	var descElement = nomDiv.getElementsByTagName("p");
	document.getElementById("descMetiers").style.display="block";
	document.getElementById("descCompetences").style.display="block";
	var descComp;
	var idNomMetier;
	var paragrapheFull="Desc"+paragraphe;
	for( var index=0; index < descElement.length; index++ ) {
		idNomMetier = descElement[index].getAttribute('id');
		descElement[index].style.display="none";
		if(idNomMetier==paragrapheFull){
			descComp = document.getElementById(paragrapheFull);
			descComp.style.display="block";
		}
 	}
}

/* Rendre visible les stats du metier : on réaffiche la div pour afficher les paragraphes
et on enlève tous les paragrahes sauf le bon (celui qui contient l'or ) */
function makeStatVisible(nomDiv,objet){
	document.getElementById("Nbror").style.display="block";
	var descElement = nomDiv.getElementsByTagName("p");
	hideParagraphe(descElement);
	document.getElementById(objet).style.display="block";
	var objetOrTotal = document.getElementById(objet).innerHTML;
	createParaStat("Nbror",objetOrTotal, "Or");
	//createinputHidden("myform",objetOrTotal,"OrInput");
}

function showDescComp(metier){
	var descCompetences = document.getElementById("descCompetences");
	var nbrOr = document.getElementById("Nbror");
	switch(metier) {
    case "erudit":
        makeVisibleCompAndMetier(descCompetences,"Connaissance");
				makeStatVisible(nbrOr,"orErudit");
        break;
    case "courtisan":
       	makeVisibleCompAndMetier(descCompetences,"Manipulation");
	   		makeStatVisible(nbrOr,"orCourtisan");
        break;
    case "roturier":
        makeVisibleCompAndMetier(descCompetences,"Debrouillardise");
	    	makeStatVisible(nbrOr,"orRoturier");
        break;
	case "mercenaire":
        makeVisibleCompAndMetier(descCompetences,"Survie");
				makeStatVisible(nbrOr,"orMercenaire");
        break;
	case "soldat":
        makeVisibleCompAndMetier(descCompetences,"Commandement");
				makeStatVisible(nbrOr,"orSoldat");
        break;
	case "eclaireur":
        makeVisibleCompAndMetier(descCompetences,"Acuite");
				makeStatVisible(nbrOr,"orEclaireur");
        break;
	}
	lancerDes();
}

function showDescMetier(metier){
	var divDescMetiers = document.getElementById("descMetiers");
	makeVisibleCompAndMetier(divDescMetiers,metier);
	showDescComp(metier);
}

function createString(classeOuMetier){
	var force="statForce"+classeOuMetier;
	var intell="statIntell"+classeOuMetier;
	var app="statApparence"+classeOuMetier;
	var dex="statDex"+classeOuMetier;
	return [force,intell,app,dex];
}

function lancerDes(){
	var metier = document.querySelector('input[name="metier"]:checked').value;
	var classe = document.querySelector('input[name="classe"]:checked').value;
	var tab = createString(classe);
	var array = [];
	for(index = 0; index < tab.length; index++){
		array.push(parseInt(document.getElementById(tab[index]).innerHTML));
	}
	var tab = createString(metier);
	for(index = 0; index < tab.length; index++){
		array.push(parseInt(document.getElementById(tab[index]).innerHTML));
	}
	var force=array[0]+array[4];
	var intel=array[1]+array[5];
	var dex=array[3]+array[6];
	var apparence=array[2]+array[7];
	createParaStat("resStat",force, "Force");
	createParaStat("resStat",intel, "Intelligence");
	createParaStat("resStat",dex, "Dexterite");
	createParaStat("resStat",apparence, "apparence");
}

/* Une fonction qui créer le paragraphe contenant les statistiques et qui sinon les créér */
function createParaStat(idResultatStat, carac, nomCarac){
	if(!document.getElementById(nomCarac)){
		var f = document.createTextNode(nomCarac+" :"+carac);
		var caracbase=carac;
		document.cookie = ' + '+nomCarac+'='+carac+';';
		var carac = document.createElement("P");
		carac.id=nomCarac;
		carac.appendChild(f);
		document.getElementById(idResultatStat).appendChild(carac);
	}
	else{
		document.cookie = ' + '+nomCarac+'='+carac+';';
		document.getElementById(nomCarac).innerHTML=nomCarac+"  : "+carac;
	}
}
/* A AMELIORER POUR FUSIONNER AVEC CELLE PLUS HAUT !*/
function createinputHidden(laDiv, carac, nomInput){
	if(!document.getElementById(nomInput)){
			// alors on le creeer
			var hiddenInput = document.createElement("input");
			// on met ses stats
			hiddenInput.setAttribute("value", carac);
			hiddenInput.setAttribute("id", nomInput);
			hiddenInput.setAttribute("name", nomInput);
			hiddenInput.setAttribute("type", "hidden");
			document.getElementById("myform").appendChild(hiddenInput);
		}
		else{
			document.getElementById(nomInput).setAttribute("value", carac);
		}
}
