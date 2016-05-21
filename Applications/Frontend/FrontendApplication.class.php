<?php
namespace Applications\Frontend;

class FrontendApplication extends \Library\Application
{
    public function __construct()
    {
        parent::__construct();

        $this->name = 'Frontend';
    }

    public function run()
    {			
        if ($this->user->isAuthenticated() || strpos($this->httpRequest->requestURI(), 'inscription')!==false)
        {
            $controller = $this->getController();
        }
        else
        {
            $controller = new Modules\Match\MatchController($this, 'Match', 'index');
        }

        $controller->execute();

        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }
}
?>