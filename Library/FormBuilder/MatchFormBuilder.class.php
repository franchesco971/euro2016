<?php
    namespace Library\FormBuilder;
    
    class MatchFormBuilder extends \Library\FormBuilder
    {
        public function build()
        {
            $this->form->add(new \Library\StringField(array(
                    'label' => 'idEquipe1',
                    'name' => 'idEquipe1',
                 )))
                ->add(new \Library\StringField(array(
                    'label' => 'idEquipe2',
                    'name' => 'idEquipe2',
                 )))
                ->add(new \Library\StringField(array(
                    'label' => 'dateMatch',
                    'name' => 'dateMatch',                    
                 )));
        }
    }