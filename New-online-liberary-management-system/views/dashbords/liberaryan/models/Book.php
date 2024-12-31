<?php
session_start();
require_once '../../../../config/db.php';

class Book
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function insertBookWithLocation($data, $file)
    {
        try {
            // Start transaction
            $this->conn->beginTransaction();

            // Handle image upload
            $imageName = $file['name'];
            $imageTemp = $file['tmp_name'];
            $extension = pathinfo($imageName, PATHINFO_EXTENSION);
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array(strtolower($extension), $allowed_extensions)) {
                return ['success' => false, 'error' => 'Invalid image format.'];
            }

            $newImageName = md5(time() . $imageName) . '.' . $extension;
            $imagePath = '../assets/bookImages/' . $newImageName;
            $employ = $_SESSION['username'];

            if (!move_uploaded_file($imageTemp, $imagePath)) {
                return ['success' => false, 'error' => 'Failed to upload the image.'];
            }

            // Insert into `book` table
            $stmt = $this->conn->prepare("INSERT INTO book (name, catID, authID, ISBNnumber, price, image, numCopy, locationID,employ_id) 
                                         VALUES (:name, :catID, :authID, :ISBNnumber, :price, :image, :numCopy, 0,:employ_id)");
            $stmt->execute([
                ':name' => $data['name'],
                ':catID' => $data['catID'],
                ':authID' => $data['authID'],
                ':ISBNnumber' => $data['ISBNnumber'],
                ':price' => $data['price'],
                ':image' => $newImageName,
                ':numCopy' => $data['numCopy'],
                ':employ_id' => $employ
            ]);

            $bookId = $this->conn->lastInsertId();

            // Insert into `location` table
            $stmt = $this->conn->prepare("INSERT INTO location (shelf, libraryname, copynumber) 
                                         VALUES ( :shelf, :libraryname, :copynumber)");
            $stmt->execute([

                ':shelf' => $data['shelf'],
                ':libraryname' => $data['libraryname'],
                ':copynumber' => $data['copynumber']
            ]);

            $locationId = $this->conn->lastInsertId();

            // Update `book` table with the `locationID`
            $stmt = $this->conn->prepare("UPDATE book SET locationID = :locationID WHERE id = :bookId");
            $stmt->execute([
                ':locationID' => $locationId,
                ':bookId' => $bookId
            ]);

            // Commit transaction
            $this->conn->commit();
            return ['success' => true];
        } catch (Exception $e) {
            $this->conn->rollBack();
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
