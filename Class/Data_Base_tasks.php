<?php
    class DataBase_tasks{
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
                return true;
            }
        }

        public function set_task($title_task, $description_task, $date_start="", $date_finish="", $id)
        {
            $array_info = array ('title' => $title_task, 'description_task' => $description_task, 'date_start'  => $date_start, 'date_finish' => $date_finish, 'id' => $id);

            foreach ($array_info as $fields => $key)
            {
                $array_info[$fields] = $this->fix_string($key);
            }
            
            $sql_query = "INSERT INTO tasks (title_tasks, description_tasks, date_start, date_finish, fk_id_user)
                          VALUES ('{$array_info['title']}', '{$array_info['description_task']}', '{$array_info['date_start']}', '{$array_info['date_finish']}', '$id')";
            $result = mysqli_query($this->connection, $sql_query);

            if(!$result)
            {
                die("Consulta ao banco falhou " . mysqli_error($this->connection));
            }
            else
            {
                return true;
            }
        }

        public function search_tasks($id, $array)
        {
            $id = $this->fix_string($id);

            $sql_query = "SELECT * FROM tasks WHERE fk_id_user = '$id' ";
            $result = mysqli_query($this->connection, $sql_query);
            
            if(!$result)
            {
                die("Consulta ao banco falhou " . mysqli_error($this->connection));
            }
            else
            {
                $count = 0;
                foreach ($result as $fields => $key)
                {
                    $array["id_task$count"] = $key['id_tasks'];
                    $array["title$count"] = $key['title_tasks'];
                    $array["description$count"] = $key['description_tasks'];
                    $count += 1;
                }
                return $array;
            }
        }

        public function count_tasks($id)
        {   
            $id = $this->fix_string($id);
            $sql_query = "SELECT COUNT(fk_id_user) FROM tasks WHERE fk_id_user = '$id' ";
            $result = mysqli_query($this->connection, $sql_query);

            if(!$result)
            {
                die("Consulta ao banco falhou " . mysqli_error($this->connection));
            }
            else
            {
                $value = null;
                while ($row = mysqli_fetch_assoc($result))
                {
                    $value = $row['COUNT(fk_id_user)'];
                }mysqli_free_result($result);

                return $value;
            }
        }

        public function update_task($colunm_update, $new_value, $id)
        {
            $colunm_update = $this->fix_string($colunm_update);
            $new_value = $this->fix_string($new_value);
            $id = $this->fix_string($id);

            $sql_query = $Query_update = "UPDATE tasks SET $colunm_update =  '$new_value'
                         WHERE id_tasks = '$id'";
            $result = mysqli_query($this->connection, $sql_query);

            if (!$result)
            {
                die ("Consulta ao banco de dados falhou! " . mysqli_error($this->connection));
            }
            else
            {
                return true;
            }
        }

        public function delete_task($id)
        {
            $sql_query = "DELETE FROM tasks WHERE id_tasks = $id";
            $result = mysqli_query($this->connection, $sql_query);

            if (!$result)
            {
                die ("Consulta ao banco de dados falhou! " . mysqli_error($this->connection));
            }
            else
            {
                return true;
            }
        }

        private function fix_string($value)
        {
            mysqli_real_escape_string($this->connection, $value);
            return $value;
        }
    }
?>