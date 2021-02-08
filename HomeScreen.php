<?php
    require("Functions_HomeScreen.php");    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>  
    <link rel="stylesheet" href="StyleHomeScreen.css" type="text/css">
</head>
<body style="background: rgb(107, 107, 25)">
    <div class="Test">
        <?php
            if(isset($_POST["Submit"])){
                $UserName = $_POST["NameSpace"];
                $Messages = array();    
                foreach($_POST as $Fields => $Key){
                    if(CheckFields($Key)){
                        $Messages[$Fields] = "$Fields esta invalido!!!";
                        echo $Messages[$Fields];
                        echo "<br/>";
                        }
                    }
                }
            else{
               echo "Preencha o formulario"; 
            }
        ?>

        <form action = "HomeScreen.php" method = "POST" class="FirstForm">
            <label for="NameSpace">
                Nome: <input type="text" name="NameSpace"/>
            </label><br>

            <label for="EmailSpace">
                E-mail: <input type="text" name="EmailSpace"/> 
            </label><br>

            <label for="PassWord">
                senha: <input type="text" name="PassWordSpace"/> 
            </label><br>

            <input type="submit" name="Submit" value="Criar"/>
        </form>

        <form>
            <a href="#" id="Login">Login</a>
        </form>
    </div>
</body>
</html>