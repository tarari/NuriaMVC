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
    private $conf;
    /**
     * rep con a paràmetre un array associatiu que 
     * permet passar els paràmetres de la URI
     * @param array $arr
     */
    public function __construct($arr) {
        parent::__construct($arr);
       //carregar la configuració
        $this->conf=$this->config;
        $this->model= new IndexModel($arr);
        $this->view=new View();
        
        
       
    }
    public function index(){
               
        $this->view->setProp($this->model->getDataout());
        //afegir configuració per ruta publica, enllaços, css ,js...
        $this->view->addProp(array('APP_W'=>$this->conf->APP_W));
        $this->view->setTemplate(APP.'/public/tpl/index.php');
        $this->view->render();
        
        
    }
    public function a(){
        $this->model->a();
        $this->view->setProp($this->model->getDataout());
        $this->view->addProp($this->conf->getData());
        $this->view->setTemplate(APP.'/public/tpl/index.php');
        $this->view->render();
    }
    public function suma(){
        $this->model->suma();
        $sum=$this->model->getDataout();
        $this->view->setProp($this->model->getDataout());
        $this->view->addProp($this->conf->getData());
        $this->view->setTemplate(APP.'/public/tpl/index.php');
        $this->view->render();
    }
}
