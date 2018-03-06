<?php
  session_start();
  $page_title="Histoires";
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
	<h1 id="titreCharge"><a href="index.php"><img alt="Le multivers des héros" src="style/img/logo2.png"></a></h1>
	<div id="Listehistoire">
		<?php echo "<p id='size'>$size</p>"; ?>
		<?php echo "<p id='theme'>$theme</p>"; ?>
		<?php echo "<p id='alignement'>$alignement</p>";
			foreach($this->histoire as $row){
				echo "<p> Nom de l'histoire : ";
				echo "$row[nom_histoire]";
				echo "</p>";
				echo "<p> Auteur : ";
				echo "$row[auteur]";
				echo "</p>";
				echo "<p> Année : ";
				echo "$row[annee]";
				echo "</p>";
				echo "<p> Résumé  : ";
				echo "$row[description]";
				echo "</p>";
				echo "<a class='lienChoixHistoire' href='$this->script_name?action=createPerso&id_histoire=$row[id_histoire]'> Jouer </a>";
			}?>
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
