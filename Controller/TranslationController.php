<?php

namespace Asiw\Controller
{
    use \Asiw\Model;
    use \PDO;

    class TranslationController extends Controller
    {
        public function Index() 
        {
            $this->GetTranslations();
        }

        public function GetTranslations()
        {
            header("Content-Type: text/json");
            echo json_encode(self::ReceiveTranslations());
        }

        public function UpdateTranslation()
        {
            header("Content-Type: text/json");
            $translationId = filter_input(INPUT_POST, "translationId");
            $colName = filter_input(INPUT_POST, "colName");
            $colValue = filter_input(INPUT_POST, "colValue");

            $updateOneTranslationResponse = $this->updateOneTranslation($translationId, $colName, $colValue);

            if ($updateOneTranslationResponse === true)
            {
                http_response_code(200);
                $this->T("BE_CHANGES_SUCCESSFUL", "json");
            }
            else
            {
                http_response_code(500);
                echo $updateOneTranslationResponse;
            }
        }

        public function AddTranslation()
        {
            header("Content-Type: text/json");

            $addBlankTranslationResponse = $this->addBlankTranslation();
            if ($addBlankTranslationResponse === true)
            {
                http_response_code(200);
                echo json_encode("Success");
            }
            else
            {
                http_response_code(500);
                echo $addBlankTranslationResponse;
            }
        }

        public function DeleteTranslation()
        {
            header("Content-Type: text/json");
            $translationId = filter_input(INPUT_POST, "translationId");

            $deleteOneTranslationResponse = $this->deleteOneTranslation($translationId);

            if ($deleteOneTranslationResponse === true)
            {
                http_response_code(200);
                echo json_encode("Success");
            }
            else
            {
                http_response_code(500);
                echo $deleteOneTranslationResponse;
            }            
        }

        public static function ReceiveTranslations()
        {
            $retVal = []; // of Translation

            try 
            {
                $sql = "SELECT * FROM translation";
                $statement = \Asiw\App::$DbHandler->Connection->prepare($sql);
                $statement->execute();
                $result = $statement->setFetchMode(PDO::FETCH_ASSOC);

                foreach ($statement->fetchAll() as $c)
                {
                    array_push($retVal, new \Asiw\Model\Translation($c["Id"], $c["Keyword"], $c["English"], $c["German"]));
                }
            }
            catch (PDOException $ex)
            {
                echo "Error: " . $ex->getMessage();
            }

            return $retVal;            
        }

        private function addBlankTranslation()
        {
            if ($this->CanAccountEdit())
            {
                try
                {
                    $sql = "INSERT INTO translation (Keyword, English, German) VALUES ('NEW_TRANSLATION', '', '')";
                    \Asiw\App::$DbHandler->Connection->exec($sql); 
                    return true;
                }
                catch (PDOException $ex)
                {
                    // http_response_code(500);
                    return "Error: " . $ex->getMessage();
                }
            }
            else
            {
                return "You are not allowed to this. You have to be signed in as an admin.";
            }
        }

        private function deleteOneTranslation($translationId)
        {
            if ($this->CanAccountEdit())
            {
                try
                {
                    $sql = "DELETE FROM translation WHERE Id = '$translationId'";
                    \Asiw\App::$DbHandler->Connection->exec($sql); 
                    return true;
                }
                catch (PDOException $ex)
                {
                    // http_response_code(500);
                    return "Error: " . $ex->getMessage();
                }
            }
            else
            {
                return "You are not allowed to this. You have to be signed in as an admin.";
            }
        }

        private function updateOneTranslation($translationId, $colName, $colValue)
        {
            if ($this->CanAccountEdit())
            {
                try
                {
                    $sql = "UPDATE translation SET $colName='$colValue' WHERE Id=$translationId";
                    $statement = \Asiw\App::$DbHandler->Connection->prepare($sql);
                    $statement->execute();    
                    return true;
                }
                catch (PDOException $ex)
                {
                    // http_response_code(500);
                    return "Error: " . $ex->getMessage();
                }
            }
            else
            {
                return "You are not allowed to this. You have to be signed in as an admin.";
            }
        }
    }
}