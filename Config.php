<?php

/* 
If you want to modify the config without changing this file,
just dublicate this file, rename it to "Config_custom.php" and make the changes you need.
*/

namespace Asiw
{
    class Config
    {
        public static $DbConfig = 
        [
            "ServerName" => "localhost",
            "DbName" => "asiw",
            "UserName" => "admin",
            "Password" => "123456"
        ];   
        public static $RootUrl = "http://localhost/Asiw/";
        public static $Title = "My first Asiw App";
        public static $Language = "English"; // "English" | "German"
    }
}