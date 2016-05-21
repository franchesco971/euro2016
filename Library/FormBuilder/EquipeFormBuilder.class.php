<?php
    namespace Library\FormBuilder;
    
    class EquipeFormBuilder extends \Library\FormBuilder
    {
        public function build()
        {
            $this->form->add(new \Library\StringField(array(
                    'label' => 'Libelle',
                    'name' => 'libelle',
                    'maxLength' => 30,
                    'validators' => array(
                        new \Library\MaxLengthValidator('Le libelle sp�cifi� est trop long (20 caract�res maximum)', 30),
                        new \Library\NotNullValidator('Merci de sp�cifier le libelle'),
                    ),
                 )))
                ->add(new \Library\StringField(array(
                    'label' => 'Flag',
                    'name' => 'flag',
                    'maxLength' => 30,
                    'validators' => array(
                        new \Library\MaxLengthValidator('Le flag sp�cifi� est trop long (20 caract�res maximum)', 30),
                        new \Library\NotNullValidator('Merci de sp�cifier le flag'),
                    ),
                 )));
        }
    }