<?php

namespace Asiw\Controller
{
    class BackendController extends Controller
    {
        public function Index()
        {
            if ($this->CanAccountEdit())
            {
                $this->ShowView();
            }
            else
            {
                $this->ShowView("BackendAccessDenied");
            }
        }
    }
}