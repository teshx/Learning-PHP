<?php
session_start();
include_once "../../../../config/db.php";

$db = new Database();
$conn = $db->connect();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        /* header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
            font-size: 1.5rem;
        } */

        #main-content {
            margin-left: 20px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .col-sm-3 {
            flex: 0 0 calc(25% - 20px);
            box-sizing: border-box;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card i {
            color: #007bff;
            margin-bottom: 10px;
        }

        .card h4 {
            font-size: 1.2rem;
            color: #333;
            margin: 10px 0;
        }

        .card h5 {
            font-size: 1rem;
            color: #555;
        }

        @media (max-width: 768px) {
            .col-sm-3 {
                flex: 0 0 calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .col-sm-3 {
                flex: 0 0 100%;
            }
        }
    </style>
</head>

<body>
    <header>
        <?php include('../includes/headers.php'); ?>
    </header>

    <div id="main-content" class="container allContent-section py-4">
        <div class="row">
            <!-- Total Users -->
            

            <!-- Total Categories -->
            <div class="col-sm-3">
                <div class="card">
                    <i class="fa fa-th-large mb-2" style="font-size: 70px;"></i>
                    <h4>view borrowing history</h4>
                    
                </div>
            </div>

           

            <!-- Total Reserved Books -->
            <div class="col-sm-3">
                <div class="card">
                    <i class="fa fa-book mb-2" style="font-size: 70px;"></i>
                    <h4>Reserved</h4>
                   
                </div>
            </div>
        </div>
    </div>
</body>

</html>