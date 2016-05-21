<?php
Namespace Applications\Backend\Modules\Equipe;

class EquipeController extends \Library\BackController
{
    
    public function executeIndex(\Library\HTTPRequest $request)
    {
        $this->page->addVar('title', 'Gestion des équipes');

        $manager = $this->managers->getManagerOf('Equipe');

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
    
    public function processForm(\Library\HTTPRequest $request)
    {
        if ($request->method() == 'POST')
        {
            $entity = new \Library\Entities\Equipe(
                array(
                    'libelle' => $request->postData('libelle'),
                    'flag' => $request->postData('flag'),
                )
            );

            if ($request->getExists('id'))
            {
                $entity->setIdEquipe($request->getData('id'));
            }
            
        }
        else
        {
            // L'identifiant de la news est transmis si on veut la modifier
            if ($request->getExists('id'))
            {
                $entity = $this->managers->getManagerOf('Equipe')->getUnique($request->getData('id'));
            }
            else
            {
                $entity = new \Library\Entities\Equipe;
            }
        }
        
        $formBuilder = new \Library\FormBuilder\EquipeFormBuilder($entity);
        $formBuilder->build();

        $form = $formBuilder->form();

        if ($request->method() == 'POST' && $form->isValid())
        {            
            $this->managers->getManagerOf('Equipe')->save($entity);
            $this->app->user()->setFlash($entity->isNew() ? 'L\'entity a bien été ajoutée !' : 'l\'entity a bien été modifiée !');
            $this->app->httpResponse()->redirect('/admin/equipes');
        }
        $this->page->addVar('form', $form->createView());
        $this->page->addVar('equipe', $entity);
    }
}