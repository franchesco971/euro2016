<?php
namespace Library\Models;

use \Library\Entities\Equipe;

abstract class EquipeManager extends \Library\Manager
{
    abstract public function getUnique($id);
    
    abstract protected function add(Equipe $equipe);
    
    abstract public function getList($debut = -1, $limite = -1);
    
    abstract public function count();
    
    /*abstract public function delete($id);*/
    
    abstract protected function modify(Equipe $equipe);
    
    public function save(Equipe $equipe)
    {
        if ($equipe->isValid())
        {            
            $equipe->isNew() ? $this->add($equipe) : $this->modify($equipe);
        }
        else
        {
            throw new \RuntimeException('L\'equipe doit être validée pour être enregistrée');
        }
    }
}