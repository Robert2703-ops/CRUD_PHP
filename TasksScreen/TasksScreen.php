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
    $Message;
    
    if (isset($_GET['id']) && isset($_GET['email']))
    {
        if(isset($_GET['id']) && isset($_GET['email']))
        {
            $User->email = $Database->search_data("users", "email", "id_user", $_GET['id']);
            $id = $Database->search_data("users", "id_user", "email", $User->email);
            $access = $Database->search_data("users", "access", "email", $User->email);
    
            if($id !== $_GET['id'] || $access !== $_GET['id'] || $User->email !== $_GET['email'])
            {
                $Links->redirect("/Projeto_CRUD/Errors/ErrorScreen.php");
            }
            else
            {
                $User->name = $Database->search_data("users", "name_user", "email", $User->email);
                $Message = "Bem vindo, $User->name";
            }
        }
    }
    else
    {
        $Links->redirect("/Projeto_CRUD/SignupScreen/SignupScreen.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="TasksScreen.css" type="text/css">
    <link rel="stylesheet" href="addtasks.css" type="text/css">
</head>
<body>
    <header class="menu">   
        <div class="welcome">
            <h1>
                <?php
                    $tasks =  $Database_task->count_tasks($id);
                    echo " $Message, voce tem $tasks tarefas";
                    ?>
            </h1>
        </div>

        <nav class="menu">
            <?php
                echo 
                "
                    <a href='/Projeto_CRUD/User_place/changename/changename.php?id=$id&email=$User->email'>Alterar nome de usuario</a>
                    <a href='/Projeto_CRUD/User_place/changepassword/changepassword.php?id=$id&email=$User->email'>Alterar senha de acesso</a>
                "
            ?>
        </nav>
    </header>

    <main>
        <div class="tasks">
            <?php
                $array = array();
                $array = $Database_task->search_tasks($id, $array);

                for ($count = 0; $count < $tasks; $count += 1)
                {
                    echo
                    "
                        <div>
                            <label>{$array["title$count"]}</label>
                            <p>{$array["description$count"]}</p>
                            </br>
                            <a href='Edittask/edittasks.php?info=edit&id_task={$array["id_task$count"]}&id_user={$id}&email={$User->email}'>Editar</a>
                            <a href='Edittask/edittasks.php?info=delete&id_task={$array["id_task$count"]}&id_user={$id}&email={$User->email}'>Excluir</a>
                        </div>
                    ";
                }
            ?>
        </div>
    </main>

    <div class="addtask">
        <h3>Adicionar uma nova tarefa</h3>

        <?php
            if ( isset($_GET['info']) ) echo $_GET['info']
        ?>

        <?php
            echo 
            "
                <form action='addtasks.php?id=$id&email=$User->email' METHOD='POST' class='addtask'>
                    <label>Titulo da tarefa: </label>
                    <input type='text' name='titulo'>

                    <label>Descricao da tarefa: </label>
                    <input type='text' name='descricao'  id='description' maxlegth=500>
                    
                    <label>Data de inicio da tarefa: </label>
                    <input type='date' name='datainicio'></input>
                    
                    <label>Data limite para a tarefa: </label>
                    <input type='date' name='datafim'> 
                    
                    <input type='submit' name='submit' value='criar'>
                </form>
            ";
        ?>
    </div>

</body>
</html>

<?php $Database->close_connection() ?>