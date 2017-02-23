<?php

class KonsoleController extends Controller
{
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->model = new Page();
    }

    public function index()
    {
        $this->data['category_kon'] = $this->model->getCategory('konsole');
    }

    public function view()
    {
        //echo "test from view";
        $params = App::getRouter()->getParams();

        if (isset($params[0]))
        {
            $id = strtolower($params[0]);

            $this->data['one_product'] = $this->model->getById($id);//"БУДЕТ ОТОБРАЖАТЬСЯ СТРАНИЦА С АЛИАСОМ -> {$alias} отображение 1 страницы PagesController/view"; // $this->model->getByAlias($alias)


            if ($_POST)
            {
                if ($this->model->saveMessage($_POST, $id))
                {
                    Session::setFlash('Спасибо! Комментарий добавлен!');
                }
            }
        }

    }
}