<?php
// Model
function getConnection()
{
	try {
		$conn = new PDO('mysql:host=localhost;dbname=MyDatabase', 'MyUsername', 'MyPassword');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $exception) {
		echo "Oh no, there was a problem" . $exception->getMessage();
	}
	return $conn;
}

function closeConnection($conn)
{
	$conn = null;
}

// get all the films
function all()
{
	$conn = getConnection();
	$query = "SELECT * FROM films";
	$resultset = $conn->query($query);
	$films = $resultset->fetchAll();
	closeConnection($conn);
	return $films;
}

// get a single film
function find($id)
{
	$conn = getConnection();
	$stmt = $conn->prepare("SELECT * FROM films WHERE films.id = :id");
	$stmt->bindValue(':id', $id);
	$stmt->execute();
	$film = $stmt->fetch();
	closeConnection($conn);
	return $film;
}

// save a film
function save($title, $year, $duration)
{
	$conn = getConnection();
	$query = "INSERT INTO films (id, title, year, duration) VALUES (NULL, :title, :year, :duration)";
	$stmt = $conn->prepare($query);
	$stmt->bindValue(':title', $title);
	$stmt->bindValue(':year', $year);
	$stmt->bindValue(':duration', $duration);
	$stmt->execute();
	closeConnection($conn);
}

// update film details
function update($id, $title, $year, $duration)
{
	$conn = getConnection();
	$query = "UPDATE films SET title=:title, year=:year, duration=:duration WHERE id=:id";
	$stmt = $conn->prepare($query);
	$stmt->bindValue(':id', $id);
	$stmt->bindValue(':title', $title);
	$stmt->bindValue(':year', $year);
	$stmt->bindValue(':duration', $duration);
	$stmt->execute();
	closeConnection($conn);
}

// delete a film
function delete($id)
{
	$conn = getConnection();
	$stmt = $conn->prepare("DELETE FROM films WHERE films.id = :id");
	$stmt->bindValue(':id', $id);
	$stmt->execute();
	closeConnection($conn);
}
