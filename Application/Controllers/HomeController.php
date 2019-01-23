<?php
    namespace Application\Controllers;

    use Application\Models\Todo;
    use Application\DB;

    class HomeController {
        private $model;

        public function __construct() {
            $this->model = new Todo(DB::getInstance());
        }

        public function getTodos() {
            return $this->model->all();
        }
    }