<?php

class ChargerPartieController extends Controleur{
    public function process($request){
  		$this->view->allID = $this->model->getIPerso();
  		$this->view->display('chargerPartie');
    }
}
?>
