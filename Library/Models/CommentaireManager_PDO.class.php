<?php
    namespace Library\Models;
    
    use \Library\Entities\Commentaire;
	use \Library\Entities\Parieur;
    
    class CommentaireManager_PDO extends CommentaireManager
    {
        protected function add(Commentaire $commentaire)
        {
            //echo 'dzdazdza**';
			$q = $this->dao->prepare('INSERT INTO commentaire SET idMatch = :idMatch, idParieur = :idParieur, contenu = :contenu, dateCommentaire = :dateCommentaire');
            
            $q->bindValue(':idMatch', $commentaire->idMatch(), \PDO::PARAM_INT);
            $q->bindValue(':idParieur', $commentaire->idParieur(), \PDO::PARAM_INT);
            $q->bindValue(':contenu', $commentaire->contenu());
			$q->bindValue(':dateCommentaire', time(), \PDO::PARAM_INT);
            
            $q->execute();
            
            //$commentaire->setId($this->dao->lastInsertId());
        }
        
        public function getListOf($idMatch)
        {
            if (!is_int($idMatch))
            {
                throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
            }
            
			$sql='	SELECT c.idParieur, idMatch, contenu, dateCommentaire 
												,pseudo,pass,email
										FROM commentaire c ,parieur p
										WHERE c.idParieur=p.idParieur
										AND idMatch = :idMatch';
			
            $q = $this->dao->prepare($sql);
            $q->bindValue(':idMatch', $idMatch, \PDO::PARAM_INT);
            $q->execute();
            
            $commentaires = array();
            
            while ($data = $q->fetch(\PDO::FETCH_ASSOC))
            {
                //$data['date'] = new \DateTime($data['date']);
				
				$parieur=new Parieur($data);
				$parieur->setId($data['idParieur']);
                $commentaire=new Commentaire($data);
				//$commentaire->setId($data['idParieur']);
				
				$commentaire->setParieur($parieur);
                $commentaires[] = $commentaire;
            }
            
            return $commentaires;
        }
		
		public function getList($debut = -1, $limite = -1)
        {
            $listeCommentaires = array();
           
            $sql = 'SELECT c.idParieur, idMatch, contenu, dateCommentaire 
						,pseudo,pass,email
					FROM commentaire c ,parieur p
					WHERE c.idParieur=p.idParieur
					ORDER BY dateCommentaire DESC';
            
            if ($debut != -1 || $limite != -1)
            {
                $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
            }
			//echo '*****<br/>';
			
            $requete = $this->dao->query($sql);
			
            while ($data= $requete->fetch(\PDO::FETCH_ASSOC))
            {
                //$news['dateAjout'] = new \DateTime($news['dateAjout']);
                //$news['dateModif'] = new \DateTime($news['dateModif']);
				$parieur=new Parieur($data);
                $commentaire=new Commentaire($data);
				
				$commentaire->setParieur($parieur);
				
                $listeCommentaires[] = $commentaire;
            }
            
            $requete->closeCursor();
            
            return $listeCommentaires;
        }
		
		/*protected function modify(Comment $comment)
        {
            $q = $this->dao->prepare('UPDATE comments SET auteur = :auteur, contenu = :contenu WHERE id = :id');
            
            $q->bindValue(':auteur', $comment->auteur());
            $q->bindValue(':contenu', $comment->contenu());
            $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
            
            $q->execute();
        }
        
        public function get($id)
        {
            $q = $this->dao->prepare('SELECT id, news, auteur, contenu FROM comments WHERE id = :id');
            $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
            $q->execute();
            
            return new Comment($q->fetch(\PDO::FETCH_ASSOC));
        }
		
		public function delete($id)
        {
            $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
        }*/
    }
