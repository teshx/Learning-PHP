<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sidebar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #3B3131;
            color: white;
            position: fixed;
            overflow-y: auto;
            transition: width 0.3s;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .sidebar .side-header {
            text-align: center;
            padding-top: 10px;
        }

        .sidebar hr {
            margin: 0 10px;
        }

        .sidebar .submenu {
            display: none;
            background-color: #2E2E2E;
            padding-left: 20px;
        }

        .submenu a {
            padding: 8px 10px;
        }

        .openbtn {
            margin: 10px;
            background-color: #3B3131;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .openbtn i {
            font-size: 18px;
        }

        #main {
            margin-left: 250px;
            padding: 10px;
            flex-grow: 1;
            transition: margin-left 0.3s;
        }

        .closebtn {
            font-size: 20px;
            font-weight: bold;
            padding: 5px;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #3B3131, #575757);
            color: white;
            border: 2px solid #FFD700;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .closebtn:hover {
            transform: scale(1.1);
            background: linear-gradient(135deg, #575757, #3B3131);
            color: #FFD700;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
        }

        .hidden {
            display: none;
        }

        .imges {
            border-radius: 50px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="mySidebar">
        <div class="side-header">
            <img src="../assets/img/user2.png" width="110" class="imges" height="90" alt="Swiss Collection">
            <h5 style="margin-top:10px;">Hello, Admin</h5>
        </div>

        <hr style="border:1px solid; background-color:#8a7b6d; border-color:#3B3131;">
        <a href="javascript:void(0)" class="closebtn" id="closeBtn" onclick="toggleSidebar()">&times;</a>
        <a href="./index.php"><i class="fa fa-home"></i> Dashboard</a>
        <a href="../../../../Home.php" onclick="toggleSubMenu('customersSubmenu')"><i class="fa fa-home"></i> HOME</a>

        <a href="./borrowing-history.php" onclick="toggleSubMenu('categorySubmenu')"><i class="fa fa-th-large"></i>borrowing-hisstory</a>

        <a href="./edit-profile.php" onclick="toggleSubMenu('sizesSubmenu')"><i class="fa fa-th"></i> Profile</a>

        <!-- <a href="#productsizes" onclick="toggleSubMenu('productSizesSubmenu')"><i class="fa fa-th-list"></i>Sizes</a>

        <a href="#products" onclick="toggleSubMenu('productsSubmenu')"><i class="fa fa-th"></i> Products</a>

        <a href="#orders" onclick="toggleSubMenu('ordersSubmenu')"><i class="fa fa-list"></i> Orders</a> -->

    </div>

    <div id="main">
        <button class="openbtn hidden" id="openBtn" onclick="toggleSidebar()"><i class="fa fa-bars"></i></button>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("mySidebar");
            const main = document.getElementById("main");
            const openBtn = document.getElementById("openBtn");
            const closeBtn = document.getElementById("closeBtn");

            if (sidebar.style.width === "0px" || sidebar.style.width === "") {
                sidebar.style.width = "250px";
                main.style.marginLeft = "250px";
                openBtn.classList.add("hidden");
                closeBtn.classList.remove("hidden");
            } else {
                sidebar.style.width = "0";
                main.style.marginLeft = "0";
                openBtn.classList.remove("hidden");
                closeBtn.classList.add("hidden");
            }
        }

        function toggleSubMenu(submenuId) {
            const submenu = document.getElementById(submenuId);
            const isVisible = submenu.style.display === 'block';

            const submenus = document.querySelectorAll('.submenu');
            submenus.forEach(menu => menu.style.display = 'none');

            if (!isVisible) {
                submenu.style.display = 'block';
            }
        }
    </script>

</body>

</html>