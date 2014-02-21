<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    class ErrorController extends ControllerBase{
        protected $model;
        protected $view;
        private $conf;
        private $arg;
        /**
         * rep con a paràmetre un array associatiu que 
         * permet passar els paràmetres de la URI
         * @param array $arr
         */
        public function __construct($arr) {
            parent::__construct($arr);
           //carregar la configuració
            $this->conf=$this->config;
            $this->model= new ErrorModel($arr);
            $this->arg=$arr;
            $this->view=new View();
            $this->view->setTemplate(APP.'/public/themes/'.$this->conf->THEME.'/tpl/error.html');
            $this->view->addProp(array('APP_W'=>$this->conf->APP_W));
            $this->view->render();
        }
        function index(){
            foreach ($this->arg as $key=>$value) {
                echo '<pre>'.$key.':'.$value.'</pre>';
            }
        }
    }