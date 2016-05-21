<?php
namespace Library\Models;

use \Library\Entities\Parieur;

class ParieurManager_PDO extends ParieurManager
{
    public function getUnique($id)
    {
        $requete = $this->dao->prepare('SELECT idParieur, pseudo, pass, email FROM parieur WHERE idParieur = :id');
        $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $requete->execute();

        if ($donnees = $requete->fetch(\PDO::FETCH_ASSOC))
        {
            return new Parieur($donnees);
        }

        return null;
    }

    protected function add(Parieur $parieur)
    {
        $sql='INSERT INTO parieur SET pseudo = :pseudo, pass = :pass, email = :email';
                    $q = $this->dao->prepare($sql);

        $q->bindValue(':pseudo', $parieur->pseudo());
        $q->bindValue(':pass', $parieur->pass());
        $q->bindValue(':email', $parieur->email());

        $q->execute();

        $parieur->setId($this->dao->lastInsertId());
    }


    public function connexion($pseudo,$pass)
    {
        $sql='SELECT idParieur as id, pseudo, pass, email FROM parieur WHERE pseudo = :pseudo AND pass = :pass';
                    $requete = $this->dao->prepare($sql);

        $requete->bindValue(':pseudo', $pseudo);
        $requete->bindValue(':pass', $pass);
        $requete->execute();

        if ($donnees = $requete->fetch(\PDO::FETCH_ASSOC))
        {
            $parieur=new Parieur($donnees);

            return $parieur;
        }

        return false;
    }

    public function parier($idGagnant,$idMatch)
    {
        $sql='INSERT INTO participation SET idParieur = :idParieur, idMatch = :idMatch, idGagnant = :idGagnant';
        $q = $this->dao->prepare($sql);
        $q->bindValue(':idGagnant', $idGagnant, \PDO::PARAM_INT);
        $q->bindValue(':idMatch', $idMatch, \PDO::PARAM_INT);
        $q->bindValue(':idParieur', $_SESSION['user']->id(), \PDO::PARAM_INT);

        $q->execute();

    }

    public function modifPari($idGagnant,$idMatch)
    {
        $sql="UPDATE participation SET idGagnant = :idGagnant WHERE idMatch = :idMatch AND idParieur = :idParieur";
        $q = $this->dao->prepare($sql);
        $q->bindValue(':idGagnant', $idGagnant, \PDO::PARAM_INT);
        $q->bindValue(':idMatch', $idMatch, \PDO::PARAM_INT);
        $q->bindValue(':idParieur', $_SESSION['user']->id(), \PDO::PARAM_INT);

        $q->execute();

    }

    public function classement()
    {
        $sql='	SELECT p1.idParieur as id,pseudo,sum(points) AS points 
                        FROM parieur p1,participation p2 
                        WHERE p1.idParieur=p2.idParieur 
                        GROUP BY pseudo 
                        ORDER BY points desc';

        $requete = $this->dao->prepare($sql);

        $requete->execute();
        $classement=[];

        while ($donnees = $requete->fetch(\PDO::FETCH_ASSOC))
        {
            $parieur=new Parieur($donnees);

            $classement[]=$parieur;
        }

        $requete->closeCursor();

        return $classement;
    }

    public function classementService()
    {
        $classementService=array();

        $sql='SELECT service as pseudo,AVG(somme) as points FROM (
                            SELECT idParieur, sum(points) as somme,\'info*\' as service FROM participation WHERE idParieur in (9,11,14,15,24,32) group by idParieur
                            UNION
                            SELECT idParieur, sum(points) as somme,\'sevres\' as service FROM participation WHERE idParieur in (20) group by idParieur
                            UNION
                            SELECT idParieur, sum(points) as somme,\'client*\' as service FROM participation WHERE idParieur in (16,12,21,22,23,27,30,33) group by idParieur
                            UNION
                            SELECT idParieur, sum(points) as somme,\'commercial\' as service FROM participation WHERE idParieur in (19) group by idParieur
                            UNION
                            SELECT idParieur, sum(points) as somme,\'marketing\' as service FROM participation WHERE idParieur in (10,17,29,31,34,35) group by idParieur
                            ) AS groupes GROUP BY service ORDER BY 	points desc';

        $requete = $this->dao->prepare($sql);
        $requete->execute();

        while ($donnees = $requete->fetch(\PDO::FETCH_ASSOC))
        {
            $parieur=new Parieur($donnees);

            $classementService[]=$parieur;
        }

        $requete->closeCursor();

        return $classementService;
    }
}