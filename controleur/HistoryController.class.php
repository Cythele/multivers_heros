<?php

class HistoryController extends Controleur{
    public function process($request){
		    $this->view->histoire = $this->model->getHistoires();
		      $this->view->display('histoireChoix');
    }
}
?>
