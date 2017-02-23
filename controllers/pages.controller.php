<?php

	class PagesController extends Controller
	{

		public function __construct($data = [])
		{
			parent::__construct($data);
			$this->model = new Page();
		}

		public function index()
		{
			// TEST! $this->data['product'] = $this->model->getStockProduct();//'здесь будет список страниц. из PagesController/index'; //$this->model->getList()
            $this->data['product_mob'] = $this->model->getStockProductByType('mobile');
            $this->data['product_tab'] = $this->model->getStockProductByType('tablet');
            $this->data['product_lap'] = $this->model->getStockProductByType('laptop');
            $this->data['product_kon'] = $this->model->getStockProductByType('konsole');
            $this->data['product_tv'] = $this->model->getStockProductByType('tv');

            $this->data['mob'] = $this->model->getThreeProduct('mobile');
		    $this->data['tab'] = $this->model->getThreeProduct('tablet');
		    $this->data['lap'] = $this->model->getThreeProduct('laptop');
		    $this->data['kon'] = $this->model->getThreeProduct('konsole');
		    $this->data['tv'] = $this->model->getThreeProduct('tv');
		}

		public function view()
		{

			$params = App::getRouter()->getParams();

			if (isset($params[0]))
			{
				$alias = strtolower($params[0]);

				$this->data['category'] = $this->model->getByProductType($alias);//"БУДЕТ ОТОБРАЖАТЬСЯ СТРАНИЦА С АЛИАСОМ -> {$alias} отображение 1 страницы PagesController/view"; // $this->model->getByAlias($alias)

			}

		}


        public function Registration()
        {
            $this->data['user'] = $this->model->saveUser($_POST);
        }

        public function Login()
        {
            echo 'test action Login';
        }




		public function admin_index()
		{
			$this->data['pages'] = $this->model->getList();
		}

		public function admin_edit() {

			if($_POST) {
				$id = isset($_POST['id']) ? $_POST['id'] : null; // определение id страницы

				$result = $this->model->save($_POST, $id); // здесь необходимо еще и учитывать id
				if($result) {
					Session::setFlash('Страница была отредактирована!');
				} else {
					Session::setFlash('Ошибка! ');
				}
				Router::redirect('/admin/pages/');
			}

			if (isset($this->params[0])) {
				$this->data['page'] = $this->model->getById($this->params[0]);
			} else {
				Session::setFlash('Неверный id страницы');
				Router::redirect('/admin/pages/');
			}
		}

		public function admin_add() {
			// Проверка того, что передается в POST запросе без записи в БД
			if($_POST) {
//				echo "<pre>";
//				print_r($_POST);
//				die();
				$result = $this->model->save($_POST);
				if($result) {
					Session::setFlash('Страница была сохранена!');
				} else {
					Session::setFlash('Ошибка! ');
				}
				Router::redirect('/admin/pages/');
			}
		}

		public function admin_delete()
		{
			if(isset($this->params[0])) {
				$result = $this->model->delete($this->params[0]);

				if($result) {
					Session::setFlash('Страница была удалена!');
				} else {
					Session::setFlash('Ошибка! ');
				}
			}
			Router::redirect('/admin/pages/');
		}

	}