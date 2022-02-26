<?php

use Pecee\SimpleRouter\SimpleRouter;

/* Load external routes file */
require_once './core/Routes.php';
require_once './core/Helpers.php';

/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */

SimpleRouter::setDefaultNamespace('\Demo\Controllers');

// Start the routing
SimpleRouter::start();
