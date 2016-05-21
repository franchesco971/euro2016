<?php
Namespace Applications\Frontend\Modules\Parieur;

class ParieurController extends \Library\BackController
{
        public function executeIndex(\Library\HTTPRequest $request)
        {
                // On ajoute une définition pour le titre
    $this->page->addVar('title', 'Inscription');	

                // On récupère le manager
    //$manager = $this->managers->getManagerOf('Match');

                // $EquipeManager = $this->managers->getManagerOf('Equipe');

                // $CommentaireManager = $this->managers->getManagerOf('Commentaire');

                //$listeResultats = $manager->getListResultats($EquipeManager);
                // $listeResultats = $manager->getListResultats();

                // On ajoute la variable $listeNews à la vue
    // $this->page->addVar('listeResultats', $listeResultats);

                // $this->page->addVar('listeCommentaires', $CommentaireManager->getList());
        }

        public function executeInscription(\Library\HTTPRequest $request)
        {						
                // Si le formulaire a été envoyé
    if ($request->method() == 'POST')
    {
        //echo 'c passé!!!!!';
                        $parieur = new \Library\Entities\Parieur(array(
            'pseudo' => $request->postData('pseudo'),
            'pass' => $request->postData('pass'),
                                'pass_verif' => $request->postData('pass_verif'),
            'email' => $request->postData('email')
        ));
    }
    else
    {
                        // echo 'c pa passé!!!!!';
                        $parieur = new \Library\Entities\Parieur;
                }

                $formBuilder = new \Library\FormBuilder\ParieurFormBuilder($parieur);
                //echo 'c passé!!!!!';
    $formBuilder->build();

    $form = $formBuilder->form();

                if($request->method() == 'POST' && $form->isValid())
    {
                        if($parieur->pass()==$parieur->pass_verif())
                        {
                                $this->managers->getManagerOf('Parieur')->save($parieur);
                $this->app->user()->setFlash('Vous avez bien été ajouté, merci !');
                        }
                        else
                        {
                                $this->app->user()->setFlash('Les mots de passe sont diff&eacute;rents');	
                        }
                        //echo 'c valid****';
                }

                $this->page->addVar('form', $form->createView());

                // On ajoute une définition pour le titre
    $this->page->addVar('title', 'Inscription');
        }

        public function executeDeconnexion(\Library\HTTPRequest $request)
        {
                $this->app->user()->setAuthenticated(false);
                $this->app->user()->unsetUser();
                $this->app->httpResponse()->redirect('/');
}

        public function executeParier(\Library\HTTPRequest $request)
        {
            if ($request->method() == 'POST')
            {
                    $this->managers->getManagerOf('Parieur')->parier($request->postData('idGagnant'),$request->postData('idMatch'));
                    $match = $this->managers->getManagerOf('Match')->getUnique($request->postData('idMatch'));
                    if($match->idGagnant())
                    $this->managers->getManagerOf('Match')->setWinners($match);
                    
                    $this->app->user()->setFlash('V&ocirc;tre pari a été pris en compte');
            }
            else
            {
                    $this->app->user()->setFlash('Un probleme est survenu');	
            }

            $this->app->httpResponse()->redirect('/parier.html');
        }

        public function executeModifPari(\Library\HTTPRequest $request)
        {
                if ($request->method() == 'POST')
    {
                        $this->managers->getManagerOf('Parieur')->modifPari($request->postData('idGagnant'),$request->postData('idMatch'));
                        $this->app->user()->setFlash('V&ocirc;tre pari a été modifi&eacute;');

                }
                else
                {
                        $this->app->user()->setFlash('Un probleme est survenu');	
                }

                $this->app->httpResponse()->redirect('/parier.html');
        }

}