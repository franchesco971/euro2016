<?php
    namespace Library\FormBuilder;
    
    class ParieurFormBuilder extends \Library\FormBuilder
    {
        public function build()
        {
            $this->form->add(new \Library\StringField(array(
                    'label' => 'Pseudo',
                    'name' => 'pseudo',
                    'maxLength' => 20,
                    'validators' => array(
                        new \Library\MaxLengthValidator('Le pseudo sp�cifi� est trop long (20 caract�res maximum)', 20),
                        new \Library\NotNullValidator('Merci de sp�cifier le pseudo'),
                    ),
                 )))
                 ->add(new \Library\StringField(array(
                    'label' => 'Mot de passe',
                    'name' => 'pass',
                    'maxLength' => 100,
                    'validators' => array(
                        new \Library\MaxLengthValidator('Le Mot de passe sp�cifi� est trop long (100 caract�res maximum)', 100),
                        new \Library\NotNullValidator('Merci de sp�cifier le Mot de passe'),
                    ),
                 )))
				 ->add(new \Library\StringField(array(
                    'label' => 'Confirmation Mot de passe',
                    'name' => 'pass_verif',
                    'maxLength' => 100,
                    'validators' => array(
                        new \Library\MaxLengthValidator('Le Mot de passe sp�cifi� est trop long (100 caract�res maximum)', 100),
                        new \Library\NotNullValidator('<b style="color:#F00;">Merci de sp�cifier le Mot de passe</b>'),
                    ),
                 )))
				 ->add(new \Library\StringField(array(
                    'label' => 'Adresse Email',
                    'name' => 'email',
                    'maxLength' => 100,
                    'validators' => array(
                        new \Library\MaxLengthValidator('Email sp�cifi� est trop long (100 caract�res maximum)', 100),
                        new \Library\NotNullValidator('Merci de sp�cifier l\'email'),
						new \Library\EmailValidator('Email incorrect'),
                    ),
                 )));
		}
	}