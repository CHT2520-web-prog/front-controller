<?php
//index.php
spl_autoload_register(function ($class_name) {
    // echo "<p>{$class_name}</p>";
    $class_name = "../".str_replace("\\", DIRECTORY_SEPARATOR, $class_name);
    // echo "<p>Loading {$class_name}</p>";
    require($class_name.'.php');
});

use App\Models\FilmRepository;
use App\Database;
use App\Controllers\FilmController;
$config = require("../config.php");

// Get the database 
$database = new Database(
    $config['database']['host'],
    $config['database']['dbname'],
    $config['database']['username'],
    $config['database']['password'],
    );
$conn = $database->getConnection();

// Pass the connection into the repository (Dependency Injection)
$filmRepository = new FilmRepository($conn);

$filmController = new FilmController($filmRepository);

/*
TODO
- Do I need to use __DIR__
- Do I need to configure a basepath/baseurl. I could put this in my config file
- Do I need to separate some of this out into a Bootstrap file
- How about adding some simple validation in the store function. 
- How handle the resource in the URL e.g. films/show/2 vs show/2

Key Aspects to discuss
- Launch from the public directory
- No (very little) error checking e.g. what if we can't find the film with the specified id

Where else to look
- The approach to the data layer could be done using a different ORM pattern
- The Active record I have used is very simple, what about a more flexible dynamic one where I don't hard code the queries. 
- https://github.com/ggelashvili/learnphptherightway-outline find the right bits
- Laracasts PHP course.

Possible exercises
- Leave edit/delete up to them
- Refactor the Model so we don't have the hard-coded database dependency
- Routing in a separate file?
- Session flashing?

*/
//Routing
//  php -S localhost:8000
//  foreach ($_SERVER as $key => $value) { 
//     echo "{$key}: {$value}<br>"; 
// }

/*
echo "<h2>Routing</h2>";

$action = "/";
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

//Just for test purposes, so we can see the action.
// echo "<p>The action is <strong>{$action}</strong></p>";

//Test the action value and call a function in controllers/filmController.php
if ($action === "/") {
    //Call index() in filmController
    // echo "index()";
    $filmController->index();
} else if ($action === "show" && isset($_GET['id'])) {
    //Call show() in $filmController
    // echo "show()";
    $filmController->show();
} else if ($action === "create" ) {
    //Call create() in $filmController
    // echo "create()";
    $filmController->create();
} else if ($action === "store") {
    //Call save() in $filmController
    // echo "store()";
    $filmController->store();
} else if ($action === "edit" && isset($_GET['id'])){
    // echo "edit()";
    $filmController->edit();
} else if ($action === "update"){
    // echo "update()";
    $filmController->update();
}else if ($action === "destroy"){
    // echo "destroy()";
    $filmController->destroy();
}else if ($action === "about"){
    // echo "destroy()";
    $filmController->about();
}else{
    http_response_code(404);
    echo "Unknown action";
}
*/


// Pretty URLs

// $method = $_SERVER['REQUEST_METHOD'];
// echo "<p>Method: {$method}</p>";
// $path = $_SERVER['REQUEST_URI'] ?? '/';
// echo "<p>Path: {$path}</p>";
// $parts = explode('/', trim($path));

// var_dump($parts);
// echo "Parts:<br>";
// foreach($parts as $part){
//     echo "<p>{$part}</p>";
// }

$path = trim($_SERVER['REQUEST_URI'], '/');
$parts = explode('/', $path);

$resource = $parts[0] ?? null;
$first    = $parts[1] ?? null;
$second   = $parts[2] ?? null;

$method = $_SERVER['REQUEST_METHOD'];

// LIST
if ($resource === 'films' && $method === 'GET' && $first === null) {
    $filmController->index();
}
// CREATE (no ID)
else if ($resource === 'films' && $method === 'GET' && $first === 'create') {
    $filmController->create();
}
// STORE (no ID)
else if ($resource === 'films' && $method === 'POST' && $first === 'store') {
    $filmController->store();
}
// SHOW
else if ($resource === 'films' && $method === 'GET' && is_numeric($first) && $second === null) {

    $filmController->show($first);
}
// EDIT
else if ($resource === 'films' && $method === 'GET' && is_numeric($first) && $second === 'edit') {
    $filmController->edit($first);
}
// UPDATE
else if ($resource === 'films' && $method === 'POST' && is_numeric($first) && $second === 'update') {
    $filmController->update();
}
// DELETE
else if ($resource === 'films' && $method === 'POST' && is_numeric($first) && $second === 'destroy') {
    $filmController->destroy();
}

else {
    echo "404 route not found";
}
