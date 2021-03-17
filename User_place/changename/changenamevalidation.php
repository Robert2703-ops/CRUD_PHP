<?php
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Links.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/User.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Data_Base.php");

    if( isset($_GET['email']) && isset($_GET['id']) )
    {
        $Links = new Links();
        $Database = new DataBase();
        $User = new User();
        $array_messages = array();

        $array_messages = $User->validation_data($_POST['name'], "", $_POST['password'], $array_messages);

        $message = null;
        foreach($array_messages as $fields => $key)
        {
            if ( strpos($key, "invalido") > 0)
            {
                $message .= "$key </br>"; 
            }
        }

        if ( $array_messages['count'] === true)
        {
            $Links->redirect("/Projeto_CRUD/User_place/changename.php", $message, $_GET['id'], $_GET['email']);
        }
        else 
        {
            $id = $Database->search_data("id_user", "email", $_GET['email']);

            if ( $Database->validation_password($_GET['email'], $_POST['password']) === true)
            {
                $Database->update_data($_GET['email'], "users", "name_user", $_POST['name']);
                $message = "nome atualizado com sucesso!";
                $Links->redirect("/Projeto_CRUD/User_place/changename.php", $message, $_GET['id'], $_GET['email']);
            }
            else 
            {
                $message = "senha incorreta, verifique-a e tente novamente";
                $Links->redirect("/Projeto_CRUD/User_place/changename.php", $message, $_GET['id'], $_GET['email']);
            }
        }
    }
?>