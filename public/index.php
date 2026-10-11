<?php
spl_autoload_register(function ($class_name) {
    $class_name = "../".str_replace("\\", DIRECTORY_SEPARATOR, $class_name);
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


$path = trim($_SERVER['REQUEST_URI'], '/'); // Need to tirm to get rid of the leading slash
$parts = explode('/', $path);

$resource = $parts[0] ?? null;
$first    = $parts[1] ?? null;
$second   = $parts[2] ?? null;

echo "<p>r: {$resource}</p>";
echo "<p>f: {$first}</p>";
echo "<p>s: {$second}</p>";

$method = $_SERVER['REQUEST_METHOD'];

if ($resource === 'films' && $method === 'GET' && $first === null) {
    $filmController->index();
}
else if ($resource === 'films' && $method === 'GET' && $first === 'create') {
    $filmController->create();
}
else if ($resource === 'films' && $method === 'POST' && $first === 'store') {
    $filmController->store();
}
else if ($resource === 'films' && $method === 'GET' && is_numeric($first) && $second === null) {

    $filmController->show($first);
}
else if ($resource === 'films' && $method === 'GET' && is_numeric($first) && $second === 'edit') {
    $filmController->edit($first);
}
else if ($resource === 'films' && $method === 'POST' && is_numeric($first) && $second === 'update') {
    $filmController->update();
}
else if ($resource === 'films' && $method === 'POST' && is_numeric($first) && $second === 'destroy') {
    $filmController->destroy();
}
else {
    echo "404 route not found";
}
