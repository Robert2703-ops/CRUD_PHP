<?php
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Links.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/User.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Data_Base.php");

    $Links = new Links();
    $Database = new DataBase();
    $User = new User();
    $array_message = array();
    $Message;

    if(isset($_GET['id']) && isset($_GET['email']))
    {
        $User->email = $Database->search_data("users", "email", "id_user", $_GET['id']);
        $id = $Database->search_data("users", "id_user", "email", $User->email);
        $access = $Database->search_data("users", "access", "email", $User->email);
 
        if($id !== $_GET['id'] || $access !== $_GET['id'] || $User->email !== $_GET['email']){
            $Links->redirect("/Projeto_CRUD/Errors/ErrorScreen.php");
        }
        else{
            $User->name = $Database->search_data("users", "name_user", "email", $User->email);
            $Message = "Aqui voce pode alterar seu nome de usuario, $User->name";
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

    <link rel="stylesheet" href="changename.css">
</head>
<body>
    <h1>
        <?php echo $Message ?>
    </h1>

    <?php
        if (isset($_GET['info'])) $info = $_GET['info']; else $info = "Preencha as informacoes";

        echo "
            <form action='changenamevalidation.php?id=$id&email=$User->email' method='POST' class='changename'> 
                <label>{$info}</label>
                <label>Digite seu novo nome de usuario aqui em baixo: </label> 
                <input type='text' name='name' placeholder='nome atual: $User->name'>

                <label>Digite sua senha: </label>
                <input type='password' name='password'> 
                
                <input type='submit' name='submit' value='enviar'> 
            </form> ";
    ?>
</body>
</html>
<?php $Database->close_connection(); ?>