<?php
    session_start();
    if(isset($_SESSION['tableauPotion'])){
      session_unset($_SESSION['tableauPotion']);
    }
    $page_title="Accueil";
    include("vues/header.php");
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
	<?php echo "<p id='size'>$size</p>"; ?><?php echo "<p id='theme'>$theme</p>"; ?><?php echo "<p id='alignement'>$alignement</p>"; ?>
	<h1 class="titreIndex"><img alt="logo du multivers des héros" src="style/img/logo2.png"></h1>
	<div id="content">
		<p>Le Multivers des Héros est une application en construction qui a pour but d’offrir des histoires interactives, inspirées des livres dont vous êtes le héros. Les choix que vous faites peuvent avoir des conséquences...</p>
		<div id="liensAccueil">
			<?php echo "<a class='choixAcceuil' href='$this->script_name?action=newGame'> Nouvelle partie </a>"; ?><?php echo "<a class='choixAcceuil' href='$this->script_name?action=chargerPartie'> Charger partie </a>"; ?><?php echo "<a class='choixAcceuil' href='$this->script_name?action=options'> Options </a>"; ?>
		</div>
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
</html>
