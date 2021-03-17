<?php
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Links.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/User.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Data_Base.php");

    $Links = new Links();
    $Database = new DataBase();
    $User = new User();
    $message = null;

    if( isset($_GET['email']) && isset($_GET['id']) && isset($_POST['submit']) && empty($_POST['newpassword']) === false)
    {
        $array_messages = array();

        $array_messages = $User->validation_data("", $_GET['email'], $_POST['password'], $array_messages);

        if( $User->validation_password() === true )
        {
            $message = "Senha invalida, por favor digite novamente";
            $Links->redirect("/Projeto_CRUD/User_place/changepassword/changepassword.php", $message, $_GET['id'], $_GET['email']);
        }
        else if( $Database->validation_password($User->email, $User->password) === true)
        {
            $Database->update_data($User->email, "users", "password_user", $_POST['newpassword']);
            $message = "Senha atualiza com sucesso!";
            $Links->redirect("/Projeto_CRUD/User_place/changepassword/changepassword.php", $message, $_GET['id'], $User->email);
        }
        else
        {
            $message = "Senha incorreta, por favor, verifeque e tente novamente!";
            $Links->redirect("/Projeto_CRUD/User_place/changepassword/changepassword.php", $message, $_GET['id'], $User->email);
        }
    }
    else
    {
        $message = "Preencha os campos corretamente!";
        $Links->redirect("/Projeto_CRUD/User_place/changepassword/changepassword.php", $message, $_GET['id'], $_GET['email']);
    }
?>