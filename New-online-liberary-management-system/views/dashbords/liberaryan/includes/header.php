<div class="navbar">
    <div class="logo">
        <img src="assets/img/logo.png" alt="Logo" />
    </div>

    <!-- Menu toggle for mobile -->
    <div class="menu-toggle">☰</div>

    <div class="navbar-menu">
        <ul class="menu-items">
            <li><a href="dashboard.php" class="active-item">DASHBOARD</a></li>
            <li><a href="dashboard.php" class="active-item">HOME</a></li>

            <li class="dropdown">
                <a href="#">Categories <i class="dropdown-arrow"></i></a>
                <ul class="dropdown-list">
                    <li><a href="./add_category.php">Add Category</a></li>
                    <li><a href="./manage-categories.php">Manage Categories</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#">Authors <i class="dropdown-arrow"></i></a>
                <ul class="dropdown-list">
                    <li><a href="./add-author.php">Add Author</a></li>
                    <li><a href="./manage-authors.php">Manage Authors</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#">Books <i class="dropdown-arrow"></i></a>
                <ul class="dropdown-list">
                    <li><a href="./addBook.php">Add Book</a></li>
                    <li><a href="manage-books.php">Manage Books</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#">Issue Books <i class="dropdown-arrow"></i></a>
                <ul class="dropdown-list">
                    <li><a href="issue-book.php">Issue New Book</a></li>
                    <li><a href="manage-issued-books.php">Manage Issued Books</a></li>
                </ul>
            </li>

            <li><a href="reg-students.php">LOGOUT</a></li>

        </ul>
    </div>
</div>


<script>
    // script.js

    // Mobile menu toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const navbarMenu = document.querySelector('.navbar-menu');
    const dropdownLinks = document.querySelectorAll('.dropdown > a');

    // Toggle the menu on mobile when the ☰ button is clicked
    menuToggle.addEventListener('click', () => {
        navbarMenu.classList.toggle('open');
    });

    // Dropdown behavior for mobile
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', (e) => {
            // Close other dropdowns
            dropdowns.forEach(otherDropdown => {
                if (otherDropdown !== dropdown) {
                    otherDropdown.classList.remove('open');
                }
            });
            // Toggle the current dropdown
            dropdown.classList.toggle('open');
            e.stopPropagation(); // Prevent the menu from closing immediately
        });
    });

    // Close the mobile menu when a link is clicked
    const links = document.querySelectorAll('.menu-items a');
    links.forEach(link => {
        link.addEventListener('click', () => {
            navbarMenu.classList.remove('open');
        });
    });
</script>