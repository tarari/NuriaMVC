<?php


/**
 * Description of ControllerBase. Main controller it provides differents methods
 *
 * @author toni
 */
class ControllerBase {
    
    protected $model;
    protected $view;
    protected $config;
    protected $arguments=array();
    protected $_ajax;
    
  function __construct($arr) {
      //habilitat el Registry
      $this->config= Config::getInstance();
      $this->config->APP_W=  dirname(filter_input(INPUT_SERVER, 'SCRIPT_NAME',FILTER_SANITIZE_URL));
      $this->arguments=$arr;
           
    }
    /**
     * 
     * @param type $mod modul redirection
     * @param type $action modul/action redirection
     */
    function Redirect($mod,$action){
        if (isset($action)){
            header('Location:'.APP_W.'/'.$mod.'/'.$action);
        }
        else{
            header('Location:'.APP_W.'/'.$mod);
        }
        }
    
   /**
    * 
    * @param type $output json output
    * @return type json
    */ 
   protected function ajax_set($output){
       
          $output=  json_encode($output); 
          ob_clean();
          echo $output;
          
       }
    
    /**
     * a partir del request seleccionem mètode
     * i resposta en json
     */
    protected function Rest($arg){
        switch ($request->method) {
            case 'GET':
                $request->parameters = $_GET;
            break;
            case 'POST':
                $request->parameters = $_POST;
            break;
            case 'PUT':
                parse_str(file_get_contents('php://input'), $request->parameters);
                break;
            case 'DELETE':
                parse_str(file_get_contents('php://input'), $request->parameters);
                break;
            break;
        }
    }

}