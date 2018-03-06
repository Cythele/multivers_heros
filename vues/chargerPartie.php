<?php
  session_start();
  $page_title="Charger partie";
  include("vues/header.php");
  if(isset($_SESSION['tableauPotion'])){
    session_unset($_SESSION['tableauPotion']);
  }
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
	<h2 id="sstitreCharge"> Les histoires sauvegardées  </h2>
<?php
echo "<div id='contenuliens'>";
	echo "<ul>";
	foreach($this->allID as $row){
			echo " <li class='liensChoixLi'>";
				echo " <a class='lienChoixPerso' href='$this->script_name?action=histoireEnCours&id_personnage=$row[id_personnage]'> ";
					echo '<img src="'.$row['url_image'].'" alt="image personnage'.$row['id_personnage'].' " height="180" width="180" />';
			    echo "<br>"; echo "<br>";
					echo " Personnage n° :";
					echo " $row[id_personnage]";
					echo "<br>";
					echo " nom : $row[nom]";
					echo "<br>";
					echo " prenom : $row[prenom]";
					echo "<br>";
					echo " genre : $row[genre]";
					echo "<br>";
					echo " niveau : $row[niveau]";
				echo "</a>";
				echo "<br>";
				echo "<br>";
			echo "</li>";
		}
		echo "</ul>";
		echo "</div>";
	?>
	<ul>
		 <li class="invisible">
			 <a class="navlinkInventaire" title="Retours haut de page" href="#contenuliens"> Retours en haut de la page </a>
		 </li>
	</ul>
	<script>
		document.getElementById('size').style.display="none";
		SizeTypo(document.getElementById('size').innerHTML);
		document.getElementById('theme').style.display="none";
		letheme(document.getElementById('theme').innerHTML);
		document.getElementById('alignement').style.display="none";
		texteAlignement(document.getElementById('alignement').innerHTML);
	</script>
	<?php include("vues/footer.php");	?>
</body>
