<?php
    namespace Library\Entities;
    
    class Commentaire extends \Library\Entity
    {
        protected $idParieur,
                  $idMatch,
                  $contenu,
                  $dateCommentaire;
				  
		protected 	$Parieur,
					$Match;
					
		const CONTENU_INVALIDE = 1;
		
		public function __construct(array $donnees = array())
        {
            parent::__construct($donnees);
			/*
			//$this->managers = new \Library\Managers('PDO', \Library\PDOFactory::getMysqlConnexion());
			$managers = new \Library\Managers('PDO', \Library\PDOFactory::getMysqlConnexion());
			//$this->equipeManager = $this->managers->getManagerOf('Equipe');
			//$equipeManager = $managers->getManagerOf('Match');
			//$this->setMatch($managers->getManagerOf('Match')->getUnique($this->idMatch));
			$this->setParieur($managers->getManagerOf('Parieur')->getUnique($this->idParieur));
			*/
		}
		
		public function isValid()
        {
            return !(empty($this->contenu));
        }
		
		// SETTERS
        
        public function setIdParieur($idParieur)
        {
            $this->idParieur = (int) $idParieur;
        }
		
		public function setIdMatch($idMatch)
        {
            $this->idMatch = (int) $idMatch;
        }
		
		public function setContenu($contenu)
        {
            if (!is_string($contenu) || empty($contenu))
                $this->erreurs[] = self::CONTENU_INVALIDE;
            else
                $this->contenu = $contenu;
        }
		
		public function setDateCommentaire($dateCommentaire)
        {
            $this->dateCommentaire = (int) $dateCommentaire;
        }
		
		public function setMatch($Match)
        {
            $this->Match = $Match;
        }
		
		public function setParieur($Parieur)
        {
            $this->Parieur = $Parieur;
        }
		
		// GETTERS
        
        public function idParieur()
        {
            return $this->idParieur;
        }
		
		public function idMatch()
        {
            return $this->idMatch;
        }
		
		public function contenu()
        {
            return $this->contenu;
        }
		
		public function dateCommentaire()
        {
            return $this->dateCommentaire;
        }
		
		public function Match()
        {
            return $this->Match;
        }
		
		public function Parieur()
        {
            return $this->Parieur;
        }		  
	}