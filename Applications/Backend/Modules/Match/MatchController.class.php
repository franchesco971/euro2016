<?php
Namespace Applications\Backend\Modules\match;

class MatchController extends \Library\BackController
{
    
    public function executeIndex(\Library\HTTPRequest $request)
    {
        $this->page->addVar('title', 'Gestion des matchs');

        $manager = $this->managers->getManagerOf('Match');
        
        $this->page->addVar('list', $manager->getList());
        
        $this->page->addVar('nbEntity', $manager->count());
    }

    public function executeInsert(\Library\HTTPRequest $request)
    {
        $this->processForm($request);
        $equipeManager = $this->managers->getManagerOf('Equipe');

        $this->page->addVar('title', 'Ajout d\'un match');
        $this->page->addVar('equipes', $equipeManager->getList());
    }

    public function executeUpdate(\Library\HTTPRequest $request)
    {
        $this->processForm($request);
        $equipeManager = $this->managers->getManagerOf('Equipe');

        $this->page->addVar('title', 'Modification d\'un match');
        $this->page->addVar('equipes', $equipeManager->getList());
    }

    public function executeDelete(\Library\HTTPRequest $request)
    {
        $this->managers->getManagerOf('Match')->delete($request->getData('id'));

        $this->app->user()->setFlash('Le Match a bien été supprimée !');

        $this->app->httpResponse()->redirect('.');
    }
    
    public function processForm(\Library\HTTPRequest $request)
    {
        if ($request->method() == 'POST')
        {
            $dateMatch=null;
            
            if( is_string($request->postData('dateMatch')))
                $dateMatch=  strtotime ($request->postData('dateMatch'));                                   
            
            $entity = new \Library\Entities\Match(
                array(
                    'idEquipe1' => $request->postData('idEquipe1'),
                    'idEquipe2' => $request->postData('idEquipe2'),
                    'score1' => $request->postData('score1'),
                    'score2' => $request->postData('score2'),
                    'dateMatch' => $dateMatch
                )
            );

            if ($request->getExists('id'))
            {
                $entity->setIdMatch($request->getData('id'));
            }
        }
        else
        {
            // L'identifiant de la news est transmis si on veut la modifier
            if ($request->getExists('id'))
            {
                $entity = $this->managers->getManagerOf('Match')->getUnique($request->getData('id'));
            }
            else
            {
                $entity = new \Library\Entities\Match;
            }
        }
        
        $formBuilder = new \Library\FormBuilder\MatchFormBuilder($entity);
        $formBuilder->build();

        $form = $formBuilder->form();
        
        if ($request->method() == 'POST' && $form->isValid())
        {
            $this->managers->getManagerOf('Match')->save($entity);
            
            if($request->postData('Valider'))
                $this->managers->getManagerOf('Match')->validate($entity);
            
            $this->app->user()->setFlash($entity->isNew() ? 'Le match a bien été ajoutée !' : 'Le match a bien été modifiée !');
            $this->app->httpResponse()->redirect('/admin/matchs');
        }
        
        $this->page->addVar('form', $form->createView());
        $this->page->addVar('match', $entity);
    }
}