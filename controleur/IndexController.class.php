<?php

class IndexController extends Controleur{
    public function process($request){
		    $this->view->noms = $this->model->getNoms();
		    $this->view->display('accueil');
    }
}
?>
