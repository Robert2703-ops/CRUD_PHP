<?php
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/User.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Data_Base.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Links.php");

    $Link = new Links();
    $DataBase = new DataBase();
    $User = new User();
    $Message = "Crie sua conta";
    $Errors_messages = array('nome', 'email', 'senha', 'count');
    
    if(isset($_POST["Submit"])){
        $Errors_messages = $User->validation_data($_POST["NameSpace"], $_POST["EmailSpace"], $_POST["PassWordSpace"],
                $Errors_messages);

        if($User->validation_email() === true){
            $Errors_messages['email'] = "campo email invalido!";
            $Message = "Preencha os campos corretamente!";
            $Errors_messages['count'] = $User->validation_count($Errors_messages['count']);
        }elseif($User->validation_email() === false){
            $number = $DataBase->search_data("email", "email", $User->email);
            if($number === $User->email){
                $Errors_messages['email'] = "Email nao disponivel";
                $Errors_messages['count'] = $User->validation_count($Errors_messages['count']);
            }
        }if($Errors_messages['count'] === false){
            $DataBase->set_data($User->name, $User->email, $User->password);
            $id = $DataBase->search_data("id_user", "email", $User->email);
            $Link->redirect_tasks($id);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>  
    <link rel="stylesheet" href="SignupScreen.css" type="text/css">
    <link rel="stylesheet" href="Text.css" type="text/css">
    <link rel="stylesheet" href="Welcome.css" type="text/css">
</head>
<body>
    <div class="Back">
        <div class="Box">
            <h1><?php echo $Message;?></h1>
            <?php 
                foreach($Errors_messages as $fields => $key){ 
                    if(strpos($key, "disponivel") > 0 || strpos($key, "invalido") > 0){
                        echo $Errors_messages[$fields];
                        echo "</br>";
                    }
                }
            ?>


            <form action = "SignupScreen.php" method = "POST" class="Box">
                <label for="NameSpace">
                    <input type="text" name="NameSpace" placeholder="Nome"/>
                </label>

                <label for="EmailSpace">
                    <input type="text" name="EmailSpace" placeholder="Email"/> 
                </label>

                <label for="PassWord">
                    <input type="password" name="PassWordSpace" placeholder="Senha"/> 
                </label>
                <input type="submit" name="Submit" value="Criar"/>
            </form>

            <div class="Text">
                Ja tem conta aqui no nosso servico? <a href="/Projeto_CRUD/LoginScreen/LoginScreen.php">Login</a>
            </div>
        </div>

        <div class="Welcome">
            <h2>Bem vindo</h2>
            <p>Aqui vai alguns exemplos do projeto!
        </div>
    </div>
</body>
</html>