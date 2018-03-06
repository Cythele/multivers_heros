<?php
	$page_title="Options";
	include("vues/header.php");
	session_start();
	/* et la taille de la typo choisie */
	if(isset($_POST['petite'])){$_SESSION['typoSize']=1;}
	elseif(isset($_POST['moyenne'])){$_SESSION['typoSize']=2;}
	else{
		if(isset($_POST['grande'])){
			$_SESSION['typoSize']=3;
		}
	}
	/* si c'est la première fois alors la taille =1 */
  if(!isset($_SESSION['typoSize'])){$size=1;}
	else {$size=$_SESSION['typoSize'];}
	/* on enregistre le theme choisi */
	if(!isset($theme)){$theme='';}
 	if(isset($_SESSION['theme']) && $_SESSION['theme']=='classique'){
	 $theme=$_SESSION['theme'];
 	}
 	if(isset($_SESSION['theme']) && $_SESSION['theme']=='malvoyant'){
	 $theme=$_SESSION['theme'];
 	}
	if(isset($_POST['classique'])){ //si on a envoye classique
		$_SESSION['theme']='classique';
		$theme=$_SESSION['theme'];
	}
	if(isset($_POST['malvoyant'])){
		$_SESSION['theme']='malvoyant';
		$theme=$_SESSION['theme'];
	}
  /* alignement */
	if(!isset($alignement)){
		$alignement="";
	}
	if(isset($_POST['justify'])){ // si centrer
		$_SESSION['justify']=$_POST['justify'];
		$alignement=$_SESSION['justify'];
	}
	if(isset($_POST['justify-center'])){ // si justifie
		$_SESSION['justify']=$_POST['justify-center'];
		$alignement=$_SESSION['justify'];
	}
	if(isset($_SESSION['justify'])){ // si il y a qqchose dans la var de session on recup
		$alignement=$_SESSION['justify'];
	}
?>
<body>
	<h1 id="titreCharge">
		<a href="index.php"> <img src="style/img/logo2.png" alt="Le multivers des héros" /></a>
	</h1>
	<div id="contentOptions">
		<?php echo "<p id='size'>$size</p>"; ?>
		<?php echo "<p id='theme'>$theme</p>"; ?>
		<?php echo "<p id='alignement'>$alignement</p>"; ?>
		<form action="<?php $this->script_name?>?action=options" method="POST" id="myform">
			<div class="form-group">
				<fieldset>
				<legend> Choix de la taille de la police</legend>
				<p class="texte"> Un essai sur pour voir si la taille convient ! Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			  <input type="submit" name="petite" id="petite" class='choixParagraphe' value="petite" onclick="SizeTypo(1)">
				 <input type="submit" id="moyenne" class="choixParagraphe" name="moyenne" value="Moyenne" onclick="SizeTypo(2)">
					<input type="submit" id="grande" class="choixParagraphe" name="grande" value="Grande" onclick="SizeTypo(3)">
				 </fieldset>
			</div>
	</form>
	<form action="<?php $this->script_name?>?action=options" method="POST" id="themeChoix">
		<div class="form-group">
			<fieldset>
				<legend> Choix du thème </legend>
				<p> Le thème malvoyant permet de changer le fond d'écran en noir. </p>
					<input type="submit" name="classique" class="choixParagraphe" id="theme-classique" value="theme classique">
					<input type="submit" name="malvoyant" class="choixParagraphe" id="theme-malvoyant" value="theme malvoyant">
			</fieldset>
		</div>
	</form>
	<form action="<?php $this->script_name?>?action=options" method="POST" id="alignementChoix">
		<div class="form-group">
			<fieldset>
				<legend> Choix de l'alignement </legend>
				<p> Le texte justifié n'est pas conseillé pour les personnes ayant des troubles cognitifs. </p>
					<input type="submit" name="justify-center" class="choixParagraphe" id="justify-center" value="centrer">
					<input type="submit" name="justify" class="choixParagraphe" id="justify" value="justifier">
			</fieldset>
		</div>
	</form>
		</div>
	<?php
	if(isset($_SESSION['id_personnage'])){ // si on vient de l inventaire alors on peut y retourner
		$id_personnage=$_SESSION['id_personnage'];
		echo "<a class='inventaire' href='$this->script_name?action=inventaire&id_personnage=$id_personnage'>  Retours inventaire</a> ";
	}
	else { echo "<a class='choixActions' href='$this->script_name?action=index'> Retours accueil </a>"; }
	?>
	<script>
		document.getElementById('size').style.display="none";
		SizeTypo(document.getElementById('size').innerHTML);
		document.getElementById('theme').style.display="none";
		letheme(document.getElementById('theme').innerHTML);
		document.getElementById('alignement').style.display="none";
		texteAlignement(document.getElementById('alignement').innerHTML);
		document.getElementById('alignement').style.display="none";
	</script>
	<?php include("vues/footer.php"); ?>
</body>
