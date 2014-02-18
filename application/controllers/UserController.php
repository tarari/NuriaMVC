<?php


/**
 * Description of IndexController
 *
 * @author toni
 */

class UserController extends ControllerBase{
    protected $model;
    protected $view;
    //private $conf;
    /**
     * rep con a paràmetre un array associatiu que 
     * permet passar els paràmetres de la URI
     * @param array $arr
     */
    public function __construct($arr) {
        parent::__construct($arr);
        $this->model= new IndexModel($arr);
        $this->view=new View();
        $this->view->setProp($this->model->getDataout());
        //afegir configuració per ruta publica, enllaços, css ,js...
        $this->view->addProp(array('APP_W'=>$this->config->APP_W));
        $this->view->addProp(array('THEME'=>$this->config->THEME));
        $this->view->setTemplate(APP.'/public/themes/'.$this->config->THEME.'/tpl/user.html');
        $this->view->render();
        
       
    }
    public function index(){
               
        
        
        
    }

    function login(){
        
    }
    
} 
       


