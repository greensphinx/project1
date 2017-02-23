<?php

    class CommentController extends Controller
    {

        public function __construct($data = [])
        {
            parent::__construct($data);

            $this->model = new Message();

        }

        public function index()
        {
            if ($_POST)
            {
                if ($this->model->saveMessage($_POST))
                {
                    Session::setFlash('Спасибо! Сообщение успешно отправлено!');
                }
            }
        }

        public function admin_index() {
            $this->data = $this->model->getList();
        }
    }