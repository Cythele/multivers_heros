<?php

class Vue{
    private $data =array();
    private $template=null;
    public function __construct($prefs){
        $this->__set("script_name", $prefs->script_name);
    }

    public function escape($string){
        return htmlspecialchars($string);
    }
    public function __set($index, $value) {
		    $this->data[$index]=$value;
    }

    public function __get($index) {
       return $this->data[$index];
    }

    public function setTemplate($template){
        $this->template=$template;
    }

    public function display($template=null){
        if($template!=null)
            $this->template= $template;
        if ($this->template==null)
            throw new Exception("Template is absent");
            include(__DIR__."/$this->template.php");
    }
}
?>
