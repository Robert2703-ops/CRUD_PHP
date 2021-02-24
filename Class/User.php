<?php
    class User{
        public $name;
        public $email;
        public $password;

        private function validation_empty($value){
            if(empty(trim($value)) || strlen($value) <= 3){
                return true;
            }else{
                return false;
            }
        }

        public function validation_name(){
            return $this->validation_empty($this->name);
        }

        public function validation_email(){
            if(strpos($this->email, "@gmail.com") === false || strpos($this->email, "@gmail.com") <= 5){
                return true;
            }else{
                return false;
            }
        }
        public function validation_password(){
            return $this->validation_empty($this->password);
        }

        public function validation_data($array_name, $array_email, $array_password,
                        $array_messages){
                                
            $this->name = $array_name;
            $this->email = $array_email;
            $this->password = $array_password;

            $array_error['nome'] = $this->validation_name();
            $array_error['senha'] = $this->validation_password();
            
            $array_messages['count'] = false;

            foreach($array_error as $fields => $error){
                if ($error === true){
                    $array_messages[$fields] = "campo $fields invalido!";
                    echo "</br>";
                    $array_messages['count'] = $this->validation_count($array_messages['count']);
                }
            }
            return $array_messages;
        }
        
        public function validation_count($value){
            $value = true;
            return $value;
        }
    }
?>