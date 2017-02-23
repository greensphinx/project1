<?php

    class LoginForm extends Controller
    {
        private $username;
        private $password;

        public function __construct(Array $data)
        {
            $this->username = isset($data['username']) ? $data['username'] : null ;
            $this->password = isset($data['password']) ? $data['password'] : null ;
        }

        public function getUsername()
        {
            return $this->username;
        }

        public function setUsername($username)
        {
            $this->username = $username;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }



        public function validate()
        {
            return !empty($this->username) && !empty($this->password);
        }

    }

