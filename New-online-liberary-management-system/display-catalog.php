<?php

session_start();  // Start the session at the beginning of the script

// Include database connection and controller
include './config/db.php';
include './controllers/BookController.php';

// Initialize database connection
$db = new Database();
$pdo = $db->connect();

// Get the book ID from the URL
$bookId = isset($_GET['id']) ? $_GET['id'] : null;

// Create controller and fetch book details
if ($bookId) {
    $bookController = new BookController($pdo);
    $bookDetails = $bookController->displayBook($bookId);
}

// Function to handle book reservation
function reserveBook($pdo, $bookDetails)
{
    // Ensure session is started to access session variables


    // Retrieve necessary session values
    $userID = $_SESSION['user_id'];
    $studentID = $_SESSION['username'];

    // Get book details from the passed argument
    $bookID = $bookDetails['BookID'];
    $bookName = $bookDetails['BookName'];
    $bookISBN = $bookDetails['ISBNnumber'];

    // Get the current time as reserveDate
    $reserveDate = date('Y-m-d H:i:s');  // Current timestamp

    // Check if the user has already reserved a book
    $checkUserQuery = "SELECT * FROM reserveBook WHERE userID = :userID OR studentID = :studentID";
    $stmt = $pdo->prepare($checkUserQuery);
    $stmt->execute(['userID' => $userID, 'studentID' => $studentID]);
    $existingReservation = $stmt->fetch();

    if ($existingReservation) {
        // User has already reserved a book, return message
        return "You can only reserve one book at a time.";
    } else {
        // User does not have an existing reservation, proceed with insertion
        // Insert the reservation into the reserveBook table
        $insertReservationQuery = "INSERT INTO reserveBook (bookID, bookName, userID, bookISBN, studentID, reserveDate) 
                                   VALUES (:bookID, :bookName, :userID, :bookISBN, :studentID, :reserveDate)";
        $stmt = $pdo->prepare($insertReservationQuery);
        $stmt->execute([
            'bookID' => $bookID,
            'bookName' => $bookName,
            'userID' => $userID,
            'bookISBN' => $bookISBN,
            'studentID' => $studentID,
            'reserveDate' => $reserveDate
        ]);

        // Update the numReserved column in the book table to reflect the new reservation
        $updateBookQuery = "UPDATE book SET numReserved = numReserved + 1 WHERE id = :bookID";
        $stmt = $pdo->prepare($updateBookQuery);
        $stmt->execute(['bookID' => $bookID]);

        // Return success message
        return "Book reserved successfully!";
    }
}

// Check if the reservation button is clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reserve'])) {
    $message = reserveBook($pdo, $bookDetails);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Book Details Section */
        .book-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: auto 0;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Book Image */
        .book-image {
            flex: 1 1 400px;
            max-width: 400px;
            margin-right: 20px;
        }

        .book-image img {
            padding-top: 70px;
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Book Info Section */
        .book-info {
            flex: 2 1 500px;
            max-width: 400px;
        }

        /* Title */
        .book-info h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #333;
        }

        /* Description Paragraphs */
        .book-info p {
            font-size: 1.2em;
            margin: 5px 0;
            color: #555;
        }

        /* Section Titles */
        .book-info h3 {
            font-size: 1.5em;
            margin-top: 10px;
            color: #333;
        }

        /* Buttons and Links */
        .book-info a {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 1.1em;
        }

        .book-info a:hover {
            background-color: #0056b3;
        }

        .book-info button {
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
        }

        .book-info button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <!-- Header -->

    <!-- Book Details Section -->
    <section class="book-details">
        <?php if ($bookDetails) { ?>
            <div class="book-image">
                <img src="./views/dashbords/liberaryan/assets/bookImages/<?php echo htmlspecialchars($bookDetails['image'] ?: 'default.jpg'); ?>" alt="<?php echo htmlspecialchars($bookDetails['BookName']); ?>">
            </div>
            <div class="book-info">
                <h1><?php echo htmlspecialchars($bookDetails['BookName']); ?></h1>
                <p><strong>Price:</strong> $<?php echo number_format($bookDetails['price'], 2); ?></p>
                <p><strong>Available number of copy:</strong> <?php echo number_format($bookDetails['numCopy']); ?></p>
                <p><strong>ISBN Number:</strong> <?php echo htmlspecialchars($bookDetails['ISBNnumber']); ?></p>

                <h3>Location</h3>
                <p><strong>Shelf:</strong> <?php echo htmlspecialchars($bookDetails['shelf']); ?></p>
                <p><strong>Library Name:</strong> <?php echo htmlspecialchars($bookDetails['libraryname']); ?></p>
                <p><strong>Copy Number start to end:</strong> <?php echo htmlspecialchars($bookDetails['copynumber']); ?></p>

                <h3>Category</h3>
                <p><?php echo htmlspecialchars($bookDetails['Category']); ?></p>

                <h3>Author</h3>
                <p><?php echo htmlspecialchars($bookDetails['Author']); ?></p>

                <?php
                if ($bookDetails['numCopy'] > $bookDetails['numBorrowed']) {
                    echo "<h3>BOOK IS AVAILABLE YOU CAN BORROW !!</h3>";
                } elseif ($bookDetails['numBorrowed'] > $bookDetails['numReserved']) {
                    echo "<form method='POST'><button type='submit' name='reserve'>Reserve Book</button></form>";
                } elseif ($bookDetails['numBorrowed'] = $bookDetails['numReserved']) {
                    echo "<h3 >ALL BOOK BORROWED AND RESERVED PLEASE WAIT !!</h3>";
                }

                if (isset($message)) {
                    echo "<p>$message</p>";
                }
                ?>

                <a href="./">Back</a>

            </div>

        <?php } else { ?>
            <p>Book not found!</p>
        <?php } ?>
    </section>

    <!-- Footer -->

</body>

</html>