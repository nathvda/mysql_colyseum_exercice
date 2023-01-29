<?php

class clientUpdaterValidator{

    private $data; 
    private static $fields = ['lastName','firstName','birthDate','fidelityCard','cardNumber'];
    private $errors = [];

    function __construct($post_data)
    {
        $this->data = $post_data;
    }

    public function validate_user(){
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->data)){
                trigger_error("$field does not exist in data");
                return;
            }
        }

        $this->validate_name();
        $this->validate_firstName();
        $this->validate_birthDate();
        $this->validate_fidelityCard();
        $this->validate_cardNumber();

        if (count($this->errors) === 0){

            include '../controller/clientscontr.php';
            
            $cli = new Clientscontr();
            $cli = $cli->editClient($this->data);

            return $this->errors;

        } else {
            return $this->errors;
        }

    }

    private function validate_name(){
        $val = htmlspecialchars(stripslashes(trim($this->data['lastName'])));
        if (empty($val)){
            $this->add_error('lastName', 'lastName cannot be empty');
        } else {
            if(!preg_match('/^[-\sa-zA-ZÁ-ù]*$/',$val)){
                $this->add_error('lastName', 'lastName must be alphanumeric');
            } else {
                $_POST['lastName'] = $val;
            }
        }
    }

    private function validate_firstName(){
        $val = htmlspecialchars(stripslashes(trim($this->data['firstName'])));
        if (empty($val)){
            $this->add_error('firstName', 'firstName cannot be empty');
        } else {
            if(!preg_match('/^[-\sa-zA-ZÀ-ù]*$/',$val)){
                $this->add_error('firstName', 'firstName must be alphanumeric');
            } else {
                $_POST['firstName'] = $val;
            }
        }
    }

    private function validate_birthDate(){
        $val = htmlspecialchars(stripslashes(trim($this->data['birthDate'])));
        if (empty($val)){
            $this->add_error('birthDate', 'birthDate cannot be empty');
        } else {
            if(!preg_match('/^[-0-9]*$/',$val)){
                $this->add_error('birthDate', 'birthDate must be alphanumeric');
            } else {
                $_POST['birthDate'] = date($val);
            }
        }
    }

    private function validate_fidelityCard(){
        $val = htmlspecialchars(trim($this->data['fidelityCard']));
        if (empty($val)){
            $this->add_error('fidelityCard', 'fidelityCard cannot be empty');
        } else {
            if(($val != "false") AND ($val != "true")){
                $this->add_error('fidelityCard', 'fidelityCard must be selected');
            } else {
                if ($val == "false") {
                    $_POST['fidelityCard'] = 0;
                } else {
                    $_POST['fidelityCard'] = 1;
                }
            }
        }
    }

    private function validate_cardNumber(){
        $val = htmlspecialchars(stripslashes(trim($this->data['cardNumber'])));
        if (empty($val)){
            $this->add_error('cardNumber', 'cardNumber cannot be empty');
        } else {
            if(!preg_match('/^[0-9]{4}$/',$val)){
                $this->add_error('cardNumber', 'cardNumber must be a digit');
            } else {

                if ($this->data['fidelityCard'] == false){
                    $_POST['cardNumber'] = NULL;
                } else {
                $_POST['cardNumber'] = intval($val);
                }
            }
        }
    }
    
    private function add_error($key,$value){

        $this->errors[$key] = $value;

    }
}




?>