<?php
session_start();
require_once '../../../../config/db.php';
require_once '../controllers/edit-book-controller.php';

// Fetch categories and authors for the dropdowns
try {
    $database = new Database();
    $conn = $database->connect();

    // Fetch categories
    $status = 1;
    $sqlCategory = "SELECT * FROM category WHERE status = :status";
    $queryCategory = $conn->prepare($sqlCategory);
    $queryCategory->bindParam(':status', $status, PDO::PARAM_INT);
    $queryCategory->execute();
    $categories = $queryCategory->fetchAll(PDO::FETCH_OBJ);

    // Fetch authors
    $sqlAuthor = "SELECT * FROM author";
    $queryAuthor = $conn->prepare($sqlAuthor);
    $queryAuthor->execute();
    $authors = $queryAuthor->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}

// Fetch Book Details
$controller = new BookController($conn);
$book = $controller->getBookById($_GET['bookid']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'catID' => $_POST['catID'],
        'authID' => $_POST['authID'],
        'ISBNnumber' => $_POST['ISBNnumber'],
        'price' => $_POST['price'],
        'locationID' => $_POST['locationID'],
        'shelf' => $_POST['shelf'],
        'numCopy' => $_POST['numCopy'],
        'libraryname' => $_POST['libraryname'],
        'copynumber' => $_POST['copynumber']
    ];

    $file = $_FILES['image'];

    if (!empty($file['name'])) {
        move_uploaded_file($file['tmp_name'], "../assets/bookImages/" . $file['name']);
        $data['image'] = $file['name'];
    } else {
        $data['image'] = $_POST['existingImage'];
    }

    if ($controller->updateBookAndLocation($data)) {
        $_SESSION['success'] = "Book and location updated successfully";
        header('Location: manage-books.php');
        exit;
    } else {
        $_SESSION['error'] = "Failed to update book and location";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link href="../assets/css/style.css" rel="stylesheet">

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }

        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }

        /* Form Styles */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        select,
        input[type="file"] {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        select:focus,
        input[type="file"]:focus {
            border-color: #007bff;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Image Preview */
        img {
            margin-top: 2px;
            border-radius: 5px;
            border: 1px solid #ddd;
            max-width: 100px;
            max-height: 100px;
        }

        /* Location Details */
        .location-details h4 {
            margin-bottom: 10px;
            color: #555;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .form-row {
                flex-direction: column;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <header> <?php include('../includes/header.php'); ?></header>
    <div class="container">
        <h2>Edit Book and Location</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
            <input type="hidden" name="locationID" value="<?php echo $book['locationID']; ?>">
            <input type="hidden" name="existingImage" value="<?php echo $book['image']; ?>">

            <!-- Book Information -->
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Book Name</label>
                    <input type="text" id="name" name="name" value="<?php echo $book['name']; ?>">
                </div>

                <div class="form-group">
                    <label for="catID">Category</label>
                    <select id="catID" name="catID">
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category) { ?>
                            <option value="<?php echo htmlentities($category->id); ?>"
                                <?php echo $category->id == $book['catID'] ? 'selected' : ''; ?>>
                                <?php echo htmlentities($category->name); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="authID">Author</label>
                    <select id="authID" name="authID">
                        <option value="">Select Author</option>
                        <?php foreach ($authors as $author) { ?>
                            <option value="<?php echo htmlentities($author->id); ?>"
                                <?php echo $author->id == $book['authID'] ? 'selected' : ''; ?>>
                                <?php echo htmlentities($author->name); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ISBNnumber">ISBN Number</label>
                    <input type="text" id="ISBNnumber" name="ISBNnumber" value="<?php echo $book['ISBNnumber']; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" id="price" name="price" value="<?php echo $book['price']; ?>">
                </div>

                <div class="form-group">
                    <label for="numCopy">Number of Copies</label>
                    <input type="number" id="numCopy" name="numCopy" value="<?php echo $book['numCopy']; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image">
                </div>
            </div>
            <img src="../assets/bookImages/<?php echo $book['image']; ?>" width="100"><br>

            <hr>

            <!-- Location Information -->
            <!-- Location Information -->
            <div class="location-details">
                <h4>Location Details</h4>

                <div class="form-row">
                    <div class="form-group">
                        <label for="shelf">Shelf</label>
                        <input type="text" id="shelf" name="shelf" value="<?php echo $book['shelf']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="libraryname">Library Name</label>
                        <input type="text" id="libraryname" name="libraryname" value="<?php echo $book['libraryname']; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="copynumber">Copy Number (start-to-end)</label>
                        <input type="text" id="copynumber" name="copynumber" value="<?php echo $book['copynumber']; ?>">
                    </div>
                </div>
            </div>


            <button type="submit">Update Book with Location</button>
        </form>
    </div>
</body>

</html>