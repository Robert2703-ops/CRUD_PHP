<?php
    $Message = "Prossiga";
    if($_GET['id'] <= 0){
        $Message = "voce nao tem acesso a essa pagina, por favor volte a pagina de login ou crie uma conta!";
    }else{
        $Message = $_GET['id'];
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