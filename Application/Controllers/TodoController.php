<?php
    namespace Application\Controllers;

    use Application\Models\Todo;
    use Application\DB;

    class TodoController {
        private $model;

        public function __construct() {
            $this->model = new Todo(DB::getInstance());
        }

        public function delete($req) {
            if (!isset($req['post_id'])) {
                return false;
            }

            return $this->model->delete($req);
        }
        
        public function complete($req) {
            if (!isset($req['post_id'])) {
                return false;
            }

            return $this->model->complete($req);
        }

        public function get($req) {
            if (!is_numeric($req['edit'])) {
                return false;
            }

            return $this->model->get($req);
        }

        /**
         * Creates a todo
         *
         * $todo keys = [title, todo]
         * 
         * @param Array $req
         * @return boolean
         */
        public function create($req) {
            if (!isset($req['title']) || !isset($req['todo'])) {
                return false;
            }

            return $this->model->create($req);
        }
        
        public function update($req) {
            if (!isset($req['title']) || !isset($req['todo'])) {
                return false;
            }

            return $this->model->update($req);
        }
    }