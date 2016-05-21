<?php
	Namespace Applications\Frontend\Modules\Classement;
	
	class ClassementController extends \Library\BackController
	{
		public function executeIndex(\Library\HTTPRequest $request)
		{
			$classement=$this->managers->getManagerOf('Parieur')->classement();
			//$classementService=$this->managers->getManagerOf('Parieur')->classementService();
                        $classementService=[];
			
			$this->page->addVar('title', 'Classement');
			
			$this->page->addVar('classement', $classement);
			$this->page->addVar('classementService', $classementService);
		}
	}