<?php
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/User.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Data_Base.php");
    require_once("C:/xampp/htdocs/Projeto_CRUD/Class/Links.php");

    $Link = new Links();
    $DataBase = new DataBase();
    $User = new User();
    $Message = "Preencha o formulario";
    $Errors_messages = array('nome', 'email', 'senha', 'count');
    
    if(isset($_POST["Submit"])){
        $Errors_messages = $User->validation_data($_POST["NameSpace"], $_POST["EmailSpace"], $_POST["PassWordSpace"],
                $Errors_messages);

        if($User->validation_email() === true){
            $Errors_messages['email'] = "campo email invalido!";
            $Errors_messages['count'] = $User->validation_count($Errors_messages['count']);
        }elseif($User->validation_email() === false){
            $number = $DataBase->search_data("email", "email", $User->email);
            if($number === $User->email){
                $Errors_messages['email'] = "Email nao disponivel";
                $Errors_messages['count'] = $User->validation_count($Errors_messages['count']);
            }
        }if($Errors_messages['count'] === false){
            $DataBase->set_data($User->name, $User->email, $User->password);
            $Link->redirect_tasks();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>  
    <link rel="stylesheet" href="LogupScreen.css" type="text/css">
</head>
<body style="background: rgb(107, 107, 25)">
    <div class="Test">
        
        <h1><?php echo $Message;?></h1>
        <?php 
            foreach($Errors_messages as $fields => $key){ 
                if(strpos($key, "disponivel") > 0 || strpos($key, "invalido") > 0){
                    echo $Errors_messages[$fields];
                    echo "</br>";
                }
            }
        ?>

        <form action = "LogupScreen.php" method = "POST" class="FirstForm">
            <label for="NameSpace">
                Nome: <input type="text" name="NameSpace"/>
            </label><br>

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