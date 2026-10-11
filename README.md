# A Front Controller

- Open your Codespace
- Clone this repository into your codespace. 
- In the terminal enter:
```
git clone https://github.com/CHT2520-web-prog/front-controller
```
- In terminal, navigate to the _front-controller_ folder

```
cd front-controller

```
- The navigate to the _public_ folder

```
cd public
```

- Start the web server
```
php -S 0.0.0.0:8000
```

The web browser should display the list of films. 

You should find that users can also view film details and add new films, but they can't edit or delete films. 

Have a look through the code and take some time to understand how the app now uses namespacing to organise files, and uses _index.php_ as a single point of access for the app. 

## On Your Own
Add code in _index.php_ that will get the edit and delete actions to work. 
You shouldn't need to make any changes to any other files e.g. `FilmController`. You only need to edit _index.php_

## Some more things to think about
There are further changes we could make to this app

- Using 'pretty URLs'. Instead of _index.php?action=show&id=3_, it would be good if we had nicer looking URLs e.g. _films/2_ 




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



