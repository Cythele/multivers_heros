<?php
  $page_title="Inventaire";
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
	<h1 id="titreCharge"><a href="index.php"><img alt="Le multivers des héros" src="style/img/logo2.png"></a></h1><?php echo "<p id='size'>$size</p>"; ?><?php echo "<p id='theme'>$theme</p>"; ?><?php echo "<p id='alignement'>$alignement</p>"; ?>
	<div id="objetsAttaquesRelations">
		<div id="choixActions">
			<form action="#" id='formOptions' method="post" name="formOptions">
				<input class='choixActions' id="sauvegarder" name="formOptions" type="submit" value="Sauvegarder"> <?php echo "<a class='choixActions' href='$this->script_name?action=chargerPartie'> Charger </a>"; ?> <?php echo "<a class='choixActions' href='$this->script_name?action=options'> Options </a>"; ?> <?php echo "<a class='choixActions' href='$this->script_name?action=index'> Quitter </a>"; ?>
			</form><!-- Dans un cas on a le paragraphe en cours dans l'autre non dans l'url non...
                Dc si le paragraphe en cours (session)> a 1 l'url change. -->
			<?php
				if($_SESSION['idparaEnCours']>1){
					$para=$_SESSION['idparaEnCours'];
					echo "<a class='retoursHistoire' href='$this->script_name?action=histoireEnCours&id_paragraphe=$id_personnage&id_paragraphe_suivant=$para'> Retour histoire </a>";
				}
				else{
					echo "<a class='retoursHistoire' href='$this->script_name?action=histoireEnCours&id_personnage=$id_personnage'> Retour histoire </a>";
				}
				?>
			<h1>Inventaire</h1>
			<form action="#" id="formInventaire" method="post" name="formInventaire">
				<?php
					echo "<br>";
					foreach($_SESSION['tableauPotion'] as $key => $value){ // Les potions
						echo "<div class='lesObjets'>";
						echo '<img src="'.$value[0].'"     alt="image'.$key.'"     height="50" width="50" />';
						echo "<br> Objet : ".$key;
						echo "<br> Quantité : ".$value[1];
						echo "<br> Effet : ".$value[2];
						echo "<br> <button name='objet' value='$key'> ";
						echo "Utiliser";
						echo "</button> <br> ";
						echo "</div>";
					}
					foreach($this->getArmes as $row){ // Les armes
						echo "<div class='lesObjets'>";
						echo '<img src="'.$row['url_image_arme'].'" alt="image'.$row['nomArme'].'" height="50" width="50" />';
						echo "<br>";
						echo $row['nomArme'];
						echo "<br>";
						echo $row['descriptionArme'];
						echo "<br>";
						echo "Poids :".$row['poids'];
						echo "<br>";
						echo "</div>";
					}
					foreach($this->getArmure as $row){ // Les armures
						echo "<div class='lesObjets'>";
						echo '<img src="'.$row['url_image_armure'].'" alt="image'.$row['nomArmure'].'" height="50" width="50" />';
						echo "<br>";
						echo $row['nomArmure'];
						echo "<br>";
						echo $row['descriptionArmure'];
						echo "<br>";
						echo "Poids :".$row['poids'];
						echo "<br>";
						echo "</div>";
					}
				?>
				<div id="blocDescObjet">
				</div>
			</form><!--<h2> Attaques connues </h2>-->
			<?php /*
				foreach($this->getAttaquesPerso as $row){ // Les attaques
					echo "<div class='attaques'>";
					echo "<p>  ";
					echo "$row[nomAttaque]";
					echo ". Effet :   ";
					echo "$row[descriptionAttq]";
					echo "</p>";
					echo "</div>";
				}*/
			?>
		</div>
		<hr>
		<div id="infosPerso">
			<h2>Personnage</h2>
			<div id="perso">
				<img alt="avatar du personnage" height="150" src="<?php echo $this->informationsPerso['url_image']; ?>" width="150"> <?php
					echo " <p> ".$this->informationsPerso['prenom'];
					echo "  ".$this->informationsPerso['nom'];
					echo "</p>";
					echo " <p> ".$this->informationsPerso['nomRace'];
					echo " Niveau ".$this->informationsPerso['niveau'];
					echo "</p>";
					echo "  <p> ".$this->informationsPerso['nomClasse'];
					echo " ".$this->informationsPerso['nomMetier'];
					echo "</p>";
					echo "</div>";
					echo "<div id='stat'>";
					echo "<h3> Statistiques </h3>";
					echo " PV : ".$this->informationsPerso['pointsVieTotal'];
					echo "<br>";
					echo " PM : ".$this->informationsPerso['pointsManaTotal'];
					echo "<br>";
					echo " Force : ".$this->informationsPerso['forceTotal'];
					echo "<br>";
					echo " Intel : ".$this->informationsPerso['intelTotal'];
					echo "<br>";
					echo " dex : ".$this->informationsPerso['dexTotal'];
					echo "<br>";
					echo " Apparence : ".$this->informationsPerso['apparenceTotal'];
					echo "<br>";
					echo " Defense physique : ".$this->informationsPerso['defenseP'];
					echo "<br>";
					echo " Defense magique : ".$this->informationsPerso['defenseM'];
					echo "<br>";
					echo " Quantité or :  : ".$this->informationsPerso['orTotal'];
					echo "</div>";
					?>
			</div>
			<script>
				document.getElementById("blocDescObjet").style.display = "none";
				// afficher dans le bloc de description et equiper...
				function myFunction(event) {
					event.preventDefault();
					if (event.which == 13){
						alert('clic sur entree');
						document.getElementById("formInventaire").submit();
					}
					if(event.which == 101){
						alert('clic sur E!') // equiper
					}
					//document.getElementById("formInventaire").submit();
				}
			</script>
		</div>
		<ul>
			<li class="invisible">
				<a class="navlinkInventaire" href="#" title="Retours haut de page">Retours en haut de la page</a>
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
		<?php include("vues/footer.php"); ?>
	</div>
</body>
</html>
