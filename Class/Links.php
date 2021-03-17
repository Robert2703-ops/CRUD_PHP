<?php
    class Links{

        public function redirect_tasks($id, $email){
            header("Location: /Projeto_CRUD/TasksScreen/TasksScreen.php?id=$id&email=$email");
        }
        public function redirect($value, $info="", $id="", $email=""){
            header("Location: $value?info=$info&id=$id&email=$email");
        }
    }
?>