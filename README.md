# A Front Controller

- Open your Codespace
- Clone this repository into your codespace. In the terminal enter:
```
git clone https://github.com/CHT2520-web-prog/front-controller
```
- In terminal, navigate to the _front-controller_ folder

```
cd front-controller

```
- Important! Then navigate to the _public_ folder

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

- Using 'pretty URLs'. Instead of _index.php?action=show&id=2_, it would be good if we had nicer looking URLs e.g. _films/2_ .
  - GET _/films_ = list
  - GET _/films/create_ = create
  - POST _/films_ = store
  - GET _/films/2_ = show
  - GET _/films/2/edit_ = edit
  - POST _/films/2/update_ = update
  - POST _/films/2/delete_ = delete

- These URLs use REST conventions.
    - Plural nouns for collections (_/films_)
    - Singular item identified by ID (_/films/42_)
    - HTTP method (GET = read data, POST = make changes)

Here's some code we could use in _index.php_ to start parsing URLs in this format.
```php
$method = $_SERVER['REQUEST_METHOD'];
echo "<p>Method: {$method}</p>";
$path = $_SERVER['REQUEST_URI'] ?? '/';
echo "<p>Path: {$path}</p>";
$parts = explode('/', trim($path));
foreach($parts as $part){
  echo "<p>{$part}</p>";
}
```