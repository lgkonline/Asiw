<?php

namespace Asiw\Controller
{
    include "Controller.php";

    // Autoload Controller classes
    $controllerFiles = scandir(__DIR__);
    foreach ($controllerFiles as $currFile)
    {
        if ($currFile != "Controller.php" && strpos($currFile, "Controller") !== false)
        {
            include $currFile;
        }
    }

    class Initializer
    {
        public static function Init()
        {
            $controllerParameter = filter_input(INPUT_GET, "controller");

            if (!$controllerParameter)
            {
                $controllerParameter = "Home";
            }

            $controllerClassName = "\Asiw\Controller\\" . $controllerParameter . "Controller";

            if (class_exists($controllerClassName, false))
            {
                \Asiw\App::$CurrentController = new $controllerClassName();
            }
            else 
            {
                throw new \RuntimeException("This Controller does not exist");
            }            
        }
    } 
}