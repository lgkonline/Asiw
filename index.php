<?php

namespace Asiw
{
    
    if (file_exists("Config_custom.php"))
    {
        include "Config_custom.php";
    }
    else
    {
        include "Config.php";
    }

    include "Model/_models.php";
    include "Controller/Initializer.php";
    include "App.php";

    session_start();

    $app = new App();
}