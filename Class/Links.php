<?php
    class Links{
        private $Link_login;
        private $Link_create_acount;
        private $forgot_password;
        private $Link_homescreen;
        private $Link_tasks;

        function Links(){
            $this->Link_tasks = "TasksScreen.php";
            $this->Link_login = "LoginScreen.php";
        }

        public function redirect_tasks($id=0){
            header("Location: /Projeto_CRUD/TasksScreen/$this->Link_tasks?id=$id");
        }
    }
?>