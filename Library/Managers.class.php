<?php
    namespace Library;
    
    class Managers
    {
        protected $api = null;
        protected $dao = null;
        protected $managers = array();
        
        public function __construct($api, $dao)
        {
            $this->api = $api;
            $this->dao = $dao;
        }
        
        public function getManagerOf($module)
        {
           
		    if (!is_string($module) || empty($module))
            {
                throw new \InvalidArgumentException('Le module spécifié est invalide');
            }
            
            if (!isset($this->managers[$module]))
            {	 
                //echo 'dzdazdazda6';
				//$manager = '\\Library\\Models\\'.$module.'Manager_'.$this->api;
				$manager = '\Library\Models\\'.$module.'Manager_'.$this->api;
				//echo $manager.'<br/>';
                $this->managers[$module] = new $manager($this->dao);
				//NewsManager_PDO
				//$this->managers[$module] = new \Library\Models\NewsManager_PDO($this->dao);
				//echo 'dzdazdazda7';
            }
             
            return $this->managers[$module];
        }
    }
?>