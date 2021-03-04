<?php
    class DataBase{
        private $bd_host;
        private $bd_user;
        private $bd_password;
        private $bd_name;
        private $connection;
    
        function DataBase(){
            $this->bd_host = "localhost";
            $this->bd_user = "robert";
            $this->bd_password = "rpl123";
            $this->bd_name = "php_CRUD";
            $this->connection = mysqli_connect($this->bd_host, $this->bd_user, $this->bd_password, $this->bd_name);
        
            if(mysqli_connect_errno()){
                die("Conexao com o banco de dados falhou!" .
                    mysqli_connect_error() .
                    "(" . mysqli_connect_errno() . ")"
                );
            }
            else{
                return "connection is working";
            }
        }

        private function set_access($value){
            $id_user = $this->search_data("id_user", "email", $value);
            
            $query_insert = "UPDATE usuarios SET access = {$id_user} 
                            WHERE id_user = {$id_user}";
            $result = mysqli_query($this->connection, $query_insert);
            
            if($result){
                echo "Suuuuuucesso!";
            }else{
                die("Consulta ao banco de dados falhou! " . mysqli_error($this->connection));
            }     
        }

        public function set_data($dataname, $dataemail, $datapassword){
            $query_insert = "INSERT INTO usuarios (name_user, email, password_user)
                                 VALUES ('$dataname', '$dataemail', '$datapassword')";
                $result = mysqli_query($this->connection, $query_insert);

            if($result){
                echo "Suuuuuucesso!";
                $this->set_access($dataemail);
            }
            else{
                die("Consulta ao banco de dados falhou! " . mysqli_error($this->connection));
            }
        }

        public function search_data($colunm, $id, $value){
            $Query_select_email = "SELECT $colunm FROM usuarios WHERE $id = '$value'";
            $result = mysqli_query($this->connection, $Query_select_email);

            if(!$result){
                die("Consulta ao banco de dados falhou!");
            }
            if($result === 0){
                return false;
            }
            else{
                $number = null;
                while($row = mysqli_fetch_assoc($result)){
                    $number = $row[$colunm];
                }mysqli_free_result($result);
                return $number;
            }
        }

        public function validation_password($colunm, $id, $value, $comparison_object){
            $var = $this->search_data($colunm, $id, $value);
            $var = $this->search_data("id_user", "email", $value);

            $var = $this->search_data("password_user", "id_user", $var);
            if($var === $comparison_object){
                return true;
            }else{
                return false;
            }
        }
    }
?>