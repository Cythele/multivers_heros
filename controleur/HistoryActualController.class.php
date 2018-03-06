<?php
  class HistoryActualController extends Controleur{
    public function process($request){
		if(!isset($_SESSION)){
			session_start();
		}
  		// Si on a posté le formulaire creerPerso alors on créer le personnage
  		if(isset($request['firstName'])){
        $_SESSION['vie']=$_COOKIE['vie'];
        $pointsVieTotal=$_COOKIE['vie'];

        $_SESSION['mana']=$_COOKIE['mana'];
        $PointsManaTotal=$_COOKIE['mana'];

        $_SESSION['force']=$_COOKIE['Force'];
        $forceTotal=$_COOKIE['Force'];

  			$_SESSION['intelligence']=$_COOKIE['Intelligence'];
  			$intelTotal=$_COOKIE['Intelligence'];

  			$_SESSION['apparence']=$_COOKIE['apparence'];
  			$apparenceTotal=$_COOKIE['apparence'];

  			$_SESSION['dex']=$_COOKIE['Dexterite'];
  			$dexTotal=$_COOKIE['Dexterite'];

  			$_SESSION['or']=$_COOKIE['Or'];
  			$orTotal=$_COOKIE['Or'];

  			$_SESSION['inputURL']=$_COOKIE['url'];

  			if (isset($request['or'])){
  				$_SESSION['or'] = $request['or'];
  				$or=$request['or'];
  			}

  			if (isset($request['firstName'])){
  				$_SESSION['firstName'] = $request['firstName'];
  				$prenom=$request['firstName'];
  			}
  			if (isset($request['name'])){
  				$_SESSION['name'] = $request['name'];
  				$nom=$request['name'];
  			}
  			if (isset($request['genre'])){
  				$_SESSION['genre'] = $request['genre'];
  				$genre= $request['genre'];
  			}
  			if (isset($request['race'])){
  				$_SESSION['race'] = $request['race'];
  				$nomRace= $request['race'];
  			}
  			if (isset($request['classe'])){
  				$_SESSION['classe'] = $request['classe'];
  				$nomClasse= $request['classe'];
  			}

  			if (isset($request['metier'])){
  				$_SESSION['metier'] = $request['metier'];
  				$nomMetier= $request['metier'];
  			}

  			$rest = substr($_SESSION['inputURL'], -33);
  			$mana = substr($_SESSION['mana'],0, -14);
  			$vie = substr($_SESSION['vie'],0, -13);

  			$this->view->getIdUrl = $this->model->getIdUrl($rest);

  			$this->view->noms = $this->model->getIdUrl($rest);
  			$data=$this->model->getIdUrl($rest);

  			$pointsVieTotal=$vie;
  			$pointsManaTotal=$mana;
  			$URLimageID=$this->view->getIdUrl["id_image"];

  			$niveau=1;
  			$type='pj';
  			$alignement=0;
  			$defenseP=2;
  			$defenseM=2;

  			$id_paragraphe=1;
  			$id_image=$URLimageID;

  			if($genre=="homme"){ $genre='H'; }
  			else if($genre=='femme'){ $genre='F'; }
  			else{ $genre='N'; }

			$orTotal = substr($orTotal, 1,-4);
			$qte=1;

  			$this->view->getIdUrl = $this->model->addPerso($nomRace,$id_paragraphe,$nomClasse,$nomMetier,$id_image,$prenom,$nom,$niveau,$genre,$type,$pointsVieTotal,$pointsManaTotal,$alignement,$forceTotal,$intelTotal,$dexTotal,$apparenceTotal,$defenseP,$defenseM,$orTotal);
			$id_personnage=$_SESSION['lastid'];
			$_SESSION['id_personnage']=$id_personnage;

			if($nomClasse=='assassin'){
			  $this->view->getIdUrl = $this->model->addArme($id_personnage,"Dague",$qte);
			  $this->view->getIdUrl = $this->model->addPotion($id_personnage,"Potion de vie",$qte);
			  $this->view->getIdUrl = $this->model->addArmure($id_personnage,"Tunique de cuir",$qte);
			}
			else if($nomClasse=='guerrier'){
			  $this->view->getIdUrl = $this->model->addArmure($id_personnage,"Plastron en maille",$qte);
			  $this->view->getIdUrl = $this->model->addArme($id_personnage,"Epée en fer",$qte);
			  $this->view->getIdUrl = $this->model->addPotion($id_personnage,"Potion de vie",$qte);
			}
			else{ // mage
			  $this->view->getIdUrl = $this->model->addArmure($id_personnage,"Robe de mage",$qte);
			  $this->view->getIdUrl = $this->model->addArme($id_personnage,"Baton de mage",$qte);
			  $this->view->getIdUrl = $this->model->addPotion($id_personnage,"Potion de mana",$qte);
			}

				if(!isset($_GET['id_paragraphe_suivant'])){
					$id_para_suivant=1;
			  $variable['id_paragraphe']=1;
			  $this->view->getInfoPara = $this->model->getInfoPara($id_personnage);
				}
				else{
					 $id_para_suivant=$_GET['id_paragraphe_suivant'];
			   $variable['id_paragraphe']=1;
			   $this->view->getInfoPara = $this->model->getInfoPara($id_personnage);
				}
  		}
  		/* On ne vient pas de crééer son personnage (donc il faut récupérer l'identifiant puisqu'on l'a chargé  */
  		else{
  			if(!isset($_GET['id_paragraphe_suivant'])){ // on arrive sur la page dc charger ds bd
				$id_personnage=$_GET['id_personnage'];
				$_SESSION['id_personnage']=$id_personnage;
				$variable = $this->model->getInfoPara($id_personnage); // id_para et contenu
				$this->view->getInfoPara =$variable;

				if($this->model->checkConditionRelation($variable['id_paragraphe'])){ // s'il existe une condition sur ce paragraphe
					$id_condition_rel = $this->model->searchConditionRelation($variable['id_paragraphe']);
					// recuperer le taux de relation de la checkCondition
					$tauxRelation = $this->model->searchTauxRelation($id_condition_rel['id_action_cond']);
					$tauxRelation['taux_relation'];
					$tauxRelation['perso_concerne'];
					// recuperer le taux de la relation actuel entre le joueur et le pnj
					$id_personnage = $_SESSION['id_personnage'];
					$tauxRelationActuel = $this->model->searchTauxRelationActuel($id_personnage,$tauxRelation['perso_concerne']);
					$tauxRelActuel = $tauxRelationActuel['tauxRelation'];
					// si la condition se valide alors le paragraphe suivnt n'est plus le mm
					if($tauxRelActuel>=$tauxRelation['taux_relation']){
						echo "la condition se vérifie on cherche le paragraphe à afficher ";
						// donc le paragraphe depend de l id condition relation
						$paraAafficher = $this->model->searchParawithCondition($id_condition_rel['id_action_cond']);
						$variable = $this->model->getContenu($paraAafficher['id_para_suivant']);
						$this->view->getInfoPara =$variable;
					}
					else {
					//echo "la condition ne se verifie pas";
					}
				}
				else{ //echo "pas de condition";
				}
			}
  			else{
				$variable = $this->model->getContenu($_GET['id_paragraphe_suivant']);
				if($this->model->checkConditionRelation($variable['id_paragraphe'])){ // s'il existe une condition sur ce paragraphe
					$id_condition_rel = $this->model->searchConditionRelation($variable['id_paragraphe']);
					// recuperer le taux de relation de la checkCondition
					$tauxRelation = $this->model->searchTauxRelation($id_condition_rel['id_action_cond']);
					$tauxRelation['taux_relation'];
					$tauxRelation['perso_concerne'];
					// recuperer le taux de la relation actuel entre le joueur et le pnj
					$id_personnage = $_SESSION['id_personnage'];
					$tauxRelationActuel = $this->model->searchTauxRelationActuel($id_personnage,$tauxRelation['perso_concerne']);
					$tauxRelActuel = $tauxRelationActuel['tauxRelation'];

					echo "le taux de relation actuel : ".$tauxRelActuel;
					// si la condition se valide alors le paragraphe suivnt n'est plus le mm
					if($tauxRelActuel>=$tauxRelation['taux_relation']){
						echo "la condition se vérifie on cherche le paragraphe à afficher ";
						// donc le paragraphe depend de l id condition relation
						$paraAafficher = $this->model->searchParawithCondition($id_condition_rel['id_action_cond']);
						echo "le numéro du para :".$paraAafficher['id_para_suivant'];
						$variable = $this->model->getContenu($paraAafficher['id_para_suivant']);
						$this->view->getInfoPara =$variable;
					}
					else{
						 
					}
				}
				else{  }
				$this->view->getInfoPara =$variable;
  			}
  		}
        $actions = $this->model->getActions($variable['id_paragraphe']); // les actions liées au para
        $this->view->actionsTest =$actions;
  		if(!isset($_GET['id_personnage'])){ // chargement de perso premiere fois sur la page
  			$id_personnage=$_SESSION['id_personnage'];
  		}
  		else{
  			$id_personnage=$_GET['id_personnage'];
  		}
        if(!isset($initRelations)){
          $initRelations=[];
        }
        if(isset($_GET['id_action'])){
			$id_liste_action=$_GET['id_action'];
			$relationCons=$this->model->actionConsequence($id_liste_action);
			$rel_pnj=$relationCons['id_pnj_concerne'];
			$taux_relation=$relationCons['modificateur_relation'];
			if($rel_pnj>0){ // il y a une consequence
				// On va dabord chercher la valeur dans peut_sociabiliser
				$getRelation = $this->model->peutsociabiliser($id_personnage, $rel_pnj);
				$taux_relation_base = $getRelation['tauxRelation'];
				if($taux_relation_base==NULL){ // on a pas encore de relation il faut la creer
				  // inserer ce couple dans la table "temporaire" sil nexiste pas
				  $couple_relation=$this->model->couple_relation($id_personnage,$rel_pnj,$taux_relation);
				}
				else{ // la relation existe deja il faut modifier le taux de relation
				  echo "il faut ajouter les consequences entre elles";
				  $ajout_relation=$this->model->ajout_relation($id_personnage,$rel_pnj,$taux_relation_base);
				}
          }
        }
  		$this->view->getNameParagraphe = $this->model->getNameParagraphe($variable['id_paragraphe']);
  		$this->view->getImageUrl = $this->model->getImageUrl($id_personnage);
  		$this->view->getStuffPerso = $this->model->getStuffPerso($id_personnage);
		$this->view->getPotions = $this->model->getPotions($id_personnage);
		function array_push_assoc($array, $key, $nomObjet, $qte, $url_image_objet){ // ajout de l'url de l'image
        $array[$key]=array( $nomObjet,$qte, $url_image_objet);
        return $array;
		}
		$initObjets=[];
		foreach($this->model->getStuffPerso($id_personnage) as $row){ // a chaque resultat (objet) on stocke ses valeurs (nom, qute)
			$nomObjet = $row['nomObjet'];
			$url_image_objet = $row['url_image_objet'];
			$qte = $row['qte'];
			$id_objet = $row['id_objet'];
			$initObjets = array_push_assoc($initObjets, $id_objet, $nomObjet,$qte, $url_image_objet);
		}
		$_SESSION['tableauObjets']=$initObjets;
		$_SESSION['tableauObjetsinit']=$initObjets;
		/* Les potions  */
		$initPotions=[];
		foreach($this->model->getPotions($id_personnage) as $row){ // a chaque resultat (objet) on stocke ses valeurs (nom, qute)
			$nomPotion = $row['nomPotion'];
			$url_image_potion = $row['url_image'];
			$qte = $row['qte'];
			$description = $row['effetPotion'];
			$initPotions = array_push_assoc($initPotions, $nomPotion, $url_image_potion,$qte,$description);
		}
		if(!isset($_SESSION['tableauPotion'])){
			$_SESSION['tableauPotion']=$initPotions;
			$_SESSION['tableauPotionInit']=$initPotions;
		}
		$this->view->display('histoireEnCours');
	}
  }
?>
