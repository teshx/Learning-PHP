<?php
require_once __DIR__ . '/../../../../middlewares/authMiddleware.php';
checkRole('Admin');

// session_start();
require_once '../controllers/edit-user.php'; // Include the controller for processing form submission
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="../assets/css/style.css" rel="stylesheet">


    <style>
        /* General Body Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }

        /* Container for the form */
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Heading Styling */
        h2 {
            text-align: center;
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
        }

        /* Alert Messages */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 15px;
        }

        /* Label Styling */
        label {
            font-size: 1em;
            color: #333;
            margin-bottom: 5px;
        }

        /* Input and Select Styling */
        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
            outline: none;
        }

        /* Input Focus Styling */
        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus {
            border-color: #007bff;
        }

        /* Button Styling */
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Media Queries for Smaller Screens */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            h2 {
                font-size: 1.5em;
            }

            button {
                padding: 8px 16px;
            }
        }
    </style>
</head>

<body>
    <header> <?php include('../includess/header.php'); ?></header>

    <div class="container">
        <h2>Edit User</h2>

        <!-- Display messages -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php elseif (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>

        <?php endif; ?>

        <!-- Form to edit user -->
        <?php if (isset($user)): ?>

            <form action="edit-user.php?userid=<?php echo $user->id; ?>" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user->username); ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user->email); ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="fullname">Full Name:</label>
                    <input type="text" name="fullname" id="fullname" value="<?php echo htmlspecialchars($user->fullname); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" <?php echo htmlspecialchars($user->status) == '1' ? 'selected' : ''; ?>>Active</option>
                        <option value="0" <?php echo htmlspecialchars($user->status) == '0' ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" id="role" class="form-control">
                        <option value="Member" <?php echo $user->role == 'Member' ? 'selected' : ''; ?>>Member</option>
                        <option value="Admin" <?php echo $user->role == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="Librarian" <?php echo $user->role == 'Librarian' ? 'selected' : ''; ?>>Librarian</option>
                    </select>
                </div>


                <div class="form-group">
                    <button type="submit" name="update" class="btn btn-primary">Update User</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>