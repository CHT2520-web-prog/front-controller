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
	function show(int $id):void
	{
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
		header('Location: /films');
	}
	function edit(int $id):void
	{
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
		header('Location: /films');
	}

	function destroy():void
	{
		$id = $_POST['id'];
		$this->filmRepository->delete($id);
		//Redirect the user to the home page
		header('Location: /films');
	}

	function about()
	{
		$this->loadView("about");
	}
}