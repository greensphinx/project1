<?php

    class Registration extends Model
    {
        private $email;
        private $username;
        private $password;
        private $passwordConfirm;

        function __construct(Array $data)
        {
            $this->email = isset($data['email']) ? $data['email'] : null;
            $this->username = isset($data['username']) ? $data['username'] : null;
            $this->password = isset($data['password']) ? $data['password'] : null;
            $this->passwordConfirm = isset($data['passwordConfirm']) ? $data['passwordConfirm'] : null;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function getUsername()
        {
            return $this->username;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function getPasswordConfirm()
        {
            return $this->passwordConfirm;
        }


        public function passwordsMatch()
        {
            return $this->password == $this->passwordConfirm;
        }

        public function validate()
        {
            return !empty($this->email) && !empty($this->username) && !empty($this->password) && !empty($this->passwordConfirm) && $this->passwordsMatch();
        }

        public function saveUser($data, $id = null)
        {
            if (!isset($data['name']) || !isset($data['email']) || !isset($data['password']) || !isset($data['confirm_password']))
            {
                return false;
            }

            $id      = (int) $id;
            $name    = $this->db->escape($data['name']);
            $email   = $this->db->escape($data['email']);
            $password = $this->db->escape($data['password']);

            if (!$id)
            {
                $sql = "insert into user
								set user_name = '{$name}',
									user_email = '{$email}',
									user_password = '{$password}'
							";
            }

            return $this->db->query($sql);
        }
    }