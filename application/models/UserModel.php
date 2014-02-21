<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class UserModel extends Model{
    
    private $user;
    
    public function __construct($arr) {
        parent::__construct($arr);
        require_once APP.'usuari.php';
        $this->user=new usuari();
        //parametres de configuració
        $this->datain=$this->config;
        //afegir en DataOut els paràmetres URI
        $this->setDataout($arr);
    }
//    public function edit(){
//        $camp=array_pop(array_keys($this->dataout));
//        $cont=  strlen(array_pop($this->dataout));
//        $this->dataout=array('camp'=>$camp,'leng'=>$cont);
//    }
    /*
     * array $arr array user to insert
     */
    function register($arr){
        $sql="CALL sp_nou_usuari(?,?,?,?,?)";
        $stmt=$this->db->prepare("CALL sp_nou_usuari(?,?,?,?,?)");
        $stmt->execute($arr);
        
    }
    function login(){
        $log=Login::singleton_login();
        if(isset($_POST['email']))
        {
            $email = $_POST['email'];
            $password = $_POST['email'];
            $usuari = $log->login_users($email,$password);
            if($usuari == TRUE)
            {
                Session::set('usuari', serialize($this->user));
                header("Location:".APP_W);
            }
}
        ////
        // desem les dades d'usuari a la sessió
        
//        while ($row = $stmt->fetchAll()) {
//            if($row['email']==$arr['email']){
//                if($row['passwd']==$arr['passwd']){
//                    Session['islogin']=true;
//            }
//
//        }
//            
//        }
    }
}

class Login
{
 
    private static $instancia;
    private $dbh;
 
    private function __construct()
    {
 
        $this->dbh = SPDO::singleton();
 
    }
 
    public static function singleton_login()
    {
 
        if (!isset(self::$instancia)) {
 
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
 
        }
 
        return self::$instancia;
 
    }
    
    public function login_users($email,$password)
    {
        
        try {
            
            $sql = "SELECT * from usuaris WHERE email = ? AND password = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(1,$email);
            $query->bindParam(2,$password);
                
            $obj=$query->fetch(PDO::FETCH_OBJ);
            var_dump($obj);
            $this->dbh = null;
 
            //si existeix l'usuari
            if($query->rowCount() == 1)
            {
                 $fila  = $query->fetch();
                 //foreach ($fila as $)
                 $_SESSION['nom'] = $fila['nom'];                 
                 return TRUE;
    
            }
            
        }catch(PDOException $e){
            
            print "Error!: " . $e->getMessage();
            
        }        
        
    }
    
 
     // Evita que el objeto se pueda clonar
    public function __clone()
    {
 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
 
    }
 
}