<?php
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Links.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/User.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Data_Base.php");

    $Links = new Links();
    $Database = new DataBase();
    $User = new User();
    $Message;
    
    if (isset($_GET['id']) && isset($_GET['email']))
    {
        if(isset($_GET['id']) && isset($_GET['email']))
        {
            $User->email = $Database->search_data("email", "id_user", $_GET['id']);
            $id = $Database->search_data("id_user", "email", $User->email);
            $access = $Database->search_data("access", "email", $User->email);
    
            if($id !== $_GET['id'] || $access !== $_GET['id'] || $User->email !== $_GET['email']){
                $Links->redirect("/Projeto_CRUD/Errors/ErrorScreen.php");
            }
            else{
                $User->name = $Database->search_data("name_user", "email", $User->email);
                $Message = "bem vindo $User->name";
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
</head>
<body>
    <header class="menu">     
        <div class="welcome">
            <h1><?php echo $Message ?></h1>
        </div>

        <nav class="menu">
            <?php
                echo "<a href='/Projeto_CRUD/User_place/changename/changename.php?id=$id&email=$User->email'>Alterar nome de usuario</a>
                      <a href='/Projeto_CRUD/User_place/changepassword/changepassword.php?id=$id&email=$User->email'>Alterar senha de acesso</a>"
            ?>
        </nav>
    </header>

    <main>
        <h3>Voce tem 0 tarefas e lembretes</h3>

        <div class="tasks">
            <p>Aqui vao as tarefas!!!!!</p>
        </div>
    </main>

    <script src="animation.js"></script>
</body>
</html>
<?php $Database->close_connection() ?>