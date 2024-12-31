<?php
// Include database connection
session_start();
require_once '../../../../config/db.php';

// Initialize database connection
$db = new Database();
$pdo = $db->connect();

// Get the user ID from the URL
$userId =
    $userId = $_SESSION['user_id'];
$reservedMessage = "";
$message = "";

// Check if user ID is valid
if (!$userId) {
    echo "Invalid User ID.";
    exit;
}

// Fetch the reserved book message (if any) from the reservebook table
try {
    $stmt = $pdo->prepare("SELECT id, message FROM reservebook WHERE userID = :studentID");
    $stmt->execute(['studentID' => $userId]);
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

    // If a reservation exists, show the message
    if ($reservation) {
        $reservedMessage = "Message from library: " . htmlspecialchars($reservation['message']);
    }
} catch (PDOException $e) {
    die("Error fetching reservation message: " . $e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteReservation'])) {
    // Call the deleteReservation function
    $message = deleteReservation($userId, $pdo);
    $reservedMessage = $message;
}

// Function to delete a reservation by userID
function deleteReservation($userId, $pdo)
{
    try {
        // Prepare the SQL statement to delete a reservation by userID
        $stmt = $pdo->prepare("DELETE FROM reservebook WHERE userID = :studentID");

        // Execute the query
        $stmt->execute(['studentID' => $userId]);

        // Return success message
        return "Reservation successfully deleted.";
    } catch (PDOException $e) {
        // Return error message if deletion fails
        return "Error deleting reservation: " . $e->getMessage();
    }
}


// Fetch the borrowed books for the user from the issued_books table
try {
    $stmt = $pdo->prepare("SELECT issued_books.id, issued_books.book_id, issued_books.issue_date, 
                            issued_books.return_date, issued_books.status, issued_books.fine, 
                            book.ISBNnumber, book.image, book.name AS book_name
                            FROM issued_books
                            JOIN book ON issued_books.book_id = book.id
                            WHERE issued_books.user_id = :userID");

    $stmt->execute(['userID' => $userId]);
    $borrowedBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching borrowed books: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Borrowed Books</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .reserved-message {
            background: #fffbcc;
            color: #856404;
            border: 1px solid #ffeeba;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .filter-container {
            margin-bottom: 15px;
        }

        #filterInput {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
            color: #333;
        }

        table img {
            max-width: 100px;
            border-radius: 4px;
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <header> <?php include('../includess/header.php'); ?></header>
    <div class="container">

        <!-- Display Reservation Message -->
        <?php if ($reservedMessage): ?>
            <div class="reserved-message">
                <p><?php echo $reservedMessage; ?></p>
                <?php if (!($message)) : ?>
                    <form method="POST">
                        <button type="submit" class="btn-danger" name=" deleteReservation" onclick="return confirm('Are you sure you want to delete this reservation?');">Delete Reservation</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <h1>Borrowed Books</h1>

        <!-- Filter Input -->
        <div class="filter-container">
            <input type="text" id="filterInput" placeholder="Filter by Book Name or ISBN">
        </div>

        <!-- Borrowed Books Table -->
        <?php if (!empty($borrowedBooks)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Book Name</th>
                        <th>ISBN</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>Fine</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($borrowedBooks as $book): ?>
                        <tr>
                            <td><img src="./views/dashbords/liberaryan/assets/bookImages/<?php echo htmlspecialchars($book['image']); ?>" alt="Book Image"></td>
                            <td><?php echo htmlspecialchars($book['book_name']); ?></td>
                            <td><?php echo htmlspecialchars($book['ISBNnumber']); ?></td>
                            <td><?php echo htmlspecialchars($book['issue_date']); ?></td>
                            <td><?php echo htmlspecialchars($book['return_date']); ?></td>
                            <td><?php echo htmlspecialchars($book['status']); ?></td>
                            <td><?php echo number_format($book['fine'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No borrowed books found.</p>
        <?php endif; ?>

    </div>

    <script>
        document.getElementById('filterInput').addEventListener('keyup', function() {
            const filterValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');

            rows.forEach(row => {
                const bookName = row.cells[1].textContent.toLowerCase(); // Book Name column
                const isbn = row.cells[2].textContent.toLowerCase(); // ISBN column
                if (bookName.includes(filterValue) || isbn.includes(filterValue)) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });
        });
    </script>
</body>

</html>