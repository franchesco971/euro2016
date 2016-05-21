<?php
    namespace Library;
    
    abstract class Entity implements \ArrayAccess
    {
        protected $erreurs = array(),
                  $id;
        
        public function __construct(array $donnees = array())
        {
            if (!empty($donnees))
            {
                $this->hydrate($donnees);
            }
        }
        
        public function isNew()
        {
            return empty($this->id);
        }
        
        public function erreurs()
        {
            return $this->erreurs;
        }
        
        public function id()
        {
            return $this->id;
        }
        
        public function setId($id)
        {
            $this->id = (int) $id;
        }
        
        public function hydrate(array $donnees)
        {
            
			foreach ($donnees as $attribut => $valeur)
            {
                $methode = 'set'.ucfirst($attribut);
				
				// echo $methode.'<br/>';
                
                if (is_callable(array($this, $methode)))
                {
                    $this->$methode($valeur);
                }
            }
        }
        
        public function offsetGet($var)
        {
            if (isset($this->$var) && is_callable(array($this, $var)))
            {
                return $this->$var();
            }
        }
        
        public function offsetSet($var, $value)
        {
            $method = 'set'.ucfirst($var);
            
            if (isset($this->$var) && is_callable(array($this, $method)))
            {
                $this->$method($value);
            }
        }
        
        public function offsetExists($var)
        {
            return isset($this->$var) && is_callable(array($this, $var));
        }
        
        public function offsetUnset($var)
        {
            throw new \Exception('Impossible de supprimer une quelconque valeur');
        }
		
		static function date_new($format,$date)
		{
			switch($_SERVER['SERVER_NAME'])
			{
				case 'euroviapresse2012.netau.net':
					$date=date($format,$date+21600);
				break;
				case 'euroviapresse2012.comuv.com':
					$date=date($format,$date+21600);
				break;
				default:
					$date=date($format,$date);
				break;	
			}
			return $date;
		}
    }
?>