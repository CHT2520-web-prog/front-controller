<?php
namespace App\Controllers;
use App\Models\Film;
use App\Models\FilmRepository;

class FilmController extends BaseController
{
	private FilmRepository $filmRepository;

	function __construct(FilmRepository $filmRepository) {
		$this->filmRepository = $filmRepository;
	}

	public function index():void
	{
		//Get all the films from the model
		$films = $this->filmRepository->all();
		$this->loadView("index", ["films" => $films]);
	}
	function create():void
	{
		$this->loadView("create");
	}
	function show():void
	{
		//Get the id from the query string e.g. for show.php?id=2, $_GET['id'] has a value of 2
		$id = (int) $_GET['id'];
		//Get the film from the film repository
		$film = $this->filmRepository->find($id);
		$this->loadView("show", ["film" => $film]);
	}
	function store():void
	{
		//get the data from the form
		$film = new Film();
		$film->title = $_POST['title'];
		$film->year = $_POST['year'];
		$film->duration = $_POST['duration'];
		//Ask the repository to save the new film
		$this->filmRepository->save($film );
		//Redirect the user to the home page
		header('Location: index.php');
	}
	function edit():void
	{
		//Get the id from the query string e.g. for show.php?id=2, $_GET['id'] has a value of 2
		$id = (int) $_GET['id'];
		//Get the film from the film repository
		$film = $this->filmRepository->find($id);
		$this->loadView("edit", ["film" => $film]);
	}
	function update():void
	{
		//get the data from the form
		$film = new Film();
		$film->id = $_POST['id'];
		$film->title = $_POST['title'];
		$film->year = $_POST['year'];
		$film->duration = $_POST['duration'];
		//Ask the repository to save the new film
		$this->filmRepository->update($film );
		//Redirect the user to the home page
		header('Location: index.php');
	}

	function destroy():void
	{
		$id = $_POST['id'];
		$this->filmRepository->delete($id);
		//Redirect the user to the home page
		header('Location: index.php');
	}

	function about()
	{
		$this->loadView("about");
	}
}