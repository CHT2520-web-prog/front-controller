<?php
spl_autoload_register(function ($class_name) {
    $class_name = "../".str_replace("\\", DIRECTORY_SEPARATOR, $class_name);
    require($class_name.'.php');
});

use App\Models\FilmRepository;
use App\Database;
use App\Controllers\FilmController;
$config = require("../config.php");

// Get the database connection
$database = new Database(
    $config['database']['host'],
    $config['database']['dbname'],
    $config['database']['username'],
    $config['database']['password'],
    );
$conn = $database->getConnection();

// Pass the connection into the repository
$filmRepository = new FilmRepository($conn);

// Create a FilmController
$filmController = new FilmController($filmRepository);

$action = "/";
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

//Test the action value and call a function in the FilmController
if ($action === "/") {
    $filmController->index();
} else if ($action === "show" && isset($_GET['id'])) {
    $filmController->show();
} else if ($action === "create" ) {
    $filmController->create();
} else if ($action === "store") {
    $filmController->store();
} else if ($action === "edit" && isset($_GET['id'])){
    $filmController->edit();
} else{
    http_response_code(404);
    echo "Unknown action";
}


