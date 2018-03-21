<?php

namespace Asiw\Controller
{
    class HomeController extends Controller
    {
        public function Index()
        {
            $this->ShowView("Home", true);
        }

        public function Count()
        {
            self::SetTest(self::GetTest()+1);
            echo self::GetTest();
        }
    }
}