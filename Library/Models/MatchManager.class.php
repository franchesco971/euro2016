<?php
    namespace Library\Models;
	
    use \Library\Entities\Match;
    
    abstract class MatchManager extends \Library\Manager
    {
        //abstract public function getListResultats($EquipeManager,$debut = -1, $limite = -1);
        abstract public function getListResultats($debut = -1, $limite = -1);

        abstract public function getList($debut = -1, $limite = -1);
        
        abstract protected function add(Match $match);
        
        abstract protected function modify(Match $match);
        
        abstract protected function setWinner(Match $match);
        
        abstract protected function getParticipations(Match $match);
        
        abstract protected function setPoints($idParieur,$idMatch,$idGagnant,$points);
        
        public function save(Match $match)
        {
            if ($match->isValid())
            {            
                $match->isNew() ? $this->add($match) : $this->modify($match);
            }
            else
            {
                throw new \RuntimeException('Le match doit être validée pour être enregistrée');
            }
        }
        
        public function validate(Match $match) {
            $score1=$match['score1'];
            $score2=$match['score2'];
            $idGagnant=0;
            
            if($score1>$score2)
                $idGagnant=$match['idEquipe1'];
            elseif($score1<$score2)
                $idGagnant=$match['idEquipe2'];
            
            $match->setIdGagnant($idGagnant);
            $this->setWinner($match);
            $this->setWinners($match);
        }
        
        public function setWinners(Match $match) {
            $participations=  $this->getParticipations($match);
            $tabParticipant=[$match->idEquipe1(),$match->idEquipe2()];
            
            foreach ($participations as $participation) {
                $idGagnantPar=$participation['idGagnant'];
                $idGagnant=$match->idGagnant();
                
                if($idGagnant==$idGagnantPar || $idGagnantPar==99)
                {                    
                    $points=0;
                    if(in_array($idGagnantPar, $tabParticipant) || $idGagnantPar==0)
                        $points=3;
                    elseif ($idGagnantPar==99 && $idGagnant==0)
                        $points=1;
                        
                    if($points>0)
                    $this->setPoints($participation['idParieur'],$match->idMatch(),$idGagnantPar,$points);
                }                                
            }
        }
    }