<?php

namespace Asiw\Controller
{
    class Controller
    {
        protected $ActionGet;
        protected $ActionPost;

        protected $ControllerName;

        function __construct()
        {
            $this->translations = TranslationController::ReceiveTranslations();
            
            $thisClassName = get_class($this);
            $splitted = explode("\\", $thisClassName);
            $this->ControllerName = str_replace("Controller", "", $splitted[count($splitted)-1]);            

            $this->ActionGet = filter_input(INPUT_GET, "action");
            $this->ActionPost = filter_input(INPUT_POST, "action");

            if (!$this->ActionGet)
            {
                $this->ActionGet = "Index";
            }

            $this->runActionMethod($this->ActionGet);
        }

        protected function ShowView($viewName = null, $useTemplate = null)
        {
            if (!isset($useTemplate))
            {
                $useTemplate = file_exists("View/_Template.php");
            }

            if (!isset($viewName))
            {
                $viewName = $this->ControllerName;
            }

            if ($useTemplate)
            {
                $view = "View/$viewName.php";
                if (file_exists("View/_Template.php"))
                {
                    include "View/_Template.php";
                }
                else
                {
                    throw new \RuntimeException("The template view couldn't be found.");
                }
            }
            else
            {
                include "View/$viewName.php";
            }
        }
        
        protected $translations;

        protected function T($keyword, $format = "normal")
        {
            $translation = \Asiw\Model\Translation::GetTranslationByKeyword($this->translations, $keyword);
            if ($format == "normal")
            {
                echo $translation->GetContent();
            }
            elseif ($format == "json")
            {
                echo json_encode($translation->GetContent());
            }
            else
            {
                return $translation->GetContent();
            }
        }

        protected function CanAccountEdit()
        {
            return \Asiw\App::GetCurrentAccount() !== null && \Asiw\App::GetCurrentAccount()->CanEdit();
        }

        protected function IsAccountAdmin()
        {
            return \Asiw\App::GetCurrentAccount() !== null && \Asiw\App::GetCurrentAccount()->IsAdmin();
        }

        private function runActionMethod($actionMethod)
        {
            if (method_exists($this, $actionMethod))
            {
                $reflection = new \ReflectionMethod($this, $actionMethod);
                if ($reflection->isPublic())
                {
                    $this->{$actionMethod}();
                }
                else
                {
                    throw new \RuntimeException("This Action Method is not public.");
                }
            }        
            else
            {
                throw new \RuntimeException("This Action Method does not exist.");
            }    
        }
    }
}