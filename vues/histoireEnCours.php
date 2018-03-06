<?php
  $page_title="Partie en cours";
  include("vues/header.php");
	// On est arrivé sur cette page. On a l'id du personnage dans l'url, on le recupère. On le met en session.
	if(isset($_GET['id_personnage'])){
		$id_personnage=$_GET['id_personnage'];
	}
	else{ $id_personnage=$_SESSION['id_personnage']; }
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
	<?php echo "<p id='size'>$size</p>"; ?>
	<?php echo "<p id='theme'>$theme</p>"; ?>
	<?php echo "<p id='alignement'>$alignement</p>"; ?>
	<h1 id="titreCharge">
		<a href="index.php"> <img src="style/img/logo2.png" alt="Le multivers des héros" /></a>
	</h1>
	<div id="contentParagraphes">
		<div id="imagePerso"> <!-- avatar  -->
			<?php echo " <a class='inventaire' href='$this->script_name?action=inventaire&id_personnage=$id_personnage'>"; ?>
			<img src="<?php echo  $this->getImageUrl['url_image'];  ?> " alt="Image soldat" height="150" width="150">
			<?php echo"</a>"; ?>
		</div>
		<div id="texteHeaderPara"><!-- Nom chapitre  -->
			<?php
				echo "<h2> Chapitre ".$this->getNameParagraphe['id_chapitre'];
				echo " : ".$this->getNameParagraphe['nom_chapitre'];
				echo "</h2>";
			?>
		</div>
		<?php
		echo '<p class="contenuPararaphe"> ' ;
		echo $this->getInfoPara['contenu'];
		echo "</p>";
		foreach($this->actionsTest as $row){
			echo "<a class='choixParagraphe' href='$this->script_name?action=histoireEnCours&id_paragraphe_suivant=$row[id_paragraphe_suivant]&id_action=$row[id_liste_action]'>$row[contenu_action]</a>";
		}
		$paraEnCours= $this->getInfoPara['id_paragraphe'];
		$_SESSION['idparaEnCours']=$paraEnCours;
		?>
	</div>
	<script>
		document.getElementById('size').style.display="none";
		SizeTypo(document.getElementById('size').innerHTML);
		document.getElementById('theme').style.display="none";
		letheme(document.getElementById('theme').innerHTML);
		document.getElementById('alignement').style.display="none";
		texteAlignement(document.getElementById('alignement').innerHTML);
	</script>
	<?php include("vues/footer.php"); ?>
</body>
