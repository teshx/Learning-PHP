<?php
require_once '../../../../config/db.php';
require_once '../controllers/editCategoryController.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management | Edit Category</title>
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header-line {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
            color: #333;
        }

        .content-wrapper {
            max-width: 900px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        .panel {
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            overflow: hidden;
        }

        .panel-heading {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            font-size: 18px;
            font-weight: bold;
        }

        .panel-body {
            padding: 20px;
        }

        form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .content-wrapper {
                padding: 15px;
            }

            .header-line {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <header> <?php include('../includes/header.php'); ?></header>
    <div class="content-wrapper">
        <h4 class="header-line">Edit Category</h4>
        <div class="panel">
            <div class="panel-heading">Category Info</div>
            <div class="panel-body">
                <form method="post" action="../controllers/editCategoryController.php">
                    <input type="hidden" name="catid" value="<?php echo $category->id; ?>">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="category" value="<?php echo htmlentities($category->name); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div>
                            <label>
                                <input type="radio" name="status" value="1" <?php echo ($category->status == 1) ? 'checked' : ''; ?>> Active
                            </label>
                        </div>
                        <div>
                            <label>
                                <input type="radio" name="status" value="0" <?php echo ($category->status == 0) ? 'checked' : ''; ?>> Inactive
                            </label>
                        </div>
                    </div>
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>