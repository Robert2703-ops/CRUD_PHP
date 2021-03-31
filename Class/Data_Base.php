<?php
    class DataBase{
        private $connection;
    
        public function __construct()
        {
            $this->connection = mysqli_connect("localhost", "robert", "rpl123", "php_tasks");
        
            if(mysqli_connect_errno())
            {
                die ("Conexao com o banco de dados falhou!" .
                    mysqli_connect_error() .
                    "(" . mysqli_connect_errno() . ")"
                );
            }
            else{
                return "conexao ta ok";
            }
        }

        public function update_data($search_value, $table_update, $colunm_update, $new_value)
        {
            $id = $this->search_data("users", "id_user", "email", $search_value);
            
            $Query_update = "UPDATE $table_update SET $colunm_update =  '$new_value'
                            WHERE id_user = '$id'";
            $result = mysqli_query($this->connection, $Query_update);

            if(!$result)
            {
                die("Consulta ao banco falhou " . mysqli_error($this->connection));
            }
            else
            {
                return true;
            }        
        }

        public function set_data($dataname, $dataemail, $datapassword)
        {
            $query_insert = "INSERT INTO users (name_user, email, password_user)
                                VALUES ('$dataname', '$dataemail', '$datapassword')";
            $result = mysqli_query($this->connection, $query_insert);

            if($result)
            {
                echo "Suuuuuucesso!";
                $id = $this->search_data("users","id_user", "email", $dataemail);
                $this->update_data($dataemail, "users", "access", $id);
            }
            else
            {
                die("Consulta ao banco de dados falhou! " . mysqli_error($this->connection));
            }
        }

        public function search_data($table,$colunm, $id, $value)
        {
            $Query_select_email = "SELECT $colunm FROM $table WHERE $id = '$value'";
            $result = mysqli_query($this->connection, $Query_select_email);

            if(!$result)
            {
                die("Consulta ao banco de dados falhou! " .  mysqli_error($this->connection));
            }
            if($result === 0)
            {
                return false;
            }
            else
            {
                $number = null;
                while($row = mysqli_fetch_assoc($result))
                {
                    $number = $row[$colunm];
                }mysqli_free_result($result);
                return $number;
            }
        }

        public function validation_password($value, $comparison_object)
        {
            $var = $this->search_data("users", "id_user", "email", $value);
            $var = $this->search_data("users", "password_user", "id_user", $var);

            if($var === $comparison_object)
            {
                return true;
            }else
            {
                return false;
            }
        }

        public function close_connection()
        {
            mysqli_close($this->connection);
        }
    }
?>