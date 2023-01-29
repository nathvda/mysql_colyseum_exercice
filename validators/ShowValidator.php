<?php
include '../controller/showscontr.php';

class ShowValidator{

    private $data; 
    private static $fields = ['title','performer','date','showType','firstGenre','secondGenre','duration','startTime'];
    private $errors = [];

    function __construct($post_data)
    {
        $this->data = $post_data;
    }

    public function validate_show(){
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->data)){
                trigger_error("$field does not exist in data");
                return;
            }
        }

        $this->validate_title();
        $this->validate_artist();
        $this->validate_date();
        $this->validate_showType();
        $this->validate_firstGenre();
        $this->validate_secondGenre();
        $this->validate_duration();
        $this->validate_startTime();

        if (count($this->errors) === 0){
        
        $show = new Showscontr();
        $show = $show->createShow($this->data);

        } else {
        return $this->errors;
        }
    }

    public function update_show(){
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->data)){
                trigger_error("$field does not exist in data");
                return;
            }
        }

        $this->validate_title();
        $this->validate_artist();
        $this->validate_date();
        $this->validate_showType();
        $this->validate_firstGenre();
        $this->validate_secondGenre();
        $this->validate_duration();
        $this->validate_startTime();

        if (count($this->errors) === 0){
        
        $show = new Showscontr();
        $show = $show->editShow($this->data);

        return $this->errors;

        } else {
        return $this->errors;
        }
    }

    private function validate_title(){
        $val = htmlspecialchars(stripslashes(trim($this->data['title'])));
        if (empty($val)){
            $this->add_error('title', 'title cannot be empty');
        } else {
            if(!preg_match('/^[-\sa-zA-ZÁ-ù:]*$/',$val)){
                $this->add_error('title', 'title must be alphanumeric');
            } else {
                $this->data['title'] = $val;
            }
        }
    }

    private function validate_artist(){
        $val = htmlspecialchars(stripslashes(trim($this->data['performer'])));
        if (empty($val)){
            $this->add_error('performer', 'performer cannot be empty');
        } else {
            if(!preg_match('/^[-\sa-zA-ZÀ-ù:]*$/',$val)){
                $this->add_error('performer', 'performer must be alphanumeric');
            } else {
                $this->data['performer'] = $val;
            }
        }
    }

    private function validate_date(){
        $val = htmlspecialchars(stripslashes(trim($this->data['date'])));
        if (empty($val)){
            $this->add_error('date', 'date cannot be empty');
        } else {
            if(!preg_match('/^[-0-9]*$/',$val)){
                $this->add_error('date', 'date must be alphanumeric');
            } else {
                $_POST['date'] = date($val);
            }
        }
    }

    private function validate_showType(){
        $val = htmlspecialchars(trim($this->data['showType']));
        if (empty($val)){
            $this->add_error('showType', 'showType cannot be empty');
        } else {
            if(!preg_match('/^[0-9]*$/',$val)){
                $this->add_error('showType', 'showType must be a number');
            } else {
                $_POST['showType'] = intval($val);
            }
        }
    }

    private function validate_firstGenre(){
        $val = htmlspecialchars(trim($this->data['firstGenre']));
        if (empty($val)){
            $this->add_error('firstGenre', 'firstGenre cannot be empty');
        } else {
            if(!preg_match('/^[0-9]*$/',$val)){
                $this->add_error('firstGenre', 'firstGenre must be a number');
            } else {
                $_POST['firstGenre'] = intval($val);
            }
        }
    }

    private function validate_secondGenre(){
        $val = htmlspecialchars(trim($this->data['secondGenre']));
        if (empty($val)){
            $this->add_error('secondGenre', 'secondGenre cannot be empty');
        } else {
            if(!preg_match('/^[0-9]*$/',$val)){
                $this->add_error('secondGenre', 'secondGenre must be a number');
            } else {
                $_POST['secondGenre'] = intval($val);
            }
        }
    }


    private function validate_duration(){
        $val = htmlspecialchars(trim($this->data['duration']));
        if (empty($val)){
            $this->add_error('duration', 'duration cannot be empty');
        } else {
            if(!preg_match('/^\d{2}:\d{2}:\d{2}$/', $val)){
                $this->add_error('duration', 'duration must be a digit');
            } else {

                $_POST['duration'] = $val;

                }
            }
        }

        private function validate_startTime(){
            $val = htmlspecialchars(trim($this->data['startTime']));
            if (empty($val)){
                $this->add_error('startTime', 'startTime cannot be empty');
            } else {
                if(!preg_match('/^\d{2}:\d{2}:\d{2}$/', $val)){
                    $this->add_error('startTime', 'startTime must be a digit');
                } else {
    
                $_POST['startTime'] = $val;
    
                    }
                }
            }
        
    

    private function add_error($key,$value){

        $this->errors[$key] = $value;

    }
}