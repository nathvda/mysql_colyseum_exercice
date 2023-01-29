<?php

include '../model/Shows.php';

class Showscontr extends Shows{

    public function createShow($data){

        $this->addShow($data['title'], $data['performer'], $data['date'], $data['showType'], $data['firstGenre'], $data['secondGenre'], $data['duration'], $data['startTime']);
        
    }

}