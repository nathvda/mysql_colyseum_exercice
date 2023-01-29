<?php 
include '../view/showsview.php';

        $shows = new ShowsView();
        $shows = $shows->showAllShows();