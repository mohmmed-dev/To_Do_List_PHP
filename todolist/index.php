<?php session_start();

use App\Core\Router;
use App\Core\Request;
use App\Controllers\LoginController;
use App\Controllers\TaskController;
use App\Controllers\RegisterController;

require "./-int.php";

Router::make()->get('' ,[TaskController::class, "index"])
  ->post('store' ,[TaskController::class, "store"])
  ->post('done' ,[TaskController::class, "done"])
  ->post('update' ,[TaskController::class, "update"])
  ->post('delete' ,[TaskController::class, "delete"])
  ->get('filter' ,[TaskController::class, "filtersTask"])
  ->get('register' ,[RegisterController::class, "registerView"])
  ->post('register' ,[RegisterController::class, "registering"])
  ->get('login' ,[LoginController::class, "loginView"])
  ->post('login' ,[LoginController::class, "login"])
  ->post('logout' ,[LoginController::class, "logout"])
  ->resolve(Request::uri(), Request::method());


































// $routes = [
//   '' => "./app/Controllers/index.php",
//   'about' => "./app/Controllers/about.php",
// ];


// $uri = trim($_SERVER['REQUEST_URI'], '/');

// echo $uri;
// الاسلوب الاول
// Router::make([
  //   '' => "./app/Controllers/index.php",
  //   'about' => "./app/Controllers/about.php",
  //   'task/create' => "./app/Controllers/taskCreat.php",
  // ])->resolve(Request::uri());
  // الاسلوب الثاني
// Router::make()->
// get('' ,"./app/Controllers/index.php")
// ->get('about', "./app/Controllers/about.php")
//   ->post('task/create' , "./app/Controllers/taskCreat.php")
// ->resolve(Request::uri(), Request::method());

//   ->get('about', "./app/Controllers/about.php")















// الاسلوب الثاني
// if(array_key_exists($uri,$routes)) {
//   require $routes[$uri];
// } else {
//    throw new Exception("Page Not Fount");
// }

// $routes = [
//   '' => "./app/Controllers/index.php",
//   'about' => "./app/Controllers/about.php",
// ];





// الاسلوب الاول

// switch ($uri) {
//   case "";
//   require "./app/Controllers/index.php";
//   break;
//   case "about";
//   require "./app/Controllers/about.php";
//   break;
//   default;
//   throw new Exception("Page Not Fount");
// }



// echo "<pre>" ;
// print_r($_SERVER);
// echo "</pre>" ;

















