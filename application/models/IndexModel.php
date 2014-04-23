<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexModel
 *
 * @author toni
 */
class IndexModel extends Model{
    
    public function __construct($arr) {
        parent::__construct($arr);
//        //parametres de configuració
//        $this->datain=$this->config;
//        //afegir en DataOut els paràmetres URI
//        $this->addDataout($arr);
    }
    /**
     * Exemple de funció
     */
    public function a(){
        //cap al controlador
        $this->addDataout(array('a'=>1));
                if($this->datain){
            $result=  array_merge($this->dataout,  $this->datain);
        $this->dataout=  $result;}
       
    }
    /**
     * suma paràmetres
     */
    public function suma(){
       // $arreglo_var=  array_keys($this->dataout);
        $arreglo_val= array_values($this->dataout);
        
        $this->dataout=array('suma'=>array_sum($arreglo_val));
    }
    public function users(){
        $sql="SELEC * FROM USERS";
        $this->prepara($sql);
        $this->exec($array);
        
    }
    function login($email,$password){
        try{
            $sql="SELECT * FROM usuaris WHERE email=? AND password=?";
            $query=$this->db->prepare($sql);
            $query->bindParam(1,$email);
            $query->bindParam(2,$password);
            $query->execute();
            $res=$query->fetch();
            if($query->rowCount()==1){
                Session::set('islogged',TRUE);
                Session::set('user',new usuari($res['nom'],$res['cognoms'],$res['email'],$res['idrol']));
                return TRUE;
            }
            else {
                Session::set('islogged',FALSE);
                return FALSE;}
        }catch(PDOException $e){
            echo "Error:".$e->getMessage();
        }

        }
        
        public function verificarEmail($email){
            $id = $this->_db->query("select id from usuaris where email = '$email'");
            if($id->fetch()){
                return true;
            }

            return false;
        }
}

