<?php
Namespace Applications\Frontend\Modules\Equipe;

class EquipeController extends \Library\BackController
{
    public function executeShow(\Library\HTTPRequest $request)
    {
        $idEquipe=(int) $request->getData('id');

        $EquipeManager = $this->managers->getManagerOf('Equipe');


        $equipe= $EquipeManager->getUnique($idEquipe);

        $this->page->addVar('title', 'Equipe '.$equipe['libelle']);

        $this->page->addVar('equipe', $equipe);

    }
    
    public function executeIndex(\Library\HTTPRequest $request)
    {
        $this->page->addVar('title', 'Gestion des équipe');

        $manager = $this->managers->getManagerOf('News');

        $this->page->addVar('listeEquipes', $manager->getList());
        $this->page->addVar('nombreEquipes', $manager->count());
    }

    public function executeInsert(\Library\HTTPRequest $request)
    {
        $this->processForm($request);

        $this->page->addVar('title', 'Ajout d\'une équipe');
    }

    public function executeUpdate(\Library\HTTPRequest $request)
    {
        $this->processForm($request);

        $this->page->addVar('title', 'Modification d\'une équipe');
    }

    public function executeDelete(\Library\HTTPRequest $request)
    {
        $this->managers->getManagerOf('Equipe')->delete($request->getData('id'));

        $this->app->user()->setFlash('L\'équipe a bien été supprimée !');

        $this->app->httpResponse()->redirect('.');
    }
}