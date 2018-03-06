<?php

class OptionsController extends Controleur{
    public function process($request){
  		$this->view->noms = $this->model->getNoms();
  		$this->view->display('options');
    }
}
?>
