<?php

include '../model/Shows.php';

class ShowsView extends Shows {

    public function showAllShows(){

        $result = $this->getAllShows();

        echo "<div class='shows__wrapper'>";
        
        foreach ($result as $enre){
            $id = $enre['id'];
            $title = $enre['title'];
            $performer = $enre['performer'];
            $date = $enre['date'];
            $startTime = $enre['startTime'];

            echo "<div class='card'><h3><a href='../view/update_show.php?id=$id'>$title</h3></a> par <b>$performer</b>, <span class='date'>$date</span> à $startTime</div>";
        }

        echo "</div>";


    }



}