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
        $User->email = $Database->search_data("email", "id_user", $_GET['id']);
        $id = $Database->search_data("id_user", "email", $User->email);
        $access = $Database->search_data("access", "email", $User->email);
 
        if($id !== $_GET['id'] || $access !== $_GET['id'] || $User->email !== $_GET['email']){
            $Links->redirect("/Projeto_CRUD/Errors/ErrorScreen.php");
        }
        else{
            $User->name = $Database->search_data("name_user", "email", $User->email);
            $Message = "Aqui voce pode alterar sua senha de usuario, $User->name";
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
</head>
<body>
    <h1>
        <?php echo $Message ?>
    </h1>

    <?php
        if ( isset($_GET['info']) ) echo $_GET['info'];
        echo "
            <form action='changepasswordvalidation.php?id=$id&email=$User->email' method='POST'> 
                <label>Para alterar sua senha, primeiro digite a senha atual</label> 
                <input type='password' name='password' placeholder='senha atual'>
                <input type='password' name='newpassword' placeholder='digite sua nova senha'> 
                <input type='submit' name='submit' value='enviar'> 
            </form> 
            ";
    ?>
</body>
</html>