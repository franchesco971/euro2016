<?php
    namespace Applications\Backend;
    
    class BackendApplication extends \Library\Application
    {
        public function __construct()
        {
            parent::__construct();
            
            $this->name = 'Backend';
        }
        
        public function run()
        {
            if ($this->user->isAuthenticated() && !isset($_SESSION['user']))
            {
                $controller = $this->getController();
            }
            else
            {
                $this->user->setAuthenticated(false);
                $this->user->unsetUser();
                $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index');
            }
            
            $controller->execute();
            
            $this->httpResponse->setPage($controller->page());
            $this->httpResponse->send();
        }
    }
?>