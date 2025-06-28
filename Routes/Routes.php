<?php
namespace App\Routes;

use Bramus\Router\Router;
use ClientsView;

$router = new Router();

$router->get('/coucou', function() {
    (new ClientsView())->showAllClients();

});

