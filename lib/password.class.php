<?php

    class Password extends Model
    {
        private $password;
        private $hashedPassword;
        private $salt;

        public function __construct($password, $salt = null)
        {
            $this->password = $password;
            $this->salt = md5( is_null($salt) ? Config::get('salt') : $salt );
            $this->hashedPassword = md5($this->salt . $password);
        }

        public function __toString()
        {
            return $this->hashedPassword;
        }

        
    }