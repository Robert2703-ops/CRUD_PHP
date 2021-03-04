<?php
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Links.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/User.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Data_Base.php");

    $Links = new Links();
    $Database = new DataBase();
    $User = new User();
    $Message = "Prossiga";
    
    if (isset($_GET['id']) && isset($_GET['email']))
    {
        $User->email = $_GET['email'];
        $id = $Database->search_data("id_user", "email", $User->email);
        $access = $Database->search_data("access", "email", $User->email);

        if ($id === $access){
            $Message = "Acesso liberado"; 
        }
        else {
            $Message = "Voce nao tem acesso aqui";
            $Links->redirect("/Projeto_CRUD/Error/ErrorScreen.php");
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
    <header class="User_place">
        <h1><?php echo $Message?></h1>
        <div>
            <a href="#"><img src="/Projeto_CRUD/Images/user_photo.jpg"></a>
        </div>
    </header>
    <main>
        
    </main>
</body>
</html>