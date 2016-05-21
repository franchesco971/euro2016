<?php
    namespace Library\Models;
    
    use \Library\Entities\Match;
	use \Library\Entities\Equipe;
    
    class MatchManager_PDO extends MatchManager
    {
        public function getListResultats($debut = -1, $limite = -1)
        {
			$listeResultats = array();
           
            $sql = 'SELECT idMatch,dateMatch,idEquipe1,idEquipe2,score1,score2
						,equipe1.libelle , equipe1.flag as flag1 
						,equipe2.libelle as libelle2, equipe2.flag as flag2 
					FROM `match`, equipe as equipe1,equipe as equipe2
					WHERE equipe1.idEquipe=idEquipe1 AND equipe2.idEquipe=idEquipe2
					AND idGagnant IS NOT NULL
                                        ORDER BY dateMatch';
            
			
            if ($debut != -1 || $limite != -1)
            {
                $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
            }
			
            $requete = $this->dao->query($sql);
			
            while ($data = $requete->fetch(\PDO::FETCH_ASSOC))
            {
                $match=new match($data);
                //echo $data['libelle'].'**'.$data['libelle2'];
                $match->setEquipe1(new Equipe(array('idEquipe'=>$data['idEquipe1'],'libelle'=>$data['libelle'],'flag'=>$data['flag1'])));
                // echo $equipe1['libelle'].'****';
                // $match->setEquipe1($equipe1);
                $match->setEquipe2(new Equipe(array('idEquipe'=>$data['idEquipe2'],'libelle'=>$data['libelle2'],'flag'=>$data['flag2'])));
				
                $listeResultats[] = $match;
            }
            
            $requete->closeCursor();
            
            return $listeResultats;
		}
		
    public function getUnique($id)
        {
            $sql='	SELECT idGagnant,idMatch,idMatch as id,dateMatch,idEquipe1,idEquipe2,score1,score2
						,equipe1.libelle , equipe1.flag as flag1 
						,equipe2.libelle as libelle2, equipe2.flag as flag2 					
					FROM `match` , equipe as equipe1,equipe as equipe2
					WHERE equipe1.idEquipe=idEquipe1 AND equipe2.idEquipe=idEquipe2							
					AND idMatch = :id';
			//echo $sql.$id;
			$requete = $this->dao->prepare($sql);
            $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
            $requete->execute();
            
            if ($donnees = $requete->fetch(\PDO::FETCH_ASSOC))
            {
                //$donnees['dateAjout'] = new \DateTime($donnees['dateAjout']);
                //$donnees['dateModif'] = new \DateTime($donnees['dateModif']);
               // echo $donnees['libelle'],'**<br/>';
			   
			  	$match=new match($donnees);
				$match->setEquipe1(new Equipe(array('idEquipe'=>$donnees['idEquipe1'],'libelle'=>$donnees['libelle'],'flag'=>$donnees['flag1'])));
				$match->setEquipe2(new Equipe(array('idEquipe'=>$donnees['idEquipe2'],'libelle'=>$donnees['libelle2'],'flag'=>$donnees['flag2'])));
                return $match;
            }
            
            return null;
        }
		
        public function getListMatchParie($idParieur)
        {
			$sql='	SELECT m.idMatch,dateMatch,idEquipe1,idEquipe2,score1,score2,p.idGagnant
						,equipe1.libelle, equipe1.flag as flag1 
						,equipe2.libelle as libelle2, equipe2.flag as flag2 
					FROM `match` m,participation p, equipe as equipe1,equipe as equipe2
					WHERE m.idMatch=p.idMatch 
					AND equipe1.idEquipe=idEquipe1 AND equipe2.idEquipe=idEquipe2
					AND p.idParieur=:id
                                        ORDER BY dateMatch';
			
			//echo $sql.'***'.$idParieur.'<br/>';				
			$requete = $this->dao->prepare($sql);
            $requete->bindValue(':id', (int) $idParieur, \PDO::PARAM_INT);
            $requete->execute();
            $listMatchParie=[];
			
            while ($donnees = $requete->fetch(\PDO::FETCH_ASSOC))
            {

                $match=new match($donnees);
                $match->setId($donnees['idMatch']);
                $match->setEquipe1(new Equipe(array('idEquipe'=>$donnees['idEquipe1'],'libelle'=>$donnees['libelle'],'flag'=>$donnees['flag1'])));
                $match->setEquipe2(new Equipe(array('idEquipe'=>$donnees['idEquipe2'],'libelle'=>$donnees['libelle2'],'flag'=>$donnees['flag2'])));

                $listMatchParie[]=$match;
            }

            $requete->closeCursor();

            return $listMatchParie;
        }
		
        public function getListMatch($idParieur)
        {
			$sql='	select m1.idMatch,m1.dateMatch,m1.idEquipe1,m1.idEquipe2,m1.score1,m1.score2
								,equipe1.libelle , equipe1.flag as flag1 
								,equipe2.libelle as libelle2, equipe2.flag as flag2
							from `match` m1
								, equipe as equipe1,equipe as equipe2
							where not exists (select null from `match` m2,participation p where p.idParieur=:id
							AND m1.idMatch=m2.idMatch and m2.idMatch=p.idMatch ) 
							AND equipe1.idEquipe=idEquipe1 AND equipe2.idEquipe=idEquipe2
							order by dateMatch,idMatch';
							
			//echo $sql.'***'.$idParieur.'<br/>';
			$requete = $this->dao->prepare($sql);
            $requete->bindValue(':id', (int) $idParieur, \PDO::PARAM_INT);
            $requete->execute();
            $ListMatch=[];
			
			while ($donnees = $requete->fetch(\PDO::FETCH_ASSOC))
            {
				$match=new match($donnees);
				$match->setId($donnees['idMatch']);
				$match->setEquipe1(new Equipe(array('idEquipe'=>$donnees['idEquipe1'],'libelle'=>$donnees['libelle'],'flag'=>$donnees['flag1'])));
				$match->setEquipe2(new Equipe(array('idEquipe'=>$donnees['idEquipe2'],'libelle'=>$donnees['libelle2'],'flag'=>$donnees['flag2'])));
                
				$ListMatch[]=$match;
			}
			
			$requete->closeCursor();
			
			return $ListMatch;
		}
                
    public function getList($debut = -1, $limite = -1) {
        $sql="SELECT m1.idMatch,m1.idGagnant,m1.dateMatch,m1.idEquipe1,m1.idEquipe2,m1.score1,m1.score2,e1.libelle as libelle1,e2.libelle as libelle2 "
                . "FROM `match` m1 "
                . "LEFT JOIN equipe e1 ON m1.idEquipe1=e1.idEquipe "
                . "LEFT JOIN equipe e2 ON m1.idEquipe2=e2.idEquipe ";
        
        if ($debut != -1 || $limite != -1)
        {
            $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
        }
        
        $requete = $this->dao->query($sql);
        
        while ($data = $requete->fetch(\PDO::FETCH_ASSOC))
        {
            $match=new match($data);
            $match->setEquipe1(new Equipe(array('idEquipe'=>$data['idEquipe1'],'libelle'=>$data['libelle1'])));
            $match->setEquipe2(new Equipe(array('idEquipe'=>$data['idEquipe2'],'libelle'=>$data['libelle2'])));
				
            $listeResultats[] = $match;
        }       
        
        return $listeResultats;
    }
    
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM `match`')->fetchColumn();
    }
    
    public function add(Match $match) {
        $q = $this->dao->prepare('INSERT INTO `match` SET idEquipe1 = :idEquipe1,idEquipe2 = :idEquipe2, dateMatch = :dateMatch');

        $q->bindValue(':idEquipe1', $match->idEquipe1(), \PDO::PARAM_INT);
        $q->bindValue(':idEquipe2', $match->idEquipe2(), \PDO::PARAM_INT);
        $q->bindValue(':dateMatch', $match->dateMatch(), \PDO::PARAM_INT);

        $q->execute();
    }
    
    protected function modify(Match $match)
    {        
        $q = $this->dao->prepare('UPDATE `match` SET idEquipe1 = :idEquipe1,idEquipe2 = :idEquipe2,score1 = :score1,score2 = :score2,dateMatch = :dateMatch WHERE idMatch = :idMatch');
        
        $q->bindValue(':idEquipe1', $match->idEquipe1(), \PDO::PARAM_INT);
        $q->bindValue(':idEquipe2', $match->idEquipe2(), \PDO::PARAM_INT);
        $q->bindValue(':score1', $match->score1());
        $q->bindValue(':score2', $match->score2());
        $q->bindValue(':dateMatch', $match->dateMatch(), \PDO::PARAM_INT);
        $q->bindValue(':idMatch', $match->idMatch(), \PDO::PARAM_INT);

        $q->execute();
    }
    
    protected function setWinner(Match $match) {
        $q = $this->dao->prepare('UPDATE `match` SET idGagnant = :idGagnant WHERE idMatch = :idMatch');
        
        $q->bindValue(':idGagnant', $match->idGagnant(), \PDO::PARAM_INT);
        $q->bindValue(':idMatch', $match->idMatch(), \PDO::PARAM_INT);

        $q->execute();
    }
    
    public function getParticipations(Match $match) {
        $sql="SELECT * "
                . "FROM participation "
                . "WHERE idMatch=:idMatch ";
        
        $requete = $this->dao->prepare($sql);
        $requete->bindValue(':idMatch', $match->idMatch(), \PDO::PARAM_INT);
        
        $requete->execute();
        
        while ($data = $requete->fetch(\PDO::FETCH_ASSOC))
        {				
            $participations[] = $data;
        }
        
        return $participations;
    }
    
    public function setPoints($idParieur,$idMatch,$idGagnant,$points) {
        $sql="UPDATE participation SET points=:points WHERE idParieur=:idParieur AND idMatch=:idMatch AND idGagnant=:idGagnant";
        
        $requete = $this->dao->prepare($sql);
        $requete->bindValue(':idMatch', $idMatch, \PDO::PARAM_INT);
        $requete->bindValue(':idParieur', $idParieur, \PDO::PARAM_INT);
        $requete->bindValue(':idGagnant', $idGagnant, \PDO::PARAM_INT);
        $requete->bindValue(':points', $points, \PDO::PARAM_INT);
        
        $requete->execute();
    }
}