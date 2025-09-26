<?php
function index()
{
    //Ask the model for all the films
    $films = all();
    //Set the title of the page
    $title = "List the films";
    //Load the films view
    require("./views/index.view.php");
}

function show()
{
    //Get the id from the query string e.g. for show.php?id=2, $_GET['id'] has a value of 2
    $id = $_GET['id'];
    //Get the specific film from the model
    $film = find($id);
    //Set the title of the page
    $title = "Show the details for a film";
    //Load the view
    require("./views/show.view.php");
}

function create()
{
    //Set the title of the page
    $title = "Add new film";
    //No model functionality need, just need to load the view
    require("./views/create.view.php");
}

function store()
{
    //get the data from the form
    $title = $_POST['title'];
    $year = $_POST['year'];
    $duration = $_POST['duration'];

    //Ask the model to save the new film
    save($title, $year, $duration);

    //Redirect the user to the home page
    header('Location: ./index.php');
    die();
}

function about()
{
    //add code in here
}

function edit()
{
    //add code in here
}

function updateFilm()
{
    //add code in here
}

function destroy()
{
    //add code in here
}
