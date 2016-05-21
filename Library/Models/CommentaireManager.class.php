<?php
    namespace Library\Models;
    
    use \Library\Entities\Commentaire;
    
    abstract class CommentaireManager extends \Library\Manager
    {
		abstract public function getListOf($idMatch);
		
		abstract public function getList($debut = -1, $limite = -1);
		
		abstract protected function add(Commentaire $parieur);
        
        public function save(Commentaire $commentaire)
        {
            if ($commentaire->isValid())
            {
                //echo 'dzdaz***';
				$commentaire->isNew() ? $this->add($commentaire) : $this->modify($commentaire);
            }
            else
            {
                throw new \RuntimeException('Le Commentaire doit être validée pour être enregistrée');
            }
        }
	}