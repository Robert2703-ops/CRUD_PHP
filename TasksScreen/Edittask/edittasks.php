<?php
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Links.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/User.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Data_Base.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Data_Base_tasks.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/task.php");

    $Links = new Links();
    $Database = new DataBase();
    $User = new User();
    $Database_task = new DataBase_tasks();
    $Task = new Task();
    $validation = array();
    $Message = "";

    if (isset($_POST['submit']))
    {
        $validation = $Task->validation_data($_POST['title_tasks'], $_POST['description_tasks'], $validation);

        if ($validation['count'] === true)
        {
            foreach ($validation as $fields => $key)
            {
                if (strpos($key, "invalido") > 0)
                {
                    $Message .= "$key </br>";
                }
            }
        }
        else
        {
            foreach ($_POST as $fields => $key)
            {
                if ($fields !== "submit")
                {
                    $Database_task->update_task($fields, $key, $_GET['id_task']);
                }
            }
        }
    }

    if (isset($_GET['id_user']) && isset($_GET['email']) && isset($_GET['id_task']))
    {
        if ($_GET['info'] === "edit" || $_POST['info'] === "edit")
        {
            $Task->title = $Database->search_data("tasks", "title_tasks", "id_tasks", $_GET['id_task']);
            $Task->description = $Database->search_data("tasks", "description_tasks", "id_tasks", $_GET['id_task']);
            $Task->start_date = $Database->search_data("tasks", "date_start", "id_tasks", $_GET['id_task']);
            $Task->finish_date = $Database->search_data("tasks", "date_finish", "id_tasks", $_GET['id_task']);

            
            echo 
            "
                <form action='edittasks.php?info=edit&id_user={$_GET['id_user']}&email={$_GET['email']}&id_task={$_GET['id_task']}' method='POST' id='edit'>
                    <label>Titulo</label>
                    <input type='text' name='title_tasks' value='{$Task->title}'>
                    
                    <label>Descricao</label>
                    <input type='text' name='description_tasks' value='{$Task->description}' id='description'>
                    
                    <label>Data inicio</label>
                    <input type='date' name='date_start' value='{$Task->start_date}'>
                    
                    <label>Data final</label>
                    <input type='date' name='date_finish' value='{$Task->finish_date}'>
                    
                    <input type='submit' name='submit' value='salvar'>
                </form>
            ";
        }
        else if ($_GET['info'] === "delete")
        {
            $Database_task->delete_task($_GET['id_task']);
            $Links->redirect("/Projeto_CRUD/TasksScreen/TasksScreen.php", "", $_GET['id_user'], $_GET['email']);
        }
    }
    else 
    {
        $Links->redirect("/Projeto_CRUD/Errors/ErrorScreen.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="edittask.css">
</head>
<body>
    
</body>
</html>