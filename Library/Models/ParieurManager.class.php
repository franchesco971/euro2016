<?php
    namespace Library\Models;
	
	use \Library\Entities\Parieur;
    
    abstract class ParieurManager extends \Library\Manager
    {
		abstract public function getUnique($id);
		
		abstract protected function add(Parieur $parieur);
        
        public function save(Parieur $parieur)
        {
            if ($parieur->isValid())
            {
                $parieur->isNew() ? $this->add($parieur) : $this->modify($parieur);
            }
            else
            {
                throw new \RuntimeException('Le parieur doit être validée pour être enregistrée');
            }
        }
	}