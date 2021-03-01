<?php
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Links.php");
    $Links = new Links();
    $Message = "Prossiga";
    if(isset($_GET['id']))
    {
        if($_GET['id']){
            $Message = "pagina de usuario";
        }else{
            $Message = $_GET['id'];
        }
    }
    else
    {
        echo 'acesso negado';
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