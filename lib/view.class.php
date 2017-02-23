<?php

    class View
    {
        protected $data;
        protected $path; // путь к текущему файлу представления

        public function __construct($data = [], $path = null)
        {
            // если path не задана
            if( !$path ){
                $path = self::getDefaultViewPath();
            }

            if( !file_exists($path) ){
                throw new Exception("Файла по пути {$path} не существует");
            }
            $this->path = $path;
            $this->data = $data;
        }

        protected static function getDefaultViewPath()
        {
            $router = App::getRouter();
            if(!$router){
                return false;
            }

            $controller_dir = $router->getController();
            $template_name = $router->getMethodPrefix().$router->getAction().'.html';
            return VIEWS_PATH.DS.$controller_dir.DS.$template_name;
        }

        public function render()
        {
            $data = $this->data;

            ob_start();
            include ($this->path);
            $content = ob_get_clean();

            return $content;
        }
    }