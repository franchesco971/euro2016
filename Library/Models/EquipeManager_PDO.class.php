<?php
namespace Library\Models;

use \Library\Entities\Equipe;

class EquipeManager_PDO extends EquipeManager
{
    public function getUnique($id)
    {
        $sql='SELECT idEquipe, libelle FROM equipe WHERE idEquipe = :id';
                    //echo $sql.$id;
                    $requete = $this->dao->prepare($sql);
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();

        if ($donnees = $requete->fetch(\PDO::FETCH_ASSOC))
        {
            //$donnees['dateAjout'] = new \DateTime($donnees['dateAjout']);
            //$donnees['dateModif'] = new \DateTime($donnees['dateModif']);
            //echo $donnees['libelle'],'<br/>';
            return new Equipe($donnees);
        }

        return null;
    }
    
    public function getList($debut = -1, $limite = -1) {
        $equipes=[];
        $sql="SELECT * FROM equipe";
        
        $requete = $this->dao->prepare($sql);
        $requete->execute();
        
        while ($data = $requete->fetch(\PDO::FETCH_ASSOC))
        {
            $equipe=new Equipe($data);
            $equipes[]=$equipe;
        }
        
        return $equipes;
    }
    
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM equipe')->fetchColumn();
    }
    
    protected function add(Equipe $equipe)
    {
        $q = $this->dao->prepare('INSERT INTO equipe SET idEquipe = :idEquipe,flag = :flag, libelle = :libelle');

        $q->bindValue(':idEquipe', $equipe->idEquipe(), \PDO::PARAM_INT);
        $q->bindValue(':libelle', $equipe->libelle());
        $q->bindValue(':flag', $equipe->flag());

        $q->execute();
    }
    
    protected function modify(Equipe $equipe)
    {        
        $q = $this->dao->prepare('UPDATE equipe SET libelle = :libelle,flag = :flag WHERE idEquipe = :idEquipe');
        
        $q->bindValue(':idEquipe', $equipe->idEquipe(), \PDO::PARAM_INT);
        $q->bindValue(':libelle', $equipe->libelle());
        $q->bindValue(':flag', $equipe->flag());

        $q->execute();
    }
}