<?php
namespace App\Models;
use PDO;

class FilmRepository {
    private ?PDO $conn;
    function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function all(): array {
        $stmt = $this->conn->query("SELECT id, title, year, duration FROM films;");
        $films = $stmt->fetchAll(PDO::FETCH_CLASS, Film::class);
        return $films;
    }

    public function find(int $id): ?Film {
        $stmt = $this->conn->prepare("SELECT id, title, year, duration FROM films WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $film =  $stmt->fetchObject(Film::class);
        return $film;
    }

    public function save(Film $film): bool {
        $query = "INSERT INTO films (id, title, year, duration) VALUES (NULL, :title, :year, :duration)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':title', $film->title);
        $stmt->bindValue(':year', $film->year);
        $stmt->bindValue(':duration', $film->duration);
        return $stmt->execute();
    }

    public function update(Film $film): bool {
        $query = "UPDATE films SET title=:title, year=:year, duration=:duration WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $film->id);
        $stmt->bindValue(':title', $film->title);
        $stmt->bindValue(':year', $film->year);
        $stmt->bindValue(':duration', $film->duration);
        return $stmt->execute();
    }

    public function delete(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM films WHERE films.id = :id");
        $stmt->bindValue(':id',$id);
        return $stmt->execute();
    }
}
