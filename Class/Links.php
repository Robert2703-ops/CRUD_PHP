<?php
    class Links{
        private $Link_tasks;

        function Links(){
            $this->Link_tasks = "TasksScreen.php";
        }

        public function redirect_tasks($id=0){
            header("Location: /Projeto_CRUD/TasksScreen/$this->Link_tasks?id=$id");
        }
        public function redirect($value){
            header("Location: $value");
        }
    }
?>