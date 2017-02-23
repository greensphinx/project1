<?php

	class UsersController extends Controller
	{
		public function __construct($data = [])
		{
			parent::__construct($data);
			$this->model = new User();
		}

		public function admin_login() {
			if($_POST && $_POST['login'] && $_POST['password']) {
				$user = $this->model->getByLogin($_POST['login']);
				$hash = md5(Config::get('salt') . $_POST['password']);
				if($user && $user['is_active'] && $hash == $user['password']) {
					Session::set('login', $user['login']);
					Session::set('role', $user['role']);
				}
				Router::redirect('/admin/');
			}
		}

		public function admin_logout() {
			Session::destroy();
			Router::redirect('/admin/');
		}

        public function register()
        {
            if ($_POST) {
                // something
                echo "GOOD!";
            }
        }

        public function login()
        {
            if ($_POST) {
                // something
                echo "GOOD222!";
            }
        }

	}