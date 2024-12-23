<?php
session_start();
require_once '../../../../config/db.php';
require_once '../controllers/edit-issue-controller.php';

// Initialize database and controller
$database = new Database();
$db = $database->connect();
$controller = new IssuedBookController($db);

// Fetch record for editing
$issuedBook = null;
$fine = 0; // Initialize fine variable

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $issuedBook = $controller->getIssuedBookById($id);

    if (!$issuedBook) {
        $_SESSION['error'] = "Record not found!";
        header('location: manage-issued-books.php');
        exit;
    }
}
$return_dates = $issuedBook->return_date;
// Fine Calculation: Subtract return_date from today
$today = new DateTime();
$returnDate = new DateTime($return_dates); // Using the posted return date

// Check if the return date is in the past
if ($returnDate < $today) {
    // Calculate the number of days the return is late
    $daysLate = $today->diff($returnDate)->days;
    $fine = $daysLate * 10; // Calculate fine (10 units per day late)
}
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $book_id = $_POST['book_id'];
    $user_id = $_POST['user_id'];
    $issue_date = $_POST['issue_date'];
    $return_date = $_POST['return_date'];
    $status = $_POST['status'];
    $fine = $_POST['fine'];
    $isbn = $_POST['isbn'];
    $username = $_POST['username'];



    // Prepare data for update
    $updateData = [
        'id' => $id,
        'book_id' => $book_id,
        'user_id' => $user_id,
        'issue_date' => $issue_date,
        'return_date' => $return_date,
        'status' => $status,
        'fine' => $fine,
        'isbn' => $isbn,
        'username' => $username
    ];

    if ($controller->updateIssuedBook($updateData)) {
        $_SESSION['msg'] = "Record updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating record!";
    }
    header('location: manage-issued-books.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Issued Book</title>
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
    <header> <?php include('../includes/header.php'); ?></header>
    <div class="container">
        <h4>Edit Issued Book</h4>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error'];
                                            unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form method="POST" action="edit-issued-book.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($issuedBook->id); ?>">

            <label>Book ID</label>
            <input type="text" name="book_id" value="<?php echo htmlspecialchars($issuedBook->book_id); ?>" required>

            <label>User ID</label>
            <input type="text" name="user_id" value="<?php echo htmlspecialchars($issuedBook->user_id); ?>" required>

            <label>Issue Date</label>
            <input type="date" name="issue_date" value="<?php echo htmlspecialchars($issuedBook->issue_date); ?>" disabled>

            <label>Return Date</label>
            <input type="date" name="return_date" value="<?php echo htmlspecialchars($issuedBook->return_date); ?>" disabled>

            <label>Status</label>
            <select name="status" required>
                <option value="issued" <?php echo $issuedBook->status == 'issued' ? 'selected' : ''; ?>>Issued</option>
                <option value="returned" <?php echo $issuedBook->status == 'returned' ? 'selected' : ''; ?>>Returned</option>
                <option value="unpaid" <?php echo $issuedBook->status == 'unpaid' ? 'selected' : ''; ?>>Unpaid</option>
            </select>

            <label>Fine</label>
            <input type="number" name="fine" value="<?php echo $fine; ?>" readonly>

            <label>ISBN</label>
            <input type="text" name="isbn" value="<?php echo htmlspecialchars($issuedBook->isbn); ?>" required>

            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($issuedBook->username); ?>" required>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="manage-issued-books.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>

</html>