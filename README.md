# Introduction to OOP in PHP

## Part 1: Basic OO Concepts
First, well get familiarity with the basic idea of inheritance in PHP.

- Open your Codespace
- Clone this repository into your codespace. 
- In the terminal enter:
```
git clone https://github.com/CHT2520-web-prog/oop-php-inheritance
```
- In terminal, navigate to the _oop-php-inheritance_ folder

```
cd oop-php-inheritance

```
- Start the web server
```
php -S 0.0.0.0:8000
```

The web browser should display a list of films. We'll look at this later.

In the web browser put `/inheritance.php` on the end of the URL. 

You should get output that looks something like the following:

```
Jane Smith has built some walls.
```

* Open _inheritance.php_ in VS Code and answer the questions. 
* In VS Code open [oop-inheritance-notes](oop-inheritance-notes.md). The notes will help you answer the questions. 

## Part 2: Applying OOP
Now we'll look at an example where we apply OOP in building web applications.
- In the browser open _index.php_ (or simply remove _/inheritance.php_ from the end of the URL).
- A list of films should be displayed. 

This is a partially complete version of the same CRUD app we worked on earlier week, but it uses inheritance OOP to help structure the code. 

Have a good look at _index.php_. There are key differences from the example we looked at earlier this week.
- This page doesn't do any work at all, instead it simply creates some objects (`$filmRepository` and `$filmController`) and calls the `index()` method of the film controller. 
- Have a good look at `FilmController`. See how it:
  - Calls the `all()` method on `$filmRepository` to get the list of films.
  - Loads the HTML page to display the list of films (`$this->loadView("index", ["films" => $films]);`)
    - This class inherits from a parent `Controller` class. Have a look inside the parent `BaseController` class to see how the view files are loaded. 

Do the same for the _store.php_, _show.php_ and _edit.php_ pages. See how we are simply calling methods on a `FilmController` object to execute each task. 

### Test your understanding
- All the CRUD actions should work apart from update and delete. Add code in _update.php_ and _destroy.php_ that will use the `FilmController` instance to update/delete the selected film from the database. 
- If you can get this to work, one design improvement would be to improve the `FilmRepository` class. At the moment we can argue it is trying to do too much, managing the database connection and running queries.
- Create a separate `Database` class that creates and stores a PDO connection. 
- In our code we could then do something like the following where we pass the PDO connection object into `$filmRepository` instead of the `FilmRepository` class having to create its own connection. 

```php
require 'Database.php';
require 'Film.php';
require 'FilmRepository.php';
require 'BaseController.php';
require 'FilmController.php';

$database = new Database('db','webdev','student','secret');
$conn = $database->getConnection();
$filmRepository = new FilmRepository($conn);
$filmController = new FilmController($filmRepository);
$filmController->index();
```



