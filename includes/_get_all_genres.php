<?php

function drop_list_genres($fieldname){
    $genres = new ShowsView();
    $genres = $genres->showAllGenres($fieldname);
    }

function drop_list_showtypes($fieldname){
    $genres = new ShowsView();
    $genres = $genres->showAllTypes($fieldname);
    }
