<?php

namespace Asiw
{
    class App
    {
        public static $Version = "1.0.0";

        public static $DbHandler;
        public static $CurrentController;

        private static $currentAccount;
        public static function SetCurrentAccount($value)
        {
            self::$currentAccount = $value;
            $_SESSION["CurrentAccount"] = $value;
        }
        public static function GetCurrentAccount()
        {
            if (isset($_SESSION["CurrentAccount"]))
            {
                self::$currentAccount = $_SESSION["CurrentAccount"];
            }
            return self::$currentAccount;
        }

        function __construct()
        {
            self::$DbHandler = new Model\DbHandler();

            \Asiw\Controller\Initializer::Init();
        }
    }
}