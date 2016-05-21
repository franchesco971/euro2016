<?php
    function autoload($class)
    {
		// echo $class.'<br/>';
		require '../'.str_replace('\\', '/', $class).'.class.php';
    }
    
    spl_autoload_register('autoload');
?>