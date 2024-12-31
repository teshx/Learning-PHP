<?php
require_once '../controllers/BookController.php';
require_once '../../../../config/db.php';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'catID' => $_POST['catID'],
        'authID' => $_POST['authID'],
        'ISBNnumber' => $_POST['ISBNnumber'],
        'price' => $_POST['price'],
        'numCopy' => $_POST['numCopy'],
        'shelf' => $_POST['shelf'],
        'libraryname' => $_POST['libraryname'],
        'copynumber' => $_POST['copynumber']
    ];
    $file = $_FILES['image'];

    $controller = new BookController();
    $controller->addBookWithLocation($data, $file);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .container {
            min-width: 900px;
            margin: 5px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 3px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="file"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-row .form-group {
            flex: 1;
            min-width: 200px;
        }

        .form-group select,
        .form-group input {
            width: 100%;
        }

        button {
            display: block;
            width: 100%;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #0056b3;
        }

        hr {
            margin: 4px 0;
            border: 1px solid #ddd;
        }

        .location-details {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 8px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <header>
        <?php include('../includes/header.php'); ?>
    </header>

    <div class="container">
        <h2>Add Book and Location</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Book Name</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="catID">Category</label>
                    <select id="catID" name="catID" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category) { ?>
                            <option value="<?php echo htmlentities($category->id); ?>">
                                <?php echo htmlentities($category->name); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="authID">Author</label>
                    <select id="authID" name="authID" required>
                        <option value="">Select Author</option>
                        <?php foreach ($authors as $author) { ?>
                            <option value="<?php echo htmlentities($author->id); ?>">
                                <?php echo htmlentities($author->name); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ISBNnumber">ISBN Number</label>
                    <input type="text" id="ISBNnumber" name="ISBNnumber" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" id="price" name="price" required>
                </div>

                <div class="form-group">
                    <label for="numCopy">Number of Copies</label>
                    <input type="text" id="numCopy" name="numCopy" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" required>
                </div>
            </div>

            <hr>

            <div class="location-details">
                <h4>Location Details</h4>

                <div class="form-row">
                    <div class="form-group">
                        <label for="shelf">Shelf</label>
                        <input type="text" id="shelf" name="shelf" required>
                    </div>

                    <div class="form-group">
                        <label for="libraryname">Library Name</label>
                        <input type="text" id="libraryname" name="libraryname" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="copynumber">Copy Number (start-to-end)</label>
                        <input type="text" id="copynumber" name="copynumber" required>
                    </div>
                </div>
            </div>

            <button type="submit">Add Book with Location</button>
        </form>
    </div>
</body>

</html>