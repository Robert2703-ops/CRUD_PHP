<?php
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Links.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/task.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Data_Base.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Data_Base_tasks.php");
 
    $Links = new Links();
    $Database = new DataBase();
    $Database_task = new DataBase_tasks();
    $Task = new Task();
    $messages = array();
    $message = "";
     
    
    if (isset($_GET['id']) && isset($_GET['email']))
    {
        if (isset($_POST['titulo']) && isset($_POST['descricao']))
        {
            $messages = $Task->validation_data($_POST['titulo'], $_POST['descricao'], $messages);
            
            if ($messages['count'] === true)
            {
                foreach ($messages as $fields => $key)
                {
                    if ( strpos($key, "invalido") > 0)
                    {
                        $message .= "$key </br>";
                    }
                }
                
                $Links->redirect("TasksScreen.php", $message, $_GET['id'], $_GET['email'] );
            }
            else 
            {
                $Database_task->set_task($Task->title, $Task->description, $Task->start_date, $Task->finish_date, $_GET['id']);
                $message = "Tarefa criada com sucesso!";
                $Links->redirect("TasksScreen.php", $message, $_GET['id'], $_GET['email'] );
            }
        }
    }
    else
    {
        $Links->redirect("/Projeto_CRUD/Errors/ErrorScreen.php");
    }

?>