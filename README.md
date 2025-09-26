# The Front Controller Design Pattern (A Router)

A commonly used design pattern for web applications is the _front controller_ pattern. The idea is that all requests go through a single page, a front controller.

## Why do this?

Usually, whenever a user requests a webpage we perform common tasks such as authentication, and loading other files e.g. model files, validation functions, before executing a specific controller action. It's a good idea to just do this once and have a single place for this code. This single location is our front controller. 

## If you are using Codespaces
- Open your existing codespace (you shouldn't create a new one) https://github.com/codespaces.
- In the terminal enter
```
git clone https://github.com/CHT2520-web-prog/front-controller
```
This will copy the contents of this repository into your codespace.

- Change the database settings in _/models/film.php_ to match your database name, username and password.
- Start Apache (```apache2ctl start```)
- Open _index.php_ in a web browser. Check you can view film details and add a new film. You should find that the *about*, *update* and *delete* pages don't work.


Now move onto [Completing the practical work](#practical)

## If you are using XAMPP

- Download and unzip this repository.
- Move it into the htdocs folder in XAMPP.
- Change the database settings in _/models/film.php_ to match your database name, username and password.
- Open _index.php_ in a web browser. Check you can view film details and add a new film. You should find that the *about*, *update* and *delete* pages don't work.
  
Now move onto [Completing the practical work](#practical)

## Completing the practical work <a name="practical"></a>

- Notice that even when viewing the details for a film or when adding a new film, the URL still says _index.php_. This _index.php_ is our front controller.
- Have a good look at _index.php_

```php
//Load the models file
require("models/film.php");

//Load the controller file
require("controllers/filmController.php");

$action = "/";
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

//Just for testing purposes, so we can see the action.
echo "<p>The action is <strong>{$action}</strong></p>";

//Test the action value and call a function in controllers/filmController.php
if ($action === "/") {
    //Call index() in filmController
    index();
} else if ($action === "show") {
    //Call show() in filmController
    show();
} else if ($action === "create") {
    //Call create() in filmController
    create();
} else if ($action === "store") {
    //Call store() in filmController
    store();
}
```

- See how we get an 'action' from the query string. Then, depending on the action, we call a specific function in the _filmController.php_ file. For example, when the URL is _index.php?action=show&id=3_. The action is _show_ and we call `show()` in the _filmController.php_ file.

Open up _filmController.php_ and find the `show()` function. You should recognise the code in here. It's the same code used previously, we've just put it in a function.

## Testing Your Understanding

Can you get the *about* page, and the *update* and *delete* functions to work? Start by trying to get the *about* page to work first.

This is going to be very similar to the *create* action.
In _filmController.php_ there is already a function called _about_. Add some code in here that will load the _about.view.php_ page.
Then, in _index.php_ add an `else` statement that will test if the action is _about_. If it is, the ```about()``` function should be called.

Next, think about how the *update* operation works. First, you need to display the form that will allow the user to edit the details for a chosen film. In _filmController.php_ there is already a function called _edit_. Add some code in this function that will:

- Get an id from the query string.
- Call `find()` in the _film.php_ file.
- Load _edit.view.php_.

Again, you will need to edit _index.php_ by adding an `else` statement that will test if the action is _edit_. If it is, the ```edit()``` function in _filmController.php_ should be called.

Next, add code in the ```updateFilm()``` function. Add some code that will:-

- Get the data from the form.
- Call ```update()``` in the _film.php_ file.
- Re-direct the user back to the _index.php_ page.
- Again, you will need to make changes to _index.php_ so that it tests if the action is 'update'.

Finally, try and get *destroy.php* to work.
