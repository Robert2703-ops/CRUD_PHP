<?php
    require("Functions_HomeScreen.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <?php
            if(isset($_POST["Submit"])){
                $UserName = $_POST["NameSpace"];
            
                foreach($_POST as $Fields => $Key){
                    if(CheckFields($Key)){
                        echo "$Fields esta invalido!!!";
                        echo "<br/>";
                    }
                }
            }
            else{
                echo "Erro!!";
            }
        ?>
    </div>
</body>
</html>