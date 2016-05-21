<?php
    namespace Library;
    
    abstract class Manager
    {
        protected $dao;
        
        public function __construct($dao)
        {
            //echo 'dzdazdazda8';
			$this->dao = $dao;
        }
		
		
    }
?>