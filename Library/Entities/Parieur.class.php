<?php
    namespace Library\Entities;
    
    class Parieur extends \Library\Entity
    {
        protected $idParieur,
                  $pseudo,
                  $pass,
                  $email;
					
		protected $pass_verif,
					$points;
		
		const PSEUDO_INVALIDE = 1;
		const PASS_INVALIDE = 2;
		const EMAIL_INVALIDE = 3;
		
		public function isValid()
        {
            return !(empty($this->pseudo) || empty($this->pass) || empty($this->email));
        }
		
		// SETTERS

		
		public function setIdParieur($idParieur)
        {
            $this->idParieur = $idParieur;
        }
		
		public function setPseudo($pseudo)
        {
			
			if (!is_string($pseudo) || empty($pseudo))
                $this->erreurs[] = self::PSEUDO_INVALIDE;
            else
                $this->pseudo = $pseudo;
        }
		
		public function setPass($pass)
        {
            if (!is_string($pass) || empty($pass))
                $this->erreurs[] = self::PASS_INVALIDE;
            else
                $this->pass = $pass;
        }
		
		public function setPass_verif($pass_verif)
        {
           // if (!is_string($pass) || empty($pass))
           //     $this->erreurs[] = self::PASS_INVALIDE;
            //else
                $this->pass_verif = $pass_verif;
        }
		
		public function setPoints($points)
        {
          	$this->points = $points;
        }
		
		public function setEmail($email)
        {
            if (!is_string($email) || empty($email))
                $this->erreurs[] = self::EMAIL_INVALIDE;
            else
                $this->email = $email;
        }
		
		// GETTERS
        
		public function idParieur()
        {
            return $this->idParieur;
        }
		
        public function pseudo()
        {
            return $this->pseudo;
        }
		
		public function pass()
        {
            return $this->pass;
        }
		
		public function pass_verif()
        {
            return $this->pass_verif;
        }
		
		public function email()
        {
            return $this->email;
        }
		
		public function points()
        {
            return $this->points;
        }
		
		//FONCTIONS
		
		public static function service($idParieur)
		{
			switch($idParieur)
			{
				case 9:
				case 11:
				case 14:
				case 15:
				case 24:		
				case 32:
				case 36:
					$service='INFO';
				break;
				case 10:
				case 17:
				case 29:
				case 31:
				case 34:		
				case 35:
					$service='MARKET';
				break;
				case 12:
				case 16:
				case 21:
				case 22:
				case 23:		
				case 27:
				case 30:
				case 33:
				
					$service='CLIENT';
				break;
				case 20:
					$service='SEVRES';
				break;
				case 37:
				case 19:
					$service='COMM';
				break;
				default:
					$service='ché pas';
				break;								
			}
			
			return $service;
		}
	}