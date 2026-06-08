<?php

session_start();
date_default_timezone_set('Asia/Jakarta');

require_once '../app/config/config.php';

require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Database.php';
require_once '../app/core/AuthMiddleware.php';
require_once '../vendor/autoload.php';

new App();