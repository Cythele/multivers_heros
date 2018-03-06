<?php

class Router{
    private $routes =array();
    private $route;
    
    private $prefs;
    private $DefaultRoute;
    private $controller;
    
    public function __construct($prefs){
        $this->prefs=$prefs;
    }
    
    public function setRoute($route, $controller){
        if ($route=="") 
            return;
        $this->routes[$route]=$controller;
    }
    
    public function setRoutes($routes){
        foreach($routes as $route=>$controller) 
            $this->setRoute($route,$controller);
    }

    public function existRoute($route){
 
	foreach($this->routes as $KeyRoute=>$controller){
        if ($KeyRoute == $route)
			return true;
        } 
        return false;
	}
        
    public function setDefaultRoute($route){
           $this->DefaultRoute=$route;
    } 
    
    public function getDefaultRoute(){
        return $this->DefaultRoute;
    } 

    public function route($route){ 
        if(!$this->existRoute($route)) {
			$route=$this->getDefaultRoute(); 
        }
        $this->$route = $route;
        $model= new Modele($this->prefs); 
        $view= new Vue($this->prefs); 
        $controller= new $this->routes[$route]($model, $view,$this->prefs); 
        $controller->process($_REQUEST); 
    } 
    
    public function routeDefault(){
        $this->route($this->getDefaultRoute());        
    }
}
?>