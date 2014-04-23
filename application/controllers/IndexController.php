<?php

/**
 * Description of IndexController
 * Main app controller
 * @author toni
 */

class IndexController extends ControllerBase{
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
        $this->view->setTemplate('index');
        $this->view->render();             
    }
    
    public function index(){      
      }
 
    function login(){
        if(isset($_POST['email'])){
            $email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $password=md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));           
            $user=$this->model->login($email,$password);
            if ($user== TRUE){
                setcookie('usuari',Session::get('user')->getEmail(),time()+3600,APP_W);
                $output=array('redirect'=>APP_W.'/index');
                $this->ajax_set($output);                
            }
            else{  
                $output=array('redirect'=>APP_W.'/user/register');
                $this->ajax_set($output);       
            }
        }
    }
    
    function acceptcookies(){
        if(!isset($_COOKIE['accept-cookies'])){
            //cookie defined for the path / , important making
            // cookies accessible to all domain
            setcookie('accept-cookies',true,time()+3600,APP_W);
            $this->Redirect('index');
        }
        else {$this->Redirect ('index');}
    }
    function logout(){
        $_SESSION=array();
        
        if (isset($_SERVER['HTTP_COOKIE'])) {   
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
        Session::destroy();
        $this->Redirect('index');
    }
       
   

}