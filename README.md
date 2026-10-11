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

- Using 'pretty URLs'. Instead of _index.php?action=show&id=3_, it would be good if we had nicer looking URLs e.g. _films/2_ .
  - GET /films = list
  - GET /films/create = create
  - POST /films = store
  - GET /films/2 = show
  - GET /films/2/edit = edit
  - POST /films/2/update = update
  - POST /films/2/delete = delete

- These URLs use REST conventions.
    - Plural nouns for collections (_/films_)
    - Singular item identified by ID (_/films/42_)
    - HTTP method (GET = read data, POST = make changes)

