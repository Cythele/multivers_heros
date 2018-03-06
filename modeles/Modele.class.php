<?php
class Modele{
    private $prefs;

  public function __construct($prefs){
      $this->prefs=$prefs;
  }

	public function getHistoires(){
      $db= $this->prefs->getDB();
      $res= $db->query("SELECT * FROM histoire");
      return $res;
    }

	public function getImagesJobs(){
    $db= $this->prefs->getDB();
    $res= $db->query("SELECT url_image FROM metier");
    return $res;
  }

  public function getNoms(){
    $db= $this->prefs->getDB();
    $res= $db->query("SELECT * FROM classe");
    return $res;
  }

  public function getDescClasse($classe){
    $db= $this->prefs->getDB();
    $res= $db->prepare("SELECT descriptionClasse FROM classe WHERE nomClasse=:nomClasse");
    $res->bindParam(':nomClasse', $classe);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function getImageMetier($metier){
    $db= $this->prefs->getDB();
    $res= $db->prepare("SELECT url_image FROM metier WHERE nomMetier=:metier");
    $res->bindParam(':metier', $metier);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function getimgRaceGenre($id_image){
    $db= $this->prefs->getDB();
    $res= $db->prepare("SELECT url_image FROM possede_image WHERE id_image=:id_image");
    $res->bindParam(':id_image', $id_image);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function getDescMetier($metier){
    $db= $this->prefs->getDB();
    $res= $db->prepare("SELECT descriptionMetier FROM metier WHERE nomMetier=:nomMetier");
    $res->bindParam(':nomMetier', $metier);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function getDescCompetences($nomCompetence){
      $db= $this->prefs->getDB();
      $res= $db->prepare("SELECT descriptionComp FROM competences WHERE nomCompetence=:nomCompetence");
      $res->bindParam(':nomCompetence', $nomCompetence);
      $res->execute();
      $data=$res->fetch(PDO::FETCH_ASSOC);
      return $data;
  }

  public function getForce($classe){
    $db= $this->prefs->getDB();
    $res= $db->prepare("SELECT laforce FROM classe WHERE nomClasse=:classe");
    $res->bindParam(':classe', $classe);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function getIntell($classe){
    $db= $this->prefs->getDB();
    $res= $db->prepare("SELECT intelligence FROM classe WHERE nomClasse=:classe");
    $res->bindParam(':classe', $classe);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function getDex($classe){
    $db= $this->prefs->getDB();
    $res= $db->prepare("SELECT dex FROM classe WHERE nomClasse=:classe");
    $res->bindParam(':classe', $classe);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function getApp($classe){
    $db= $this->prefs->getDB();
    $res= $db->prepare("SELECT apparence FROM classe WHERE nomClasse=:classe");
    $res->bindParam(':classe', $classe);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

public function getOrMetier($metier){
  $db= $this->prefs->getDB();
  $res= $db->prepare("SELECT nombreOr FROM metier WHERE nomMetier=:metier");
  $res->bindParam(':metier', $metier);
  $res->execute();
  $data=$res->fetch(PDO::FETCH_ASSOC);
  return $data;
}

public function getInfosMetier($metier,$carac){
  $db = $this->prefs->getDB();
  $res= $db->prepare("SELECT $carac FROM metier WHERE nomMetier=:metier");
  $res->bindParam(':metier', $metier);
  $res->execute();
  $data=$res->fetch(PDO::FETCH_ASSOC);
  return $data;
}

	public function getPVHumainMin(){
    $db= $this->prefs->getDB();
    $res= $db->query("SELECT borneInfVie FROM race WHERE nomRace='Humain'");
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
    }

	public function getPVHumainMax(){
      $db= $this->prefs->getDB();
      $res= $db->query("SELECT borneSupVie FROM race WHERE nomRace='Humain'");
      $data=$res->fetch(PDO::FETCH_ASSOC);
      return $data;
    }

	public function getManaHumainMin(){
      $db= $this->prefs->getDB();
      $res= $db->query("SELECT borneInfMana FROM race WHERE nomRace='Humain'");
      $data=$res->fetch(PDO::FETCH_ASSOC);
      return $data;
    }

	public function getManaHumainMax(){
      $db= $this->prefs->getDB();
      $res= $db->query("SELECT borneSupMana FROM race WHERE nomRace='Humain'");
      $data=$res->fetch(PDO::FETCH_ASSOC);
      return $data;
    }

	public function getIdUrl($urlImage){
    $db= $this->prefs->getDB();
		$res= $db->prepare("SELECT id_image FROM possede_image WHERE url_image=:urlImage");
		$res->bindParam('urlImage', $urlImage, PDO::PARAM_INT);
		$res->execute();
		$data=$res->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

	public function addPerso($nomRace,$id_paragraphe,$nomClasse,$nomMetier,$id_image,$prenom,$nom,$niveau,$genre,$type,$pointsManaTotal,$pointsVieTotal,$alignement,$forceTotal,$intelTotal,$dexTotal,$apparenceTotal,$defenseP,$defenseM,$orTotal){
		$db= $this->prefs->getDB();
		$st = $db->prepare("INSERT INTO personnage(nomRace,id_paragraphe,nomClasse,nomMetier,id_image,prenom,nom,niveau,genre,type,pointsManaTotal,pointsVieTotal,alignement,forceTotal,intelTotal,dexTotal,apparenceTotal,defenseP,defenseM,orTotal) VALUES (:nomRace,:id_paragraphe,:nomClasse,:nomMetier,:id_image,:prenom,:nom,:niveau,:genre,:type,:pointsManaTotal,:pointsVieTotal,:alignement,:forceTotal,:intelTotal,:dexTotal,:apparenceTotal,:defenseP,:defenseM,:orTotal)");
		$st->bindParam(':nom', $nom);
		$st->bindParam(':nomRace', $nomRace);
		$st->bindParam(':id_paragraphe', $id_paragraphe);
		//$st->bindParam(':id_inventaire', $id_inventaire);
		$st->bindParam(':nomClasse', $nomClasse);
		$st->bindParam(':nomMetier', $nomMetier);
		$st->bindParam(':id_image', $id_image);
		$st->bindParam(':prenom', $prenom);
		$st->bindParam(':niveau', $niveau);
		$st->bindParam(':type', $type);
		$st->bindParam(':genre', $genre);
		$st->bindParam(':pointsVieTotal', $pointsVieTotal);
		$st->bindParam(':pointsManaTotal', $pointsManaTotal);
		$st->bindParam(':alignement', $alignement);
		$st->bindParam(':forceTotal', $forceTotal);
		$st->bindParam(':intelTotal', $intelTotal);
		$st->bindParam(':dexTotal', $dexTotal);
		$st->bindParam(':apparenceTotal', $apparenceTotal);
		$st->bindParam(':defenseP', $defenseP);
		$st->bindParam(':defenseM', $defenseM);
		$st->bindParam(':orTotal', $orTotal);
		$st->execute();
		$_SESSION['lastid'] =  $db->lastInsertId();
	}

  public function addObjets($id_objet, $id_personnage,$qte){
    $db= $this->prefs->getDB();
    $st = $db->prepare("INSERT INTO possede_qte_objet(id_objet,id_personnage,qte) VALUES (:id_objet, :id_personnage,:qte)");
    $st->bindParam(':id_personnage', $id_personnage);
    $st->bindParam(':id_objet', $id_objet);
    $st->bindParam(':qte', $qte);
    $st->execute();
  }

  public function addPotion($nomPotion, $id_personnage,$qte){
    $db= $this->prefs->getDB();
    $st = $db->prepare("INSERT INTO perso_possede_potions(nomPotion,id_personnage,qte) VALUES (:id_personnage, :nomPotion,:qte)");
    $st->bindParam(':id_personnage', $id_personnage);
    $st->bindParam(':nomPotion', $nomPotion);
    $st->bindParam(':qte', $qte);
    $st->execute();
  }

  public function addArme($id_personnage,$nomArme,$qte){
    $db= $this->prefs->getDB();
    $st = $db->prepare("INSERT INTO perso_possede_arme(id_personnage,nomArme,qte) VALUES (:id_personnage,:nomArme,:qte)");
    $st->bindParam(':id_personnage', $id_personnage);
    $st->bindParam(':nomArme', $nomArme);
    $st->bindParam(':qte', $qte);
    $st->execute();
  }

  public function addArmure($id_personnage,$nomArmure,$qte){
    $db= $this->prefs->getDB();
    $st = $db->prepare("INSERT INTO perso_possede_armure(id_personnage,nomArmure,qte) VALUES (:id_personnage,:nomArmure,:qte)");
    $st->bindParam(':id_personnage', $id_personnage);
    $st->bindParam(':nomArmure', $nomArmure);
    $st->bindParam(':qte', $qte);
    $st->execute();
  }

	public function getIDParagraphe($id_personnage){
    $db= $this->prefs->getDB();
		$res= $db->prepare("SELECT id_paragraphe FROM personnage WHERE id_personnage=:id_personnage");
		$res->bindParam(':id_personnage', $id_personnage);
		$res->execute();
		$data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
   }

    public function getInfoPara($id_personnage){
      $db= $this->prefs->getDB();
  		$res= $db->prepare("SELECT paragraphe.id_paragraphe,contenu FROM personnage INNER JOIN paragraphe ON paragraphe.id_paragraphe = personnage.id_paragraphe WHERE id_personnage=:id_personnage");
  		$res->bindParam(':id_personnage', $id_personnage);
  		$res->execute();
  		$data=$res->fetch(PDO::FETCH_ASSOC);
      return $data;
    }

    public function getContenu($id_paragraphe){
      $db= $this->prefs->getDB();
      $res= $db->prepare("SELECT id_paragraphe, contenu FROM paragraphe WHERE id_paragraphe=:id_paragraphe");
      $res->bindParam(':id_paragraphe', $id_paragraphe);
      $res->execute();
      $data=$res->fetch(PDO::FETCH_ASSOC);
      return $data;
    }

	public function getParagraphe($id_paragraphe){ // le paragraphe depuis le para
		$db= $this->prefs->getDB();
		$res= $db->prepare("SELECT DISTINCT contenu, id_histoire FROM paragraphe NATURAL JOIN chapitre NATURAL JOIN personnage WHERE personnage.id_paragraphe=paragraphe.id_paragraphe");
		$res->bindParam('id_paragraphe', $id_paragraphe, PDO::PARAM_INT);
		$res->execute();
		$data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
	}

	public function getActions($id_paragraphe){ // les actions depuis le paragraphe
		$db= $this->prefs->getDB();
		$res= $db->prepare("SELECT contenu_action, id_paragraphe_suivant, propose_liste_actions.id_liste_action from propose_liste_actions INNER JOIN liste_actions on propose_liste_actions.id_liste_action = liste_actions.id_liste_action WHERE propose_liste_actions.id_paragraphe =:id_paragraphe");
		$res->bindParam('id_paragraphe', $id_paragraphe, PDO::PARAM_INT);
		$res->execute();
	  $data=[];
    for($i = 0; $i<$res->rowCount();$i+=1) {
	     $data[$i]=$res->fetch(PDO::FETCH_ASSOC);
    }
    return $data;
	}

  public function getParafromAction($id_liste_action){ // laction recupere depuis le paragraphe
		$db= $this->prefs->getDB();
		$res= $db->prepare("SELECT id_liste_action, paragraphe.id_paragraphe, contenu,id_paragraphe_suivant FROM Paragraphe INNER JOIN propose_liste_actions ON Paragraphe.id_paragraphe = propose_liste_actions.id_paragraphe WHERE  Paragraphe.id_paragraphe=:id_liste_action;");
		$res->bindParam('id_liste_action', $id_liste_action);
		$res->execute();
    return $data;
	}

	public function getNameParagraphe($id_paragraphe){ // récupérer le nom du paragraphe
		$db= $this->prefs->getDB();
		$res= $db->prepare("SELECT chapitre.id_chapitre, nom_chapitre from chapitre INNER JOIN chapitre_contient_paragraphe WHERE id_paragraphe=:id_paragraphe");
		$res->bindParam('id_paragraphe', $id_paragraphe, PDO::PARAM_INT);
		$res->execute();
		$data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
	}

	public function getImageUrl($id_personnage){
    $db= $this->prefs->getDB();
		$res= $db->prepare("SELECT url_image FROM possede_image INNER JOIN personnage ON possede_image.id_image=personnage.id_image WHERE id_personnage=:id_personnage");
		$res->bindParam(':id_personnage', $id_personnage);
		$res->execute();
		$data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
   }

	public function getIPerso(){
    $db= $this->prefs->getDB();
		$res= $db->prepare("SELECT id_personnage, url_image, personnage.id_image, nom,prenom,niveau,personnage. genre FROM Personnage INNER JOIN possede_image ON personnage.id_image=possede_image.id_image");
		$res->execute();
    return $res;
   }

	public function getInfoPerso($id_personnage){
    $db= $this->prefs->getDB();
		$res= $db->prepare("SELECT id_personnage, nom, prenom,niveau,personnage.nomRace,personnage.nomClasse,nomMetier,personnage.genre,url_image,pointsVieTotal,pointsManaTotal,alignement,forceTotal,intelTotal,dexTotal,apparenceTotal,defenseP,orTotal,defenseM FROM Personnage INNER JOIN possede_image ON possede_image.id_image = personnage.id_image WHERE id_personnage=:id_personnage");
		$res->bindParam(':id_personnage', $id_personnage);
		$res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
   }

    public function savePara($paraEnCours, $id_personnage){
      $db= $this->prefs->getDB();
      $res=$db->prepare("UPDATE personnage set id_paragraphe=:id_paragraphe WHERE personnage.id_personnage=:id_personnage");
      $res->bindParam(':id_personnage', $id_personnage);
      $res->bindParam(':id_paragraphe', $paraEnCours);
      $res->execute();
    }

	public function getStuffPerso($id_personnage){
	    $db= $this->prefs->getDB();
	    $res= $db->prepare("SELECT distinct url_image_objet, objet.id_objet, nomObjet, qte, descriptionObjet, poidsObjet from Objet INNER JOIN objet_possede_image ON objet_possede_image.id_objet=objet.id_objet INNER JOIN possede_qte_objet ON possede_qte_objet.id_objet = objet.id_objet INNER JOIN Personnage ON Personnage.id_personnage = possede_qte_objet.id_personnage WHERE Personnage.id_personnage=:id_personnage");
      $res->bindParam(':id_personnage', $id_personnage);
		  $res->execute();
      return $res;
	}

  public function getArmePerso($id_personnage){
      $db= $this->prefs->getDB();
      $res= $db->prepare("SELECT arme.nomArme, descriptionArme, url_image_arme, poids FROM arme INNER JOIN perso_possede_arme ON arme.nomArme=perso_possede_arme.nomArme INNER JOIN personnage ON personnage.id_personnage=perso_possede_arme.id_personnage WHERE perso_possede_arme.id_personnage=:id_personnage");
      $res->bindParam(':id_personnage', $id_personnage);
      $res->execute();
      return $res;
  }

  public function getArmurePerso($id_personnage){
      $db= $this->prefs->getDB();
      $res= $db->prepare("SELECT armure.nomArmure, descriptionArmure, url_image_armure, poids FROM armure INNER JOIN perso_possede_armure ON armure.nomArmure=perso_possede_armure.nomArmure INNER JOIN personnage ON personnage.id_personnage=perso_possede_armure.id_personnage WHERE perso_possede_armure.id_personnage=:id_personnage");
      $res->bindParam(':id_personnage', $id_personnage);
      $res->execute();
      return $res;
  }

  public function getPotions($id_personnage){
	    $db= $this->prefs->getDB();
      $res= $db->prepare("SELECT DISTINCT potion.nomPotion, effetPotion, qte,url_image FROM perso_possede_potions INNER JOIN Potion ON perso_possede_potions.nomPotion=Potion.nomPotion INNER JOIN Personnage ON perso_possede_potions.id_personnage=:id_personnage");
      $res->bindParam(':id_personnage', $id_personnage);
		  $res->execute();
      return $res;
  }

	public function getAttaquesPerso($id_personnage){
	  $db= $this->prefs->getDB();
		$res= $db->prepare("SELECT distinct nomAttaque, descriptionAttq FROM attaques INNER JOIN classe on attaques.nomClasse = classe.nomClasse INNER JOIN metier INNER JOIN personnage ON personnage.nomClasse=attaques.nomClasse WHERE personnage.id_personnage=:id_personnage");
		$res->bindParam(':id_personnage', $id_personnage);
		$res->execute();
    return $res;
	}

	public function getInfosObjets($nomObjet){
	  $db= $this->prefs->getDB();
		$res= $db->prepare("select * from Objet INNER JOIN objet_possede_image ON Objet.id_objet=objet_possede_image.id_objet WHERE nomObjet=:nomObjet");
		$res->bindParam(':nomObjet', $nomObjet);
		$res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
	}

  public function objetModif($id_objet,$id_personnage, $qte){
	  $db=$this->prefs->getDB();
    $res=$db->prepare("update possede_qte_objet set possede_qte_objet.qte=:qte WHERE possede_qte_objet.id_personnage=:id_personnage and possede_qte_objet.id_objet=:id_objet");
    $res->bindParam(':id_objet', $id_objet);
    $res->bindParam(':qte', $qte);
    $res->bindParam(':id_personnage', $id_personnage);
		$res->execute();
    return $res;
	}

  public function potionModif($nomPotion,$id_personnage, $qte){
	  $db=$this->prefs->getDB();
    $res=$db->prepare("UPDATE perso_possede_potions set qte=:qte WHERE id_personnage=:id_personnage and nomPotion=:nomPotion");
    $res->bindParam(':nomPotion', $nomPotion);
    $res->bindParam(':qte', $qte);
    $res->bindParam(':id_personnage', $id_personnage);
		$res->execute();
    return $res;
	}

  public function deleteObjet($id_objet,$id_personnage){
    $db=$this->prefs->getDB();
    $res=$db->prepare("delete from possede_qte_objet WHERE id_objet=:id_objet and id_personnage=:id_personnage");
    $res->bindParam(':id_objet', $id_objet);
    $res->bindParam(':id_personnage', $id_personnage);
    $res->execute();
    return $res;
  }

  public function deletePotions($nomPotion,$id_personnage){
    $db=$this->prefs->getDB();
    $res=$db->prepare("DELETE from perso_possede_potions WHERE nomPotion=:nomPotion AND id_personnage=:id_personnage");
    $res->bindParam(':nomPotion', $nomPotion);
    $res->bindParam(':id_personnage', $id_personnage);
    $res->execute();
    return $res;
  }

  public function checkConditionRelation($id_paragraphe){
    $db=$this->prefs->getDB();
    $res=$db->prepare("SELECT COUNT(action_condition_relation.id_action_cond), propose_liste_actions.id_liste_action FROM propose_liste_actions INNER JOIN action_condition_relation ON action_condition_relation.id_liste_action=propose_liste_actions.id_liste_action WHERE id_paragraphe=:id_paragraphe");
    $res->bindParam(':id_paragraphe', $id_paragraphe);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    if($data['COUNT(action_condition_relation.id_action_cond)']==0){return false;}
    else {return true;}
  }

  // On cherche le pnj selectionne dans la condition (recuperer id de la condition)
  public function searchConditionRelation($id_paragraphe){
    $db=$this->prefs->getDB();
    $res=$db->prepare("SELECT id_action_cond FROM propose_liste_actions INNER JOIN action_condition_relation ON action_condition_relation.id_liste_action=propose_liste_actions.id_liste_action WHERE id_paragraphe=:id_paragraphe");
    $res->bindParam(':id_paragraphe', $id_paragraphe);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  // Le taux de relation en fonction de l'id de la condition
  public function searchTauxRelation($id_condition_rel){
    $db=$this->prefs->getDB();
    $res=$db->prepare("SELECT taux_relation,perso_concerne FROM condition_relation WHERE id_condition_rel=:id_condition_rel");
    $res->bindParam(':id_condition_rel', $id_condition_rel);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function searchTauxRelationActuel($id_personnage,$id_personnageRelation){
    $db=$this->prefs->getDB();
    $res=$db->prepare("SELECT tauxRelation from peut_sociabiliser WHERE id_personnage=:id_personnage AND id_personnage_relation=:id_personnageRelation; ");
    $res->bindParam(':id_personnage', $id_personnage);
    $res->bindParam(':id_personnageRelation', $id_personnageRelation);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function searchParawithCondition($id_condition_rel){
    $db=$this->prefs->getDB();
    $res=$db->prepare("SELECT id_para_suivant from condition_relation WHERE id_condition_rel=:id_condition_rel");
    $res->bindParam(':id_condition_rel', $id_condition_rel);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function actionConsequence($id_liste_action){
    $db=$this->prefs->getDB();
    $res=$db->prepare("SELECT modificateur_relation, id_pnj_concerne FROM action_consequence WHERE id_liste_action=:id_liste_action");
    $res->bindParam(':id_liste_action', $id_liste_action);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function updateRelations($id_personnage, $id_personnage_relation,$relationCons){
    $db=$this->prefs->getDB();
    $res=$db->prepare("REPLACE INTO peut_sociabiliser(id_personnage,id_personnage_relation,tauxRelation) VALUES ($id_personnage,$id_personnage_relation,$relationCons)");
    $res->execute();
  }

  public function peutsociabiliser($id_personnage, $id_personnage_relation){
      $db=$this->prefs->getDB();
      $res=$db->prepare("SELECT id_personnage, id_personnage_relation, tauxRelation FROM peut_sociabiliser WHERE id_personnage=:id_personnage AND id_personnage_relation=:id_personnage_relation");
      $res->bindParam(':id_personnage', $id_personnage);
      $res->bindParam(':id_personnage_relation', $id_personnage_relation);
      $res->execute();
      $data=$res->fetch(PDO::FETCH_ASSOC);
      return $data;
  }


    public function getAllSociabiliser($id_personnage){
      $db=$this->prefs->getDB();
      $res=$db->prepare("SELECT * FROM peut_sociabiliser WHERE id_personnage=:id_personnage");
      $res->bindParam(':id_personnage', $id_personnage);
      $res->execute();
      $data=$res->fetch(PDO::FETCH_ASSOC);
      return $data;
    }

    public function tmpTable(){
      $db=$this->prefs->getDB();
      $res= $db->query("SHOW TABLES LIKE 'social_tmp' ");
      $data=$res->fetch(PDO::FETCH_ASSOC);
      if ($data!=false) {return true;}
        else { return false; }
        return $res;
      }

  public function couple_relation($id_personnage,$id_personnage_relation,$taux_relation){
    $db=$this->prefs->getDB();
    $res=$db->prepare("SELECT id_personnage, id_personnage_relation, taux_relation FROM social_tmp WHERE id_personnage=:id_personnage AND id_personnage_relation=:id_personnage_relation");
    $res->bindParam(':id_personnage', $id_personnage);
    $res->bindParam(':id_personnage_relation', $id_personnage_relation);
    $res->execute();
    $data=$res->fetch(PDO::FETCH_ASSOC);
    if ($data!=false) {
      $resRel=$db->query("SELECT taux_relation FROM social_tmp WHERE id_personnage=$id_personnage AND id_personnage_relation=$id_personnage_relation");
      $dataRel=$resRel->fetch(PDO::FETCH_ASSOC);
      $dataRelint=(int)$dataRel['taux_relation'];
      $taux_relationint=(int)$taux_relation;
      $resRelation=$dataRelint+$taux_relationint;
      $stmt = $db->query("UPDATE social_tmp set id_personnage=$id_personnage,id_personnage_relation=$id_personnage_relation,taux_relation=$resRelation WHERE id_personnage=$id_personnage AND id_personnage_relation=$id_personnage_relation");
      $stmt->execute();
      return true;
    }
    else {
        $stmt = $db->prepare("INSERT INTO social_tmp(id_personnage,id_personnage_relation,taux_relation) VALUES (:id_personnage,:id_personnage_relation,:taux_relation)");
        $stmt->bindParam(':id_personnage', $id_personnage);
        $stmt->bindParam(':id_personnage_relation', $id_personnage_relation);
        $stmt->bindParam(':taux_relation', $taux_relation);
        $stmt->execute();
    }
    return $res;
  }
}
?>
