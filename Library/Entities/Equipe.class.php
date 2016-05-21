<?php
    namespace Library\Entities;

    class Equipe extends \Library\Entity
    {
        protected	$idEquipe,
                            $libelle,
                $flag;

        const LIBELLE_INVALIDE = 1;

        public function isValid()
        {
            return !(empty($this->libelle));
        }

            // SETTERS //

    public function setIdEquipe($idEquipe)
    {
        $this->idEquipe = $idEquipe;
        $this->id = $idEquipe;
    }
    
    public function setFlag($flag)
    {
        $this->flag = $flag;
    }

    public function setLibelle($libelle)
    {
        if (!is_string($libelle) || empty($libelle))
            $this->erreurs[] = self::LIBELLE_INVALIDE;
        else
            $this->libelle = $libelle;
    }



            // GETTERS //

    public function idEquipe()
    {
        return $this->idEquipe;
    }

    public function libelle()
    {
               return $this->libelle;
    }
    
    public function flag()
    {
        return $this->flag;
    }
}
	