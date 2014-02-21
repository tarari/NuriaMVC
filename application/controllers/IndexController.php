<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author toni
 */

class IndexController extends ControllerBase{
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
       //carregar la configuració
       $this->model= new IndexModel($arr);
       $this->view=new View();
       $this->view->setProp($this->model->getDataout());
        //afegir configuració per ruta publica, enllaços, css ,js...
        $this->view->addProp(array('APP_W'=>$this->config->APP_W));
        $this->view->addProp(array('THEME'=>$this->config->THEME));
        $this->view->setTemplate(APP.'/public/themes/'.$this->config->THEME.'/tpl/index.html');
        $this->view->render();
        
       
    }
    public function index(){
               
        
        
        
    }
//    public function a(){
//        $this->model->a();
//        $this->view->setProp($this->model->getDataout());
//        $this->view->addProp($this->conf->getData());
//        $this->view->setTemplate(APP.'/public/tpl/index.php');
//        $this->view->render();
//    }
//    public function suma(){
//        $this->model->suma();
//        $sum=$this->model->getDataout();
//        $this->view->setProp($this->model->getDataout());
//        $this->view->addProp($this->conf->getData());
//        $this->view->setTemplate(APP.'/public/tpl/index.php');
//        $this->view->render();
//    }
    function login(){
        if(isset($_POST['email'])){
            $email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $password=md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
            $user=$this->model->login($email,$password);
            if ($user== TRUE){
                $this->Redirect('index');
                // cap a la pàgina principal
                 //header('Location:'.APP_W.'/index/index');
            }
            else{
                $this->Redirect('index','register');
                
                //header('Location:'.APP_W.'/index/register');
                
            }
    }
    }
} 
       


