<?php

namespace Asiw\Model
{
    class Account
    {
        public $Id;
        public $Email;
        public $Role;

        function __construct($id, $email, $role)
        {
            $this->Id = $id;
            $this->Email = $email;
            $this->Role = $role;
        }

        public function CanEdit()
        {
            return $this->Role == "Admin" || $this->Role == "Editor";
        }

        public function IsAdmin()
        {
            return $this->Role == "Admin";
        }
    }
}