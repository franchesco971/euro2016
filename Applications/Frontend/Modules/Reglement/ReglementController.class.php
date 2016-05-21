<?php
	Namespace Applications\Frontend\Modules\Reglement;
	
	class ReglementController extends \Library\BackController
	{
		public function executeIndex(\Library\HTTPRequest $request)
		{
            $this->page->addVar('title', 'Reglement');	
		}
	}