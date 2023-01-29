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

            echo "<div class='card'><h3><a href='../public/update_show.php?id=$id'>$title</h3></a> par <b>$performer</b>, <span class='date'>$date</span> à $startTime</div>";
        }

        echo "</div>";
    }

    public function showAllGenres($fieldname){

        $result = $this->getShowGenres();

        echo "<select name='$fieldname'>";

        foreach($result as $enre){

        $id = $enre['id'];
        $genre = $enre['genre'];

        echo "<option value='$id' name='$fieldname'>$genre</option>";
        }

        echo "</select>";

}

    public function showAllTypes($fieldname){

        $result = $this->getShowTypes();

        echo "<select name='$fieldname'>";

        foreach($result as $enre){

        $id = $enre['id'];
        $type = $enre['type'];

        echo "<option value='$id' name='$fieldname'>$type</option>";
        }

        echo "</select>";
    }


    public function showShow($id){

        $result = $this->getShow($id);

        $_SESSION['modifyShow'] = $result;
    }

    }

