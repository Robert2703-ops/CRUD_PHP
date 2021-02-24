<?php
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/User.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Data_Base.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Links.php");
   
    $User = new User();
    $Database = new DataBase();
    $Link = new Links();
    $Message = "Faca login na sua conta";
    $array_messages = array('email', 'senha');
    

    if(isset($_POST['Submit'])){
        $array_messages = $User->validation_data(null,$_POST['EmailSpace'], $_POST['PassWordSpace'],
                            $array_messages);
                $array_messages['nome'] = null;

        if($User->validation_email() === true && $User->validation_password() === true){
            $array_messages['email'] = "campo email invalido!";
            $Message = "Por favor, preencha o formulario corretamente";
        }if($User->validation_email() === true){
            $array_messages['email'] = "campo email invalido!";
        }
        elseif($User->validation_email() === false && $User->validation_password() === false){
            $count = $Database->search_data("email","email", $User->email);
            if($count === false){
                    $array_messages['email'] = "Email nao encontrado!";
                }else{
                    if($Database->validation_password("id_user", "email", $User->email, $User->password) === true){
                        $Link->redirect_tasks();
                    }else{
                        $array_messages['senha'] = "senha incorreta, por favor, tente novamente";
                    }
                }
            }
        }    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>  
    <link rel="stylesheet" href="LoginScreen.css" type="text/css">
</head>
<body style="background: rgb(107, 107, 25)">
    <div class="Test">
        <h1><?php echo $Message;?></h1>
        <?php
            foreach($array_messages as $fields => $key){
                if(strpos($key, "invalido") || strpos($key, "incorreta")){
                    echo $array_messages[$fields];
                    echo "</br>";
                }
            }
        ?>

        <form action = "LoginScreen.php" method = "POST" class="FirstForm">
            <label for="EmailSpace">
                E-mail: <input type="text" name="EmailSpace"/> 
            </label><br>

            <label for="PassWord">
                senha: <input type="password" name="PassWordSpace"/> 
            </label><br>
            <input type="submit" name="Submit" value="Criar"/>
        </form>
    </div>

</body>
</html>