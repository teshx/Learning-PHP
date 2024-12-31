<?php
// Include database connection
include 'config/db.php';
$db = new Database();
$pdo = $db->connect();
// Initialize variables for filters
$search = $_GET['search'] ?? '';
$categoryFilter = $_GET['category'] ?? '';
$authorFilter = $_GET['author'] ?? '';

// Pagination Setup
$limit = 15; // Number of books per page
$page = isset($_GET['page']) ? max((int)$_GET['page'], 1) : 1; // Current page number
$offset = ($page - 1) * $limit; // Offset for SQL query

// Fetch category and author options for dropdowns
try {
    $categoryOptions = $pdo->query("SELECT id, name FROM category")->fetchAll(PDO::FETCH_ASSOC);
    $authorOptions = $pdo->query("SELECT id, name FROM author")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching filter options: " . $e->getMessage());
}

// Fetch filtered and paginated book details
try {
    $sql = "
    SELECT 
        book.id AS BookID,
        book.name AS BookName,
        category.name AS Category,
        author.name AS Author,
        book.image AS Image
    FROM 
        book
    JOIN category ON book.catID = category.id
    JOIN author ON book.authID = author.id
    WHERE 
        (book.name LIKE :search OR author.name LIKE :search OR category.name LIKE :search)
        AND (:category = '' OR book.catID = :category)
        AND (:author = '' OR book.authID = :author)
    LIMIT :limit OFFSET :offset";

    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->bindValue(':category', $categoryFilter, PDO::PARAM_INT);
    $stmt->bindValue(':author', $authorFilter, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get total book count for pagination
    $countSql = "
    SELECT COUNT(*) 
    FROM 
        book
    JOIN category ON book.catID = category.id
    JOIN author ON book.authID = author.id
    WHERE 
        (book.name LIKE :search OR author.name LIKE :search OR category.name LIKE :search)
        AND (:category = '' OR book.catID = :category)
        AND (:author = '' OR book.authID = :author)";

    $countStmt = $pdo->prepare($countSql);
    $countStmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $countStmt->bindValue(':category', $categoryFilter, PDO::PARAM_INT);
    $countStmt->bindValue(':author', $authorFilter, PDO::PARAM_INT);
    $countStmt->execute();
    $totalBooks = $countStmt->fetchColumn();

    $totalPages = ceil($totalBooks / $limit);
} catch (PDOException $e) {
    die("Error fetching book records: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">Library</div>
        <nav>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="./views/dashboard.php">Dashbord</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="./login">Login</a></li>
                <li><a href="./views/logout.php">logout</a></li>
            </ul>
        </nav>
        <div class="menu-toggle">☰</div> <!-- Menu toggle for mobile -->
    </header>

    <!-- Main Content -->
    <section class="home">
        <div class="overlay">
            <div class="content">
                <h1>Welcome to Our Library</h1>
                <p>Your gateway to unlimited knowledge and learning. Explore our collection of books, resources, and more.</p>
            </div>
        </div>
    </section>

    <!-- Book Table Section -->
    <section>
        <h1>Library Books</h1>

        <!-- Filters -->
        <form method="GET" action="">
            <div class="filters">
                <!-- Search Input with Button -->
                <div style="display: flex;">
                    <input
                        type="text"
                        name="search"
                        placeholder="Search by title or author..."
                        value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit">Search</button>
                </div>

                <!-- Dropdown Filters -->
                <select name="category" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <?php foreach ($categoryOptions as $category) { ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo $categoryFilter == $category['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php } ?>
                </select>

                <select name="author" onchange="this.form.submit()">
                    <option value="">All Authors</option>
                    <?php foreach ($authorOptions as $author) { ?>
                        <option value="<?php echo $author['id']; ?>" <?php echo $authorFilter == $author['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($author['name']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </form>

        <!-- Book Listing -->
        <div class="container">
            <?php if (!empty($books)) { ?>
                <?php foreach ($books as $book) { ?>
                    <a href="./display-catalog.php?id=<?php echo
                                                        htmlspecialchars($book['BookID']);  ?>">
                        <div class="book">
                            <img src="./views/dashbords/liberaryan/assets/bookImages/<?php echo htmlspecialchars($book['Image'] ?: 'default.jpg'); ?>" alt="<?php echo htmlspecialchars($book['BookName']); ?>">
                            <div class="book-title"><?php echo htmlspecialchars($book['BookName']); ?></div>
                            <div class="book-author">By: <?php echo htmlspecialchars($book['Author']); ?></div>
                        </div>
                    </a>

                <?php } ?>
            <?php } else { ?>
                <p>No books found.</p>
            <?php } ?>
        </div>
    </section>
    <div class="pagination">
        <?php if ($page > 1) { ?>
            <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>" class="prev">Previous</a>
        <?php } ?>

        <span>Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>

        <?php if ($page < $totalPages) { ?>
            <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>" class="next">Next</a>
        <?php } ?>
    </div>

    <!-- About Section -->
    <section id="about">
        <h2>About Us</h2>
        <p>Our library management system is designed to provide easy access to resources for students, faculty, and visitors.</p>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <h2>Contact Us</h2>
        <p>Have questions? Reach out to us at library@university.edu or call us at +123-456-7890.</p>
    </section>

    <script src="assets/scripts.js"></script>
</body>

</html>





