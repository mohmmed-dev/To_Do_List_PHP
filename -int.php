<?php



// require './vendor/monolog/monolog/src/Monolog/Logger.php';
// require './vendor/monolog/monolog/src/Monolog/Level.php';
// require './vendor/monolog/monolog/src/Monolog/Handler/StreamHandler.php';

use App\App;
use App\Database\QUE;
use App\Database\DBCeca;
// use Monolog\Logger;
// use Monolog\Handler\StreamHandler;
// use Monolog\Level;

require "./vendor/autoload.php";

App::set("config", require './config.php');
// $log = new Logger("PHP_FIRTD");
// $log->pushHandler(new StreamHandler('queries.log',Level::Info));

QUE::make(DBCeca::make(App::get('config')["database"]));