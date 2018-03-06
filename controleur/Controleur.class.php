<?php

abstract class Controleur{
    public $model;
    public $prefs;
    public $view;
    /* getters et setters */
    public function __construct($model,$view,$prefs){
  		$this->model = $model;
  		$this->prefs=$prefs;
  		$this->view = $view;
    }
    public abstract function process($request);
}

?>
