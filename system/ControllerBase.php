<?php


/**
 * Description of ControllerBase
 *
 * @author toni
 */
class ControllerBase {
    
    protected $model;
    protected $view;
    protected $config;
    protected $arguments=array();
    
  function __construct($arr) {
      //habilitat el Registry
      $this->config= Config::getInstance();
      $this->config->APP_W=  dirname(filter_input(INPUT_SERVER, 'SCRIPT_NAME',FILTER_SANITIZE_URL));
      $this->arguments=$arr;
        /**
         * instanciem model
         */
      //  $this->model=new Model($arr);
      //  $this->view=new View();
        
    }
    function Redirect($mod){
        header('Location:'.APP.$mod);
    }
    
    function ajax($arr){
        return $arr;
    }
}
