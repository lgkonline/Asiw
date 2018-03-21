<?php

namespace Asiw\Controller
{
    use \Asiw\Model;
    use \PDO;

    // http://php.net/manual/de/ref.password.php

    class AccountController extends Controller
    {
        public function Register()
        {
            header("Content-Type: text/json");
            $email = filter_input(INPUT_POST, "email");
            $password = filter_input(INPUT_POST, "password");

            $addUserResponse = $this->addUser($email, $password);

            if ($addUserResponse === true)
            {
                http_response_code(200);
                echo json_encode("Success");
            }
            else
            {
                http_response_code(500);
                echo $addUserResponse;
            }
        }

        public function SignIn()
        {
            header("Content-Type: text/json");
            $email = filter_input(INPUT_POST, "email");
            $password = filter_input(INPUT_POST, "password");

            $receiveUserResponse = $this->receiveUser($email, $password);

            if ($receiveUserResponse === true)
            {
                http_response_code(200);
                echo json_encode("Success");
            }
            else
            {
                http_response_code(500);
                echo $receiveUserResponse;
            }
        }

        public function SignOut()
        {
            \Asiw\App::setCurrentAccount(null);
            header("Location: " . \Asiw\Config::$RootUrl);
        }

        public function GetAccounts()
        {
            header("Content-Type: text/json");
            http_response_code(200);
            echo json_encode($this->getAllAccounts());            
        }

        private function doesUserExist($email)
        {
            try
            {
                $sql = "SELECT Id FROM user WHERE Email = '$email' LIMIT 1";
                $statement = \Asiw\App::$DbHandler->Connection->prepare($sql);
                $statement->execute();
                $result = $statement->setFetchMode(PDO::FETCH_ASSOC);

                foreach ($statement->fetchAll() as $u)
                {
                    return true;
                } 
                return false;
            }
            catch (PDOException $ex)
            {
                return "Error: " . $ex->getMessage();
            }
        }

        private function addUser($email, $password)
        {
            if ($this->doesUserExist($email))
            {
                return "This user does already exist.";
            }
            else
            {
                $password = \password_hash($password, PASSWORD_BCRYPT);

                try
                {
                    $sql = "INSERT INTO user (Email, Password) "
                            . "VALUES('$email', '$password')";

                    \Asiw\App::$DbHandler->Connection->exec($sql);
                    return true;
                }
                catch (PDOException $ex)
                {
                    return "Error: " . $ex->getMessage();
                }
            }
        }

        private function receiveUser($email, $password)
        {
            try
            {
                $sql = "SELECT * FROM user WHERE Email = '$email' LIMIT 1";
                $statement = \Asiw\App::$DbHandler->Connection->prepare($sql);
                $statement->execute();
                $result = $statement->setFetchMode(PDO::FETCH_ASSOC);

                foreach ($statement->fetchAll() as $u)
                {
                    if (password_verify($password, $u["Password"]))
                    {
                        // Password correct

                        $this->setCurrentAccount($u);

                        return true;
                    }
                    else
                    {
                        // Password wrong
                        return "The password is wrong";
                    }
                }   
                return "This user does not exist.";             
            }
            catch (PDOException $ex)
            {
                return "Error: " . $ex->getMessage();
            }
        }

        private function getAllAccounts()
        {
            $retVal = [];

            try
            {
                $sql = "SELECT * FROM user";
                $statement = \Asiw\App::$DbHandler->Connection->prepare($sql);
                $statement->execute();
                $result = $statement->setFetchMode(PDO::FETCH_ASSOC);

                foreach ($statement->fetchAll() as $u)
                {
                    array_push($retVal, $this->getAccountByUserData($u));
                }            
            }
            catch (PDOException $ex)
            {
                throw new \RuntimeException("Error: " . $ex->getMessage());
            }

            return $retVal;
        }

        private function getAccountByUserData($userFromDb)
        {
            return new \Asiw\Model\Account($userFromDb["Id"], $userFromDb["Email"], $userFromDb["Role"]);
        }

        private function setCurrentAccount($userFromDb)
        {
            \Asiw\App::setCurrentAccount($this->getAccountByUserData($userFromDb));
        }
    }
}