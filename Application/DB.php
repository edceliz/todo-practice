<?php
    namespace Application;

    class DB {
        static function getInstance() {
            return new \mysqli('localhost', 'root', 'notroot', 'practice_crud1');
        }
    }