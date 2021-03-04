<?php
    class Links{
        private $Link_tasks;

        function Links(){
            $this->Link_tasks = "TasksScreen.php";
        }

        public function redirect_tasks($id, $email){
            header("Location: /Projeto_CRUD/TasksScreen/$this->Link_tasks?id=$id&email=$email");
        }
        public function redirect($value){
            header("Location: $value");
        }
    }
?>