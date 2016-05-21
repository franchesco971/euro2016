<?php
Namespace Applications\Frontend\Modules\Match;

use \Library\Entities\Parieur;

class MatchController extends \Library\BackController
{
    public function executeIndex(\Library\HTTPRequest $request)
    {
        if ($request->postExists('pseudo'))
        {
            $pseudo = $request->postData('pseudo');
            $pass = $request->postData('pass');
            $ParieurManager = $this->managers->getManagerOf('parieur');
            //echo 'c pass***'.$pseudo.'***'.$pass;
            if($pseudo!='' && $pass!='')
            {
                    $Parieur=$ParieurManager->connexion($pseudo,$pass);

                    if($Parieur !== false )
                    {
                            $this->app->user()->setAuthenticated(true);
                            $this->app->user()->setUser($Parieur);
                            //$this->app->httpResponse()->redirect('.');
                            $this->page->addVar('parieur', $Parieur);
                    }
                    else
                    {
                            //echo '*****';
                            $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
                    }
            }
            else
            {
                    $this->app->user()->setFlash('Le pseudo ou le mot de passe n\'est pas renseign&eacute;.');	
            }
        }


                // On ajoute une définition pour le titre
        $this->page->addVar('title', 'R&eacute;sultats des matches');	

                    // On récupère le manager
        $manager = $this->managers->getManagerOf('Match');

        $EquipeManager = $this->managers->getManagerOf('Equipe');

        $CommentaireManager = $this->managers->getManagerOf('Commentaire');

                    //$listeResultats = $manager->getListResultats($EquipeManager);
        $listeResultats = $manager->getListResultats();

                    // On ajoute la variable $listeNews à la vue
        $this->page->addVar('listeResultats', $listeResultats);

        $this->page->addVar('listeCommentaires', $CommentaireManager->getList());

                 //$this->page->addVar('form', \Applications\Frontend\Modules\Connexion\Views\index.php);
    }

    public function executeShow(\Library\HTTPRequest $request)
    {
        //echo $request->getData('id').'****<br/>';
        $idMatch=(int) $request->getData('id');

        $MatchManager = $this->managers->getManagerOf('Match');
        $CommentaireManager = $this->managers->getManagerOf('Commentaire');



        if ($request->method() == 'POST')
        {
            $commentaire = new \Library\Entities\Commentaire(array(
                'idMatch' => $request->getData('id'),
                                    'idParieur' => $request->postData('idParieur'),
                'contenu' => $request->postData('contenu'),
                'dateMatch' => time()
            ));
        }
        else
        {
            $commentaire = new \Library\Entities\Commentaire;
        }

        $formBuilder = new \Library\FormBuilder\CommentaireFormBuilder($commentaire);
        $formBuilder->build();

        $form = $formBuilder->form();

        if($request->method() == 'POST' && $form->isValid())
        {
            //$this->managers->getManagerOf('Commentaire')->save($commentaire);
            $CommentaireManager->save($commentaire);
            $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
            //$this->app->httpResponse()->redirect('match-'.$request->getData('id').'.html');
        }

        $ListeCommentaires=$CommentaireManager->getListOf($idMatch);
        $match= $MatchManager->getUnique($idMatch);

        $this->page->addVar('title', 'Match '.$match['equipe1']['libelle'].' - '.$match['equipe2']['libelle']);

        $this->page->addVar('match', $match);
        $this->page->addVar('ListeCommentaires', $ListeCommentaires);
        $this->page->addVar('form', $form->createView());

    }

    public function executePari(\Library\HTTPRequest $request)
    {
            $MatchManager = $this->managers->getManagerOf('Match');

            $listeMatchsParie=$MatchManager->getListMatchParie($_SESSION['user']->id());
            $listeMatchs=$MatchManager->getListMatch($_SESSION['user']->id());

            $this->page->addVar('title', 'Parier sur le match du jour');

            $this->page->addVar('listeMatchsParie', $listeMatchsParie);
            $this->page->addVar('listeMatchs', $listeMatchs);
    }
}