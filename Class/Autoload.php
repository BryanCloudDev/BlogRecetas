<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once('./Controllers/functions.php');
require_once('./db/config.php');

spl_autoload_register(
    function ($class) 
    {
        if(file_exists('./Controllers/' . $class . '.php'))
        {
            require_once('./Controllers/' . $class . '.php');
        }
        elseif(file_exists('./Models/' . $class . '.php'))
        {
            require_once('./Models/' . $class . '.php');
        }
        elseif(file_exists('./Class/' . $class . '.php'))
        {
            require_once('./Class/' . $class . '.php');
        }
    }
);