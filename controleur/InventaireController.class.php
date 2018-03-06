<?php
if(!isset($_SESSION)){
  session_start();
}
  class InventaireController extends Controleur{
    public function process($request){
  		if(isset($_GET['id_personnage'])){
  			$id_personnage=$_GET['id_personnage'];
  			$_SESSION['id_personnage'] =$id_personnage;
  	}

    function contains($search, $tabInit){
        foreach($tabInit as $key => $value){
          if($search == $key){ return true;}
        }
        return false;
    }

    function updateBase($tabInit,$tabModifs, $self){
      //echo $_SESSION['pnj_affecte'];

      //$self->view->objetModif = $self->model->updateRelations($_SESSION['id_personnage'], $_SESSION['pnj_affecte'], $_SESSION['taux_relation']);
      foreach($tabInit as $key => $value){
        if(contains($key,$tabModifs)){
          $qte=$tabModifs[$key][1];
          $self->view->objetModif = $self->model->potionModif($key,$_SESSION['id_personnage'], $qte);
        }
        else{
          $self->view->deleteObjet = $self->model->deletePotions($key,$_SESSION['id_personnage']);
        }
      }
      if(isset($tabModifs)){
        foreach($tabModifs as $key => $value){
          //echo "nouvel item à insérer dans la bd <br>";
        }
      }
      else {
        echo"pas d'ajouts <br>";
      }
    }




		if(isset($request['formOptions'])){ // sauvegarde
      $tabInitPotions=$_SESSION['tableauPotionInit'];
      $tabModifsPotion=$_SESSION['tableauPotion'];
      $copiePotions=$tabModifsPotion;
      updateBase($_SESSION['tableauPotionInit'], $copiePotions, $this);
      // changer le paragraphe
      $paraEnCours=$_SESSION['idparaEnCours'];
      $this->view->savePara = $this->model->savePara($paraEnCours, $id_personnage);
    }

    // Quand on a consommé la potion elle disparait du tableau
		if(isset($request['objet'])){ // Clic sur un objet (consomme)
			$name=$request['objet'];
			$this->view->getInfosObjets = $this->model->getInfosObjets($request['objet']); // old
      if($name=="Potion de vie" || $name=="Potion de mana"){
       if(isset($_SESSION['tableauPotion'][$name])){ // cas où on rafraichit la page
        $_SESSION['tableauPotion'][$name][1]-=1;
        // si on est tombé à 0 alors on supprime
        if($_SESSION['tableauPotion'][$name][1]<=0){
           unset($_SESSION['tableauPotion'][$name]);
        }
      }
     } else{
       echo "c'est de l'équipement";
     }
		}
		//$this->view->getStuffPerso = $this->model->getStuffPerso($id_personnage);
    $this->view->getPotions = $this->model->getPotions($id_personnage);
    $this->view->getArmes = $this->model->getArmePerso($id_personnage);
    $this->view->getArmure = $this->model->getArmurePerso($id_personnage);

		$this->view->informationsPerso = $this->model->getInfoPerso($id_personnage);
		$this->view->getAttaquesPerso = $this->model->getAttaquesPerso($id_personnage);

		$this->view->display('inventaire');

    /* sauvegarde
    if(isset($request['objet'])){ // Clic sur un objet (consomme)
			$name=$request['objet'];
      echo "id de lobjet:".$id_objet;
			$this->view->getInfosObjets = $this->model->getInfosObjets($request['objet']); // old
      //if name == potion de mana/de vie...
      if($name=="Potion de vie" || $name=="Potion de mana"){

       if(isset($_SESSION['tableauObjets'][$id_objet])){ // cas où on rafraichit la page
        $_SESSION['tableauObjets'][$id_objet][1]-=1;
        // si on est tombé à 0 alors on supprime
        if($_SESSION['tableauObjets'][$id_objet][1]<=0){
           unset($_SESSION['tableauObjets'][$id_objet]);
        }
      }
     } else{
       echo "c'est de l'équipement";
     }
		}
    */
		//$this->view->getStuffPerso = $this->model->getStuffPerso($id_personnage);
		//$this->view->informationsPerso = $this->model->getInfoPerso($id_personnage);
    }
}
?>
