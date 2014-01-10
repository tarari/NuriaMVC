<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Model: proporciona eines d'accés bàsic a DADES
 *
 * @author toni
 */
class Model extends Database{
    /**
     *
     * @datain array , per comunicar amb BBDD
     * @dataout array, per comunicar amb controller
     * 
     */
    protected $db;
    protected $config;
    protected $datain=array();
    protected $dataout=array();
    
    function __construct($arr) {
        parent::__construct();
        $this->datain=array();
        $this->dataout=$arr;
    }
    
    public function setDatain($arr){
        if (isset($arr)){
            $this->datain=$arr;
        }
    }
    public function setDataout($arr){
         if (isset($arr)){
            $this->dataout=$arr;
        }
    }
    /**
     * Metode per afegir arrays de comunic amb controller
     * @param type $arr
     */
    public function addDataout($arr){
        if ($arr || $this->dataout){
            $this->dataout=  array_merge($this->dataout,$arr);
        }else{
            $this->dataout=$arr;
        }
    }
    public function getDatain(){
        return $this->datain;
    }
    public function getDataout(){
        return $this->dataout;
    }
}