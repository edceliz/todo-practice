<?php
    namespace Application\Models;

    class Todo {
        private $db;

        function __construct($db) {
            $this->db = $db;
        }

        function create($todo) {
            $query = $this->db->prepare('INSERT INTO todos (title, todo) VALUES (?, ?)');
            $query->bind_param('ss', $todo['title'], $todo['todo']);
            $query->execute();
            $insert_id = $query->insert_id;
            $query->close();
            $this->db->close();

            return $insert_id;
        }

        function delete($todo) {
            $query = $this->db->prepare('DELETE FROM todos WHERE id = ? LIMIT 1');
            $query->bind_param('i', $todo['post_id']);
            $query->execute();
            $deleted = $query->affected_rows;
            $query->close();
            $this->db->close();

            return $deleted;
        }
        
        function complete($todo) {
            $query = $this->db->prepare('UPDATE todos SET is_completed = 1 WHERE id = ? LIMIT 1');
            $query->bind_param('i', $todo['post_id']);
            $query->execute();
            $updated = $query->affected_rows;
            $query->close();
            $this->db->close();

            return $updated;
        }
        
        function update($todo) {
            $query = $this->db->prepare('UPDATE todos SET title = ?, todo = ? WHERE id = ? LIMIT 1');
            $query->bind_param('ssi', $todo['title'], $todo['todo'], $todo['id']);
            $query->execute();
            $updated = $query->affected_rows;
            $query->close();
            $this->db->close();

            return $updated;
        }

        /**
         * Returns all todos
         *
         * @return Array
         */
        function all() {
            $query = $this->db->query('SELECT * FROM todos ORDER BY id DESC');
            $result = [];
            while ($row = $query->fetch_assoc()) {
                $result[] = (object) $row;
            }
            $this->db->close();
            
            return $result;
        }

        function get($todo) {
            $query = $this->db->prepare('SELECT * FROM todos WHERE id = ? LIMIT 1');
            $query->bind_param('i', $todo['edit']);
            $query->execute();
            $result = (object) $query->get_result()->fetch_assoc();
            $query->close();
            $this->db->close();

            return  $result;
        }
    }