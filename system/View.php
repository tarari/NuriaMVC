<?php

/**
 * Description of View. This implements all the methods to show data 
 *
 * @author toni <t.jimenez@escolesnuria.cat>
 */
class View  {
    /**
     *
     * @template plantilla en html
     * @properties propietats substituïbles al template i
     *  els seus valors en array associatiu.
     */
    protected static $template;
    protected static $head;
    protected static $cookies;
    protected static $body;
    protected static $foot;
    protected $properties;
    protected $conf;
    
    public function __construct() {
        $this->properties=array();
        $this->conf= Config::getInstance();
        //definir capçalera i peus comuns en totes les plantilles
        self::$cookies=APP.'public/themes/'.THEME.'/tpl/cookies.phtml';
        self::$head=APP.'public/themes/'.THEME.'/tpl/head.phtml';
        // self::$head=file_get_contents($file_h);
        self::$foot=APP.'public/themes/'.THEME.'/tpl/foot.phtml';
        //self::$foot=file_get_contents($file_f);
        
    }
   
    /**
     * Estableix la plantilla
     * @param file $file
     */
    public static function setTemplate($file){
        self::$body=APP.'/public/themes/'.THEME.'/tpl/'.$file.'.phtml';
        $file_c=  file_get_contents(self::$cookies);
        $file_h= file_get_contents(self::$head);
        $file_f=  file_get_contents(self::$foot);
        $file_b=  file_get_contents(self::$body);
        if ($file=='index'){
            //init with cookies if begins with IndexController
            self::$template=$file_c.$file_b.$file_f;
        }
        else{
            self::$template=$file_h.$file_b.$file_f;
        }
        

        
    }
    /**
     * Remplaçar propietats
     * en layout
     */
    public function setProp($arr){
        $this->properties=$arr;
    }
    /**
     * per afegir array de propietats a substituir
     * @param array $arr
     */
    public function addProp($arr){
        if ($arr || $this->properties){
            if ($this->properties==null){
                $this->properties=$arr;
            }
            else{
            $this->properties= array_merge($this->properties,$arr);
            }
        }
    }
    public function getTemplate(){
        return $this->template;
    }
    /**
     * Substitueix en la plantilla els valors dinàmics passats
     * a través de l'array de propietats
     * 
     * @return void
     */
    private function transform(){
        
        $html=  self::$template;
        if ($this->properties){
        foreach ($this->properties as $clau => $valor) {
            $html=str_replace('{'.$clau.'}',$valor, $html);
        }
        self::$template=$html;
        }
    }
    
    public  function render(){
        //comencem sortida
        ob_start();
        $this->transform();
        // la funció eval permet utilitzar expressions
        // del tipus <?= $valor; dintre de la plantilla
       eval('?>'.self::$template.'<?');
        
        
    }
            
}
