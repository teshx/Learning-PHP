<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = "";     // Replace with your DB password
$dbname = "school"; // Replace with your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Create
if (isset($_POST['create'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $sex = $_POST['sex'];

    $sql = "INSERT INTO user (fullname, email, sex) VALUES ('$fullname', '$email', '$sex')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert success'>User created successfully!</div>";
    } else {
        echo "<div class='alert error'>Error: " . $conn->error . "</div>";
    }
}

// Handle Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $sex = $_POST['sex'];

    $sql = "UPDATE user SET fullname='$fullname', email='$email', sex='$sex' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert success'>User updated successfully!</div>";
    } else {
        echo "<div class='alert error'>Error: " . $conn->error . "</div>";
    }
}

// Handle Delete
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM user WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert success'>User deleted successfully!</div>";
    } else {
        echo "<div class='alert error'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-top: 40px;
            color: #4CAF50;
            font-size: 36px;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 5px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .alert {
            padding: 15px;
            text-align: center;
            margin-top: 20px;
            border-radius: 5px;
            font-size: 16px;
        }

        .alert.success {
            background-color: #4CAF50;
            color: white;
        }

        .alert.error {
            background-color: #f44336;
            color: white;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 12px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .table-container {
            margin-top: 30px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons button {
            background-color: #f44336;
            font-size: 14px;
            padding: 6px 12px;
            background-color: #4CAF50;
        }

        .action-buttons button.update {
            background-color: #4CAF50;
        }

        .action-buttons button.delete {
            background-color: #f44336;
        }
    </style>
</head>

<body>

    <h1>User Management</h1>

    <div class="container">
        <!-- Create Form -->
        <h2>Create User</h2>
        <form method="POST">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="fullname" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Sex:</label>
                <select name="sex" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <button type="submit" name="create">Create User</button>
        </form>

        <!-- Table to Display Users -->
        <div class="table-container">
            <h2>All Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Sex</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM user";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['fullname']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['sex']}</td>
                                    <td class='action-buttons'>
                                        <form method='POST' style='display:inline;'>
                                            <button type='submit' name='edit' class='update'>Edit</button>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                        </form>
                                        <form method='POST' style='display:inline;'>
                                            <button type='submit' name='delete' class='delete'>Delete</button>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Update Form (Triggered when Edit Button is Clicked) -->
        <?php
        if (isset($_POST['edit'])) {
            $id = $_POST['id'];
            $sql = "SELECT * FROM user WHERE id = $id";
            $result = $conn->query($sql);
            $user = $result->fetch_assoc();
        ?>
            <h2>Update User</h2>
            <form method="POST">
                <div class="form-group">
                    <label>Full Name:</label>
                    <input type="text" name="fullname" value="<?php echo $user['fullname']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Sex:</label>
                    <select name="sex" required>
                        <option value="Male" <?php echo ($user['sex'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($user['sex'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                        <option value="Other" <?php echo ($user['sex'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <button type="submit" name="update">Update User</button>
            </form>
        <?php } ?>
    </div>

</body>

</html>

<?php
$conn->close();
?>