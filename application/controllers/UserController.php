<?php


/**
 * Description of IndexController
 *
 * @author toni
 */

class UserController extends ControllerBase{
    protected $model;
    protected $view;
   
    /**
     * rep con a paràmetre un array associatiu que 
     * permet passar els paràmetres de la URI
     * @param array $arr
     */
    public function __construct($arr) {
        parent::__construct($arr);
       //carregar la configuració
       $this->model= new IndexModel($arr);
       $this->view=new View();
       $this->view->setProp($this->model->getDataout());
        //afegir configuració per ruta publica, enllaços, css ,js...
        $this->view->addProp(array('APP_W'=>$this->config->APP_W));
        $this->view->addProp(array('THEME'=>$this->config->THEME));
        $this->view->setTemplate('user');
        $this->view->render();
        
       
    }
    public function index(){
               
      
    }

    function register(){
        echo "DDDDDDDDDDDDDDDDD";
    }
    
    function logout(){
        Session::destroy();
    }
} 
       


