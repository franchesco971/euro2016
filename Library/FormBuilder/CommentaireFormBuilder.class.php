<?php
    namespace Library\FormBuilder;
    
    class CommentaireFormBuilder extends \Library\FormBuilder
    {
        public function build()
        {
			
			$this->form->add(new \Library\StringField(array(
                    'label' => 'Contenu',
                    'name' => 'contenu',
                    'maxLength' => 50,
                    'validators' => array(
                        new \Library\MaxLengthValidator('Le contenu est trop long (50 caractères maximum)', 50),
                        new \Library\NotNullValidator('Merci de spécifier le contenu du commentaire'),
                    ),
                 )));
		}
	}