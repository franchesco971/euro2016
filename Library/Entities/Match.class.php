<?php
    namespace Library\Entities;

    class Match extends \Library\Entity
    {
            protected	$idMatch,
                                    $dateMatch,
                                    $score1,
                                    $score2,
                                    $idEquipe1,
                                    $idEquipe2,
                                    $idGagnant;

            protected 	$equipe1,
                                    $equipe2,
                                    $equipeGagnant;
	
        const DATE_INVALIDE=1;
        const EQUIPE_IDENTIQUE=2;
            
	/*public function __construct(array $donnees = array())
        {
            parent::__construct($donnees);
			
            var_dump($donnees);
        }*/
		
        public function isValid()
        {
            return !(empty($this->idEquipe1) || empty($this->idEquipe2) || empty($this->dateMatch) || $this->idEquipe1==$this->idEquipe2);
        }
		
		 // SETTERS //
        
		public function setIdMatch($idMatch)
        {
            $this->idMatch = $idMatch;
            $this->id = $idMatch;
        }
		
        public function setDateMatch($dateMatch)
        {
            if(empty($dateMatch))
                $this->erreurs[] = self::DATE_INVALIDE;
            else
            {                                
                $this->dateMatch = $dateMatch;
            }
                
        }
		
		public function setScore1($score1)
        {
            $this->score1 = $score1;
        }
		
		public function setScore2($score2)
        {
            $this->score2 = $score2;
        }
		
        public function setIdEquipe1($idEquipe1)
        {
            if($idEquipe1==$this->idEquipe2)
                $this->erreurs[] = self::EQUIPE_IDENTIQUE;
            else
                $this->idEquipe1 = $idEquipe1;
        }
		
        public function setIdEquipe2($idEquipe2)
        {
            if($this->idEquipe1==$idEquipe2)
                $this->erreurs[] = self::EQUIPE_IDENTIQUE;
            else
                $this->idEquipe2 = $idEquipe2;
        }
		
		public function setIdGagnant($idGagnant)
        {
            $this->idGagnant = $idGagnant;
        }
		
		public function setEquipe1($equipe1)
        {
            // echo $equipe1['libelle'].'**a**';
			$this->equipe1 = $equipe1;
			
        }
		
		public function setEquipe2($equipe2)
        {
            $this->equipe2 = $equipe2;
        }
		
		public function setEquipeGagnant($equipeGagnant)
        {
            $this->equipeGagnant = $equipeGagnant;
        }
		
		// GETTERS //
        
		public function idMatch()
        {
            return $this->idMatch;
        }
		
        public function dateMatch()
        {
            return $this->dateMatch;
        }
		
		public function score1()
        {
            return $this->score1;
        }
		
		public function score2()
        {
            return $this->score2;
        }
		
		public function idEquipe1()
        {
            return $this->idEquipe1;
        }
		
		public function idEquipe2()
        {
            return $this->idEquipe2;
        }
		
		public function idGagnant()
        {
            return $this->idGagnant;
        }
		
		public function equipe1()
        {
            //$this->setEquipe1($this->equipeManager->getUnique($match['idEquipe1']));
			return $this->equipe1;
        }
		
		public function equipe2()
        {
          	/*$this->managers->->getManagerOf('Equipe');
			$this->setEquipe2();*/
		    return $this->equipe2;
        }
		
		public function equipeGagnant()
        {
            return $this->equipeGagnant;
        }
	}