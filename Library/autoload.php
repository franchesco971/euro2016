<?php
    function autoload($class)
    {
        //echo $class.'<br/>';
        //$class='../'.str_replace('\\', '/', $class).'.class.php';
        $class='../'.str_replace('\\', '/', $class).'.class.php';
        //echo $class.'<br/>';
        require $class;
    }
    
    spl_autoload_register('autoload');
?>