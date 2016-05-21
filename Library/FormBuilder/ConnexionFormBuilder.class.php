<?php
    namespace Library\FormBuilder;
    
    class ConnexionFormBuilder extends \Library\FormBuilder
    {
        public function build()
        {
			$this->form->add(new \Library\StringField(array(
                    'label' => 'Pseudo',
                    'name' => 'Pseudo',
                    'maxLength' => 20,
                    'validators' => array(
                        new \Library\MaxLengthValidator('Le\'pseudo spécifié est trop long (20 caractères maximum)', 20),
                        new \Library\NotNullValidator('Merci de spécifier l\'pseudo de la news'),
                    ),
                 )))
                 ->add(new \Library\StringField(array(
                    'label' => 'Mot de passe',
                    'name' => 'Mot de passe',
                    'maxLength' => 30,
                    'validators' => array(
                        new \Library\MaxLengthValidator('Le Mot de passe spécifié est trop long (30 caractères maximum)', 30),
                        new \Library\NotNullValidator('Merci de spécifier le Mot de passe de la news'),
                    ),
                 )));
		}
	}