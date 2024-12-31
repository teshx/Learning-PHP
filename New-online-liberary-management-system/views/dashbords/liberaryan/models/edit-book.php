<?php

class Book
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllBooks()
    {
        $sql = "SELECT book.*, location.shelf, location.booknumber, location.libraryname, location.copynumber
FROM book
LEFT JOIN location ON book.locationID = location.id";
        $query = $this->conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBookById($id)
    {
        $sql = "SELECT book.*, location.shelf, location.libraryname, location.copynumber
FROM book
LEFT JOIN location ON book.locationID = location.id
WHERE book.id = :id";
        $query = $this->conn->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateBookAndLocation($data)
    {
        try {
            // Update Location
            $locationSql = "UPDATE location SET
shelf = :shelf,
-- booknumber = :booknumber,
libraryname = :libraryname,
copynumber = :copynumber
WHERE id = :locationID";
            $locationQuery = $this->conn->prepare($locationSql);
            $locationQuery->bindParam(':shelf', $data['shelf'], PDO::PARAM_STR);
            // $locationQuery->bindParam(':booknumber', $data['booknumber'], PDO::PARAM_STR);
            $locationQuery->bindParam(':libraryname', $data['libraryname'], PDO::PARAM_STR);
            $locationQuery->bindParam(':copynumber', $data['copynumber'], PDO::PARAM_STR);
            $locationQuery->bindParam(':locationID', $data['locationID'], PDO::PARAM_INT);
            $locationQuery->execute();

            // Update Book
            $bookSql = "UPDATE book SET
name = :name,
catID = :catID,
authID = :authID,
ISBNnumber = :ISBNnumber,
price = :price,
image = :image,
numCopy = :numCopy
WHERE id = :id";
            $bookQuery = $this->conn->prepare($bookSql);
            $bookQuery->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $bookQuery->bindParam(':catID', $data['catID'], PDO::PARAM_INT);
            $bookQuery->bindParam(':authID', $data['authID'], PDO::PARAM_INT);
            $bookQuery->bindParam(':ISBNnumber', $data['ISBNnumber'], PDO::PARAM_STR);
            $bookQuery->bindParam(':price', $data['price'], PDO::PARAM_STR);
            $bookQuery->bindParam(':image', $data['image'], PDO::PARAM_STR);
            $bookQuery->bindParam(':numCopy', $data['numCopy'], PDO::PARAM_INT);
            $bookQuery->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $bookQuery->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
