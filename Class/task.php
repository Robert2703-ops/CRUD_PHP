<?php
    class Task 
    {
        public $title;
        public $description;
        public $start_date;
        public $finish_date;

        private function validation_empty($value)
        {
            if(empty(trim($value)) || strlen($value) <= 4){
                return true;
            }else{
                return false;
            }
        }

        public function validation_title()
        {
            return $this->validation_empty($this->title);
        }    
        public function validation_description()
        {
            return $this->validation_empty($this->description);
        }

        public function validation_data($array_title, $array_description, $array_messages)
        {                        
            $this->title = $array_title;
            $this->description = $array_description;

            $array_error['titulo'] = $this->validation_title();
            $array_error['descricao'] = $this->validation_description();
            
            $array_messages['count'] = false;

            foreach($array_error as $fields => $error)
            {
                if ($error === true){
                    $array_messages[$fields] = "campo $fields invalido! ";
                    $array_messages['count'] = $this->validation_count($array_messages['count']);
                }
            }
            return $array_messages;
        }

        public function validation_count($value)
        {
            $value = true;
            return $value;
        }
    }
?>