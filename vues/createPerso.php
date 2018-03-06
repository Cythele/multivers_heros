<?php
  session_start();
  $page_title="Histoires";
	include("vues/headerCreatePerso.php");
  /* si c'est la première fois alors la taille =1 */
  if(!isset($_SESSION['typoSize'])){$size=1;}
  else {$size=$_SESSION['typoSize'];}
  /* on enregistre le theme choisi */
  if(!isset($theme)){ $theme='';}
  if(isset($_SESSION['theme'])){ $theme=$_SESSION['theme'];}
  // si l alignement n est pas def alors il est justifie
  if(!isset($_SESSION['justify'])){$alignement='justifie';}
  else{$alignement=$_SESSION['justify'];}
?>
<body>
	<h1 id="titreCharge">
		<a href="index.php"> <img src="style/img/logo2.png" alt="Le multivers des héros" /></a>
	</h1>
	<?php echo "<p id='size'>$size</p>"; ?>
	<?php echo "<p id='theme'>$theme</p>"; ?>
	<?php echo "<p id='alignement'>$alignement</p>"; ?>
	<div id="content">
	<?php
		/* Les genres */
		$humainN = $this->imgHumainN['url_image'];
		$humainF = $this->imgHumainF['url_image'];
		$humainH = $this->imgHumainH['url_image'];
		/* Les non connus ou autres + classes */
		$humainNG = $this->imgHumainNguerrier['url_image'];
		$humainNA = $this->imgHumainNAssassin['url_image'];
		$humainNM = $this->imgHumainNMage['url_image'];
		/* Les hommes + classes */
		$humainHG = $this->imgHumainHguerrier['url_image'];
		$humainHA = $this->imgHumainHAssassin['url_image'];
		$humainHM = $this->imgHumainHMage['url_image'];
		/* Femmes + classes */
		$humainFG = $this->imgHumainFguerrier['url_image'];
		$humainFA = $this->imgHumainFAssassin['url_image'];
		$humainFM = $this->imgHumainFMage['url_image'];
		/* On met dans un tableau pour crééer des paragraphes avec une boucle */
		$array = array($humainN,$humainF,$humainH,$humainNG,$humainNA,$humainNM,$humainHG,$humainHA,$humainHM,$humainFG,
		$humainFA,$humainFM);
		echo "<div id='divImgUrl'>";
			foreach ($array as $value) {
				echo "<p class='imageClasseP'>".$value."</p>";
			}
		echo '</div>';
	?>
	<h1> Création du personnage </h1>
	<form action=" <?php $this->script_name?>?action=histoireEnCours" method="POST" id="myform">
		<div id="identite">
			<fieldset> <legend> Identité </legend>
				<div id="avatar">
				</div>
				<label for="firstName">Prénom de votre héro :</label> <input type="text" id="firstName" name="firstName" required>
				<input type="button" value="aide prenom" onclick="generateNames('firstName')"/>
				<br>
				<label for="name"> Nom de votre héro : </label> <input type="text" id="name" name="name" required >
				<input type="button" value="aide nom" onclick="generateNames('name')"/>
				<br>
				<br >
			</fieldset>
			<fieldset> <legend> Genre </legend>
				<div class="genre">
					<input type="radio" id="homme" name="genre" value="homme" onclick="showImage()" />
					<label for="homme">Homme</label>
				</div>
				<div class="genre">
					<input type="radio" id="femme" name="genre" value="femme" onclick="showImage()" />
					<label for="femme">Femme</label>
				</div>
				<div class="genre">
					<input type="radio" name="genre" id="inconnu" value="inconnu" onclick="showImage()" checked>
					<label for="inconnu">Inconnu/sans importance</label>
				</div>
				<br>
			</fieldset>
			<fieldset> <legend> Race </legend>
				<div>
					<!--<input type="radio" class="btn_race" name="race" id="autre" value="autre" >
					<label for="autre">Autre</label>-->
				</div>
				<div>
					<input type="radio" name="race" id="humain" value="humain" checked>
					<label for="humain"> Humains
						 <img src="<?php echo $humainN ?>" alt="Image humain" height="150" width="150">
					</label>
				</div>
			</fieldset>
			<fieldset class="field"> <legend> Classes </legend>
				<div class="classes">
					<input type="radio" name="classe" id="guerrier" value="guerrier" onclick="getDesc('guerrier')" checked>
					<label for="guerrier">Guérrier</label>
						<img src="<?php echo $humainNG ?>" alt="Image guerrier" height="150" width="150">
				</div>
				<div class="classes">
					<input type="radio" name="classe" id="assassin" value="assassin" onclick="getDesc('assassin')">
					<label for="assassin">assassin</label>
						<img src="<?php echo $humainNA ?>" alt="Image assassin" height="150" width="150">
					</div>
				<div class="classes">
					<input type="radio" name="classe" id="mage" value="mage" onclick="getDesc('mage')">
					<label for="mage"> Mage</label>
						<img src="<?php echo  $humainNM ?> " alt="Image mage" height="150" width="150">
				</div>
				<div id="descClasse">
					<h2> Description de la classe : </h2>
					<p id="guerrierDesc"> <?php echo  $this->descGuerrier['descriptionClasse'];  ?> </p>
					<p id="assassinDesc">  <?php echo  $this->descAssassin['descriptionClasse'];  ?>  </p>
					<p id="mageDesc"><?php echo  $this->descMage['descriptionClasse'];  ?></p>
				</div>
			</fieldset>
		<div id="classeMetier">
			<fieldset> <legend> Métiers </legend>
				<div class="metiers">
					<input type="radio" name="metier" id="courtisan" value="courtisan" onclick="showDescMetier('courtisan')" checked>
					<label for="courtisan"> Courtisan </label>
						<img src="<?php echo  $this->imgCourtisan['url_image'];  ?> " alt="Image courtisan" height="150" width="150">
				</div>
				<div class="metiers">
					<input type="radio" name="metier" id="eclaireur" value="eclaireur" onclick="showDescMetier('eclaireur')">
					<label for="eclaireur"> Eclaireur</label>
						<img src="<?php echo  $this->imgEclaireur['url_image'];  ?> " alt="Image éclaireur" height="150" width="150">
				</div>
				<div class="metiers">
					<input type="radio" name="metier" id="erudit" value="erudit" onclick="showDescMetier('erudit')">
					<label for="erudit"> Erudit </label>
						<img src="<?php echo  $this->imgErudit['url_image'];  ?> " alt="Image érudit" height="150" width="150">
				</div>
				<div class="metiers">
					<input type="radio" name="metier" id="mercenaire" value="mercenaire" onclick="showDescMetier('mercenaire')">
					<label for="mercenaire"> Mercenaire</label>
						<img src="<?php echo  $this->imgMercenaire['url_image'];  ?> " alt="Image mercenaire" height="150" width="150">
				</div>
				<div class="metiers">
					<input type="radio" name="metier" id="roturier" value="roturier" onclick="showDescMetier('roturier')">
					<label for="roturier"> Roturier </label>
						<img src="<?php echo  $this->imgRoturier['url_image'];  ?> " alt="Image roturier" height="150" width="150">
				</div>
				<div class="metiers">
					<input type="radio" name="metier" id="soldat" value="soldat" onclick="showDescMetier('soldat')">
					<label for="soldat"> Soldat </label>
						<img src="<?php echo  $this->imgSoldat['url_image'];  ?> " alt="Image soldat" height="150" width="150">
				</div>
				<div id="descMetiers">
					<h2> Description des métiers :  </h2>
					<p id="Desccourtisan"> <?php echo $this->descCourtisan['descriptionMetier'];  ?> </p>
					<p id="Desceclaireur"> <?php echo $this->descEclaireur['descriptionMetier']; ?>  </p>
					<p id="Descerudit">  <?php echo $this->descErudit['descriptionMetier']; ?>  </p>
					<p id="Descmercenaire">  <?php echo $this->descMercenaire['descriptionMetier']; ?>    </p>
					<p id="Descroturier">   <?php echo $this->descRoturier['descriptionMetier']; ?>     </p>
					<p id="Descsoldat">  <?php echo $this->descSoldat['descriptionMetier']; ?></p>
				</div>
				<div id="descCompetences">
				<h2> Description de la compétence :  </h2>
					<p id="DescConnaissance"> <?php echo $this->descConnaissance['descriptionComp'];  ?> </p>
					<p id="DescDebrouillardise"> <?php echo $this->descDebrouillardise['descriptionComp']; ?>  </p>
					<p id="DescManipulation">  <?php echo $this->descManipulation['descriptionComp']; ?>  </p>
					<p id="DescSurvie">  <?php echo $this->descSurvie['descriptionComp']; ?>    </p>
					<p id="DescAcuite">  <?php echo $this->descAcuite['descriptionComp']; ?>  </p>
					<p id="DescCommandement">  <?php echo $this->descCommandement['descriptionComp']; ?>    </p>
				</div>
				<div id="statPerso">
					<p id="statForceguerrier"> <?php echo $this->forceGuerrier['laforce'];  ?>  </p>
					<p id="statIntellguerrier"> <?php echo $this->intellGuerrier['intelligence']; ?> </p>
					<p id="statDexguerrier">  <?php echo $this->DexGuerrier['dex']; ?>  </p>
					<p id="statApparenceguerrier">  <?php echo $this->AppGuerrier['apparence']; ?>    </p>
					<p id="statForceassassin"> <?php echo $this->forceAssassin['laforce'];  ?> </p>
					<p id="statIntellassassin"> <?php echo $this->IntellAssassin['intelligence']; ?>  </p>
					<p id="statDexassassin">  <?php echo $this->DexAssassin['dex']; ?>  </p>
					<p id="statApparenceassassin">  <?php echo $this->AppAssassin['apparence']; ?>    </p>
					<p id="statForcemage"> <?php echo $this->ForceMage['laforce'];  ?> </p>
					<p id="statIntellmage"> <?php echo $this->IntellMage['intelligence']; ?>  </p>
					<p id="statDexmage">  <?php echo $this->DexMage['dex']; ?>  </p>
					<p id="statApparencemage">  <?php echo $this->AppMage['apparence']; ?>    </p>
				</div>
				<div id="statMetiers">
					<h2> Statistiques des métiers </h2>
					<p id="statForcecourtisan"> <?php echo $this->forceCourtisan['modifForce'];  ?> </p>
					<p id="statIntellcourtisan"> <?php echo $this->intellCourtisan['modifIntell']; ?> </p>
					<p id="statDexcourtisan">  <?php echo $this->dexCourtisan['modifDex']; ?>  </p>
					<p id="statApparencecourtisan">  <?php echo $this->apparanceCourtisan['modifApparence']; ?>    </p>
					<!-- Eclaireur-->
					<p id="statForceeclaireur"> <?php echo $this->ForceEclaireur['modifForce'];  ?>  </p>
					<p id="statIntelleclaireur"> <?php echo $this->IntellEclaireur['modifIntell']; ?> </p>
					<p id="statDexeclaireur">  <?php echo $this->DexEclaireur['modifDex']; ?>  </p>
					<p id="statApparenceeclaireur">  <?php echo $this->AppEclaireur['modifApparence']; ?>    </p>
					<!-- Erudit-->
					<p id="statForceerudit"> <?php echo $this->ForceErudit['modifForce'];  ?>  </p>
					<p id="statIntellerudit"> <?php echo $this->IntellErudit['modifIntell']; ?> </p>
					<p id="statDexerudit">  <?php echo $this->DexErudit['modifDex']; ?>  </p>
					<p id="statApparenceerudit">  <?php echo $this->ApparenceErudit['modifApparence']; ?>    </p>
					<!-- Mercenaire-->
					<p id="statForcemercenaire"> <?php echo $this->ForceMercenaire['modifForce'];  ?>  </p>
					<p id="statIntellmercenaire"> <?php echo $this->IntellMercenaire['modifIntell']; ?> </p>
					<p id="statDexmercenaire">  <?php echo $this->DexMercenaire['modifDex']; ?>  </p>
					<p id="statApparencemercenaire">  <?php echo $this->ApparenceMercenaire['modifApparence']; ?>    </p>
					<!-- Roturier-->
					<p id="statForceroturier"> <?php echo $this->ForceRoturier['modifForce'];  ?>  </p>
					<p id="statIntellroturier"> <?php echo $this->IntellRoturier['modifIntell']; ?> </p>
					<p id="statDexroturier">  <?php echo $this->DexRoturier['modifDex']; ?>  </p>
					<p id="statApparenceroturier">  <?php echo $this->AppRoturier['modifApparence']; ?>    </p>
					<!-- Soldat-->
					<p id="statForcesoldat"> <?php echo $this->ForceSoldat['modifForce'];  ?>  </p>
					<p id="statIntellsoldat"> <?php echo $this->IntellSoldat['modifIntell']; ?> </p>
					<p id="statDexsoldat">  <?php echo $this->DexSoldat['modifDex']; ?>  </p>
					<p id="statApparencesoldat">  <?php echo $this->AppSoldat['modifApparence']; ?>    </p>
				</div>
			</fieldset>
			<div id="resStat">
			</div>
			<div id="Nbror">
				<p id="orCourtisan"> <?php echo $this->orCourtisan['nombreOr'];  ?> Or </p>
				<p id="orEclaireur"> <?php echo $this->orEclaireur['nombreOr']; ?> Or </p>
				<p id="orErudit"> <?php echo $this->orErudit['nombreOr']; ?>  Or</p>
				<p id="orMercenaire"> <?php echo $this->orMercenaire['nombreOr']; ?>  Or</p>
				<p id="orRoturier"> <?php echo $this->orRoturier['nombreOr']; ?>  Or</p>
				<p id="orSoldat"> <?php echo $this->orSoldat['nombreOr']; ?>  Or</p>
			</div>
			<div id="Points">
				<p id="pointsvieMin">  <?php echo $this->pointsVieHMin['borneInfVie']; ?> </p>
				<p id="pointsVieMax">  <?php echo $this->pointsVieHMax['borneSupVie']; ?> </p>
				<p id="Vie">   </p>
				<p id="pointsManaHMin">  <?php echo $this->pointsManaHMin['borneInfMana']; ?> </p>
				<p id="pointsManaHMax">  <?php echo $this->pointsManaHMax['borneSupMana']; ?> </p>
				<p id="Mana">   </p>
			</div>
			<input type="submit" name="creerPerso" id="creerPerso" value="Créer le personnage ! ">
		</div>
		</div>
	</form>
	<div id="resultat">
	</div>
	<div id="response">
	</div>
	</div>
	<ul>
	   <li class="invisible">
	     <a class="navlink" title="Retours haut de page" href="#identite"> Retours en haut de la page </a>
	   </li>
	</ul>
	<script>
		document.getElementById('size').style.display="none";
		SizeTypo(document.getElementById('size').innerHTML);
		document.getElementById('theme').style.display="none";
		letheme(document.getElementById('theme').innerHTML);
		document.getElementById('alignement').style.display="none";
		console.log(document.getElementById('alignement').innerHTML);
		texteAlignement(document.getElementById('alignement').innerHTML);
	</script>
	<?php include("vues/footer.php");?>
</body>
</html>
